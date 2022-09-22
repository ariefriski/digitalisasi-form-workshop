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

    
   

    function searchIdOrder($formatIdOrder)
    {
        $this->db->get_where('order',array('id_order'=>$formatIdOrder))->num_rows();
    }

    function get_datatables_kadept_user()
	{
		$this->_get_datatables_kadept_user();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
    
    private function _get_datatables_kadept_user()
    {
        $this->db->select('order.*,approval.status_approval_1,approval.approve1');
        $this->db->from('order');
        $this->db->join('approval','order.id_order=approval.id_order','left');
        $this->db->where('order.id_department',$this->session->id_department);

        
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

   
    
    // ($l->status_approval_1==NULL)||($l->status_approval_2==NULL)||($l->status_approval==NULL)
    
    private function _get_datatables_user()
    {
        $this->db->select('order.*,approval.status_approval_1,approval_pic_workshop.status_approval_2,approval_final.status_approval,approval.approve1,approval.approve2,approval.approve3,
        approval_pic_workshop.alasan_2,approval.alasan,approval_final.alasan_3,detail_estimate_routing.tempat_pembuatan');
        $this->db->from('order');
        $this->db->join('approval','order.id_order=approval.id_order','left');
        $this->db->join('approval_pic_workshop','order.id_order=approval_pic_workshop.id_order','left');
        $this->db->join('approval_final','order.id_order=approval_final.id_order','left');
        $this->db->join('detail_estimate_routing','order.id_order=detail_estimate_routing.id_order','left');
        if ($this->session->userdata('level') == 'user'){
			$this->db->where('order.id_user',$this->session->id_user);
		} else if($this->session->userdata('level') == 'kasie_user'){
        $this->db->where('order.id_department',$this->session->id_department);
        $this->db->where('order.id_section',$this->session->id_section);
        }else if($this->session->userdata('level') == 'kadept_user'){
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

    function get_datatables_user()
	{
		$this->_get_datatables_user();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

    public function count_filtered_user_dashboard()
    {
        $this->_get_datatables_user();
        $this->db->where('order.status_pengerjaan','WAITING');
        $this->db->where('approval.alasan',NULL);
        $this->db->where('approval_pic_workshop.alasan_2',NULL);
        $this->db->where('approval_final.alasan_3',NULL);
        $this->db->where('approval.approve1 !=','no');
        // $this->db->where('approval_pic_workshop.alasan_2',NULL);
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function count_all_user_dashboard()
    { 
        $this->db->select('order.*,approval.status_approval_1,approval_pic_workshop.status_approval_2,approval_final.status_approval,approval.approve1,approval.approve2,approval.approve3,
        approval_pic_workshop.alasan_2');
        $this->db->from('order');
        $this->db->join('approval','order.id_order=approval.id_order','left');
        $this->db->join('approval_pic_workshop','order.id_order=approval_pic_workshop.id_order','left');
        $this->db->join('approval_final','order.id_order=approval_final.id_order','left');
        $this->db->where('order.status_pengerjaan','WAITING');
        $this->db->where('approval.alasan',NULL);
        $this->db->where('approval_pic_workshop.alasan_2',NULL);
        $this->db->where('approval_final.alasan_3',NULL);
        $this->db->where('approval.approve1 !=','no');
        // $this->db->where('approval_pic_workshop.alasan_2',NULL);
        return $this->db->count_all_results();
    }

    public function count_filtered_user_response()
    {
        $this->_get_datatables_user();
        $this->db->where("(approval.alasan IS NOT NULL OR approval_pic_workshop.alasan_2 IS NOT NULL OR approval_final.alasan_3 IS NOT NULL)");
        // $this->db->or_where('(approval.alasan IS NOT NULL');
        // $this->db->or_where('approval_pic_workshop.alasan_2 IS NOT NULL');
        // $this->db->or_where('approval_final.alasan_3 IS NOT NULL)'); 
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function count_all_user_response()
    { 
        $sql = 'SELECT [dbo].[order].*,approval_pic_workshop.status_approval_2,approval_pic_workshop.alasan_2,approval.alasan,approval_final.alasan_3 FROM [dbo].[order]
		LEFT JOIN  approval_pic_workshop ON [dbo].[order].id_order=approval_pic_workshop.id_order
		LEFT JOIN  approval ON [dbo].[order].id_order=approval.id_order
		LEFT JOIN approval_final ON [dbo].[order].id_order=approval_final.id_order
		WHERE [dbo].[order].id_user = '.$this->session->id_user.'
        AND (approval.alasan IS NOT NULL OR approval_pic_workshop.alasan_2 IS NOT NULL OR approval_final.alasan_3 IS NOT NULL)';
        $this->db->query($sql);
        return $this->db->count_all_results();
    }

    public function count_filtered_user_response_proses()
    {
        $this->_get_datatables_user();
        
        $this->db->where('approval.status_approval_1','Disetujui');
        $this->db->where('approval_pic_workshop.status_approval_2','Disetujui');
        $this->db->where('approval_final.status_approval','Disetujui');
        $this->db->where('order.status_pengerjaan','On Working');
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function count_all_user_response_proses()
    { 
        $this->db->select('order.*,approval.status_approval_1,approval_pic_workshop.status_approval_2,approval_final.status_approval,approval.approve1,approval.approve2,approval.approve3');
        $this->db->from('order');
        $this->db->join('approval','order.id_order=approval.id_order','left');
        $this->db->join('approval_pic_workshop','order.id_order=approval_pic_workshop.id_order','left');
        $this->db->join('approval_final','order.id_order=approval_final.id_order','left');
        $this->db->where('order.id_user',$this->session->id_user);
        $this->db->where('approval.status_approval_1','Disetujui');
        $this->db->where('approval_pic_workshop.status_approval_2','Disetujui');
        $this->db->where('approval_final.status_approval','Disetujui');
        $this->db->where('order.status_pengerjaan','On Working');
        return $this->db->count_all_results();
    }

    public function count_filtered_user_response_finish()
    {
        $this->_get_datatables_user();
        $this->db->where('approval.status_approval_1','Disetujui');
        $this->db->where('approval_pic_workshop.status_approval_2','Disetujui');
        $this->db->where('approval_final.status_approval','Disetujui');
        $this->db->where('order.status_pengerjaan','Finish');
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function count_all_user_response_finish()
    { 
        $this->db->select('order.*,approval.status_approval_1,approval_pic_workshop.status_approval_2,approval_final.status_approval,approval.approve1,approval.approve2,approval.approve3');
        $this->db->from('order');
        $this->db->join('approval','order.id_order=approval.id_order','left');
        $this->db->join('approval_pic_workshop','order.id_order=approval_pic_workshop.id_order','left');
        $this->db->join('approval_final','order.id_order=approval_final.id_order','left');
        $this->db->where('order.id_user',$this->session->id_user);
        $this->db->where('approval.status_approval_1','Disetujui');
        $this->db->where('approval_pic_workshop.status_approval_2','Disetujui');
        $this->db->where('approval_final.status_approval','Disetujui');
        $this->db->where('order.status_pengerjaan','Finish');
        return $this->db->count_all_results();
    }
    

    public function count_filtered_kasie_user_dashboard()
    {
        $this->_get_datatables_user();
        $this->db->where('approval.approve1','new');
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function count_all_kasie_user_dashboard()
    { 
        $this->db->select('order.*,approval.status_approval_1,approval_pic_workshop.status_approval_2,approval_final.status_approval,approval.approve1,approval.approve2,approval.approve3,
        approval_pic_workshop.alasan_2');
        $this->db->from('order');
        $this->db->join('approval','order.id_order=approval.id_order','left');
        $this->db->join('approval_pic_workshop','order.id_order=approval_pic_workshop.id_order','left');
        $this->db->join('approval_final','order.id_order=approval_final.id_order','left');
        $this->db->where('order.id_section',$this->session->id_section);
        $this->db->where('order.id_department',$this->session->id_department);
        $this->db->where('approval.approve1','new');
        return $this->db->count_all_results();
    }

    public function count_filtered_kasie_user_response()
    {
        $this->_get_datatables_user();
        $this->db->where('approval.status_approval_1','Disetujui');
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function count_all_kasie_user_response()
    { 
        $this->db->select('order.*,approval.status_approval_1,approval_pic_workshop.status_approval_2,approval_final.status_approval,approval.approve1,approval.approve2,approval.approve3');
        $this->db->from('order');
        $this->db->join('approval','order.id_order=approval.id_order','left');
        $this->db->join('approval_pic_workshop','order.id_order=approval_pic_workshop.id_order','left');
        $this->db->join('approval_final','order.id_order=approval_final.id_order','left');
        $this->db->where('order.id_section',$this->session->id_section);
        $this->db->where('order.id_department',$this->session->id_department);
        $this->db->where('approval.status_approval_1','Disetujui');
        return $this->db->count_all_results();
    }

   

    public function count_filtered_kasie_user_tolak()
    {
        $this->_get_datatables_user();
        $this->db->where('approval.status_approval_1','Ditolak');
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function count_all_kasie_user_tolak()
    { 
        $this->db->select('order.*,approval.status_approval_1,approval_pic_workshop.status_approval_2,approval_final.status_approval,approval.approve1,approval.approve2,approval.approve3');
        $this->db->from('order');
        $this->db->join('approval','order.id_order=approval.id_order','left');
        $this->db->join('approval_pic_workshop','order.id_order=approval_pic_workshop.id_order','left');
        $this->db->join('approval_final','order.id_order=approval_final.id_order','left');
        $this->db->where('order.id_section',$this->session->id_section);
        $this->db->where('order.id_department',$this->session->id_department);
         $this->db->where('approval.status_approval_1','Ditolak');
        return $this->db->count_all_results();
    }

    //Kad3pt

    public function count_filtered_kadept_user_dashboard()
    {
        $this->_get_datatables_user();
        $this->db->where('approval.approve1','new');
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function count_all_kadept_user_dashboard()
    { 
        $this->db->select('order.*,approval.status_approval_1,approval_pic_workshop.status_approval_2,approval_final.status_approval,approval.approve1,approval.approve2,approval.approve3');
        $this->db->from('order');
        $this->db->join('approval','order.id_order=approval.id_order','left');
        $this->db->join('approval_pic_workshop','order.id_order=approval_pic_workshop.id_order','left');
        $this->db->join('approval_final','order.id_order=approval_final.id_order','left');
        $this->db->where('approval.approve1','new');
        return $this->db->count_all_results();
    }

    public function count_filtered_kadept_user_response()
    {
        $this->_get_datatables_user();
        $this->db->where('approval.status_approval_1','Disetujui');
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function count_all_kadept_user_response()
    { 
        $this->db->select('order.*,approval.status_approval_1,approval_pic_workshop.status_approval_2,approval_final.status_approval,approval.approve1,approval.approve2,approval.approve3');
        $this->db->from('order');
        $this->db->join('approval','order.id_order=approval.id_order','left');
        $this->db->join('approval_pic_workshop','order.id_order=approval_pic_workshop.id_order','left');
        $this->db->join('approval_final','order.id_order=approval_final.id_order','left');
        $this->db->where('order.id_department',$this->session->id_department);
        $this->db->where('approval.status_approval_1','Disetujui');
        return $this->db->count_all_results();
    }

    public function count_filtered_kadept_user_tolak()
    {
        $this->_get_datatables_user();
        $this->db->where('approval.status_approval_1','Ditolak');
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function count_all_kadept_user_tolak()
    { 
        $this->db->select('order.*,approval.status_approval_1,approval_pic_workshop.status_approval_2,approval_final.status_approval,approval.approve1,approval.approve2,approval.approve3');
        $this->db->from('order');
        $this->db->join('approval','order.id_order=approval.id_order','left');
        $this->db->join('approval_pic_workshop','order.id_order=approval_pic_workshop.id_order','left');
        $this->db->join('approval_final','order.id_order=approval_final.id_order','left');
        $this->db->where('order.id_department',$this->session->id_department);
        $this->db->where('approval.status_approval_1','Ditolak');
        return $this->db->count_all_results();
    }
    



    ////////////////////////






    private function _get_datatables_query_1()
    {
        $this->db->select('order.*,approval_pic_workshop.status_approval_2,approval_pic_workshop.alasan_2,approval.status_approval_1,approval.approve1,approval.approve2,approval.approve3,approval.approve4,approval_final.jenis_approval_2,
        approval_final.status_approval,detail_estimate_routing.tempat_pembuatan,scheduling.total_day,
        scheduling.start_date,scheduling.end_date,working_order.start_working,working_order.end_working,
        approval_final.jenis_approval_1,approval_final.jenis_approval_2,approval_final.alasan_3');
        $this->db->from('order');
        $this->db->join('approval_pic_workshop','order.id_order=approval_pic_workshop.id_order','left');
        $this->db->join('approval_final','order.id_order=approval_final.id_order','left');
        $this->db->join('detail_estimate_routing','order.id_order=detail_estimate_routing.id_order','left');
        $this->db->join('scheduling','order.id_order=scheduling.id_order','left');
        $this->db->join('approval','order.id_order=approval.id_order','left');   
        $this->db->join('working_order','order.id_order=working_order.id_order','left');
       
             
        
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

    public function count_filtered_admin_ws_dashboard()
    {
        $this->_get_datatables_query_1();
        $this->db->where('approval_pic_workshop.status_approval_2',NULL);
        $this->db->where('approval.status_approval_1','Disetujui');
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function count_all_admin_ws_dashboard()
    {
        $this->db->select('order.*,approval_pic_workshop.status_approval_2,approval_pic_workshop.alasan_2,approval.status_approval_1,approval.approve1,approval.approve2,approval.approve3,approval.approve4,approval_final.jenis_approval_2,
        approval_final.status_approval,detail_estimate_routing.tempat_pembuatan,scheduling.total_day,
        scheduling.start_date,scheduling.end_date,working_order.start_working,working_order.end_working,
        approval_final.jenis_approval_1,approval_final.jenis_approval_2');
        $this->db->from('order');
        $this->db->join('approval_pic_workshop','order.id_order=approval_pic_workshop.id_order','left');
        $this->db->join('approval_final','order.id_order=approval_final.id_order','left');
        $this->db->join('detail_estimate_routing','order.id_order=detail_estimate_routing.id_order','left');
        $this->db->join('scheduling','order.id_order=scheduling.id_order','left');
        $this->db->join('approval','order.id_order=approval.id_order','left');   
        $this->db->join('working_order','order.id_order=working_order.id_order','left');
        $this->db->where('approval.status_approval_1','Disetujui');
        $this->db->where('approval_pic_workshop.status_approval_2',NULL);
       return $this->db->count_all_results();
    }

    public function count_filtered_admin_ws_reject()
    {
        $this->_get_datatables_query_1();
        $this->db->where('approval_final.status_approval','Ditolak');
        $this->db->or_where('approval_pic_workshop.status_approval_2','Ditolak');
        $this->db->or_where('approval_final.alasan_3 !=',NULL);
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function count_all_admin_ws_reject()
    {
        $this->db->select('order.*,approval_pic_workshop.status_approval_2,approval_pic_workshop.alasan_2,approval.status_approval_1,approval.approve1,approval.approve2,approval.approve3,approval.approve4,approval_final.jenis_approval_2,
        approval_final.status_approval,detail_estimate_routing.tempat_pembuatan,scheduling.total_day,
        scheduling.start_date,scheduling.end_date,working_order.start_working,working_order.end_working,
        approval_final.jenis_approval_1,approval_final.jenis_approval_2,approval_final.alasan_3');
        $this->db->from('order');
        $this->db->join('approval_pic_workshop','order.id_order=approval_pic_workshop.id_order','left');
        $this->db->join('approval_final','order.id_order=approval_final.id_order','left');
        $this->db->join('detail_estimate_routing','order.id_order=detail_estimate_routing.id_order','left');
        $this->db->join('scheduling','order.id_order=scheduling.id_order','left');
        $this->db->join('approval','order.id_order=approval.id_order','left');   
        $this->db->join('working_order','order.id_order=working_order.id_order','left');
        $this->db->where('approval_final.status_approval','Ditolak');
        $this->db->or_where('approval_pic_workshop.status_approval_2','Ditolak');
        $this->db->or_where('approval_final.alasan_3 !=',NULL);
       return $this->db->count_all_results();
    }

    public function count_filtered_admin_ws_wait_aprove()
    {
        $this->_get_datatables_query_1();
        $this->db->where('approval.status_approval_1','Disetujui');
        $this->db->where('approval_pic_workshop.status_approval_2','Disetujui');
        $this->db->where('approval_final.status_approval !=','Ditolak');
        $this->db->where('order.status_pengerjaan','WAITING');   
        $this->db->where('order.kategori','urgent');
        $this->db->where('approval.approve4',NULL);
        $this->db->or_where('order.kategori','biasa');
        $this->db->where('approval.approve3',NULL);
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function count_all_admin_ws_wait_aprove()
    {
        $this->db->select('order.*,approval_pic_workshop.status_approval_2,approval_pic_workshop.alasan_2,approval.status_approval_1,approval.approve1,approval.approve2,approval.approve3,approval.approve4,approval_final.jenis_approval_2,
        approval_final.status_approval,detail_estimate_routing.tempat_pembuatan,scheduling.total_day,
        scheduling.start_date,scheduling.end_date,working_order.start_working,working_order.end_working,
        approval_final.jenis_approval_1,approval_final.jenis_approval_2');
        $this->db->from('order');
        $this->db->join('approval_pic_workshop','order.id_order=approval_pic_workshop.id_order','left');
        $this->db->join('approval_final','order.id_order=approval_final.id_order','left');
        $this->db->join('detail_estimate_routing','order.id_order=detail_estimate_routing.id_order','left');
        $this->db->join('scheduling','order.id_order=scheduling.id_order','left');
        $this->db->join('approval','order.id_order=approval.id_order','left');   
        $this->db->join('working_order','order.id_order=working_order.id_order','left');
        $this->db->where('approval.status_approval_1','Disetujui');
        $this->db->where('approval_pic_workshop.status_approval_2','Disetujui');
        $this->db->where('approval_final.status_approval !=','Ditolak');
        $this->db->where('order.status_pengerjaan','WAITING');  
        $this->db->where('order.kategori','urgent');
        $this->db->where('approval.approve4',NULL);
        $this->db->or_where('order.kategori','biasa');
        $this->db->where('approval.approve3',NULL);
        return $this->db->count_all_results();
    }

    public function count_filtered_admin_ws_input()
    {
        $this->_get_datatables_query_1();
        $this->db->where('order.kategori','urgent');
        $this->db->where('detail_estimate_routing.tempat_pembuatan',NULL);
        $this->db->where('approval.approve4 !=',NULL);
        $this->db->or_where('order.kategori','biasa');
        $this->db->where('approval.approve3 !=',NULL);
        $this->db->where('detail_estimate_routing.tempat_pembuatan',NULL);
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function count_all_admin_ws_input()
    {
        $this->db->select('order.*,approval_pic_workshop.status_approval_2,approval_pic_workshop.alasan_2,approval.status_approval_1,approval.approve1,approval.approve2,approval.approve3,approval.approve4,approval_final.jenis_approval_2,
        approval_final.status_approval,detail_estimate_routing.tempat_pembuatan,scheduling.total_day,
        scheduling.start_date,scheduling.end_date,working_order.start_working,working_order.end_working,
        approval_final.jenis_approval_1,approval_final.jenis_approval_2');
        $this->db->from('order');
        $this->db->join('approval_pic_workshop','order.id_order=approval_pic_workshop.id_order','left');
        $this->db->join('approval_final','order.id_order=approval_final.id_order','left');
        $this->db->join('detail_estimate_routing','order.id_order=detail_estimate_routing.id_order','left');
        $this->db->join('scheduling','order.id_order=scheduling.id_order','left');
        $this->db->join('approval','order.id_order=approval.id_order','left');   
        $this->db->join('working_order','order.id_order=working_order.id_order','left');
        $this->db->where('order.kategori','urgent');
        $this->db->where('detail_estimate_routing.tempat_pembuatan',NULL);
        $this->db->where('approval.approve4 !=',NULL);
        $this->db->or_where('order.kategori','biasa');
        $this->db->where('approval.approve3 !=',NULL);
       
       return $this->db->count_all_results();
    }

    public function count_filtered_admin_ws_waiting_for_working()
    {
        $this->_get_datatables_query_1();
        $this->db->where('order.status_pengerjaan','On Scheduling');
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function count_all_admin_ws_waiting_for_working()
    {
        $this->db->select('order.*,approval_pic_workshop.status_approval_2,approval_pic_workshop.alasan_2,approval.status_approval_1,approval.approve1,approval.approve2,approval.approve3,approval.approve4,approval_final.jenis_approval_2,
        approval_final.status_approval,detail_estimate_routing.tempat_pembuatan,scheduling.total_day,
        scheduling.start_date,scheduling.end_date,working_order.start_working,working_order.end_working,
        approval_final.jenis_approval_1,approval_final.jenis_approval_2');
        $this->db->from('order');
        $this->db->join('approval_pic_workshop','order.id_order=approval_pic_workshop.id_order','left');
        $this->db->join('approval_final','order.id_order=approval_final.id_order','left');
        $this->db->join('detail_estimate_routing','order.id_order=detail_estimate_routing.id_order','left');
        $this->db->join('scheduling','order.id_order=scheduling.id_order','left');
        $this->db->join('approval','order.id_order=approval.id_order','left');   
        $this->db->join('working_order','order.id_order=working_order.id_order','left');
        $this->db->where('order.status_pengerjaan','On Scheduling');
       return $this->db->count_all_results();
    }


    public function count_filtered_admin_ws_schedulling()
    {
        $this->_get_datatables_query_1();
        $this->db->where('approval.status_approval_1','Disetujui');
        $this->db->where('approval_pic_workshop.status_approval_2','Disetujui');
        $this->db->where('approval_final.status_approval','Disetujui');
        $this->db->where('detail_estimate_routing.tempat_pembuatan !=',NULL);
        $this->db->where('scheduling.total_day',NULL);
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function count_all_admin_ws_schedulling()
    {
        $this->db->select('order.*,approval_pic_workshop.status_approval_2,approval_pic_workshop.alasan_2,approval.status_approval_1,approval.approve1,approval.approve2,approval.approve3,approval.approve4,approval_final.jenis_approval_2,
        approval_final.status_approval,detail_estimate_routing.tempat_pembuatan,scheduling.total_day,
        scheduling.start_date,scheduling.end_date,working_order.start_working,working_order.end_working,
        approval_final.jenis_approval_1,approval_final.jenis_approval_2');
        $this->db->from('order');
        $this->db->join('approval_pic_workshop','order.id_order=approval_pic_workshop.id_order','left');
        $this->db->join('approval_final','order.id_order=approval_final.id_order','left');
        $this->db->join('detail_estimate_routing','order.id_order=detail_estimate_routing.id_order','left');
        $this->db->join('scheduling','order.id_order=scheduling.id_order','left');
        $this->db->join('approval','order.id_order=approval.id_order','left');   
        $this->db->join('working_order','order.id_order=working_order.id_order','left');
        $this->db->where('approval.status_approval_1','Disetujui');
        $this->db->where('approval_pic_workshop.status_approval_2','Disetujui');
        $this->db->where('approval_final.status_approval','Disetujui');
        $this->db->where('detail_estimate_routing.tempat_pembuatan !=',NULL);
        $this->db->where('scheduling.total_day',NULL);
       return $this->db->count_all_results();
    }

    public function count_filtered_admin_ws_working()
    {
        $this->_get_datatables_query_1();
        $this->db->where('order.status_pengerjaan','On Working');
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function count_all_admin_ws_working()
    {
        $this->db->select('order.*,approval_pic_workshop.status_approval_2,approval_pic_workshop.alasan_2,approval.status_approval_1,approval.approve1,approval.approve2,approval.approve3,approval.approve4,approval_final.jenis_approval_2,
        approval_final.status_approval,detail_estimate_routing.tempat_pembuatan,scheduling.total_day,
        scheduling.start_date,scheduling.end_date,working_order.start_working,working_order.end_working,
        approval_final.jenis_approval_1,approval_final.jenis_approval_2');
        $this->db->from('order');
        $this->db->join('approval_pic_workshop','order.id_order=approval_pic_workshop.id_order','left');
        $this->db->join('approval_final','order.id_order=approval_final.id_order','left');
        $this->db->join('detail_estimate_routing','order.id_order=detail_estimate_routing.id_order','left');
        $this->db->join('scheduling','order.id_order=scheduling.id_order','left');
        $this->db->join('approval','order.id_order=approval.id_order','left');   
        $this->db->join('working_order','order.id_order=working_order.id_order','left');
        $this->db->where('order.status_pengerjaan','On Working');
       return $this->db->count_all_results();
    }
    public function count_filtered_admin_ws_finish()
    {
        $this->_get_datatables_query_1();
        $this->db->where('approval.status_approval_1','Disetujui');
        $this->db->where('approval_pic_workshop.status_approval_2','Disetujui');
        $this->db->where('approval_final.status_approval','Disetujui');
        $this->db->where('order.status_pengerjaan','Finish');
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function count_all_admin_ws_finish()
    {
        $this->db->select('order.*,approval_pic_workshop.status_approval_2,approval_pic_workshop.alasan_2,approval.status_approval_1,approval.approve1,approval.approve2,approval.approve3,approval.approve4,approval_final.jenis_approval_2,
        approval_final.status_approval,detail_estimate_routing.tempat_pembuatan,scheduling.total_day,
        scheduling.start_date,scheduling.end_date,working_order.start_working,working_order.end_working,
        approval_final.jenis_approval_1,approval_final.jenis_approval_2');
        $this->db->from('order');
        $this->db->join('approval_pic_workshop','order.id_order=approval_pic_workshop.id_order','left');
        $this->db->join('approval_final','order.id_order=approval_final.id_order','left');
        $this->db->join('detail_estimate_routing','order.id_order=detail_estimate_routing.id_order','left');
        $this->db->join('scheduling','order.id_order=scheduling.id_order','left');
        $this->db->join('approval','order.id_order=approval.id_order','left');   
        $this->db->join('working_order','order.id_order=working_order.id_order','left');
        $this->db->where('approval.status_approval_1','Disetujui');
        $this->db->where('approval_pic_workshop.status_approval_2','Disetujui');
        $this->db->where('approval_final.status_approval','Disetujui');
        $this->db->where('order.status_pengerjaan','Finish');
       return $this->db->count_all_results();
    }

    ///////////Kasie ws
    public function count_filtered_kasie_ws()
    {
        $this->_get_datatables_query_1();
        $this->db->where('approval_pic_workshop.status_approval_2','Disetujui');
        $this->db->where('approval.approve2','ok');
        $this->db->where('approval.approve3',NULL);
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function count_all_kasie_ws()
    {
        $this->db->select('order.*,approval_pic_workshop.status_approval_2,approval_pic_workshop.alasan_2,approval.status_approval_1,approval.approve1,approval.approve2,approval.approve3,approval.approve4,approval_final.jenis_approval_2,
        approval_final.status_approval,detail_estimate_routing.tempat_pembuatan,scheduling.total_day,
        scheduling.start_date,scheduling.end_date,working_order.start_working,working_order.end_working,
        approval_final.jenis_approval_1,approval_final.jenis_approval_2');
        $this->db->from('order');
        $this->db->join('approval_pic_workshop','order.id_order=approval_pic_workshop.id_order','left');
        $this->db->join('approval_final','order.id_order=approval_final.id_order','left');
        $this->db->join('detail_estimate_routing','order.id_order=detail_estimate_routing.id_order','left');
        $this->db->join('scheduling','order.id_order=scheduling.id_order','left');
        $this->db->join('approval','order.id_order=approval.id_order','left');   
        $this->db->join('working_order','order.id_order=working_order.id_order','left');
        $this->db->where('approval_pic_workshop.status_approval_2','Disetujui');
        $this->db->where('approval.approve2','ok');
        $this->db->where('approval.approve3',NULL);
       return $this->db->count_all_results();
    }

    public function count_filtered_kasie_ws_reject()
    {
        $this->_get_datatables_query_1();
        $this->db->where('approval_final.status_approval','Ditolak');
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function count_all_kasie_ws_reject()
    {
        $this->db->select('order.*,approval_pic_workshop.status_approval_2,approval_pic_workshop.alasan_2,approval.status_approval_1,approval.approve1,approval.approve2,approval.approve3,approval.approve4,approval_final.jenis_approval_2,
        approval_final.status_approval,detail_estimate_routing.tempat_pembuatan,scheduling.total_day,
        scheduling.start_date,scheduling.end_date,working_order.start_working,working_order.end_working,
        approval_final.jenis_approval_1,approval_final.jenis_approval_2');
        $this->db->from('order');
        $this->db->join('approval_pic_workshop','order.id_order=approval_pic_workshop.id_order','left');
        $this->db->join('approval_final','order.id_order=approval_final.id_order','left');
        $this->db->join('detail_estimate_routing','order.id_order=detail_estimate_routing.id_order','left');
        $this->db->join('scheduling','order.id_order=scheduling.id_order','left');
        $this->db->join('approval','order.id_order=approval.id_order','left');   
        $this->db->join('working_order','order.id_order=working_order.id_order','left');
        $this->db->where('approval_final.status_approval','Ditolak');
       return $this->db->count_all_results();
    }

    public function count_filtered_kasie_ws_response()
    {
        $this->_get_datatables_query_1();
        $this->db->where('approval.approve3','ok');
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function count_all_kasie_ws_response()
    {
        $this->db->select('order.*,approval_pic_workshop.status_approval_2,approval_pic_workshop.alasan_2,approval.status_approval_1,approval.approve1,approval.approve2,approval.approve3,approval.approve4,approval_final.jenis_approval_2,
        approval_final.status_approval,detail_estimate_routing.tempat_pembuatan,scheduling.total_day,
        scheduling.start_date,scheduling.end_date,working_order.start_working,working_order.end_working,
        approval_final.jenis_approval_1,approval_final.jenis_approval_2');
        $this->db->from('order');
        $this->db->join('approval_pic_workshop','order.id_order=approval_pic_workshop.id_order','left');
        $this->db->join('approval_final','order.id_order=approval_final.id_order','left');
        $this->db->join('detail_estimate_routing','order.id_order=detail_estimate_routing.id_order','left');
        $this->db->join('scheduling','order.id_order=scheduling.id_order','left');
        $this->db->join('approval','order.id_order=approval.id_order','left');   
        $this->db->join('working_order','order.id_order=working_order.id_order','left');
        $this->db->where('approval.approve3','ok');
       return $this->db->count_all_results();
    }

    public function count_filtered_kadept_ws()
    {
        $this->_get_datatables_query_1();
        $this->db->where('order.kategori','urgent');
        $this->db->where('approval.approve2','ok');
        $this->db->where('approval_final.jenis_approval_2',NULL);
        $this->db->where('approval_final.status_approval','Disetujui');
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function count_all_kadept_ws()
    {
        $this->db->select('order.*,approval_pic_workshop.status_approval_2,approval_pic_workshop.alasan_2,approval.status_approval_1,approval.approve1,approval.approve2,approval.approve3,approval.approve4,approval_final.jenis_approval_2,
        approval_final.status_approval,detail_estimate_routing.tempat_pembuatan,scheduling.total_day,
        scheduling.start_date,scheduling.end_date,working_order.start_working,working_order.end_working,
        approval_final.jenis_approval_1,approval_final.jenis_approval_2');
        $this->db->from('order');
        $this->db->join('approval_pic_workshop','order.id_order=approval_pic_workshop.id_order','left');
        $this->db->join('approval_final','order.id_order=approval_final.id_order','left');
        $this->db->join('detail_estimate_routing','order.id_order=detail_estimate_routing.id_order','left');
        $this->db->join('scheduling','order.id_order=scheduling.id_order','left');
        $this->db->join('approval','order.id_order=approval.id_order','left');   
        $this->db->join('working_order','order.id_order=working_order.id_order','left');
        $this->db->where('order.kategori','urgent');
        $this->db->where('approval.approve2','ok');
        $this->db->where('approval_final.jenis_approval_2',NULL);
        $this->db->where('approval_final.status_approval','Disetujui');
       return $this->db->count_all_results();
    }

    public function count_filtered_kadept_ws_response()
    {
        $this->_get_datatables_query_1();
        $this->db->where('approval_pic_workshop.status_approval_2','Disetujui');
        $this->db->where('approval.approve4','ok');
        $this->db->where('order.kategori','urgent');
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function count_all_kadept_ws_response()
    {
        $this->db->select('order.*,approval_pic_workshop.status_approval_2,approval_pic_workshop.alasan_2,approval.status_approval_1,approval.approve1,approval.approve2,approval.approve3,approval.approve4,approval_final.jenis_approval_2,
        approval_final.status_approval,detail_estimate_routing.tempat_pembuatan,scheduling.total_day,
        scheduling.start_date,scheduling.end_date,working_order.start_working,working_order.end_working,
        approval_final.jenis_approval_1,approval_final.jenis_approval_2');
        $this->db->from('order');
        $this->db->join('approval_pic_workshop','order.id_order=approval_pic_workshop.id_order','left');
        $this->db->join('approval_final','order.id_order=approval_final.id_order','left');
        $this->db->join('detail_estimate_routing','order.id_order=detail_estimate_routing.id_order','left');
        $this->db->join('scheduling','order.id_order=scheduling.id_order','left');
        $this->db->join('approval','order.id_order=approval.id_order','left');   
        $this->db->join('working_order','order.id_order=working_order.id_order','left');
        $this->db->where('approval_pic_workshop.status_approval_2','Disetujui');
        $this->db->where('approval.approve4','ok');
        $this->db->where('order.kategori','urgent');
       return $this->db->count_all_results();
    }

    public function count_filtered_kadept_ws_response_reject()
    {
        $this->_get_datatables_query_1();
        $this->db->where('approval_final.alasan_3 !=',NULL);
        $this->db->where('approval_final.jenis_approval_2','Decline');
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function count_all_kadept_ws_response_reject()
    {
        $this->db->select('order.*,approval_pic_workshop.status_approval_2,approval_pic_workshop.alasan_2,approval.status_approval_1,approval.approve1,approval.approve2,approval.approve3,approval.approve4,approval_final.jenis_approval_2,
        approval_final.status_approval,detail_estimate_routing.tempat_pembuatan,scheduling.total_day,
        scheduling.start_date,scheduling.end_date,working_order.start_working,working_order.end_working,
        approval_final.jenis_approval_1,approval_final.jenis_approval_2,approval_final.alasan_3');
        $this->db->from('order');
        $this->db->join('approval_pic_workshop','order.id_order=approval_pic_workshop.id_order','left');
        $this->db->join('approval_final','order.id_order=approval_final.id_order','left');
        $this->db->join('detail_estimate_routing','order.id_order=detail_estimate_routing.id_order','left');
        $this->db->join('scheduling','order.id_order=scheduling.id_order','left');
        $this->db->join('approval','order.id_order=approval.id_order','left');   
        $this->db->join('working_order','order.id_order=working_order.id_order','left');
        $this->db->where('approval_final.alasan_3 !=',NULL);
        $this->db->where('approval_final.jenis_approval_2','Decline');
       return $this->db->count_all_results();
    }

    public function count_filtered_user_ws_()
    {
        $this->_get_datatables_query_1();
        $this->db->where('order.status_pengerjaan','On Scheduling');
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function count_all_user_ws_()
    {
        $this->db->select('order.*,approval_pic_workshop.status_approval_2,approval_pic_workshop.alasan_2,approval.status_approval_1,approval.approve1,approval.approve2,approval.approve3,approval.approve4,approval_final.jenis_approval_2,
        approval_final.status_approval,detail_estimate_routing.tempat_pembuatan,scheduling.total_day,
        scheduling.start_date,scheduling.end_date,working_order.start_working,working_order.end_working,
        approval_final.jenis_approval_1,approval_final.jenis_approval_2');
        $this->db->from('order');
        $this->db->join('approval_pic_workshop','order.id_order=approval_pic_workshop.id_order','left');
        $this->db->join('approval_final','order.id_order=approval_final.id_order','left');
        $this->db->join('detail_estimate_routing','order.id_order=detail_estimate_routing.id_order','left');
        $this->db->join('scheduling','order.id_order=scheduling.id_order','left');
        $this->db->join('approval','order.id_order=approval.id_order','left');   
        $this->db->join('working_order','order.id_order=working_order.id_order','left');
        $this->db->where('order.status_pengerjaan','On Scheduling');
       return $this->db->count_all_results();
    }

    public function count_filtered_user_ws_response()
    {
        $this->_get_datatables_query_1();
        $this->db->where('order.status_pengerjaan','On Working');
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function count_all_user_ws_response()
    {
        $this->db->select('order.*,approval_pic_workshop.status_approval_2,approval_pic_workshop.alasan_2,approval.status_approval_1,approval.approve1,approval.approve2,approval.approve3,approval.approve4,approval_final.jenis_approval_2,
        approval_final.status_approval,detail_estimate_routing.tempat_pembuatan,scheduling.total_day,
        scheduling.start_date,scheduling.end_date,working_order.start_working,working_order.end_working,
        approval_final.jenis_approval_1,approval_final.jenis_approval_2');
        $this->db->from('order');
        $this->db->join('approval_pic_workshop','order.id_order=approval_pic_workshop.id_order','left');
        $this->db->join('approval_final','order.id_order=approval_final.id_order','left');
        $this->db->join('detail_estimate_routing','order.id_order=detail_estimate_routing.id_order','left');
        $this->db->join('scheduling','order.id_order=scheduling.id_order','left');
        $this->db->join('approval','order.id_order=approval.id_order','left');   
        $this->db->join('working_order','order.id_order=working_order.id_order','left');
        $this->db->where('order.status_pengerjaan','On Working');
       return $this->db->count_all_results();
    }

    public function count_filtered_user_ws_finish()
    {
        $this->_get_datatables_query_1();
        $this->db->where('approval.status_approval_1','Disetujui');
        $this->db->where('approval_pic_workshop.status_approval_2','Disetujui');
        $this->db->where('approval_final.status_approval','Disetujui');
        $this->db->where('order.status_pengerjaan','Finish');
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function count_all_user_ws_finish()
    {
        $this->db->select('order.*,approval_pic_workshop.status_approval_2,approval_pic_workshop.alasan_2,approval.status_approval_1,approval.approve1,approval.approve2,approval.approve3,approval.approve4,approval_final.jenis_approval_2,
        approval_final.status_approval,detail_estimate_routing.tempat_pembuatan,scheduling.total_day,
        scheduling.start_date,scheduling.end_date,working_order.start_working,working_order.end_working,
        approval_final.jenis_approval_1,approval_final.jenis_approval_2');
        $this->db->from('order');
        $this->db->join('approval_pic_workshop','order.id_order=approval_pic_workshop.id_order','left');
        $this->db->join('approval_final','order.id_order=approval_final.id_order','left');
        $this->db->join('detail_estimate_routing','order.id_order=detail_estimate_routing.id_order','left');
        $this->db->join('scheduling','order.id_order=scheduling.id_order','left');
        $this->db->join('approval','order.id_order=approval.id_order','left');   
        $this->db->join('working_order','order.id_order=working_order.id_order','left');
        $this->db->where('approval.status_approval_1','Disetujui');
        $this->db->where('approval_pic_workshop.status_approval_2','Disetujui');
        $this->db->where('approval_final.status_approval','Disetujui');
        $this->db->where('order.status_pengerjaan','Finish');
       return $this->db->count_all_results();
    }


    public function getListForm()
    {
        return $this->db->get('order')->result();
    }

    function getOrderById($id)
    {
        $this->db->select(' order.nama_part, order.id_order, material.nama_material, 
                            detail_estimate_routing.*');
        $this->db->from('order');
        $this->db->join('material','material.id_material = order.id_material');
        $this->db->join('detail_estimate_routing','detail_estimate_routing.id_order = order.id_order');
        $this->db->where('order.id_order', $id);
        $this->db->where('detail_estimate_routing.tempat_pembuatan IS NOT NULL');
        return $this->db->get()->result_array();
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
        $this->db->select('order.*,department.department_name,user.npk,user.name,material.nama_material,
        detail_raw_type.id_raw_type,detail_raw_type.panjang,detail_raw_type.lebar,detail_raw_type.diameter,detail_raw_type.volume,
        detail_raw_type.berat,approval.alasan,approval.jenis_approval,approval.status_approval_1,approval.tanggal,
        approval.approve1,approval.approve2,approval.approve3,detail_estimate_routing.tempat_pembuatan,
        approval_final.status_approval,approval_final.jenis_approval_1,approval_final.alasan_3,approval_final.tanggal_2,approval_final.jenis_approval_2
        ,approval_pic_workshop.status_approval_2,approval_pic_workshop.alasan_2');
        $this->db->from('order');
        $this->db->join('department','order.id_department=department.id_department');
        $this->db->join('user','order.id_user=user.id_user');
        $this->db->join('material','order.id_material=material.id_material','left');
        $this->db->join('detail_raw_type','detail_raw_type.id_order=order.id_order');
        $this->db->join('detail_estimate_routing','order.id_order=detail_estimate_routing.id_order');
        $this->db->join('approval_final','approval_final.id_order=order.id_order','left');
        $this->db->join('approval','approval.id_order=order.id_order','left');
        $this->db->join('approval_pic_workshop','approval_pic_workshop.id_order=order.id_order','left');
        $this->db->where('order.id_order',$id);
        return $this->db->get()->result_array();
    }

    public function getDataForTracker($id){
        $this->db->select('order.*,approval.approve1,approval.approve2,approval.approve3,approval.approve4,
        detail_estimate_routing.tempat_pembuatan');
        $this->db->from('order');
        $this->db->join('approval','order.id_order=approval.id_order','left');
        $this->db->join('detail_estimate_routing','order.id_order=detail_estimate_routing.id_order','left');
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

    

    public function count_all_user_onprocess()
    {
        $this->db->select('order.id_order,approval.status_approval_1,approval_pic_workshop.status_approval_2,approval_final.status_approval,
        detail_estimate_routing.tempat_pembuatan');
        $this->db->from('order');
        $this->db->join('approval','order.id_order=approval.id_order',);
        $this->db->join('approval_pic_workshop','order.id_order=approval_pic_workshop.id_order');
        $this->db->join('approval_final','order.id_order=approval_final.id_order');
        $this->db->join('detail_estimate_routing','order.id_order=detail_estimate_routing.id_order');
        $this->db->where('approval.status_approval_1','Disetujui');
        $this->db->where('approval_pic_workshop.status_approval_2','Disetujui');
        $this->db->where('approval_final.status_approval','Disetujui');
        $this->db->where('detail_estimate_routing.tempat_pembuatan','inhouse');
		return $this->db->count_all_results();
    }

    

    public function count_all_user_reject()
    {
        $this->db->select('order.id_order,approval.status_approval_1,approval_pic_workshop.status_approval_2,approval_final.status_approval');
        $this->db->from('order');
        $this->db->join('approval','order.id_order=approval.id_order','left');
        $this->db->join('approval_pic_workshop','order.id_order=approval_pic_workshop.id_order','left');
        $this->db->join('approval_final','order.id_order=approval_final.id_order','left');
        $this->db->or_where('approval.status_approval_1','Ditolak');
        $this->db->or_where('approval_pic_workshop.status_approval_2','Ditolak');
        $this->db->or_where('approval_final.status_approval','Ditolak');
		return $this->db->count_all_results();
    }

   

    public function count_filtered()
    {
        $this->_get_datatables_user();
		$query = $this->db->get();
		return $query->num_rows();
    }
    public function count_filtered_kadept()
    {
        $this->_get_datatables_kadept_user();
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function count_filtered_user()
    {
        $this->_get_datatables_user();
		$query = $this->db->get();
		return $query->num_rows();
    }

    

    public function addDetailRawType($data)
    {
        $this->db->insert('detail_raw_type',$data);
    }

    function updateDetailRawType($id,$data)
    {
        $this->db->where('id_order',$id);
        $this->db->update('detail_raw_type',$data);
    }

    public function sumRowsOrder()
    {        
        $this->db->select('id_order');
        $this->db->from('order');
        $this->db->where('MONTH(tanggal)', date("n"));
        return $this->db->get()->num_rows();
    }

    public function getLastIdOrder()
    {        
        $this->db->select('id_order');
        $this->db->from('order');
        $this->db->where('MONTH(tanggal)', date("n"));
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit(1);
        return $this->db->get()->result_array();
    }

    function updateTempatPembuatan($id,$response_order)
    {
        $this->db->set('tempat_pembuatan',$response_order);
		$this->db->where('id_order',$id);
		$this->db->update('order');
    }


    //#######################
    // public function count_all_user_dashboard()
    // {
    //     $this->db->select('order.*,approval.status_approval_1,approval_pic_workshop.status_approval_2,approval_final.status_approval,detail_estimate_routing.tempat_pembuatan,
    //     scheduling.total_day,approval.approve1,approval.approve2,approval.approve3');
    //     $this->db->from('order');
    //     $this->db->join('approval','order.id_order=approval.id_order','left');
    //     $this->db->join('approval_pic_workshop','order.id_order=approval_pic_workshop.id_order','left');
    //     $this->db->join('approval_final','order.id_order=approval_final.id_order','left');
    //     $this->db->where('order.status_pengerjaan','WAITING');
    //     $this->db->where('approval.status_approval_1',NULL);
    //     $this->db->where('approval_pic_workshop.status_approval_2',NULL);
    //     $this->db->where('approval_final.status_approval',NULL);
    //     $this->db->where('order.id_department',$this->session->id_department);
    //     $this->db->where('order.id_section',$this->session->id_section);
   
			
        
	// 	return $this->db->count_all_results();
    // }


   

   
    public function testing()
    {
        $this->db->select('order.*,approval_pic_workshop.status_approval_2,approval_pic_workshop.alasan_2,approval.status_approval_1,approval.approve1,approval.approve2,approval.approve3,approval.approve4,approval_final.jenis_approval_2,
        approval_final.status_approval,detail_estimate_routing.tempat_pembuatan,scheduling.total_day,
        scheduling.start_date,scheduling.end_date,working_order.start_working,working_order.end_working,
        approval_final.jenis_approval_1,approval_final.jenis_approval_2');
        $this->db->from('order');
        $this->db->join('approval_pic_workshop','order.id_order=approval_pic_workshop.id_order','left');
        $this->db->join('approval_final','order.id_order=approval_final.id_order','left');
        $this->db->join('detail_estimate_routing','order.id_order=detail_estimate_routing.id_order','left');
        $this->db->join('scheduling','order.id_order=scheduling.id_order','left');
        $this->db->join('approval','order.id_order=approval.id_order','left');   
        $this->db->join('working_order','order.id_order=working_order.id_order','left');
        $this->db->where('approval.status_approval_1','Disetujui');
        $this->db->where('approval_pic_workshop.status_approval_2','Disetujui');
        $this->db->where('approval_final.status_approval !=','Ditolak');
        $this->db->where('order.status_pengerjaan','WAITING');  
        $this->db->where('order.kategori','urgent');
        $this->db->where('approval.approve4',NULL);
        $this->db->or_where('order.kategori','biasa');
        $this->db->where('approval.approve3',NULL);
        return $this->db->get()->result_array();
    }

 
    
}
?>