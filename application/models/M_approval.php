<?php 
date_default_timezone_set('Asia/Jakarta');
class M_approval extends CI_model
{
    function addApproval($data)
    {
        $this->db->insert('approval',$data);
    }

    function addApprovalPic($data)
    {
        $this->db->insert('approval_pic_workshop',$data);
    }
}