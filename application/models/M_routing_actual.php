<?php 

class M_routing_actual extends CI_model
{
    function inputRoutimeActual($data) {
        $this->db->insert('routing_actual', $data);
    }
    function inputDetailActualRouting($data) {
        $this->db->insert('detail_actual_routing', $data);
    }
}