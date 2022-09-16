<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Section extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model('m_login');
        $this->load->model('m_section');
        $this->load->model('m_user');
        if($this->session->userdata('admin_ws_is_logged_in')=='') {
			$this->session->set_flashdata('msg','Please Login to Continue');
			redirect('login');
		}
    }

	public function index()
	{
        $data['data'] = $this->m_section->getSection();
		$this->load->view('v_admin/createSection/header');
		$this->load->view('v_admin/createSection/viewSection', $data);
		$this->load->view('v_admin/createSection/footer');
	}

    public function addSection()
    {
        $data = array(
            'id_department' => $this->input->post('id_department'),
            'section_name' => $this->input->post('section-name')
        );
        $this->m_section->addSection($data);
        redirect(site_url('admin/section'));
    }

    public function getSectionById()
    {
        $id_section = $this->input->get('id_section');
		$data = $this->m_section->getSectionById($id_section);
		echo json_encode($data);
    }

    public function editSection()
    {
        $id_section = $this->input->post('section-id-edit');
        $id_department = $this->input->post('id_department_edit');
		$section_name = $this->input->post('section-name-edit');
		$this->m_section->editSection($id_section, $id_department, $section_name);
        redirect(site_url('admin/section'));
    }

    public function deleteSection() {
        $id_section = $this->input->get('id_section');
		$this->m_section->deleteSection($id_section);
        redirect(site_url('admin/section'));
    }
}
