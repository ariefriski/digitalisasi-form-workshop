<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_order');
		$this->load->model('m_login');
		$this->load->model('m_approval');
		if($this->session->userdata('kadept_ws_is_logged_in')=='') {
			$this->session->set_flashdata('msg','Please Login to Continue');
			redirect('login');
		}
    }

    public function index()
	{
		$this->load->view('v_kadept_ws/header_dashboard/header');
		$this->load->view('v_kadept_ws/dashboardKadeptWs');
		$this->load->view('v_kadept_ws/footer');
	}

    public function viewAcceptOrder()
	{
		$id = $this->input->get('id');
		$data['accept'] = $this->m_order->getResponseOrder($id);
		$this->load->view('v_kadept_ws/header');
		$this->load->view('v_kadept_ws/form_acc',$data);
		$this->load->view('v_kadept_ws/footer');
	}

    public function order_list()
	{
		$list = $this->m_order->get_datatables_1();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $l) {
            if(($l->kategori=='urgent')&&($l->approve2=='Done')&&($l->jenis_approval_2==NULL)&&($l->status_approval=='Disetujui')){
			$view ='<a type="button" href="'.base_url() . 'kadept_ws/dashboard/viewAcceptOrder?id='.$l->id_order.'"  class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Response">
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
						"recordsTotal" => $this->m_order->count_all(),
						"recordsFiltered" => $this->m_order->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

    public function acceptKadeptWs()
	{
		//$id = $this->input->get('id');
		
		$id_order = $this->input->post('id_order');
		// $no_order = $this->input->post('no_order');
		$id_user = $this->session->userdata('id_user');
		$approve = $this->input->post('r_kadept');
		$alasan = $this->input->post('alasan');
		$tanggal_2 = "%Y-%M-%d %H:%i";
		$approve3 = 'Done';
		if ($approve == 'accept'){
			$jenis_approval_2 = $this->session->userdata('level');
		}else if ($approve == 'reject'){
			$jenis_approval_2 = 'Decline';
		}
		$data =array(
			'tanggal_2'=>mdate($tanggal_2),
			'jenis_approval_2'=>$jenis_approval_2,
			'alasan_3'=>$alasan
		);

		$update = array(
			'approve3'=>$approve3
		);
		

		$this->m_approval->updateApprovalFinal($id_order,$data);
		$this->m_approval->updateApprovalKdWs($id_order,$update);
		redirect(site_url('kadept_ws/dashboard/'));
	}

}

?>