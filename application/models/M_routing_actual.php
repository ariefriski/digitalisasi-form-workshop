<?php 

class M_routing_actual extends CI_model
{
    function inputRoutimeActual($data) {
        $this->db->insert('routing_actual', $data);
    }
}