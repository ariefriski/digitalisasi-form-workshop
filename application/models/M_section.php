<?php
class M_section extends CI_Model 
{
	function getSection() {
        $this->db->select('section.*, department.department_name');
        $this->db->from('section');
        $this->db->join('department', 'department.id_department = section.id_department');
        return $this->db->get()->result_array();
    }

    function getSectionById($id) {
        return $this->db->get_where('section', array('id_section' => $id))->result_array();
    }

    function addSection($data) {
        $this->db->insert('section', $data);
    }

    function editSection($id_section, $id_department, $section_name) {
        $this->db->set('id_department', $id_department);
        $this->db->set('section_name', $section_name);
        $this->db->where('id_section', $id_section);
        $this->db->update('section');
    }

    function deleteSection($id_section) {
        $this->db->where('id_section', $id_section);
        $this->db->delete('section');
    }
}
