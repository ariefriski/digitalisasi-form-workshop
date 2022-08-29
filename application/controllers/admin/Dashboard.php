<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_order');
		$this->load->model('m_routing');
		$this->load->model('m_proses');
		$this->load->helper('url', 'form');
		$this->load->library('upload');
		$this->load->model('m_login');
		if($this->session->userdata('admin_is_logged_in')=='') {
			$this->session->set_flashdata('msg','Please Login to Continue');
			redirect('login');
		}

    }

	
	public function index()
	{
		
		$this->load->view('v_admin/header');
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
			$departmentName = $this->m_order->getDepartmentName($l->id_department);
			$delete = '	<a id="id-delete" name="delete" href="#"  class="btn btn-sm btn-secondary item_delete" data-toggle="tooltip" title="Delete">
							  <i class="fa fa-times"></i>
						</a>';
			
			
			$view = '<a type="button" href="'.base_url() . 'admin/dashboard/viewAcceptedResponse?id='.$l->id_order.'"  class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Response">
							<i class="fa fa-hand-o-up"></i>
						</a>';	
			
			$report = 		'<a type="button" href="'.base_url() . 'admin/dashboard/viewReportPaper?id='.$l->id_order.'"  class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Response">
							<i class="fa fa-save"></i>
						</a>';	
			// '.base_url() . 'user/dashboard/viewResponseOrder?id='.$l->id_order.'
		
			// if ($l->status_laporan == 'Disetujui'){
			// 	$delete = '	<a id="id-delete" name="delete" href="#" style="width:13%;" class="btn btn-sm btn-secondary item_delete" data-toggle="tooltip" title="Delete">
			// 				  <i class="fa fa-times"></i>
			// 			</a>';
			// }else{
			// $delete = '	<a id="id-delete" name="delete" href="'.base_url() . 'user/dashboard/deleteOrder?id='.$l->id_order.'" style="width:13%;" class="btn btn-sm btn-secondary item_delete" data-toggle="tooltip" title="Delete">
			// 				  <i class="fa fa-times"></i>
			// 			</a>';
			// }			
				
			$no++;
			$tanggal = date_create($l->tanggal);
			$row = array();
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
			$row[] = $view.$delete.$report;
			
			}
			
			$data[] = $row;
			
		}
		
		$output = array(
						//"draw" => $_POST['draw'],
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
		$this->load->view('v_form/form_response',$data);
		$this->load->view('v_admin/footer');
	}

	public function viewReportPaper()
	{
		$id = $this->input->get('id');
		$data['report'] = $this->m_proses->getReportPaper($id);
		$data['processing'] = $this->m_proses->getProcessing($id);
		$this->load->view('v_admin/report',$data);
	}

	

	
	public function inputOrder()
	{
		//$id = $this->input->get('id');
		$ordercheck = $this->input->post('inputorder');
		$hour = $this->input->post('hour');
		$id_order = $this->input->post('id_order');
		$no_order = $this->input->post('no_order');
		$response_order = $this->input->post('response_order');
		$total = 0;
		for ($i=0;$i< sizeof($ordercheck);$i++)
		{
			$total_cost = $this->m_proses->getProcessById($ordercheck[$i]);
			$result = $hour[$i] * $total_cost[0]['total_cost'];
			$total += $result;
			$data = array(
				'id_proses' => $ordercheck[$i],
				'hour'=> $hour[$i],
				'id_order'=>$id_order,
				'estimate_cost_process'=>$result
			);
			// $this->m_order->updateOrderNoPict($id_order,$data2);
			 $this->m_proses->addInputOrder($data);
			 
			
		}
		$total_cost_material = $this->m_routing->getTotalCostMaterialByIdOrder($id_order);
		$total_all = $total + $total_cost_material[0]['total_cost_material'];
		$this->m_routing->updateEstimateRouting($id_order,$total,$total_all);
		
		redirect(site_url('admin/dashboard/'));
		//Tambah Sintaks Update No Order
	}
	
	public function table()
	{
		
		$this->load->view('v_form/form_table');
		
	}

	public function testing()
	{
		// $data['ambil'] = $this->m_proses->
		$data['test'] = $this->m_proses->testing();
		$this->load->view('v_form/test',$data);
	}

	public function routingList()
	{
		$list = $this->m_proses->get_datatables_1();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $l) {		
		
			// '.base_url() . 'user/dashboard/viewResponseOrder?id='.$l->id_order.'
		
			// if ($l->status_laporan == 'Disetujui'){
			// 	$delete = '	<a id="id-delete" name="delete" href="#" style="width:13%;" class="btn btn-sm btn-secondary item_delete" data-toggle="tooltip" title="Delete">
			// 				  <i class="fa fa-times"></i>
			// 			</a>';
			// }else{
			// $delete = '	<a id="id-delete" name="delete" href="'.base_url() . 'user/dashboard/deleteOrder?id='.$l->id_order.'" style="width:13%;" class="btn btn-sm btn-secondary item_delete" data-toggle="tooltip" title="Delete">
			// 				  <i class="fa fa-times"></i>
			// 			</a>';
			// }			
				
			$no++;
			
			$row = array();
			// $rl['status']; foreach($routingList as $rl){	
			//PartName			
			
			//Total
			
			$row[] = $l->nama_part;
			$row[] = $l->id_order;
			$row[] = $l->tempat_pembuatan;
			$row[] = $l->nama_material;
			$row[] = $l->total_cost_material;
			$row[] = $l->total_cost_process;
			$row[] = $l->total_all;
			
			// $row[] = $l->total;
			// $row[] = $l->total;
			// $row[] = '???';
			// $row[] = 'design';
			// $row[] = '???';
			// $row[] = 'CAM';
			
			// $row[] = $l->MANUAL;
			// $row[] = 'Manual';
			// $row[] = $l->CNC;
			// $row[] = 'CNC';
			// $row[] = $l->MILLING;
			// $row[] = 'Milling';
			// $row[] = $l->BUBUT;
			// $row[] = 'Bubut';
			// $row[] = $l->GRINDING;
			// $row[] = 'Grinding';
			// $row[] = $l->SAWING;
			// $row[] = 'Saw';
			// $row[] = $l->DRILLING;
			// $row[] = 'Drilling';
			// $row[] = $l->MANMACHINING;
			// $row[] = 'Man.Machining';
			// $row[] = $l->WELDING;
			// $row[] = 'Welding';
			// $row[] = $l->MANFABRIKASI;
			// $row[] = 'Man.Fabrikasi';
			// $row[] = 'Inspeksi';
			// $row[] = '???';
			// }
			// foreach($routingLiz as $rl){
			// 	$row[] = $rl['hour'];
			// 	$row[] = $rl['nama_proses'];
			// }
			// $row[] = $l->total_actual;
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
			$row[] = $l->price_kg;
			
			
			$columnTitle = $this->m_proses->showDatabaseProcess();
			$idOrder = $this->m_proses->getIdOrderProcess();
                
			// foreach ($columnTitle as $ct) {
			// 	$detailProcess = $this->m_proses->getDataProcessing($idOrder[$i]['id_order'],$ct['id_proses']);
			// 	if(!empty($detailProcess[0]['hour'])) {
			// 		$row[] = $detailProcess[0]['hour'];
			// 	} else {
			// 		$row[]= "-";
			// 	}
			// }
			$row[] = $l->total_actual;
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
