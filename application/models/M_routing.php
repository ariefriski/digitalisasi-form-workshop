<?php 
date_default_timezone_set('Asia/Jakarta');
class M_routing extends CI_model
{
	var $table = 'routing';
	var $column_order = array(null, 'status'); //set column field database for datatable orderable
	var $column_search = array('status'); //set column field database for datatable searchable 
	var $orderr = array('id_routing' => 'desc'); // default order

    public function getRoutingList($id)
    {
        $this->db->select('routing.*');
        $this->db->from('routing');
        // $this->db->where('id_order',$id);
        $query = $this->db->get();
        return $query->result_array();
    }


	public function count_all()
    {
        $this->db->from($this->table);
		return $this->db->count_all_results();
    }
    public function count_filtered()
    {
        $this->_get_datatables_query_1();
		$query = $this->db->get();
		return $query->num_rows();
    }

	public function addRouting($data)
	{
		$this->db->insert('routing',$data);
	}

	private function _get_datatables_query_1()
    {
        $this->db->select('routing.*,order.*,user.name,department.department_name');
        $this->db->from('routing');
		$this->db->join('order','routing.id_order=order.id_order');
		$this->db->join('user','order.id_user=user.id_user');
		$this->db->join('department','order.id_department=department.id_department');
		
        $i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
            if(isset($_POST['orderr'])) // here order processing
		    {
			$this->db->order_by($this->column_order[$_POST['orderr']['0']['column']], $_POST['orderr']['0']['dir']);
		    } 
		    else if(isset($this->orderr))
		    {
			$orderr = $this->orderr;
			$this->db->order_by(key($orderr), $orderr[key($orderr)]);
		    }
		}


    }
	function get_datatables_1()
	{
		$this->_get_datatables_query_1();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function selectRouting()
    {
        $this->db->select('process.id_proses,process.nama_proses');
		$this->db->from('process');
        $result = $this->db->get();
        return $result->result_array();
    }

	function addEstimateRouting($data)
	{
		$this->db->insert('detail_estimate_routing',$data);
	}

	function updEstimateRouting($id,$total_cost_material)
	{
		$this->db->set('total_cost_material',$total_cost_material);
		$this->db->where('id_order',$id);
		$this->db->update('detail_estimate_routing');
	}

	function updateEstimateRouting($id,$total_cost_process,$total_all,$total_hour,$response_order)
	{
		$this->db->set('total_cost_process',$total_cost_process);
		$this->db->set('total_all',$total_all);
		$this->db->set('total_hour',$total_hour);
		$this->db->set('tempat_pembuatan',$response_order);
		$this->db->where('id_order',$id);
		$this->db->update('detail_estimate_routing');
	}
	function getTotalCostMaterialByIdOrder($id)
	{
		return $this->db->get_where('detail_estimate_routing',array('id_order'=>$id))->result_array();
	}

	function getDataRoutingPlan($id)
	{
		$this->db->select('routing_plan.*, process.nama_proses');
		$this->db->from('routing_plan');
		$this->db->join('process', 'process.id_proses = routing_plan.id_proses');
		$this->db->where('id_order',$id);
		return $this->db->get()->result_array();
	}
}
?>