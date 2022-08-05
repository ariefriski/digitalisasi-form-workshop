<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_order');
		$this->load->model('m_routing');
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

	public function inputorder()
	{
		$this->load->view('v_admin/header');
		$this->load->view('v_admin/input_order');
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
		$list = $this->m_order->get_datatables();
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
			$date = date_create($l->jam);
			$row = array();
			foreach($departmentName as $d){
			$row[] = $no;
			$row[] = $l->nama_part;
			$row[] = $l->tanggal;
			$row[] = date_format($date,"H:i");
			if ($l->kategori == 'urgent'){
				$row[] = '<span class="badge badge-danger">urgent</span>';
			}else if ($l->kategori == 'biasa'){
				$row[] = '<span class="badge badge-warning">biasa</span>';
			}
			$row[] = $d['department_name'];
			$row[] = $l->status_laporan;
			$row[] = $l->status_pengerjaan;
			$row[] = $view.$delete;
			
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
		$this->load->view('v_admin/header');
		$this->load->view('v_form/form_response',$data);
		$this->load->view('v_admin/footer');
	}

	

	public function addNomorOrder()
	{
		$id = $this->input->get('id');
		$no_order = $this->input->post('no_order');
		$response_order = $this->input->post('response_order');
		$routing_item_1 = $this->input->post('routing_item_1');
		$hour_1 = $this->input->post('hour_1');
		$routing_item_2 = $this->input->post('routing_item_2');
		$hour_2 = $this->input->post('hour_2');
		$routing_item_3 = $this->input->post('routing_item_3');
		$hour_3 = $this->input->post('hour_3');
		$routing_item_4 = $this->input->post('routing_item_4');
		$hour_4 = $this->input->post('hour_4');
		$routing_item_5 = $this->input->post('routing_item_5');
		$hour_5 = $this->input->post('hour_5');
		$routing_item_6 = $this->input->post('routing_item_6');
		$hour_6 = $this->input->post('hour_6');
		$routing_item_7 = $this->input->post('routing_item_7');
		$hour_7 = $this->input->post('hour_7');
		$routing_item_8 = $this->input->post('routing_item_8');
		$hour_8 = $this->input->post('hour_8');
		$routing_item_9 = $this->input->post('routing_item_9');
		$hour_9 = $this->input->post('hour_9');
		$routing_item_10 = $this->input->post('routing_item_10');
		$hour_10 = $this->input->post('hour_10');
		
		$id_order = $this->input->post('id_order');
		
		$data =array(
			'no_order'=>$no_order
			
		);

		$data1 = array(
			'id_order' => $id_order,
			'routing_plan1'=>$routing_item_1,
			'hour_1'=>$hour_1,
			'routing_plan2'=>$routing_item_2,
			'hour_2'=>$hour_2,
			'routing_plan3'=>$routing_item_3,
			'hour_3'=>$hour_3,
			'routing_plan4'=>$routing_item_4,
			'hour_4'=>$hour_4,
			'routing_plan5'=>$routing_item_5,
			'hour_5'=>$hour_5,
			'routing_plan6'=>$routing_item_6,
			'hour_6'=>$hour_6,
			'routing_plan7'=>$routing_item_7,
			'hour_7'=>$hour_7,
			'routing_plan8'=>$routing_item_8,
			'hour_8'=>$hour_8,
			'routing_plan9'=>$routing_item_9,
			'hour_9'=>$hour_9,
			'routing_plan10'=>$routing_item_10,
			'hour_10	'=>$hour_10
			
		);
		$this->m_order->updateOrderNoPict($id,$data);
		$this->m_routing->addRouting($data1);
		
		redirect(site_url('admin/dashboard/'));
	}
	
	public function table()
	{
		
		$this->load->view('v_form/form_table');
		
	}

	public function routingList()
	{
		$list = $this->m_routing->get_datatables_1();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $l) {
			//$order = $this->m_order->getRoutingList($l->id_order);
			
		
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
			$row[] = $l->nama_part;
			//No.Order
			$row[] = $l->no_order;
			//IN/OUTHOUSE (status)
			$row[] = $l->status; 
			//Material
			$row[] = $l->material;
			//Cost Material
			$row[] = 'cost material';
			//Cost Price
			$row[] = 'Price';
			//Total Cost
			$row[] = 'Total Cost';
			//Process Design & Cam
			//JAM
			$row[] = $l->hour_1;
			//1
			$row[] = $l->routing_plan1;
			//JAM
			$row[] = $l->hour_2;
			//1
			$row[] = $l->routing_plan2;
			//Proses
			//JAM
			$row[] = $l->hour_3;
			//1
			$row[] = $l->routing_plan3;
			//Proses
			//JAM
			$row[] = $l->hour_4;
			//1
			$row[] = $l->routing_plan4;
			//Proses
			//JAM
			$row[] = $l->hour_5;
			//1
			$row[] = $l->routing_plan5;
			//Proses
			//JAM
			$row[] = $l->hour_6;
			//1
			$row[] = $l->routing_plan6;
			//Proses
			///JAM
			$row[] = $l->hour_7;
			//1
			$row[] = $l->routing_plan7;
			//Proses
			//JAM
			$row[] = $l->hour_8;
			//1
			$row[] = $l->routing_plan8;
			//Proses
			//JAM
			$row[] = $l->hour_9;
			//1
			$row[] = $l->routing_plan9;
			//Proses
			//JAM
			$row[] = $l->hour_10;
			//1
			$row[] = $l->routing_plan10;
			//Proses
			//JAM
			$row[] = $l->hour_11;
			//1
			$row[] = $l->routing_plan11;
			//Total
			$row[] = 'Total';
			// }
			
			$data[] = $row;
			
		}
		
		$output = array(
						//"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_routing->count_all(),
						"recordsFiltered" => $this->m_routing->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function inputList()
	{
		$list = $this->m_routing->get_datatables_1();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $l) {
			//$order = $this->m_order->getRoutingList($l->id_order);
			
		
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
			//Tanggal			
			$row[] = $l->tanggal;
			//Urgent
			$row[] = $l->kategori;
			//Nomor Permintaan
			$row[] = $l->no_order; 
			//Requestor
			$row[] = $l->name;
			//Department
			$row[] = $l->department_name;
			//Mesin
			$row[] = $l->nama_part;
			//Material
			$row[] = $l->material;
			//Jumlah
			$row[] = $l->jumlah;
			//Item Pekerjaan
			$row[] = $l->order_type;
			//Status
			$row[] = $l->status_pengerjaan;
			//cos Mat
			$row[] = 'Cost.Mat';
			//Preparation/Manual
			if($l->routing_plan1=='PREPARATION' || $l->routing_plan1=='MANUAL'){
				$row[] = $l->hour_1;
			}else{
				$row[] = '';
			}
			if($l->routing_plan2=='CNC'){
				$row[] = $l->hour_2;
			}else{
				$row[] = '';
			}
			if($l->routing_plan3=='MILLING'){
				$row[] = $l->hour_3;
			}else{
				$row[] = '';
			}
			if($l->routing_plan4=='BUBUT'){
				$row[] = $l->hour_4;
			}else{
				$row[] = '';
			}
			if($l->routing_plan5=='GRINDING'){
				$row[] = $l->hour_5;
			}else{
				$row[] = '';
			}
			if($l->routing_plan6=='DRILLING'){
				$row[] = $l->hour_6;
			}else{
				$row[] = '';
			}
			if($l->routing_plan7=='SAW'){
				$row[] = $l->hour_7;
			}else{
				$row[] = '';
			}
			if($l->routing_plan8=='MANMACHINING'){
				$row[] = $l->hour_8;
			}else{
				$row[] = '';
			}
			if($l->routing_plan9=='WELDING'){
				$row[] = $l->hour_9;
			}else{
				$row[] = '';
			}
			if($l->routing_plan10=='MANFABRIKASI'){
				$row[] = $l->hour_10;
			}else{
				$row[] = '';
			}
			
			
			
			$data[] = $row;
			
		}
		
		$output = array(
						//"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_routing->count_all(),
						"recordsFiltered" => $this->m_routing->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
}
