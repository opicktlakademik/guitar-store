<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Hitungwp_M extends CI_Model {

    public function get_all_data()
    {
        $this->db->select('pencocokan.id, alternative.nama AS nama_alt, alternative.id AS id_alt, dt_pencocokan.nilai AS nilai, criteria.criteria, criteria.bobot, criteria.jenis');
        $this->db->from('pencocokan');
        $this->db->join('alternative', 'pencocokan.id_alternative = alternative.id');
        $this->db->join('dt_pencocokan', 'pencocokan.id = dt_pencocokan.id_pencocokan');
        $this->db->join('criteria', 'criteria.id = dt_pencocokan.id_kriteria');
        $data = $this->db->get();
        
        return $data->result();
    }

    public function insert_hasil($perhitungan, $dt_perhitungan)
    {
        $this->db->trans_start();
        $this->db->insert('perhitungan', $perhitungan);
        $this->db->insert_batch('dt_perhitungan', $dt_perhitungan);
        $this->db->trans_complete();

        return $this->db->trans_status();
        
    }

}

/* End of file Hitungwp_M.php */

?>