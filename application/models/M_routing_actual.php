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


    function tableRunningHour($tahun)
    {
        $query = $this->db->query("SELECT [dbo].[order].status_pengerjaan,MONTH([dbo].[order].created_at) as Bulan,SUM(detail_actual_routing.total_hour)as count FROM detail_actual_routing
		JOIN [dbo].[order] ON detail_actual_routing.id_order=[dbo].[order].id_order WHERE [dbo].[order].status_pengerjaan='Finish' AND YEAR([dbo].[order].tanggal)=$tahun GROUP BY  MONTH([dbo].[order].created_at),[dbo].[order].status_pengerjaan"); 
        return $query->result_array();
    }

    function tableRunningCost($tahun)
    {
        $query = $this->db->query("SELECT [dbo].[order].status_pengerjaan,MONTH([dbo].[order].created_at) as Bulan,SUM(detail_actual_routing.total_cost_process)as count FROM detail_actual_routing
		JOIN [dbo].[order] ON detail_actual_routing.id_order=[dbo].[order].id_order WHERE [dbo].[order].status_pengerjaan='Finish' AND YEAR([dbo].[order].tanggal)=$tahun GROUP BY  MONTH([dbo].[order].created_at),[dbo].[order].status_pengerjaan"); 
        return $query->result_array();
    }

    function tableTotalRunningCost($tahun)
    {
        $query = $this->db->query("SELECT [dbo].[order].status_pengerjaan,MONTH([dbo].[order].created_at) as Bulan,SUM(detail_actual_routing.total_cost_process * 0.3)as count FROM detail_actual_routing
		JOIN [dbo].[order] ON detail_actual_routing.id_order=[dbo].[order].id_order WHERE [dbo].[order].status_pengerjaan='Finish' AND YEAR([dbo].[order].tanggal)=$tahun GROUP BY  MONTH([dbo].[order].created_at),[dbo].[order].status_pengerjaan"); 
        return $query->result_array();
    }

    function quantityJobOrder($tahun)
    {
        $query = $this->db->query("SELECT [dbo].[order].status_pengerjaan,section.section_name as seksi,COUNT(id_order) as count FROM [dbo].[order] 
        JOIN section ON [dbo].[order].id_section=section.id_section WHERE [dbo].[order].status_pengerjaan='Finish' AND YEAR([dbo].[order].tanggal)=$tahun GROUP BY section.section_name,[dbo].[order].id_section,[dbo].[order].status_pengerjaan"); 
        return $query->result_array();
    }

    function jobOrder($tahun)
    {
        $query = $this->db->query("SELECT order_type ,count(*) AS total from [dbo].[order] WHERE YEAR([dbo].[order].tanggal)=$tahun AND [dbo].[order].status_pengerjaan='Finish'
        GROUP BY order_type"); 
        return $query->result_array();
    }

    
  

}

