<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model('m_login');
        $this->load->model('m_order');
		$this->load->model('m_routing');
		$this->load->model('m_proses');
		$this->load->model('m_approval');
		$this->load->helper('url', 'form');
		$this->load->library('upload');
		
		if($this->session->userdata('admin_ws_is_logged_in')=='') {
			$this->session->set_flashdata('msg','Please Login to Continue');
			redirect('login');
		}

    }

	
	public function index()
	{
		$this->load->view('v_admin/header_dashboard/header');
		$this->load->view('v_admin/dashboardAdmin');
		$this->load->view('v_admin/footer');
	}

	public function resultroute()
	{
		$this->load->view('v_admin/header');
		$this->load->view('v_admin/form_table');
		$this->load->view('v_admin/footer');
	}

	public function IO()
	{
		//
		$data['columnTitle'] = $this->m_proses->showDatabaseProcess();
		$this->load->view('v_admin/header');
		$this->load->view('v_admin/input_order',$data);
		$this->load->view('v_admin/footer');
	}
	
	
	public function response()
	{
		$this->load->view('v_admin/header');
		$this->load->view('v_form/form_response');
		$this->load->view('v_admin/footer');
	}
	public function test()
	{
		$this->load->view('v_form/header');
		$this->load->view('v_admin/input_order');
		$this->load->view('v_form/footer');
	}

	public function order_list()
	{
		$list = $this->m_order->get_datatables_1();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $l) {
			if(($l->status_approval_1=='Disetujui')&&($l->approve1==NULL)){
			$departmentName = $this->m_order->getDepartmentName($l->id_department);
			
			$view = '<a type="button" href="'.base_url() . 'admin/dashboard/viewAcceptedResponse?id='.$l->id_order.'"  class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Response">
							<i class="fa fa-hand-o-up"></i>
						</a>';	
							
			$no++;
			$tanggal = date_create($l->tanggal);
			$row = array();
			if($l->status_approval_1=='Disetujui'){
				foreach($departmentName as $d){
					$row[] = $no;
					$row[] = $l->nama_part;
					$row[] = date_format($tanggal,"d/m/Y");
					$row[] = date_format($tanggal,"H:i");
					if ($l->kategori == 'urgent'){
						$row[] = '<span class="badge badge-danger">urgent</span>';
					}else if ($l->kategori == 'biasa'){
						$row[] = '<span class="badge badge-warning">biasa</span>';
					}
					$row[] = $d['department_name'];
					
					$row[] = $l->status_pengerjaan;
					$row[] = 'waiting  ';
					$row[] = $view;
					
					}
			}
			
			
			$data[] = $row;
		}
		}
		
		$output = array(
						"recordsTotal" => $this->m_order->count_all(),
						"recordsFiltered" => $this->m_order->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function viewAcceptedResponse()
	{
		$id = $this->input->get('id');
		$data['accept_response'] = $this->m_order->getResponseOrder($id);
		$data['get_Routing'] = $this->m_routing->selectRouting();
		$this->load->view('v_admin/header');
		$this->load->view('v_admin/form_response',$data);
		$this->load->view('v_admin/footer');
	}

	public function viewReportPaper()
	{
		$id = $this->input->get('id');
		$data['report'] = $this->m_proses->getReportPaper($id);
		$data['processing'] = $this->m_proses->getRoutingPlan($id);
		$data['total'] = $this->m_proses->totalALL($id);
		$this->load->view('v_admin/report',$data);
	}

	public function inputOrder()
	{
		//$id = $this->input->get('id');
		$ordercheck = $this->input->post('inputorder');
		$hour = $this->input->post('hour');
		$id_order = $this->input->post('id_order');
		// $no_order = $this->input->post('no_order');
		$response_order = $this->input->post('response_order');
		$total_hour = 0;
		$total = 0;
		for ($i=0;$i< sizeof($ordercheck);$i++)
		{
			$total_cost = $this->m_proses->getProcessById($ordercheck[$i]);
			$result = $hour[$i] * $total_cost[0]['total_cost'];
			$total += $result;
			$total_hour += $hour[$i];
			$data = array(
				'id_proses' => $ordercheck[$i],
				'hour'=> $hour[$i],
				'id_order'=>$id_order,
				'estimate_cost_process'=>$result
			);
			 $this->m_proses->addInputOrder($data);
			 
			
		}
		$total_cost_material = $this->m_routing->getTotalCostMaterialByIdOrder($id_order);
		$total_all = $total + $total_cost_material[0]['total_cost_material'];
		$this->m_routing->updateEstimateRouting($id_order,$total,$total_all,$total_hour,$response_order);
		
		redirect(site_url('admin/dashboard/'));
	}

	public function acceptPIC()
	{
		$id_order = $this->input->post('id_order');
		$id_user = $this->session->userdata('id_user');
		$approve = $this->input->post('pic_response');
		$alasan = $this->input->post('alasan');
		$jenis_approval = $this->session->userdata('level');
		$tanggal = "%Y-%M-%d %H:%i";
		$approve1 = 'Done';
		if ($approve == 'accept'){
			$status_approval = 'Disetujui';
		}else if ($approve == 'reject'){
			$status_approval = 'Ditolak';
		}
		$data =array(
			'id_order'=>$id_order,
			'id_user'=>$id_user,
			'status_approval_2'=>$status_approval,
			'tanggal'=>mdate($tanggal),
			'alasan_2'=>$alasan,
			'jenis_approval'=>$jenis_approval
		);

		$update = array(
			'approve1'=>$approve1
		);
		

		$this->m_approval->addApprovalPic($data);
		$this->m_approval->updateApprovalPic($id_order,$update);
		redirect(site_url('admin/dashboard/'));
	}
	
	public function routingList()
	{
		$list = $this->m_proses->get_datatables_routing_plan();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $l) {	
			$no++;
			
			$row = array();
			
			$row[] = $l->nama_part;
			$row[] = $l->id_order;
			$row[] = $l->tempat_pembuatan;
			$row[] = $l->nama_material;
			$row[] = $l->total_cost_material;
			$row[] = $l->total_cost_process;
			$row[] = $l->total_all;
			$row[] = '<a type="button" href="'.base_url() . 'admin/dashboard/detailResultRoute?id='.$l->id_order.'" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View">
							<i class="fa fa-eye"></i>
						</a>';
			
			$data[] = $row;
			
		}
		
		$output = array(
						//"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_proses->count_all(),
						"recordsFiltered" => $this->m_proses->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function detailResultRoute()
	{
		$id_order = $this->input->get('id');

		$dataRoutingPlan = $this->m_order->getOrderById($id_order);
		$detailDataRoutingPlan = $this->m_routing->getDataRoutingPlan($id_order);

		$data['dataRoutingPlan'] = $dataRoutingPlan;
		$data['detailDataRoutingPlan'] = $detailDataRoutingPlan;

		$this->load->view('v_admin/header');
		$this->load->view('v_admin/viewDetailResultRoute',$data);
		$this->load->view('v_admin/footer');
	}

	public function inputList()
	{
		$list = $this->m_proses->get_datatables_1();
		$data = array();
		$no = $_POST['start'];
		$i = 0;
		foreach ($list as $l) {
			
			$no++;
			$row = array();
			
			$tanggal = date_create($l->tanggal);
			$row[] = date_format($tanggal,"d/m/Y");
			//Urgent
			
			$row[] = $l->kategori;
			$row[] = $l->id_order;
			$row[] = $l->name;
			$row[] = $l->department_name;
			$row[] = $l->nama_part;
			$row[] = $l->jumlah;			
			$row[] = $l->nama_material;			  
			$row[] = $l->order_type;
			$row[] = $l->status_pengerjaan;
			$row[] = 'Rp '.number_format($l->total_cost_material, 0, ',', '.');
			$row[] = 'Rp '.number_format($l->total_cost_process, 0, ',', '.');
			$row[] = 'Rp '.number_format($l->total_all, 0, ',', '.');
			
			
			$columnTitle = $this->m_proses->showDatabaseProcess();
			$idOrder = $this->m_proses->getIdOrderProcess();
                
			foreach ($columnTitle as $ct) {
				$detailProcess = $this->m_proses->getDataProcessing($idOrder[$i]['id_order'],$ct['id_proses']);
				if(!empty($detailProcess[0]['hour'])) {
					$row[] = $detailProcess[0]['hour'];
				} else {
					$row[]= "-";
				}
				
			}
			$row[] = $l->total_hour;
			// $row[] = $l->total_actual;
			$data[] = $row;
			$i++;
		}
		
		$output = array(
						//"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_proses->count_all(),
						"recordsFiltered" => $this->m_proses->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

}
