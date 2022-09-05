<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Response extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_order');
		$this->load->model('m_login');
		$this->load->model('m_routing');
		$this->load->model('m_proses');
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
		$this->load->view('v_user_ws/onProcessUserWs');
		$this->load->view('v_user_ws/footer');
	}

	public function finish()
	{
		$this->load->view('v_user_ws/header_dashboard/header');
		$this->load->view('v_user_ws/finishListUserWs');
		$this->load->view('v_user_ws/footer');
	}

    public function order_list()
	{	
		$list = $this->m_order->get_datatables_1();
		$data = array();
		$no = $_POST['start'];
		$i = 0;
		foreach ($list as $l) {
			if($l->status_pengerjaan == 'On Working'){
			$no++;
			$row = array();
			
			$tanggal = date_create($l->tanggal);
			// $row[] = date_format($tanggal,"d/m/Y");
			//Urgent
			
			$row[] = $l->kategori;
			$row[] = $l->id_order;
			$row[] = $l->nama_part;
			$row[] = $l->start_date;
			$row[] = $l->end_date;
			$row[] = '<a href="'.base_url() . 'user_ws/dashboard/input_working_order?id='.$l->id_order.'" type="button" title="Selesai" class="btn btn-success mr-5 mb-5">
						<i class="fa fa-check"></i>
					  </a>';
			$data[] = $row;
			$i++;
		}
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

	public function finish_list()
	{	
		$list = $this->m_order->get_datatables_1();
		$data = array();
		$no = $_POST['start'];
		$i = 0;
		foreach ($list as $l) {
			if($l->status_pengerjaan == 'Finish'){
			$no++;
			$row = array();
			
			$tanggal = date_create($l->tanggal);
			// $row[] = date_format($tanggal,"d/m/Y");
			//Urgent
			
			$row[] = $l->kategori;
			$row[] = $l->id_order;
			$row[] = $l->nama_part;
			$row[] = $l->start_date;
			$row[] = $l->end_date;
			$row[] = $l->status_pengerjaan;
			// $row[] = '<a href="'.base_url() . 'user_ws/dashboard/input_working_order?id='.$l->id_order.'" type="button" title="Selesai" class="btn btn-success mr-5 mb-5">
			// 			<i class="fa fa-check"></i>
			// 		  </a>';
			$data[] = $row;
			$i++;
		}
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
?>