<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	// function __construct() {
    //     parent::__construct();
    //     $this->load->model('m_checksheet');
	// 	$this->load->model('m_response');
	// 	$this->load->model('m_login');
    //     if($this->session->userdata('is_logged_in')=='') {
	// 		$this->session->set_flashdata('msg','Please Login to Continue');
	// 		redirect('login');
	// 	}
    // }

	function __construct() {
        parent::__construct();
        $this->load->model('m_order');
		$this->load->model('m_login');
		if($this->session->userdata('kadept_is_logged_in')=='') {
			$this->session->set_flashdata('msg','Please Login to Continue');
			redirect('login');
		}
    }


	public function index()
	{
		// $data['count1'] = count($this->m_checksheet->getSumRowsChecksheet());
		// $data['count'] = count($this->m_response->getSumRowsResponse());
		$this->load->view('v_kadept/header');
		$this->load->view('v_kadept/dashboardKadept');
		$this->load->view('v_kadept/footer');
	}

	public function acceptForm(){
		$this->load->view('v_kadept/header');
		$this->load->view('v_form/form_acc');
		$this->load->view('v_kadept/footer');
	}
	
	public function order_list()
	{
		$list = $this->m_order->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $l) {
	
			if (($l->status_laporan == 'Disetujui') || ($l->status_laporan == 'Ditolak')){
			$view ='<a type="button" href="#"  class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Response">
						<i class="fa fa-eye"></i>
					</a>'; 
			}else{
				$view ='<a type="button" href="'.base_url() . 'kadept/dashboard/viewAcceptOrder?id='.$l->id_order.'"  class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Response">
						<i class="fa fa-eye"></i>
					</a>'; 
			}	
			$no++;
			$date = date_create($l->jam);
			$row = array();
			$row[] = $no;
			$row[] = $l->nama_part;
			$row[] = $l->tanggal;
			$row[] = date_format($date,"H:i");
			if ($l->kategori == 'urgent'){
				$row[] = '<span class="badge badge-danger">urgent</span>';
			}else if ($l->kategori == 'biasa'){
				$row[] = '<span class="badge badge-warning">biasa</span>';
			}
			$row[] = $l->status_laporan;
			$row[] = $view;
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

	public function viewAcceptOrder()
	{
		$id = $this->input->get('id');
		$data['accept'] = $this->m_order->getResponseOrder($id);
		$this->load->view('v_kadept/header');
		$this->load->view('v_form/form_acc',$data);
		$this->load->view('v_kadept/footer');
	}

	public function acceptOrder()
	{
		$id = $this->input->get('id');
		$approve = $this->input->post('r_order_response');
		$alasan = $this->input->post('alasan');
		if ($approve == 'accept'){
			$status_laporan = 'Disetujui';
		}else if ($approve == 'reject'){
			$status_laporan = 'Ditolak';
		}
		$data =array(
			'status_laporan'=>$status_laporan,
			'approve'=>$approve,
			'alasan' =>$alasan
		);
		$this->m_order->updateOrder($id,$data);
		redirect(site_url('kadept/dashboard/'));
	}
}
