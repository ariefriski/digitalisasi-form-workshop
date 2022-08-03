<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_order');
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

	
	
	public function response()
	{
		$this->load->view('v_admin/header');
		$this->load->view('v_form/form_response');
		$this->load->view('v_admin/footer');
	}
	public function test()
	{
		$this->load->view('v_form/header');
		$this->load->view('v_form/form_perhitungan');
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
			$row[] = $d['name'];
			$row[] = $l->status_laporan;
			$row[] = $l->status_pengerjaan;
			$row[] = $view.$delete;
			
			}
			
			$data[] = $row;
			
		}
		
		$output = array(
						//"draw" => $_POST['draw'],
						// "recordsTotal" => $this->m_checksheet->count_all(),
						// "recordsFiltered" => $this->m_checksheet->count_filtered(),
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
	
}
