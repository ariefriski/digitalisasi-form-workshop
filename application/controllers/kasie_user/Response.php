<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Response extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_order');
		$this->load->model('m_login');
		$this->load->model('m_approval');
		if($this->session->userdata('kasie_user_is_logged_in')=='') {
			$this->session->set_flashdata('msg','Please Login to Continue');
			redirect('login');
		}
    }


	public function index()
	{
		$this->load->view('v_kasie_user/header_dashboard/header');
		$this->load->view('v_kasie_user/responseKasieUser');
		$this->load->view('v_kasie_user/footer');
	}

	
	public function reject()
	{
		$this->load->view('v_kasie_user/header_dashboard/header');
		$this->load->view('v_kasie_user/rejectOrder');
		$this->load->view('v_kasie_user/footer');
	}

    public function order_list()
	{
		$list = $this->m_order->get_datatables_user();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $l) {
		if($l->status_approval_1 =='Disetujui' ){
			$view ='<a type="button" href="'.base_url() . 'kasie_user/response/viewAcceptOrder_r?id='.$l->id_order.'"  class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Response">
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
						"recordsFiltered" => $this->m_order->count_filtered_kasie_user_response(),
						"recordsTotal" => $this->m_order->count_all_kasie_user_response(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function tolak_list()
	{
		$list = $this->m_order->get_datatables_user();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $l) {
		if($l->status_approval_1 =='Ditolak' ){
			$view ='<a type="button" href="'.base_url() . 'kasie_user/response/viewAcceptOrder_r?id='.$l->id_order.'"  class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Response">
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
			
			$row[] = $view;
			$data[] = $row;
		}   
		}
		
		$output = array(
						//"draw" => $_POST['draw'],
						"recordsFiltered" => $this->m_order-> count_filtered_kasie_user_tolak(),
						"recordsTotal" => $this->m_order->count_all_kasie_user_tolak(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function viewAcceptOrder_r()
	{
		$id = $this->input->get('id');
		$data['accept'] = $this->m_order->getResponseOrder($id);
		$this->load->view('v_kasie_user/header');
		$this->load->view('v_kasie_user/form_acc_r',$data);
		$this->load->view('v_kasie_user/footer');
	}

}

?>
