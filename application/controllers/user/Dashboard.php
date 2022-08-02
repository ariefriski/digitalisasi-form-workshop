<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Dashboard extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_order');

    }

	public function index()
	{
		// $data['list'] = $this->m_order->getListForm();
		$this->load->view('v_user/header');
		$this->load->view('v_user/dashboardUser');
		$this->load->view('v_user/footer');
	}

	public function createForm(){
		$this->load->view('v_form/header');
		$this->load->view('v_form/form_customer');
		$this->load->view('v_form/footer');
	}
	public function createOrder(){
		$id_customer =1;
		$id_department = 1;
		$order_type = $this->input->post('r_jenispekerjaan');
		$kategori = $this->input->post('kategori');
		$nama_part = $this->input->post('nama_part');
		$jumlah= $this->input->post('jumlah');
		$raw_type = $this->input->post('raw_type');
		$panjang = $this->input->post('panjang');
		$lebar	=$this->input->post('lebar');
		$tinggi = $this->input->post('tinggi');
		$material =$this->input->post('material');
		$status_laporan = 'Menunggu Approve';
		$status_pengerjaan = 'Belum dikerjakan';
		$approve = 'No';
		$data =array(
			'id_customer'=>$id_customer,
			'id_department' =>$id_department,
			'order_type' => $order_type,
			'kategori'=>$kategori,
			'nama_part'=>$nama_part,
			'jumlah'=>$jumlah,
			'raw_type'=>$raw_type,
			'panjang'=>$panjang,
			'lebar'=>$lebar,
			'tinggi'=>$tinggi,
			'material'=>$material,
			'status_laporan'=>$status_laporan,
			'status_pengerjaan'=>$status_pengerjaan,
			'jam'=>date('H:i',strtotime('now')),
			'tanggal' => date('d-m-Y',strtotime('now')),
			'approve' =>$approve
			
		);

		$this->m_order->addOrder($data);
		redirect(site_url('user/dashboard/'));
	}

	public function updateOrder()
	{
		$id = $this->input->get('id');
		$id_customer =1;
		$id_department = 1;
		$order_type = $this->input->post('r_jenispekerjaan');
		$kategori = $this->input->post('kategori');
		$nama_part = $this->input->post('nama_part');
		$jumlah= $this->input->post('jumlah');
		$raw_type = $this->input->post('raw_type');
		$panjang = $this->input->post('panjang');
		$lebar	=$this->input->post('lebar');
		$tinggi = $this->input->post('tinggi');
		$material =$this->input->post('material');
		
		$data =array(
			'id_customer'=>$id_customer,
			'id_department' =>$id_department,
			'order_type' => $order_type,
			'kategori'=>$kategori,
			'nama_part'=>$nama_part,
			'jumlah'=>$jumlah,
			'raw_type'=>$raw_type,
			'panjang'=>$panjang,
			'lebar'=>$lebar,
			'tinggi'=>$tinggi,
			'material'=>$material,
			'jam'=>date('H:i',strtotime('now')),
			'tanggal' => date('d-m-Y',strtotime('now')),	
		);
		$this->m_order->updateOrder($id,$data);
		redirect(site_url('user/dashboard/'));
	}

	public function order_list()
	{
		$list = $this->m_order->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $l) {
			
			
			
			
			
			$view = '<a type="button" href="'.base_url() . 'user/dashboard/viewResponseOrder?id='.$l->id_order.'" style="width:13%;" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Response">
							<i class="fa fa-eye"></i>
						</a>';	
		
			// ="'.base_url() . 'admin/response/viewResponseByTitle?id='.$l->id_checksheet.'
		
			if ($l->status_laporan == 'Disetujui'){
				$delete = '	<a id="id-delete" name="delete" href="#" style="width:13%;" class="btn btn-sm btn-secondary item_delete" data-toggle="tooltip" title="Delete">
							  <i class="fa fa-times"></i>
						</a>';
			}else{
			$delete = '	<a id="id-delete" name="delete" href="'.base_url() . 'user/dashboard/deleteOrder?id='.$l->id_order.'" style="width:13%;" class="btn btn-sm btn-secondary item_delete" data-toggle="tooltip" title="Delete">
							  <i class="fa fa-times"></i>
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
			$row[] = $l->status_pengerjaan;
			$row[] = $view.$delete;
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
		$this->load->view('v_user/header');
		$this->load->view('v_form/form_customer_response_detail',$data);
		$this->load->view('v_user/footer');
		
	}

	

}

