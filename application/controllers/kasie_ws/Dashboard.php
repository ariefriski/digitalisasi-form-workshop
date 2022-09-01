<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_order');
		$this->load->model('m_login');
		$this->load->model('m_approval');
		if($this->session->userdata('kasie_ws_is_logged_in')=='') {
			$this->session->set_flashdata('msg','Please Login to Continue');
			redirect('login');
		}
    }

    public function index()
	{
		$this->load->view('v_kasie_ws/header_dashboard/header');
		$this->load->view('v_kasie_ws/dashboardKasieWs');
		$this->load->view('v_kasie_ws/footer');
	}

    public function viewAcceptOrder()
	{
		$id = $this->input->get('id');
		$data['accept'] = $this->m_order->getResponseOrder($id);
		$this->load->view('v_kasie_ws/header');
		$this->load->view('v_kasie_ws/form_acc',$data);
		$this->load->view('v_kasie_ws/footer');
	}

    public function order_list()
	{
		$list = $this->m_order->get_datatables_1();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $l) {
            if(($l->status_approval_2=='Disetujui')&&($l->approve2==NULL)){
			$view ='<a type="button" href="'.base_url() . 'kasie_ws/dashboard/viewAcceptOrder?id='.$l->id_order.'"  class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Response">
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

    public function acceptKasieWs()
	{
		//$id = $this->input->get('id');
		
		$id_order = $this->input->post('id_order');
		$id_user = $this->session->userdata('id_user');
		$approve = $this->input->post('r_kasie');
		$jenis_approval = $this->session->userdata('level');
		$alasan = $this->input->post('alasan');
		$tanggal = "%Y-%M-%d %H:%i";
		$approve2 = 'Done';
		if ($approve == 'accept'){
			$status_approval = 'Disetujui';
		}else if ($approve == 'reject'){
			$status_approval = 'Ditolak';
		}
		$data =array(
			'id_order'=>$id_order,
			'id_user'=>$id_user,
			'status_approval'=>$status_approval,
			'alasan_3'=>$alasan,
			'tanggal'=>mdate($tanggal),
			'jenis_approval_1'=>$jenis_approval
		);

		$update = array(
			'approve2'=>$approve2
		);
		

		$this->m_approval->addApprovalKasieWs($data);
		$this->m_approval->updateApprovalKasieWs($id_order,$update);
		redirect(site_url('kasie_ws/dashboard/'));
	}

}

?>