<?php
class M_user extends CI_Model 
{
	function getUser() {
        $this->db->select('user.*, department.department_name, section.section_name');
        $this->db->from('user');
        $this->db->join('department', 'department.id_department = user.id_department', 'left');
        $this->db->join('section', 'section.id_section = user.id_section', 'left');
        return $this->db->get()->result_array();
    }

    function getUserById($id) {
        return $this->db->get_where('user', array('id_user' => $id))->result_array();
    }

    function addUser($data) {
        $this->db->insert('user', $data);
    }

    function editUser($id_user, $id_department, $id_section,$npk,$name, $level) {
        $this->db->set('id_department', $id_department);
        $this->db->set('id_section', $id_section);
        $this->db->set('npk', $npk);
        $this->db->set('name', $name);
        $this->db->set('level', $level);
        $this->db->where('id_user', $id_user);
        $this->db->update('user');
    }

    function editPasswordUser($id_user, $password) {
        $this->db->set('password', $password);
        $this->db->where('id_user', $id_user);
        $this->db->update('user');
    }

    function deleteUser($id_user) {
        $this->db->where('id_user', $id_user);
        $this->db->delete('user');
    }

    function getNameDepartment() {
		return $this->db->get('department')->result_array();
	}
    function getNameSection($id) {
		return $this->db->get_where('section', array('id_department' => $id))->result_array();
	}


}
