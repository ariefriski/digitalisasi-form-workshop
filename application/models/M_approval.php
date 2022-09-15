<?php 
date_default_timezone_set('Asia/Jakarta');
class M_approval extends CI_model
{
    function addApproval($data)
    {
        $this->db->insert('approval',$data);
    }

    function updateApproval($id,$data)
    {
        $this->db->where('id_order',$id);
        $this->db->update('approval',$data);
        
    }

    function addApprovalPic($data)
    {
        $this->db->insert('approval_pic_workshop',$data);
    }

    function updateApprovalPic($id,$data)
    {
        $this->db->where('id_order',$id);
        $this->db->update('approval',$data);
        
    }

    function addApprovalKasieWs($data)
    {
        $this->db->insert('approval_final',$data);
    }

    function updateApprovalKasieWs($id,$data)
    {
        $this->db->where('id_order',$id);
        $this->db->update('approval',$data);
    }

    function updateApprovalFinal($id,$data)
    {
        $this->db->where('id_order',$id);
        $this->db->update('approval_final',$data);
    }

    function updateApprovalKdWs($id,$data)
    {
        $this->db->where('id_order',$id);
        $this->db->update('approval',$data);
    }

    
}