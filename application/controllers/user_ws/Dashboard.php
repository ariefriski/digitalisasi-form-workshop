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
		$update_status_pengerjaan = 'Finish';
		$total_hour = 0;
		$total = 0;
		for ($i=0; $i < count($arrIdProcess); $i++) { 
			$total_cost = $this->m_proses->getProcessById($arrIdProcess[$i]);
			$result = $arrHourProcess[$i] * $total_cost[0]['total_cost'];
			$total += $result;
			$total_hour += $arrHourProcess[$i];
			$data = array(
				'id_order'=>$id_order,
				'id_proses' => $arrIdProcess[$i],
				'hour'=> $arrHourProcess[$i],
				'actual_cost_process'=>$result
			);
			$this->m_routing_actual->inputRoutimeActual($data);
		}
		$total_cost_material = $this->m_routing->getTotalCostMaterialByIdOrder($id_order);
		$total_all = $total + $total_cost_material[0]['total_cost_material'];

		$data2 = array(
			'id_order'=>$id_order,
			'total_cost_process'=>$total,
			'total_all'=>$total_all,
			'total_hour'=>$total_hour
		);
		$this->m_routing_actual->inputDetailActualRouting($data2);
		$this->m_proses->updatePengerjaan($id_order,$update_status_pengerjaan);


		redirect(site_url('user_ws/dashboard/'));
	}
	
	public function order_list()
	{	
		$list = $this->m_order->get_datatables_1();
		$data = array();
		$no = $_POST['start'];
		$i = 0;
		foreach ($list as $l) {
			if($l->status_pengerjaan == 'On Scheduling'){
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
			$work = '<a href="'.base_url() . 'user_ws/dashboard/startProcess?id='.$l->id_order.'" type="button" title="Kerjakan" class="btn btn-sm btn-secondary">
						<i class="si si-clock"></i>
					</a>';

			$detail_order = '<a href="'.base_url() . 'user_ws/dashboard/viewOnProcess?id='.$l->id_order.'" type="button" title="Lihat Detail" class="btn btn-sm btn-secondary">
								<i class="fa fa-eye"></i>
							</a>';

	

			$row[] = $work.$detail_order;		
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

	public function startProcess()
	{
		$id_order = $this->input->get('id');
		$update_status_pengerjaan = 'On Working';
		$this->m_proses->updatePengerjaan($id_order,$update_status_pengerjaan);

		redirect(site_url('user_ws/response/'));
	}

	public function viewOnProcess()
	{
		$id = $this->input->get('id');
		$data['accept_response'] = $this->m_order->getResponseOrder($id);
		$data['get_Routing'] = $this->m_routing->selectRouting();
		$data['data']=$this->m_proses->selectMaterial();
		$data['routing_plan']=$this->m_routing->getDataRoutingPlan($id);
		$this->load->view('v_user_ws/header');
		$this->load->view('v_user_ws/viewOnProcess',$data);
		$this->load->view('v_user_ws/footer');
	}

}

