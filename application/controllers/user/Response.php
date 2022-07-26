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
		$this->load->model('m_approval');
		$this->load->helper('url', 'form');
		$this->load->library('upload');
		if($this->session->userdata('user_is_logged_in')=='') {
			$this->session->set_flashdata('msg','Please Login to Continue');
			redirect('login');
		}
    }

	public function index()
	{
		$this->load->view('v_user/header_dashboard/header');
		$this->load->view('v_user/responseUser');
		$this->load->view('v_user/footer');
	}

	public function finish()
	{
		$this->load->view('v_user/header_dashboard/header');
		$this->load->view('v_user/finishListUser');
		$this->load->view('v_user/footer');
	}

	public function viewAcceptOrder_r()
	{
		$id = $this->input->get('id');
		$data['accept'] = $this->m_order->getResponseOrder($id);
		$this->load->view('v_user/header');
		$this->load->view('v_user/form_acc_r',$data);
		$this->load->view('v_user/footer');
	}

    public function order_list()//reject
	{
		$list = $this->m_order->get_datatables_user();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $l) {
            if(($l->alasan!=NULL)||($l->alasan_2!=NULL)||($l->alasan_3!=NULL)){
			// $delete = '	<a id="id-delete" name="delete" style="width:20%;" href="'.base_url() . 'user/dashboard/deleteOrder?id='.$l->id_order.'" style="width:13%;" class="btn btn-sm btn-secondary item_delete" data-toggle="tooltip" title="Delete">
			// 				<i class="fa fa-times"></i>
		  	// 			</a>';
			$view ='<a type="button" href="'.base_url() . 'user/response/viewAcceptOrder_r?id='.$l->id_order.'"  class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Response">
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
			"recordsFiltered" => $this->m_order->count_filtered_user_response(),
			"recordsTotal" => $this->m_order->count_all_user_response(),
			"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function onProcess()
	{
		$this->load->view('v_user/header_dashboard/header');
		$this->load->view('v_user/onProcessUser');
		$this->load->view('v_user/footer');
	}


	    public function onprocess_list()
	{
		$list = $this->m_order->get_datatables_user();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $l) {
            if($l->status_pengerjaan=='On Working'){
			$view ='<a type="button" href="'.base_url() . 'user/response/viewAcceptedResponse_rr?id='.$l->id_order.'"  class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Response">
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
						"recordsTotal" => $this->m_order->count_filtered_user_response_proses(),
						"recordsFiltered" => $this->m_order->count_all_user_response_proses(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}


	public function finish_list()
	{
		$list = $this->m_order->get_datatables_user();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $l) {
            if($l->status_pengerjaan=='Finish'){
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
			
			$data[] = $row;
            }
		}
		
		$output = array(
						"recordsTotal" => $this->m_order->count_filtered_user_response_finish(),
						"recordsFiltered" => $this->m_order->count_all_user_response_finish(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function viewAcceptedResponse_rr()
	{
		$id = $this->input->get('id');
		$data['accept_response'] = $this->m_order->getResponseOrder($id);
		$data['get_Routing'] = $this->m_routing->selectRouting();
		$data['tracker'] = $this->m_order->getDataForTracker($id);
		$this->load->view('v_user/header');
		$this->load->view('v_user/form_response_rr',$data);
		$this->load->view('v_user/footer');
	}

}
?>