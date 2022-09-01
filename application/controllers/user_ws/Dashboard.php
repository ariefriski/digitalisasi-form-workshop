<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Dashboard extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_order');
		$this->load->model('m_login');
		$this->load->model('m_routing');
		$this->load->model('m_proses');
		$this->load->model('m_routing_actual');
		$this->load->model('m_material');
		$this->load->helper('url', 'form');
		$this->load->library('upload');
		if($this->session->userdata('user_ws_is_logged_in')=='') {
			$this->session->set_flashdata('msg','Please Login to Continue');
			redirect('login');
		}
    }

	public function index()
	{
		$this->load->view('v_user_ws/header_dashboard/header');
		$this->load->view('v_user_ws/dashboardUserWs');
		$this->load->view('v_user_ws/footer');
	}

	public function input_working_order()
	{
		$id_order = $this->input->get('id');

		$data['data']=$this->m_proses->selectMaterial();
		$data['routing_plan']=$this->m_routing->getDataRoutingPlan($id_order);
		
		$this->load->view('v_user/header');
		$this->load->view('v_form/form_input_working_order_by_operator',$data);
		$this->load->view('v_user/footer');
	}

	public function input_actual_process()
	{
		$id_order = $this->input->post('id_order');
		$id_proses = $this->input->post('arr_id_proses');
		$hour_proses = $this->input->post('arr_hour_proses');

		$arrIdProcess = explode(',', $id_proses);
		$arrHourProcess = explode(',', $hour_proses);

		for ($i=0; $i < count($arrIdProcess); $i++) { 
			$total_cost = $this->m_proses->getProcessById($arrIdProcess[$i]);
			$result = $arrHourProcess[$i] * $total_cost[0]['total_cost'];

			$data = array(
				'id_order'=>$id_order,
				'id_proses' => $arrIdProcess[$i],
				'hour'=> $arrHourProcess[$i],
				'actual_cost_process'=>$result
			);
			$this->m_routing_actual->inputRoutimeActual($data);
		}

		redirect(site_url('user_ws/dashboard/'));
	}
	
	public function order_list()
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
			$row[] = '<a href="'.base_url() . 'user_ws/dashboard/input_working_order?id='.$l->id_order.'" type="button" class="btn btn-sm btn-secondary">
						<i class="fa fa-pencil"></i>
					</a>';

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

