<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() {
        parent::__construct();		
    }

	public function index()
	{
		if ($this->session->userdata('user_is_logged_in')) {
			redirect('user/dashboard');
		} else if ($this->session->userdata('kadept_is_logged_in')) {
			redirect('kadept/dashboard');
		} else if ($this->session->userdata('admin_logged_in')) {
			redirect('admin/dashboard');
		} else {
			$this->session->set_flashdata('msg','Please Login to Continue');
			redirect('login');
		}
	}
}
