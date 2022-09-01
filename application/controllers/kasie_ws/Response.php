<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Response extends CI_Controller {

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
		$this->load->view('v_kasie_ws/responseKasieWs');
		$this->load->view('v_kasie_ws/footer');
	}

    public function order_list()
	{
		$list = $this->m_order->get_datatables_1();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $l) {
            if(($l->status_approval_2=='Disetujui')&&($l->approve2=='Done')){
			$view ='<a type="button" href="'.base_url() . 'kasie_ws/response/viewAcceptOrder_r?id='.$l->id_order.'"  class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Response">
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
						"recordsTotal" => $this->m_order->count_all(),
						"recordsFiltered" => $this->m_order->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function viewAcceptOrder_r()
	{
		$id = $this->input->get('id');
		$data['accept'] = $this->m_order->getResponseOrder($id);
		$this->load->view('v_kasie_ws/header');
		$this->load->view('v_kasie_ws/form_acc_r',$data);
		$this->load->view('v_kasie_ws/footer');
	}


}
?>