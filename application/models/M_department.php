<?php
class M_department extends CI_Model 
{
	function getDepartment() {
        return $this->db->get('department')->result_array();
    }

    function getDepartmentById($id) {
        return $this->db->get_where('department', array('id_department' => $id))->result_array();
    }

    function addDepartment($data) {
        $this->db->insert('department', $data);
    }

    function editDepartment($id_department, $department_name) {
        $this->db->set('department_name', $department_name);
        $this->db->where('id_department', $id_department);
        $this->db->update('department');
    }

    function deleteDepartment($id_department) {
        $this->db->where('id_department', $id_department);
        $this->db->delete('department');
    }
}
