<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Response extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model('m_login');
        $this->load->model('m_order');
		$this->load->model('m_routing');
		$this->load->model('m_routing_actual');
		$this->load->model('m_proses');
		$this->load->model('m_user');
		$this->load->model('m_approval');
		$this->load->helper('url', 'form');
		$this->load->library('upload');
		$this->load->database();  
		if($this->session->userdata('admin_ws_is_logged_in')=='') {
			$this->session->set_flashdata('msg','Please Login to Continue');
			redirect('login');
		}

    }

    public function index()
	{
		$this->load->view('v_admin/header_dashboard/header');
		$this->load->view('v_admin/responseAdmin');
		$this->load->view('v_admin/footer');
	}

	public function finish()
	{
		$this->load->view('v_admin/header_dashboard/header');
		$this->load->view('v_admin/finishListAdmin');
		$this->load->view('v_admin/footer');
	}

	public function waitingworking()
	{
		$this->load->view('v_admin/header_dashboard/header');
		$this->load->view('v_admin/waitWorking');
		$this->load->view('v_admin/footer');
	}
	public function working()
	{
		$this->load->view('v_admin/header_dashboard/header');
		$this->load->view('v_admin/onWorkingAdmin');
		$this->load->view('v_admin/footer');
	}

	public function onprocess()
	{
		
		$this->load->view('v_admin/header_dashboard/header');
		$this->load->view('v_admin/onProcessAdmin');
		$this->load->view('v_admin/footer');
	}

	public function route()
	{
		$this->load->view('v_admin/header_dashboard/header');
		$this->load->view('v_admin/routeAdmin');
		$this->load->view('v_admin/footer');
	}

	public function getSection()
	{
		$id_department = $this->input->post('id_department');
		$section = $this->m_user->getNameSection($id_department);

		echo '
			<br>
			<label for="id_section">Section</label>
			<select class="form-control" id="id_section" name="id_section">
				<option value="" selected disabled>Please select</option>';
					foreach ($section as $sect) {
						echo '
							<option value="'.$sect['id_section'].'">'.$sect['section_name'].'</option>
						';
					}
		echo '</select>';

	}

	

    public function order_list()
	{
		$list = $this->m_order->get_datatables_1();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $l) { //&&($l->status_approval!='Ditolak')
			if(($l->status_approval_1=='Disetujui')&&($l->status_approval_2=='Disetujui')&&((($l->kategori=='urgent')&&(($l->approve4==NULL)))||(($l->kategori=='biasa')&&(($l->approve3==NULL))))&&($l->status_pengerjaan=='WAITING')){
			$departmentName = $this->m_order->getDepartmentName($l->id_department);
			$view = '<a type="button" href="'.base_url() . 'admin/response/viewAcceptedResponse_r?id='.$l->id_order.'"  class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Response">
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
					$row[] = $view;
					
					}
			}
			
			
			$data[] = $row;
		}
		}
		
		$output = array(
						//"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_order->count_all_admin_ws_wait_aprove(),
						"recordsFiltered" => $this->m_order->count_filtered_admin_ws_wait_aprove(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function order_list_route()
	{
		$list = $this->m_order->get_datatables_1();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $l) {
			if(((($l->kategori =='urgent')&&($l->approve4 !=NULL))||(($l->kategori =='biasa')&&($l->approve3 !=NULL)))&&($l->tempat_pembuatan == NULL)){
			$departmentName = $this->m_order->getDepartmentName($l->id_department);
			
			$view = '<a type="button" href="'.base_url() . 'admin/response/viewAcceptedResponse_rr?id='.$l->id_order.'"  class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Response">
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
					$row[] = $view;
					
					}
			}
			
			
			$data[] = $row;
		}
		}
		
		$output = array(
						//"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_order->count_all_admin_ws_input(),
						"recordsFiltered" => $this->m_order->count_filtered_admin_ws_input(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function process_list_route()
	{
		$list = $this->m_order->get_datatables_1();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $l) {
			if(($l->status_approval_1=='Disetujui')&&($l->status_approval_2=='Disetujui')&&($l->status_approval=='Disetujui')&&($l->tempat_pembuatan!=NULL)&&($l->total_day==NULL)){//
			$departmentName = $this->m_order->getDepartmentName($l->id_department);
			
			$view = '<a type="button" href="'.base_url() . 'admin/response/viewOnProcess?id='.$l->id_order.'"  class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Response" >
							<i class="fa fa-hand-o-up"></i>
						</a>';	
			
			$report = 	'<a type="button" href="'.base_url() . 'admin/dashboard/viewReportPaperPlan?id='.$l->id_order.'"  class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Response" >
							<i class="fa fa-save"></i>
						</a>';
			
			$schedulling = '<a type="button" href="#modal-jadwal" class="btn btn-sm btn-secondary id-jadwal" data-toggle="modal" data-id="'.$l->id_order.'">
								<i class="si si-calendar"></i>
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
					$row[] = $view.$report.$schedulling;
					
					}
			}
			
			
			$data[] = $row;
		}
		}
		
		$output = array(
						//"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_order->count_all_admin_ws_schedulling(),
						"recordsFiltered" => $this->m_order->count_filtered_admin_ws_schedulling(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function finish_list()
	{
		$list = $this->m_order->get_datatables_1();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $l) {
			if($l->status_pengerjaan == 'Finish'){//
			$departmentName = $this->m_order->getDepartmentName($l->id_department);
			
			$report = 	'<a type="button" href="'.base_url() . 'admin/dashboard/viewReportPaperPlan?id='.$l->id_order.'"  class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Report Plan" >
							<i class="fa fa-save"></i>
						</a>';
			
			$report2 = 	'<a type="button" href="'.base_url() . 'admin/dashboard/viewReportPaperActual?id='.$l->id_order.'"  class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Report Actual" >
							<i class="fa fa-save"></i>
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
					$row[] = $report.$report2;
					
					}
			}
			
			
			$data[] = $row;
		}
		}
		
		$output = array(
						//"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_order->count_all_admin_ws_finish(),
						"recordsFiltered" => $this->m_order->count_filtered_admin_ws_finish(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function waiting_working()
	{	
		$list = $this->m_order->get_datatables_1();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $l) {
			if($l->status_pengerjaan == 'On Scheduling'){//
			$departmentName = $this->m_order->getDepartmentName($l->id_department);
			
			$view = '<a type="button" href="'.base_url() . 'admin/response/viewOnProcess?id='.$l->id_order.'"  class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Response" >
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
					$row[] = $l->total_day;	
					if ($l->kategori == 'urgent'){
						$row[] = '<span class="badge badge-danger">urgent</span>';
					}else if ($l->kategori == 'biasa'){
						$row[] = '<span class="badge badge-warning">biasa</span>';
					}
					$row[] = $d['department_name'];
					
					$row[] = $l->status_pengerjaan;
				
					
					
					}
			}
			
			
			$data[] = $row;
		}
		}
		
		$output = array(
						//"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_order->count_all_admin_ws_waiting_for_working(),
						"recordsFiltered" => $this->m_order->count_filtered_admin_ws_waiting_for_working(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}


	public function working_list()
	{
		$list = $this->m_order->get_datatables_1();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $l) {
			if(($l->status_pengerjaan == 'On Working')){//
			$departmentName = $this->m_order->getDepartmentName($l->id_department);
			
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
					
					}
			}
			
			
			$data[] = $row;
		}
		}
		
		$output = array(
						//"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_order->count_all_admin_ws_working(),
						"recordsFiltered" => $this->m_order->count_filtered_admin_ws_working(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	
	public function viewAcceptedResponse_r()
	{
		$id = $this->input->get('id');
		$data['accept_response'] = $this->m_order->getResponseOrder($id);
		$data['get_Routing'] = $this->m_routing->selectRouting();
		$this->load->view('v_admin/header');
		$this->load->view('v_admin/form_response_r',$data);
		$this->load->view('v_admin/footer');
	}

	public function viewAcceptedResponse_rr()
	{
		$id = $this->input->get('id');
		$data['accept_response'] = $this->m_order->getResponseOrder($id);
		$data['get_Routing'] = $this->m_routing->selectRouting();
		$this->load->view('v_admin/header');
		$this->load->view('v_admin/form_response_rr',$data);
		$this->load->view('v_admin/footer');
	}

	public function viewOnProcess()
	{
		$id = $this->input->get('id');
		$data['accept_response'] = $this->m_order->getResponseOrder($id);
		$data['get_Routing'] = $this->m_routing->selectRouting();
		$this->load->view('v_admin/header');
		$this->load->view('v_admin/viewOnProcess',$data);
		$this->load->view('v_admin/footer');
	}

	function addJadwal()
	{
		$jadwal = $this->input->post('daterange');
		$id_order = $this->input->post('id_order');
		$dates = explode(" - ", $jadwal);
		$start= mdate($dates[0]);
		$end= mdate($dates[1]);
		$start_date = new DateTime($start);
		$end_date = new DateTime($end);
		$update_status_pengerjaan = 'On Scheduling';
		$data = array(
			'id_order'=>$id_order,
			'start_date'=>$start,
			'end_date'=>$end,
			'total_day'=>$start_date->diff($end_date)->format("%d")
		);		

		

		
		$this->m_proses->addJadwal($data);
		$this->m_proses->updatePengerjaan($id_order,$update_status_pengerjaan);
		redirect(site_url('admin/response/onprocess'));
	}


	function chartRunningHourMachine()
	{
		$data['running_hour'] = $this->m_routing_actual->tableRunningHour();

		$this->load->view('v_admin/chart/HighChart', $data); 

	}

	function chartRunningCost()
	{
		$data['running_cost'] = $this->m_routing_actual->tableRunningCost();

		$this->load->view('v_admin/chart/runningCost', $data); 
	}

	function chartTotalRunningCost()
	{
		$data['running_total_cost'] = $this->m_routing_actual->tableTotalRunningCost();

		$this->load->view('v_admin/chart/runningCostTotal', $data); 
	}

	function quantityJobOrder()
	{
		$data['quantity_job_order'] = $this->m_routing_actual->quantityJobOrder();

		$this->load->view('v_admin/chart/quantityJob', $data); 
	}

	function quantityOrderType()
	{
		$data['quantity_order_type'] = $this->m_routing_actual->jobOrder();

		$this->load->view('v_admin/chart/orderType', $data); 
	}

	function pieChart()
	{
		foreach($this->m_routing_actual->pieChart()->result_array() as $row)
		{ 
			$data[] = array(
			'hasil' => $row['hasil'],
			'total' => $row['total']
			);    
		} 

  		echo json_encode($data);  

		//$this->load->view('v_admin/pieChart');
   }

   function grafik()
   {
		$this->load->view('v_admin/chart/pieChart');
   }
	
}


?>