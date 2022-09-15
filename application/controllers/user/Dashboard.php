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
		$this->load->view('v_user/dashboardUser');
		$this->load->view('v_user/footer');
	}

	public function generateIdOrder()
	{
		$getLastNumberOrder = $this->m_order->getLastIdOrder();
		$last = $getLastNumberOrder[0]['id_order'];
		$lastNumberOrder = explode("-",$last);
		$currentNumberOrder = (int)$lastNumberOrder[2] + 1;

		
		$sumRowOrder = $this->m_order->sumRowsOrder();
		$startNumberOrder = 1;

		if ($sumRowOrder == 0) {
			$formatIdOrder = "K-".date('m')."-".$startNumberOrder;
		} else {
			$formatIdOrder = "K-".date('m')."-".$currentNumberOrder;
		}

		return $formatIdOrder;
	}

	public function createForm(){
		$data['material']=$this->m_proses->selectMaterial();
		$this->load->view('v_user/header');
		$this->load->view('v_form/form_customer',$data);
		$this->load->view('v_user/footer');
	}

	public function createOrder(){
		$config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2000;
		$filename = 'userfile';
 
        $this->load->library('upload', $config);
		$this->upload->initialize($config);
		$this->upload->do_upload($filename);
	
		$id_order= $this->generateIdOrder();
		$id_user = $this->input->post('id_user');
		$id_department = $this->input->post('id_department');
		$id_section = $this->input->post('id_section');
		$order_type = $this->input->post('r_jenispekerjaan');
		$kategori = $this->input->post('kategori');
		$nama_part = $this->input->post('nama_part');
		$jumlah= $this->input->post('jumlah');
		$raw_type = $this->input->post('raw_type');
		$panjang = $this->input->post('panjang');
		$lebar	=$this->input->post('lebar');
		$diameter = $this->input->post('diameter');
		$material =$this->input->post('material');
		$status_pengerjaan = 'WAITING';
		$tanggal = "%Y-%M-%d %H:%i";

		//aprroval
		$approve1='new';
		$status_approval=NULL;
		$alasan=NULL;
		$jenis_approval=NULL;
		//image
		$image = $this->upload->data('file_name');
		if($lebar==0){
			$volume = 3.14 * (($diameter/2) * ($diameter/2)) * $panjang;
		}else{
			$volume = $panjang*$lebar*$diameter;
		}
		$material_detail = $this->m_material->getMaterialById($material);
		$berat = $volume * $material_detail[0]['massa_jenis'];
		
		//Rumus Material Cost
		$total_cost_material = ($material_detail[0]['price_kg']*$berat*$jumlah)*1.1;

		
		$data_order =array(
			'id_order'=>$id_order,
			'id_user'=>$id_user,
			'id_department' =>$id_department,
			'id_section'=>$id_section,
			'order_type' => $order_type,
			'kategori'=>$kategori,
			'nama_part'=>$nama_part,
			'jumlah'=>$jumlah,
			'id_material'=>$material,
			'status_pengerjaan'=>$status_pengerjaan,
			'tanggal'=>mdate($tanggal),
			'attachment' => $image
			
		);

		$data_detail_raw_type = array(
			'id_order'=>$id_order,
			'id_raw_type'=>$raw_type,
			'panjang'=>$panjang,
			'lebar'=>$lebar,
			'diameter'=>$diameter,
			'volume'=>$volume,
			'berat'=>$berat

		);

		$data_estimate_routing = array(
			'id_order'=>$id_order,
			'total_cost_material'=>$total_cost_material
		);

		$data =array(
			'id_order'=>$id_order,
			'id_user'=>$id_user,
			'status_approval_1'=>$status_approval,
			'alasan' =>$alasan,
			'tanggal'=>mdate($tanggal),
			'jenis_approval'=>$jenis_approval,
			'approve1'=>$approve1
		);
		
		$this->m_order->addOrder($data_order);
		$this->m_order->addDetailRawType($data_detail_raw_type);
		$this->m_routing->addEstimateRouting($data_estimate_routing);
		$this->m_approval->addApproval($data);
		redirect(site_url('user/dashboard/'));
	}


	public function updateOrder()
	{
		$id = $this->input->get('id');
		$order_type = $this->input->post('r_jenispekerjaan');
		$kategori = $this->input->post('kategori');
		$nama_part = $this->input->post('nama_part');
		$jumlah= $this->input->post('jumlah');
		$raw_type = $this->input->post('raw_type');
		$panjang = $this->input->post('panjang');
		$lebar	=$this->input->post('lebar');
		$diameter = $this->input->post('diameter');
		$id_material =$this->input->post('material');
		$material =$this->input->post('material');
		if($lebar==0){
			$volume = 3.14 * (($diameter/2) * ($diameter/2)) * $panjang;
		}else{
			$volume = $panjang*$lebar*$diameter;
		}
		$material_detail = $this->m_material->getMaterialById($material);
		$berat = $volume * $material_detail[0]['massa_jenis'];
		
		//Rumus Material Cost
		$total_cost_material = ($material_detail[0]['price_kg']*$berat*$jumlah)*1.1;
		if($_FILES['userfile']['name'] != ""){
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$this->load->library('upload', $config);
			$this->path = './uploads/';

			$this->upload->initialize($config);
			if(!$this->upload->do_upload('userfile')){
			$error = array('error'=>$this->upload->display_errors());
		}	else{
			$imageUpload = $this->upload->data();
			$userfile_attachment = $imageUpload['file_name'];
		}
	  }else{
		$userfile_attachment = $this->input->post('userfile_old');
	  }

		$data =array(
			'order_type' => $order_type,
			'kategori'=>$kategori,
			'nama_part'=>$nama_part,
			'jumlah'=>$jumlah,
			'id_material'=>$id_material,
			'attachment' => $userfile_attachment
		);
		$data_detail_raw_type = array(
			'id_raw_type'=>$raw_type,
			'panjang'=>$panjang,
			'lebar'=>$lebar,
			'diameter'=>$diameter,
			'volume'=>$volume,
			'berat'=>$berat
		);
		
		$this->m_order->updateOrder($id,$data);
		$this->m_order->updateDetailRawType($id,$data_detail_raw_type);
		$this->m_routing->updEstimateRouting($id,$total_cost_material);
		redirect(site_url('user/dashboard/'));
	}
