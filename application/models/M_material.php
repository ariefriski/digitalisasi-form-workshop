<?php 
date_default_timezone_set('Asia/Jakarta');
class M_material extends CI_model
{

    public function count_all()
    {
        $this->db->from('material');
		return $this->db->count_all_results();
    }
    public function count_filtered()
    {
        $this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
    }
    private function _get_datatables_query()
    {
        $this->db->select('*');
        $this->db->from('material');
    }

    function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

    function addMaterial($data)
    {
        $this->db->insert('material',$data);
    }

    function showModalByIdMaterial($id_material)
    {
        $hsl = $this->db->query("SELECT * FROM material WHERE id_material='$id_material'");
        if ($hsl->num_rows() > 0) {
			foreach ($hsl->result() as $data) {
				$hasil = array(
					'id_material' => $data->id_material,
					'nama_material' => $data->nama_material,
                    'price_kg'=>$data->price_kg,
                    'type' =>$data->type,
                    'massa_jenis'=>$data->massa_jenis,
                    
				);
			}
		}
        return $hasil;
    }

    function updateMaterial($id_material,$nama_material,$price_kg,$type,$massa_jenis)
    {
        $hasil = $this->db->query("UPDATE material SET nama_material='$nama_material', 
        price_kg='$price_kg', type='$type',massa_jenis='$massa_jenis' WHERE id_material='$id_material'");
		return $hasil;
    }

    function deleteMaterial($id_material)
    {
        $hasil = $this->db->query("DELETE FROM material WHERE id_material='$id_material'");
		return $hasil;
    }
    
}
