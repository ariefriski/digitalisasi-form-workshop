<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_department');
		$this->load->model('m_login');
        if($this->session->userdata('admin_ws_is_logged_in')=='') {
			$this->session->set_flashdata('msg','Please Login to Continue');
			redirect('login');
		}
    }

	public function index()
	{
        $data['data'] = $this->m_department->getDepartment();
        $this->load->view('v_admin/createDepartment/header');
		$this->load->view('v_admin/createDepartment/viewDepartment', $data);
		$this->load->view('v_admin/createDepartment/footer');
	}

    public function addDepartment()
    {
        $data = array(
            'department_name' => $this->input->post('department-name')
        );
        $this->m_department->addDepartment($data);
        redirect(site_url('admin/department'));
    }

    public function getDepartmentById()
    {
        $id_department = $this->input->get('id_department');
		$data = $this->m_department->getDepartmentById($id_department);
		echo json_encode($data);
    }

    public function editDepartment()
    {
        $id_department = $this->input->post('department-id-edit');
		$department_name = $this->input->post('department-name-edit');
		$this->m_department->editDepartment($id_department, $department_name);
		redirect(site_url('admin/department'));
    }

    public function deleteDepartment() {
        $id_department = $this->input->get('id_department');
		$this->m_department->deleteDepartment($id_department);
		redirect(site_url('admin/department'));
    }
}