//($l->status_approval_1=='Ditolak')||($l->status_approval_2=='Ditolak')||($l->status_approval=='Ditolak')
	public function order_list()
	{
		$list = $this->m_order->get_datatables_user();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $l) {
			
			if($l->status_pengerjaan=='WAITING' && $l->alasan==NULL && $l->alasan_2==NULL && $l->alasan_3==NULL && ((($l->approve1=='new')||($l->approve1=='ok'))||(($l->approve2=='ok')&&($l->approve3=='ok'))) ){
			$view = '<a type="button" style="width:20%;" href="'.base_url() . 'user/dashboard/viewResponseOrder?id='.$l->id_order.'" style="width:13%;" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Response">
							<i class="fa fa-eye"></i>
						</a>';	
		
			
			
			$delete = '	<a id="id-delete" name="delete" style="width:20%;" href="'.base_url() . 'user/dashboard/deleteOrder?id='.$l->id_order.'" style="width:13%;" class="btn btn-sm btn-secondary item_delete" data-toggle="tooltip" title="Delete">
							  <i class="fa fa-times"></i>
						</a>';
						
		
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
			 $row[] = $view.$delete;
			$data[] = $row;
		
		}
		
		}
		$output = array(
						"recordsFiltered" => $this->m_order->count_filtered_user_dashboard(),
						"recordsTotal" => $this->m_order->count_all_user_dashboard(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function deleteOrder()
	{
		$id = $this->input->get('id');
		$this->m_order->deleteOrder($id);
		redirect(site_url('user/dashboard'));
	}

	public function viewResponseOrder()
	{
		$id = $this->input->get('id');
		$data['response'] = $this->m_order->getResponseOrder($id);
		$data['tracker'] = $this->m_order->getDataForTracker($id);
		$data['material']=$this->m_proses->selectMaterial();
		$this->load->view('v_user/header');
		$this->load->view('v_form/form_customer_response_detail',$data);
		$this->load->view('v_user/footer');
	}

	
}

