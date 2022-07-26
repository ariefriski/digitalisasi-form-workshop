<?php

class M_login extends CI_Model {

    /**
    * Validate the login's data with the database
    * @param string $username
    * @param string $password
    * @return void
    */

    /*Check Login*/
   	function validate($username, $password)
	{
		$this->db->where('password', $password);
		$this->db->where('username', $username);
		
		$query = $this->db->get('user');
		return $query->result();
	}

	/*Get Session values */
		
	function get_id($username, $password)
	{
		$this->db->select('user.*,department.department_name');
		$this->db->from('user');
		$this->db->join('department','user.id_department=department.id_department');
		$this->db->where('password', $password);
		$this->db->where('username', $username);	
		return $this->db->get()->result();	
	}		


}