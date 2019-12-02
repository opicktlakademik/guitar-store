<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Selection_M extends CI_Model {

    public function get_pencocokan()
    {   
        $this->db->select('alternative.merk as merk_alt, alternative.id as id_alt, pencocokan.id as id_pencocokan');
        $this->db->from('alternative');
        $this->db->join('pencocokan', 'alternative.id = pencocokan.id_alternative', 'left');
        $alternative = $this->db->get()->result();

        $this->db->reset_query();

        $criteria = $this->db->get('criteria');
        $pencocokan = [];
        $thead = [];
        $null_value = 0;

        if (sizeof($alternative) > 0) {
            $thead[] = "Alternative";
            $check_head = $alternative[0]->id_alt;

            foreach ($alternative as $alt_key => $alt_val) {
                $data_nilai = [];
                $data_nilai[] = $alt_val->id_alt;
                $data_nilai[] = $alt_val->id_pencocokan;
                $data_nilai[] = $alt_val->merk_alt;
                $null = 0;
                foreach ($criteria->result() as $crit_key => $crit_val) {
                    $data_nilai[] = $crit_val->id;
                    $this->db->select('*');
                    $this->db->from('dt_pencocokan');
                    $this->db->where('id_pencocokan', $alt_val->id_pencocokan);
                    $this->db->where('id_kriteria', $crit_val->id);
                    $nilai = $this->db->get();
                    if ($nilai->num_rows() > 0) {
                        $data_nilai[] = $nilai->result()[0]->nilai;
                    } else {
                        $data_nilai[] = "<i>NULL</i>";
                        $null += 1;
                        $null_value += 1;
                    }

                    if ($check_head === $alt_val->id_alt) {
                        $thead[] = $crit_val->criteria;
                    }
                }
                $data_nilai[] = $null;
                $data_nilai[] = $criteria->num_rows();
                $pencocokan[] = $data_nilai;
                $this->db->reset_query();
            }
        }
        
        return [ 'tbody' => $pencocokan, 'thead' => $thead, 'null_value' => $null_value];

        
            
    }

    public function get_perhitungan($by = "Last", $id = 0, $data_parse = FALSE)
    {
        $this->db->select('hitung.id, alt.merk as merk_alt, dt_hitung.hasil_perhitungan as hasil, hitung.tanggal');
        $this->db->from('perhitungan hitung');
        $this->db->join('dt_perhitungan dt_hitung', 'hitung.id = dt_hitung.id_perhitungan');
        $this->db->join('alternative alt', 'dt_hitung.id_alternative = alt.id');
        if ($by === 'Last') {
            $this->db->where('hitung.tanggal = ( SELECT max(tanggal) FROM perhitungan)');
            $this->db->where('hitung.id = ( SELECT max(id) FROM perhitungan)');
        }elseif($by === 'id' AND $id > 0){
            $this->db->where('hitung.id', $id);
        }else{
            return FALSE;
        }
        $this->db->group_by('hitung.tanggal, alt.id');
        
        $this->db->order_by('dt_hitung.hasil_perhitungan', 'desc');
        
        
        $data = $this->db->get();

        if ($data_parse) {
            $data = $data->result();
        }
        
        return $data;
                
    }

    public function get_riwayat()
    {
        $this->db->select('*');
        $this->db->from('perhitungan');
        $this->db->order_by('tanggal, id', 'desc');
        $data = $this->db->get();
        
        return $data->result();
    }

}

/* End of file Selection_Model.php */

?>  