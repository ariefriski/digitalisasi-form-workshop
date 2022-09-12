<?php 

class M_routing_actual extends CI_model
{
    function inputRoutimeActual($data) {
        $this->db->insert('routing_actual', $data);
    }
    function inputDetailActualRouting($data) {
        $this->db->insert('detail_actual_routing', $data);
    }

    function inputStartWorkingDate($data)
    {
        $this->db->insert('working_order',$data);
    }

    function updateEndWorking($id_order,$end_working)
    {
        $this->db->set('end_working',$end_working);
		$this->db->where('id_order',$id_order);
		$this->db->update('working_order');
    }

    function pieChart()
    {
        
        $this->db->select('order_type AS hasil,count(*) AS total');
        $this->db->from('order');
        $this->db->group_by(array('order_type','MONTH(created_at)'));
        return  $this->db->get();
       
    }


    function tableRunningHour()
    {
        $query = $this->db->query("SELECT MONTH([dbo].[order].created_at) as Bulan,SUM(detail_actual_routing.total_hour)as count FROM detail_actual_routing
		JOIN [dbo].[order] ON detail_actual_routing.id_order=[dbo].[order].id_order GROUP BY  MONTH([dbo].[order].created_at)"); 
        return $query->result_array();
    }

    function tableRunningCost()
    {
        $query = $this->db->query("SELECT MONTH([dbo].[order].created_at) as Bulan,SUM(detail_actual_routing.total_cost_process)as count FROM detail_actual_routing
		JOIN [dbo].[order] ON detail_actual_routing.id_order=[dbo].[order].id_order GROUP BY  MONTH([dbo].[order].created_at)"); 
        return $query->result_array();
    }

    function tableTotalRunningCost()
    {
        $query = $this->db->query("SELECT MONTH([dbo].[order].created_at) as Bulan,SUM(detail_actual_routing.total_cost_process * 0.3)as count FROM detail_actual_routing
		JOIN [dbo].[order] ON detail_actual_routing.id_order=[dbo].[order].id_order GROUP BY  MONTH([dbo].[order].created_at)"); 
        return $query->result_array();
    }

    function quantityJobOrder()
    {
        $query = $this->db->query("SELECT section.section_name as seksi,COUNT(id_order) as count FROM [dbo].[order] 
        JOIN section ON [dbo].[order].id_section=section.id_section GROUP BY section.section_name,[dbo].[order].id_section"); 
        return $query->result_array();
    }

    function jobOrder()
    {
        $query = $this->db->query("SELECT order_type ,count(*) AS total from [dbo].[order]
        GROUP BY order_type,MONtH(created_at)"); 
        return $query->result_array();
    }

    
  

}

