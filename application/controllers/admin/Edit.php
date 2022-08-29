<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_order');
		$this->load->model('m_routing');
		$this->load->model('m_proses');
		$this->load->model('m_material');
		$this->load->helper('url', 'form');
		$this->load->library('upload');
		$this->load->model('m_login');
		if($this->session->userdata('admin_ws_is_logged_in')=='') {
			$this->session->set_flashdata('msg','Please Login to Continue');
			redirect('login');
		}

    }

    public function proses()
	{
        
		$this->load->view('v_admin/header');
		$this->load->view('v_admin/editabledata/editprocess');
		$this->load->view('v_admin/footer');
	}

	public function material()
	{
		$this->load->view('v_admin/header');
		$this->load->view('v_admin/editabledata/editmaterial');
		$this->load->view('v_admin/footer');
	}

	public function insertProses()
	{
		$nama_proses = $this->input->post('nama_proses');
		$harga_perjam_mesin = $this->input->post('harga_perjam');
		$harga_perjam_manusia = $this->input->post('harga_perjam_manusia');
		$consumable = $this->input->post('consumable');
		$listrik =  $this->input->post('listrik');
		$harga_mesin = $this->input->post('harga_mesin');
		$total_cost = $this->input->post('total_cost');

		$data = array(
			'nama_proses'=>$nama_proses,
			'harga_perjam'=>$harga_perjam_mesin,
			'harga_perjam_manusia'=>$harga_perjam_manusia,
			'consumable'=>$consumable,
			'listrik'=>$listrik,
			'harga_mesin'=>$harga_mesin,
			'total_cost'=>$total_cost
		);
		$this->m_proses->addProses($data);
		redirect(site_url('admin/edit/proses'));
	}

	public function insertMaterial()
	{
		$nama_material = $this->input->post('nama_material');
		$price_kg = $this->input->post('price_kg');
		$type = $this->input->post('type');
		$massa_jenis = $this->input->post('massa_jenis');
		$data = array(
			'nama_material'=>$nama_material,
			'price_kg'=>$price_kg,
			'type'=>$type,
			'massa_jenis'=>$massa_jenis,
			
		);
		$this->m_material->addMaterial($data);
		redirect(site_url('admin/edit/material'));
	}

	public function editProsesTable()
	{
		$list = $this->m_proses->get_datatables_2();
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
			$delete = '	<a id="id-delete"  href="javascript:;" style="width:30%;" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#modal-hapus">
							  <i class="fa fa-times item_delete" data="'.$l->id_proses.'"></i>
						</a>';
						//'.base_url() . 'user/dashboard/deleteOrder?id='.$l->id_order.'
			// }	
			$edit = '<a  href="javascript:;" "class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#modal-edit">
							<i class="fa fa-pencil item_edit" data="'.$l->id_proses.'"></i>
						</a>';
			$no++;
			
			$row = array();
			// $rl['status']; foreach($routingList as $rl){	
			//Tanggal			
			$row[] = $no;
			//Urgent
			$row[] = $l->nama_proses;
			$row[] = $l->harga_mesin;
			$row[] = $l->harga_perjam_manusia;
			$row[] = $l->consumable;
			$row[] = $l->listrik;
			$row[] = $l->harga_perjam;
			$row[] = $l->total_cost;
			$row[] = $delete.$edit;
			
			$data[] = $row;
			
		}
		
		$output = array(
						//"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_proses->count_all_1(),
						"recordsFiltered" => $this->m_proses->count_filtered_1(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function editMaterialTable()
	{
		$list = $this->m_material->get_datatables();
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
			$delete = '	<a id="id-delete"  href="javascript:;" style="width:30%;" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#modal-hapus">
							  <i class="fa fa-times item_delete" data="'.$l->id_material.'"></i>
						</a>';
						//'.base_url() . 'user/dashboard/deleteOrder?id='.$l->id_order.'
			// }	
			$edit = '<a  href="javascript:;" "class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#modal-edit">
							<i class="fa fa-pencil item_edit" data="'.$l->id_material.'"></i>
						</a>';
			$no++;
			
			$row = array();
			// $rl['status']; foreach($routingList as $rl){	
			//Tanggal			
			$row[] = $no;
			//Urgent
			$row[] = $l->nama_material;
			$row[] = $l->price_kg;
			$row[] = $l->type;
			$row[] = $l->massa_jenis;

			$row[] = $delete.$edit;
			
			$data[] = $row;
			
		}
		
		$output = array(
						//"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_material->count_all(),
						"recordsFiltered" => $this->m_material->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function showModalById()
	{
		$id_proses = $this->input->get('id_proses');
		$data = $this->m_proses->showModalById($id_proses);
		echo json_encode($data);
	}

	public function showModalByIdMaterial()
	{
		$id_material = $this->input->get('id_material');
		$data = $this->m_material->showModalByIdMaterial($id_material);
		echo json_encode($data);
	}

	public function updateProses()
	{
		$id_proses = $this->input->post('id_proses');
		$nama_proses = $this->input->post('nama_proses');
		$harga_perjam = $this->input->post('harga_perjam');
		$harga_perjam_manusia = $this->input->post('harga_perjam_manusia');
		$consumable = $this->input->post('consumable');
		$listrik = $this->input->post('listrik');
		$harga_mesin = $this->input->post('harga_mesin');
		$total_cost = $this->input->post('total_cost');
		$data = $this->m_proses->updateProses($id_proses,$nama_proses,$harga_perjam,$harga_perjam_manusia,$consumable,$listrik,$harga_mesin,$total_cost);
		echo json_encode($data);
	}

	public function updateMaterial()
	{
		$id_material = $this->input->post('id_material');
		$nama_material = $this->input->post('nama_material');
		$price_kg = $this->input->post('price_kg');
		$type = $this->input->post('type');
		$massa_jenis = $this->input->post('massa_jenis');
		$data = $this->m_material->updateMaterial($id_material,$nama_material,$price_kg,$type,$massa_jenis);
		echo json_encode($data);
	}

	public function deleteProses()
	{
		$id_proses = $this->input->post('id_proses');
		$data = $this->m_proses->deleteProses($id_proses);
		echo json_encode($data);
	}
	public function deleteMaterial()
	{
		$id_material = $this->input->post('id_material');
		$data = $this->m_material->deleteMaterial($id_material);
		echo json_encode($data);
	}

}

