<?php 
date_default_timezone_set('Asia/Jakarta');
class M_proses extends CI_model
{
    var $table = 'order';
	var $column_order = array(null, 'nama_part'); //set column field database for datatable orderable
	var $column_search = array('nama_part'); //set column field database for datatable searchable 
	var $orderr = array('kategori' => 'desc'); // default order

    public function addInputOrder($data)
    {
        $this->db->insert('routing_plan',$data);
    }

	public function count_all()
    {
        $this->db->from('process');
		return $this->db->count_all_results();
    }
    public function count_filtered()
    {
        $this->_get_datatables_process();
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function count_all_material()
    {
        $this->db->from('material');
		return $this->db->count_all_results();
    }
    public function count_filtered_material()
    {
        $this->_get_datatables_material();
		$query = $this->db->get();
		return $query->num_rows();
    }

    private function _get_datatables_process()
    {
        $this->db->select('*');
        $this->db->from('process');
    }

    private function _get_datatables_material()
    {
        $this->db->select('*');
        $this->db->from('material');
    }

    public function count_filtered_2()
    {
        $this->_get_datatables_query_2  ();
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function count_all_1()
    {
        $this->db->from('process');
		return $this->db->count_all_results();
    }
    public function count_filtered_1()
    {
        $this->_get_datatables_query_2();
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function getReportPaper($id)
    {
        $this->db->select('order.*,user.name,department.department_name,material.nama_material,material.price_kg,
        detail_estimate_routing.total_cost_process,detail_estimate_routing.total_cost_material,detail_estimate_routing.total_all,detail_estimate_routing.tempat_pembuatan,
        detail_raw_type.berat,detail_raw_type.volume');
        $this->db->from('order');
        $this->db->join('user','order.id_user=user.id_user');
        $this->db->join('department','order.id_department=department.id_department');
        $this->db->join('material','order.id_material=material.id_material');
        $this->db->join('detail_estimate_routing','order.id_order=detail_estimate_routing.id_order');
        $this->db->join('detail_raw_type','order.id_order=detail_raw_type.id_order');
        $this->db->where('order.id_order',$id);
        return $this->db->get()->result_array();
    }
    public function getReportPaperActual($id)
    {
        $this->db->select('order.*,user.name,department.department_name,material.nama_material,material.price_kg,
        detail_actual_routing.total_cost_process,detail_estimate_routing.total_cost_material,detail_actual_routing.total_all,detail_estimate_routing.tempat_pembuatan,
        detail_raw_type.berat,detail_raw_type.volume');
        $this->db->from('order');
        $this->db->join('user','order.id_user=user.id_user');
        $this->db->join('department','order.id_department=department.id_department');
        $this->db->join('material','order.id_material=material.id_material');
        $this->db->join('detail_estimate_routing','order.id_order=detail_estimate_routing.id_order');
        $this->db->join('detail_actual_routing','order.id_order=detail_actual_routing.id_order');
        $this->db->join('detail_raw_type','order.id_order=detail_raw_type.id_order');
        $this->db->where('order.id_order',$id);
        return $this->db->get()->result_array();
    }

    public function getRoutingPlan($id)
    {
        $this->db->select('process.nama_proses,process.total_cost, routing_plan.id_proses,routing_plan.hour,routing_plan.estimate_cost_process');
        $this->db->from('process');
        $this->db->join('routing_plan','process.id_proses=routing_plan.id_proses');
        $this->db->where('routing_plan.id_order',$id);
        return $this->db->get()->result_array();
    }

    public function getRoutingActual($id)
    {
        $this->db->select('process.nama_proses,process.total_cost, routing_actual.id_proses,routing_actual.hour,routing_actual.actual_cost_process');
        $this->db->from('process');
        $this->db->join('routing_actual','process.id_proses=routing_actual.id_proses');
        $this->db->where('routing_actual.id_order',$id);
        return $this->db->get()->result_array();
    }

    function totalALL($id)
    {
        $this->db->select('total_all');
        $this->db->from('detail_estimate_routing');
        $this->db->where('id_order',$id);
        return $this->db->get()->result_array();
    }

    function totalALLActual($id)
    {
        $this->db->select('total_all');
        $this->db->from('detail_actual_routing');
        $this->db->where('id_order',$id);
        return $this->db->get()->result_array();
    }

	

    function printData()
    {
        $this->db->select('order.*,user.name,department.department_name,material.nama_material,material.price_kg,
        detail_estimate_routing.total_hour,approval.status_approval_1,detail_estimate_routing.*');
        $this->db->from('order');
        $this->db->join('user','order.id_user = user.id_user');
        $this->db->join('department','order.id_department = department.id_department');
        $this->db->join('material','order.id_material=material.id_material');
        $this->db->join('detail_estimate_routing','order.id_order=detail_estimate_routing.id_order');
        $this->db->join('approval','order.id_order=approval.id_order');
        $this->db->where('approval.status_approval_1','Disetujui');
        $this->db->where('detail_estimate_routing.total_hour is NOT NULL');
        $query = $this->db->get();
		return $query->result();
    }

	

    private function _get_datatables_query_routing_plan()
    {
        $this->db->select(' order.nama_part, order.id_order, material.nama_material, 
                            detail_estimate_routing.*');
        $this->db->from('order');
        $this->db->join('material','material.id_material = order.id_material');
        $this->db->join('detail_estimate_routing','detail_estimate_routing.id_order = order.id_order');
        $this->db->where('detail_estimate_routing.tempat_pembuatan IS NOT NULL');
    }

	function get_datatables_routing_plan()
	{
		$this->_get_datatables_query_routing_plan();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}


    function routingTable($id)
    {
        $this->db->select('processing.hour,process.nama_proses,process.harga_perjam');
        $this->db->select('SUM(processing.hour * process.harga_perjam)as total');
        $this->db->from('processing');
        $this->db->join('process','processing.id_proses=process.id_proses');
        $this->db->where('processing.id_order',$id);
        $this->db->group_by(array("processing.hour","process.nama_proses","process.harga_perjam"));
        $result = $this->db->get();
        return $result->result_array();

    }

    function showDatabaseProcess()
    {
        $this->db->select('*');
        $this->db->from('process');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function selectMaterial()
    {
        
        $result = $this->db->get('material');
        return $result->result_array();
    }

    private function _get_datatables_query_2()
    {
        $this->db->select('order.*,user.name,department.department_name,material.nama_material,material.price_kg,
        detail_actual_routing.total_hour,approval.status_approval_1,detail_actual_routing.*,detail_estimate_routing.total_cost_material');
        $this->db->from('order');
        $this->db->join('user','order.id_user = user.id_user');
        $this->db->join('department','order.id_department = department.id_department');
        $this->db->join('material','order.id_material=material.id_material');
        $this->db->join('detail_actual_routing','order.id_order=detail_actual_routing.id_order');
        $this->db->join('approval','order.id_order=approval.id_order');
        $this->db->join('detail_estimate_routing','order.id_order=detail_estimate_routing.id_order');
        $this->db->where('approval.status_approval_1','Disetujui');
        $this->db->where('detail_actual_routing.total_hour is NOT NULL');
    }
	function get_datatables_2()
	{
		$this->_get_datatables_query_2();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

    public function count_all_actual()
    {
        $this->db->select('order.*,user.name,department.department_name,material.nama_material,material.price_kg,
        detail_actual_routing.total_hour,approval.status_approval_1,detail_actual_routing.*,detail_estimate_routing.total_cost_material');
        $this->db->from('order');
        $this->db->join('user','order.id_user = user.id_user');
        $this->db->join('department','order.id_department = department.id_department');
        $this->db->join('material','order.id_material=material.id_material');
        $this->db->join('detail_actual_routing','order.id_order=detail_actual_routing.id_order');
        $this->db->join('approval','order.id_order=approval.id_order');
        $this->db->join('detail_estimate_routing','order.id_order=detail_estimate_routing.id_order');
        $this->db->where('approval.status_approval_1','Disetujui');
        $this->db->where('detail_actual_routing.total_hour is NOT NULL');
		return $this->db->count_all_results();
    }
    public function count_filtered_actual()
    {
        $this->_get_datatables_query_2();
        $this->db->where('approval.status_approval_1','Disetujui');
        $this->db->where('detail_actual_routing.total_hour is NOT NULL');
		$query = $this->db->get();
		return $query->num_rows();
    }

    private function _get_datatables_query_1()
    {
        $this->db->select('order.*,user.name,department.department_name,material.nama_material,material.price_kg,
        detail_estimate_routing.total_hour,approval.status_approval_1,detail_estimate_routing.*');
        $this->db->from('order');
        $this->db->join('user','order.id_user = user.id_user');
        $this->db->join('department','order.id_department = department.id_department');
        $this->db->join('material','order.id_material=material.id_material');
        $this->db->join('detail_estimate_routing','order.id_order=detail_estimate_routing.id_order');
        $this->db->join('approval','order.id_order=approval.id_order');
        $this->db->where('approval.status_approval_1','Disetujui');
        $this->db->where('detail_estimate_routing.total_hour is NOT NULL');
    }

    function get_datatables_1()
	{
		$this->_get_datatables_query_1();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

    public function count_all_plan()
    {
        $this->db->select('order.*,user.name,department.department_name,material.nama_material,material.price_kg,
        detail_actual_routing.total_hour,approval.status_approval_1,detail_actual_routing.*,detail_estimate_routing.total_cost_material');
        $this->db->from('order');
        $this->db->join('user','order.id_user = user.id_user');
        $this->db->join('department','order.id_department = department.id_department');
        $this->db->join('material','order.id_material=material.id_material');
        $this->db->join('detail_actual_routing','order.id_order=detail_actual_routing.id_order');
        $this->db->join('approval','order.id_order=approval.id_order');
        $this->db->join('detail_estimate_routing','order.id_order=detail_estimate_routing.id_order');
        $this->db->where('approval.status_approval_1','Disetujui');
        $this->db->where('detail_estimate_routing.total_hour is NOT NULL');
		return $this->db->count_all_results();
    }
    public function count_filtered_plan()
    {
        $this->_get_datatables_query_1();
        $this->db->where('approval.status_approval_1','Disetujui');
        $this->db->where('detail_estimate_routing.total_hour is NOT NULL');
		$query = $this->db->get();
		return $query->num_rows();
    }

    

    function addProses($data)
    {
        $this->db->insert('process',$data);
    }

    function updateProses($id_proses,$nama_proses,$harga_perjam,$harga_perjam_manusia,$consumable,$listrik,$harga_mesin,$total_cost)
    {
        $hasil = $this->db->query("UPDATE process SET nama_proses='$nama_proses', 
        harga_perjam='$harga_perjam', harga_perjam_manusia='$harga_perjam_manusia',
        consumable='$consumable', listrik='$listrik', harga_mesin='$harga_mesin', 
        total_cost='$total_cost' WHERE id_proses='$id_proses'");
		return $hasil;
    }

    function deleteProses($id_proses)
    {
        $hasil = $this->db->query("DELETE FROM process WHERE id_proses='$id_proses'");
		return $hasil;
    }

    function showModalById($id_proses)
    {
        $hsl = $this->db->query("SELECT * FROM process WHERE id_proses='$id_proses'");
        if ($hsl->num_rows() > 0) {
			foreach ($hsl->result() as $data) {
				$hasil = array(
					'id_proses' => $data->id_proses,
					'nama_proses' => $data->nama_proses,
                    'harga_perjam'=>$data->harga_perjam,
                    'harga_perjam_manusia' =>$data->harga_perjam_manusia,
                    'consumable'=>$data->consumable,
                    'listrik'=>$data->listrik,
                    'harga_mesin'=>$data->harga_mesin,
                    'total_cost'=>$data->total_cost,
				);
			}
		}
        return $hasil;
    }

    function getDataProcessing($id_order, $id_proses) {
        return $this->db->get_where('routing_plan',array('id_order'=>$id_order,'id_proses'=>$id_proses))->result_array();
    }

    function getDataProcessingActual($id_order, $id_proses) {
        return $this->db->get_where('routing_actual',array('id_order'=>$id_order,'id_proses'=>$id_proses))->result_array();
    }
    
    function getIdOrderProcess() {
        // $this->db->distinct();
        // return $this->db->get('processing')->result_array();
        $sql = "select distinct id_order from routing_plan";
        return $this->db->query($sql)->result_array();

    }
    function getIdOrderProcessActual() {
        // $this->db->distinct();
        // return $this->db->get('processing')->result_array();
        $sql = "select distinct id_order from routing_actual";
        return $this->db->query($sql)->result_array();

    }


    function getProcessById($id)
    {
        return $this->db->get_where('process',array('id_proses'=>$id))->result_array();
    }

    function addJadwal($data)
    {
        $this->db->insert('scheduling',$data);
    }

    function updatePengerjaan($id_order,$update_status_pengerjaan)
    {
        $this->db->set('status_pengerjaan',$update_status_pengerjaan);
		$this->db->where('id_order',$id_order);
		$this->db->update('order');
    }

    private function _get_datatables_query_3()
    {
        $this->db->select('*');
        $this->db->from('process');
    }
	function get_datatables_3()
	{
		$this->_get_datatables_query_3();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}


    
}