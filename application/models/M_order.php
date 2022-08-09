<?php 
date_default_timezone_set('Asia/Jakarta');
class M_order extends CI_model
{
    var $table = 'order';
	var $column_order = array(null, 'nama_part'); //set column field database for datatable orderable
	var $column_search = array('nama_part'); //set column field database for datatable searchable 
	var $orderr = array('kategori' => 'desc'); // default order
    
    public function addOrder($data)
    {
        
        $this->db->insert('order',$data);
        
    }

    public function updateOrder($id,$data)
    {   
        //extract($data);
        // $this->db->where('id_order',$id);
        // $this->db->update('order',$data);
        $row = $this->db->where('id_order',$id)->get('order')->row();
        if($row->attachment != $data['attachment']){
        unlink('./uploads/'.$row->attachment);
        $this->db->where('id_order',$id);
        $this->db->update($this->table,$data);
        }else{
        $this->db->where('id_order',$id);
        $this->db->update($this->table,$data);
        }
        
        
    }

    public function updateOrderNoPict($id,$data)
    {
        $this->db->where('id_order',$id);
        $this->db->update('order',$data);
    }

    public function getNpk($npk)
    {
        $this->db->select('id_customer, npk as text');
        $this->db->like('npk',$npk);
        $query = $this->db->get('customer');
        return $query->result();
    }


    private function _get_datatables_query()
    {
        $this->db->select('order.*');
        $this->db->from('order');
        if ($this->session->userdata('level') == 'kadept' || $this->session->userdata('level') == 'user') {
			$this->db->where('order.id_department',$this->session->id_department);
		}
        
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

    private function _get_datatables_query_1()
    {
        $this->db->select('order.*');
        $this->db->from('order');
        
        
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

    function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

    function get_datatables_1()
	{
		$this->_get_datatables_query_1();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}


    public function getListForm()
    {
        return $this->db->get('order')->result();
    }

    public function getRowOrder($id)
    {
        return $this->db->get_where('order',array('id_order'=>$id))->num_rows();
    }

    public function deleteOrder($id)
    {
        $row = $this->db->where('id_order',$id)->get('order')->row();
        unlink('./uploads/'.$row->attachment);
        $this->db->where('id_order',$id);
        $this->db->delete($this->table);
        return true;
    }

    public function getResponseOrder($id)
    {
        $this->db->select('order.*,department.department_name,user.npk,user.name');
        $this->db->from('order');
        $this->db->join('department','order.id_department=department.id_department');
        $this->db->join('user','order.id_user=user.id_user');
        $this->db->where('order.id_order',$id);
        return $this->db->get()->result_array();
    }

    public function getDepartmentName($id)
    {
        $this->db->select('department.department_name');
        $this->db->from('department');
        $this->db->join('order','department.id_department=order.id_department');
        $this->db->where('department.id_department',$id);
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
        $this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
    }
}
?>