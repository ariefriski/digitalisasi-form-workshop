<?php 
date_default_timezone_set('Asia/Jakarta');
class M_routing extends CI_model
{
    public function addRouting($data)
    {
        
        $this->db->insert('routing',$data);
        
    }
}
?>