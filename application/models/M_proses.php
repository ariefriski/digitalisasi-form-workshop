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
        $this->db->insert('processing',$data);
    }

// /
	

    // public function getRoutingList($id)
    // {
    //     $this->db->select('routing.*');
    //     $this->db->from('routing');
    //     // $this->db->where('id_order',$id);
    //     $query = $this->db->get();
    //     return $query->result_array();
    // }


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

    public function getReportPaper($id)
    {
        $this->db->select('order.*,user.name,department.department_name');
        $this->db->select('SUM(processing.hour * process.harga_perjam) AS total');
        $this->db->select('SUM(processing.hour) as total_actual');
        $this->db->select('max(case when processing.id_proses = 1 then processing.hour end) as MANUAL,
        max(case when processing.id_proses = 2 then processing.hour end) as CNC,
        max(case when processing.id_proses = 3 then processing.hour end) as MILLING,
        max(case when processing.id_proses = 4 then processing.hour end) as BUBUT,
        max(case when processing.id_proses = 5 then processing.hour end) as GRINDING,
        max(case when processing.id_proses = 6 then processing.hour end) as SAWING,
        max(case when processing.id_proses = 7 then processing.hour end) as DRILLING,
        max(case when processing.id_proses = 8 then processing.hour end) as MANMACHINING,
        max(case when processing.id_proses = 9 then processing.hour end) as WELDING,
        max(case when processing.id_proses = 10 then processing.hour end) as MANFABRIKASI');
        $this->db->from('order');
        $this->db->join('user','order.id_user = user.id_user');
        $this->db->join('department','order.id_department = department.id_department');
        $this->db->join('processing','order.id_order = processing.id_order');
        $this->db->join('process','processing.id_proses=process.id_proses');
        $this->db->where('order.id_order',$id);
        $this->db->group_by(array("order.id_order", "order.id_user","order.id_department",
        "order.no_order","order.order_type","order.kategori","order.nama_part","order.jumlah",
        "order.raw_type","order.panjang","order.lebar","order.tinggi","order.material","order.attachment",
        "order.status_laporan","order.status_pengerjaan","order.jam","order.tanggal","order.approve",
        "order.alasan","order.inhouse","user.name","department.department_name"));
        return $this->db->get()->result_array();
    }


	private function _get_datatables_query_1()
    {
        $this->db->select('order.*,user.name,department.department_name');
        $this->db->select('SUM(processing.hour * process.harga_perjam) AS total');
        $this->db->select('SUM(processing.hour) as total_actual');
        $this->db->select('max(case when processing.id_proses = 1 then processing.hour end) as MANUAL,
        max(case when processing.id_proses = 2 then processing.hour end) as CNC,
        max(case when processing.id_proses = 3 then processing.hour end) as MILLING,
        max(case when processing.id_proses = 4 then processing.hour end) as BUBUT,
        max(case when processing.id_proses = 5 then processing.hour end) as GRINDING,
        max(case when processing.id_proses = 6 then processing.hour end) as SAWING,
        max(case when processing.id_proses = 7 then processing.hour end) as DRILLING,
        max(case when processing.id_proses = 8 then processing.hour end) as MANMACHINING,
        max(case when processing.id_proses = 9 then processing.hour end) as WELDING,
        max(case when processing.id_proses = 10 then processing.hour end) as MANFABRIKASI');
        $this->db->from('order');
        $this->db->join('user','order.id_user = user.id_user');
        $this->db->join('department','order.id_department = department.id_department');
        $this->db->join('processing','order.id_order = processing.id_order');
        $this->db->join('process','processing.id_proses=process.id_proses');
        $this->db->group_by(array("order.id_order", "order.id_user","order.id_department",
        "order.no_order","order.order_type","order.kategori","order.nama_part","order.jumlah",
        "order.raw_type","order.panjang","order.lebar","order.tinggi","order.material","order.attachment",
        "order.status_laporan","order.status_pengerjaan","order.jam","order.tanggal","order.approve",
        "order.alasan","order.inhouse","user.name","department.department_name"));

    

    }
	function get_datatables_1()
	{
		$this->_get_datatables_query_1();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

    function testing()
    {
        $this->db->select('order.*,user.name,department.department_name');
        $this->db->select('SUM(processing.hour * process.harga_perjam) AS total');
        $this->db->select('max(case when processing.id_proses = 1 then processing.hour end) as MANUAL,
        max(case when processing.id_proses = 2 then processing.hour end) as CNC,
        max(case when processing.id_proses = 3 then processing.hour end) as MILLING,
        max(case when processing.id_proses = 4 then processing.hour end) as BUBUT,
        max(case when processing.id_proses = 5 then processing.hour end) as GRINGING,
        max(case when processing.id_proses = 6 then processing.hour end) as SAWING');
        $this->db->from('order');
        $this->db->join('user','order.id_user = user.id_user');
        $this->db->join('department','order.id_department = department.id_department');
        $this->db->join('processing','order.id_order = processing.id_order');
        $this->db->join('process','processing.id_proses=process.id_proses');
        $this->db->group_by(array("order.id_order", "order.id_user","order.id_department",
        "order.no_order","order.order_type","order.kategori","order.nama_part","order.jumlah",
        "order.raw_type","order.panjang","order.lebar","order.tinggi","order.material","order.attachment",
        "order.status_laporan","order.status_pengerjaan","order.jam","order.tanggal","order.approve",
        "order.alasan","user.name","department.department_name"));
        $result = $this->db->get();
        return $result->result_array();

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

}