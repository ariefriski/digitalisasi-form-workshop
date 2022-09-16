<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model('m_login');
        $this->load->model('m_user');
		$this->load->database();  
		if($this->session->userdata('admin_ws_is_logged_in')=='') {
			$this->session->set_flashdata('msg','Please Login to Continue');
			redirect('login');
		}

    }

    function getNameSection($id) {
		return $this->db->get_where('section', array('id_department' => $id))->result_array();
	}

    public function getSection()
	{
		$id_department = $this->input->post('id_department');
		$section = $this->m_user->getNameSection($id_department);

		echo '
			<br>
			<label for="id_section">Section</label>
			<select class="form-control" id="id_section" name="id_section">
				<option value="" selected disabled>Please select</option>';
					foreach ($section as $sect) {
						echo '
							<option value="'.$sect['id_section'].'">'.$sect['section_name'].'</option>
						';
					}
		echo '</select>';

	}


    public function index()
	{
        $data['data'] = $this->m_user->getUser();
		$this->load->view('v_admin/createRole/header');
		$this->load->view('v_admin/createRole/viewUser', $data);
		$this->load->view('v_admin/createRole/footer');
	}

    public function addUser()
    {
        $data = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'name' => $this->input->post('name'),
            'npk' => $this->input->post('npk'),
            'id_department' => $this->input->post('id_department'),
            'id_section' => $this->input->post('id_section'),
            'level' => $this->input->post('level')
        );
        $this->m_user->addUser($data);
        redirect(site_url('admin/user'));
    }

    public function editUser()
    {
        $id_user = $this->input->get('id');
		$data['data'] = $this->m_user->getUserById($id_user);

		$this->load->view('v_admin/createRole/header');
		$this->load->view('v_admin/createRole/viewUserEdit', $data);
		$this->load->view('v_admin/createRole/footer');
    }

    public function prosesEditUser()
    {
        $id_user = $this->input->post('id_user');
        $name = $this->input->post('name');
        $id_department = $this->input->post('id_department');
        $npk = $this->input->post('npk');
        $id_section = $this->input->post('id_section');
        $level = $this->input->post('level');

        $this->m_user->editUser($id_user, $id_department, $id_section,$npk,$name, $level);
        echo '<script type="text/javascript">
                alert("Data berhasil disimpan");
                window.location.href="'.base_url('admin/user').'";
            </script>';
    }

    public function editPasswordUser()
    {
        $id_user = $this->input->post('user-id-edit');
        $password = $this->input->post('password-edit');

        $this->m_user->editPasswordUser($id_user,$password);
        echo '<script type="text/javascript">
                alert("Password berhasil diubah");
                window.location.href="'.base_url('admin/user').'";
            </script>';
    }
    public function deleteUser() {
        $id_user = $this->input->get('id_user');
		$this->m_user->deleteUser($id_user);
		redirect(site_url('admin/user'));
    }
	
	
}


?>