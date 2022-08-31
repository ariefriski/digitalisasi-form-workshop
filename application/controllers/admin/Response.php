<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Response extends CI_Controller {

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
		$this->load->view('v_admin/responseAdmin');
		$this->load->view('v_admin/footer');
	}

	public function route()
	{
		$this->load->view('v_admin/header_dashboard/header');
		$this->load->view('v_admin/routeAdmin');
		$this->load->view('v_admin/footer');
	}

	public function onprocess()
	{
		$this->load->view('v_admin/header_dashboard/header');
		$this->load->view('v_admin/onProcessAdmin');
		$this->load->view('v_admin/footer');
	}
	

    public function order_list()
	{
		$list = $this->m_order->get_datatables_1();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $l) {
			if(($l->status_approval_1=='Disetujui')&&($l->approve1=='Done')&&($l->approve2==NULL)){
			$departmentName = $this->m_order->getDepartmentName($l->id_department);
			
			$view = '<a type="button" href="'.base_url() . 'admin/response/viewAcceptedResponse_r?id='.$l->id_order.'"  class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Response">
							<i class="fa fa-hand-o-up"></i>
						</a>';	
			
			$report = 		'<a type="button" href="'.base_url() . 'admin/dashboard/viewReportPaper?id='.$l->id_order.'"  class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Response">
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
					$row[] = 'waiting  ';
					$row[] = $view.$report;
					
					}
			}
			
			
			$data[] = $row;
		}
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

	public function order_list_route()
	{
		$list = $this->m_order->get_datatables_1();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $l) {
			if(((($l->kategori =='urgent')&&($l->approve3 !=NULL))||(($l->kategori =='biasa')&&($l->approve2 !=NULL)))&&($l->tempat_pembuatan ==NULL)){
			$departmentName = $this->m_order->getDepartmentName($l->id_department);
			
			$view = '<a type="button" href="'.base_url() . 'admin/response/viewAcceptedResponse_rr?id='.$l->id_order.'"  class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Response">
							<i class="fa fa-hand-o-up"></i>
						</a>';	
			
			$report = 		'<a type="button" href="'.base_url() . 'admin/dashboard/viewReportPaper?id='.$l->id_order.'"  class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Response">
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
					$row[] = 'waiting  ';
					$row[] = $view.$report;
					
					}
			}
			
			
			$data[] = $row;
		}
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

	public function process_list_route()
	{
		$list = $this->m_order->get_datatables_user();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $l) {
			if(($l->status_approval_1=='Disetujui')&&($l->status_approval_2=='Disetujui')&&($l->status_approval=='Disetujui')&&($l->tempat_pembuatan!=NULL)){
			$departmentName = $this->m_order->getDepartmentName($l->id_department);
			
			$view = '<a type="button" href="'.base_url() . 'admin/response/viewOnProcess?id='.$l->id_order.'"  class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Response">
							<i class="fa fa-hand-o-up"></i>
						</a>';	
			
			$report = 		'<a type="button" href="'.base_url() . 'admin/dashboard/viewReportPaper?id='.$l->id_order.'"  class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Response">
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
					$row[] = 'waiting  ';
					$row[] = $view.$report;
					
					}
			}
			
			
			$data[] = $row;
		}
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

}
?>