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

	public function index()
	{
		// $data['count1'] = count($this->m_checksheet->getSumRowsChecksheet());
		// $data['count'] = count($this->m_response->getSumRowsResponse());
		$this->load->view('v_kadept/header');
		$this->load->view('v_kadept/dashboardKadept');
		$this->load->view('v_kadept/footer');
	}

	public function acceptForm(){
		$this->load->view('v_form/header');
		$this->load->view('v_form/form_acc');
		$this->load->view('v_form/footer');
	}
	
}
