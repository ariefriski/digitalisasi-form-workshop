<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_order');
		$this->load->model('m_login');
		$this->load->model('m_approval');
		if($this->session->userdata('kadept_user_is_logged_in')=='') {
			$this->session->set_flashdata('msg','Please Login to Continue');
			redirect('login');
		}
    }


	public function index()
	{
		$this->load->view('v_kadept_user/header_dashboard/header');
		$this->load->view('v_kadept_user/dashboardKadeptUser');
		$this->load->view('v_kadept_user/footer');
	}

	public function acceptForm(){
		$this->load->view('v_kadept_user/header');
		$this->load->view('v_kadept_user/form_acc');
		$this->load->view('v_kadept_user/footer');
	}
	
	public function order_list()
	{
		$list = $this->m_order->get_datatables_user();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $l) {
		if(($l->approve1=='new')&&($l->status_approval_1==NULL)){
			$view ='<a type="button" href="'.base_url() . 'kadept_user/dashboard/viewAcceptOrder?id='.$l->id_order.'"  class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Response">
						<i class="fa fa-eye"></i>
					</a>'; 
			// }	
			$no++;
			$tanggal = date_create($l->tanggal);
			$row = array();
			$row[] = $no;
			$row[] = $l->nama_part;
			$row[] = date_format($tanggal,"d/m/Y");
			$row[] = date_format($tanggal,"H:i");
			if ($l->kategori == 'urgent'){
				$row[] = '<span class="badge badge-danger">urgent</span>';
			}else if ($l->kategori == 'biasa'){
				$row[] = '<span class="badge badge-warning">biasa</span>';
			}
			$row[] = $l->status_pengerjaan;
			$row[] = $view;
			$data[] = $row;
		}   
		}
		
		$output = array(
						//"draw" => $_POST['draw'],
						"recordsFiltered" => $this->m_order->count_filtered_kadept_user_dashboard(),
						"recordsTotal" => $this->m_order->count_all_kadept_user_dashboard(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function viewAcceptOrder()
	{
		$id = $this->input->get('id');
		$data['accept'] = $this->m_order->getResponseOrder($id);
		$this->load->view('v_kadept_user/header');
		$this->load->view('v_kadept_user/form_acc',$data);
		$this->load->view('v_kadept_user/footer');
	}

	public function acceptOrder()
	{
		$id_order = $this->input->get('id');
		$approve = $this->input->post('r_order_response');
		$alasan = $this->input->post('alasan');
		$id_user = $this->session->userdata('id_user');
		$tanggal = "%Y-%M-%d %H:%i";
		
		$jenis_approval = $this->session->userdata('level');
		if ($approve == 'accept'){
			$status_approval = 'Disetujui';
			$approve1 = 'ok';
		}else if ($approve == 'reject'){
			$status_approval = 'Ditolak';
			$approve1 = 'no';
		}
		$data =array(
			'status_approval_1'=>$status_approval,
			'alasan' =>$alasan,
			'tanggal'=>mdate($tanggal),
			'jenis_approval'=>$jenis_approval,
			'approve1'=>$approve1
		);
		$this->m_approval->updateApproval($id_order,$data);
		redirect(site_url('kadept_user/dashboard/'));
	}
}
