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
        $this->db->select('order.*,user.name,department.department_name,material.nama_material,material.price_kg,material.massa_jenis');
        $this->db->select('SUM(processing.hour * process.harga_perjam) AS total');
        $this->db->select('SUM(processing.hour) as total_actual');
        
        $this->db->from('order');
        $this->db->join('user','order.id_user = user.id_user');
        $this->db->join('department','order.id_department = department.id_department');
        $this->db->join('processing','order.id_order = processing.id_order');
        $this->db->join('process','processing.id_proses=process.id_proses');
        $this->db->join('material','order.id_material=material.id_material');
        $this->db->where('order.id_order',$id);
        $this->db->group_by(array("order.id_order", "order.id_user","order.id_department",
        "order.no_order","order.order_type","order.kategori","order.nama_part","order.jumlah",
        "order.raw_type","order.panjang","order.lebar","order.diameter","order.id_material","order.attachment",
        "order.status_laporan","order.status_pengerjaan","order.jam","order.tanggal","order.approve",
        "order.alasan","order.inhouse","user.name","department.department_name","material.nama_material","material.price_kg",
        "processing.id_order","material.massa_jenis"));
        return $this->db->get()->result_array();
    }

    public function getProcessing($id)
    {
        $this->db->select('process.nama_proses,process.total_cost,processing.hour');
        $this->db->select('SUM(processing.hour*process.total_cost) as harga');
        $this->db->from('process');
        $this->db->join('processing','process.id_proses=processing.id_proses');
        $this->db->where('processing.id_order',$id);
        $this->db->group_by(array("process.nama_proses","process.total_cost","processing.hour"));
        return $this->db->get()->result_array();
    }
//         // $this->db->select('IIF(order.lebar > 1,order.panjang * order.lebar * order.diameter ,3.14 * order.diameter /2 * order.diameter /2 * panjang) as Volume');
        

	private function _get_datatables_query_1()
    {
        $this->db->select('order.*,user.name,department.department_name,material.nama_material,material.price_kg');
        $this->db->select('SUM(processing.hour * process.harga_perjam) AS total');
        $this->db->select('SUM(processing.hour) as total_actual');
        $this->db->select('SUM(3.14 * diameter / 2 * diameter / 2 * panjang / 6) AS Volume');
        $this->db->select('SUM(3.14 * diameter / 2 * diameter / 2 * panjang / 6 / 1000000 * 78) AS Berat');
        $this->db->from('order');
        $this->db->join('user','order.id_user = user.id_user');
        $this->db->join('department','order.id_department = department.id_department');
        $this->db->join('processing','order.id_order = processing.id_order');
        $this->db->join('process','processing.id_proses=process.id_proses');
        $this->db->join('material','order.id_material=material.id_material');
        
        $this->db->group_by(array("order.id_order", "order.id_user","order.id_department",
        "order.no_order","order.order_type","order.kategori","order.nama_part","order.jumlah",
        "order.raw_type","order.panjang","order.lebar","order.diameter","order.id_material","order.attachment",
        "order.status_laporan","order.status_pengerjaan","order.jam","order.tanggal","order.approve",
        "order.alasan","order.inhouse","user.name","department.department_name","material.nama_material","material.price_kg",
        "processing.id_order"));

   

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
        $this->db->select('order.*,user.name,department.department_name,material.nama_material,material.price_kg,processing.id_proses,process.nama_proses,processing.hour');
        $this->db->select('SUM(processing.hour * process.harga_perjam) AS total');
        $this->db->select('SUM(processing.hour) as total_actual');
        $this->db->select('SUM(3.14 * diameter / 2 * diameter / 2 * panjang / 6) AS Volume');
        $this->db->select('SUM(3.14 * diameter / 2 * diameter / 2 * panjang / 6 / 1000000 * 78) AS Berat');
        $this->db->from('order');
        $this->db->join('user','order.id_user = user.id_user');
        $this->db->join('department','order.id_department = department.id_department');
        $this->db->join('processing','order.id_order = processing.id_order');
        $this->db->join('process','processing.id_proses=process.id_proses');
        $this->db->join('material','order.id_material=material.id_material');
        
        $this->db->group_by(array("order.id_order", "order.id_user","order.id_department",
        "order.no_order","order.order_type","order.kategori","order.nama_part","order.jumlah",
        "order.raw_type","order.panjang","order.lebar","order.diameter","order.id_material","order.attachment",
        "order.status_laporan","order.status_pengerjaan","order.jam","order.tanggal","order.approve",
        "order.alasan","order.inhouse","user.name","department.department_name","material.nama_material","material.price_kg",
        "processing.id_order","process.nama_proses","processing.hour"));
        return $this->db->get()->result_array();

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
        $this->db->select('*');
        $this->db->from('process');
    }
	function get_datatables_2()
	{
		$this->_get_datatables_query_2();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
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
        return $this->db->get_where('processing',array('id_order'=>$id_order,'id_proses'=>$id_proses))->result_array();
    }
    
    function getIdOrderProcess() {
        // $this->db->distinct();
        // return $this->db->get('processing')->result_array();
        $sql = "select distinct id_order from processing";
        return $this->db->query($sql)->result_array();

    }
}