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

    public function get_pencocokan_case_study()
    {
        $this->db->select('alternative.jenis_guitar, alternative.stock, alternative.merk, alternative.id as id_alt, pencocokan.id as id_pencocokan');
        $this->db->from('alternative');
        $this->db->join('pencocokan', 'alternative.id = pencocokan.id_alternative', 'left');
        $this->db->where(['alternative.stock !=' => 0]);
        
        $alternative = $this->db->get()->result();

        $this->db->reset_query();

        $criteria = $this->db->get('criteria')->result();

        $data = [];
        $header = [];
        $data_hitung = [];
        $header_check = "";

        $header[] = "Stock";
        $header[] = "Jenis Gitar";
       
        if (sizeof($alternative) > 0) {

            $i = 0;
            $header_check = $alternative[0]->id_alt;
            foreach ($alternative as $key_alt => $alt) {

                $data[$i] = [
                    "stock" => $alt->stock, 
                    "jenis_gitar" => $alt->jenis_guitar
                ];

                $data_hitung[$i] = [
                    "alternative" => [
                        "id_alt" => $alt->id_alt, "id_pck" => $alt->id_pencocokan ,"stock" => $alt->stock, "jenis_gitar" => $alt->jenis_guitar
                    ],
                     $alt->id_alt,
                ];

                foreach ($criteria as $key_crt => $crt) {
                    
                    $value = NULL;
                    $result = NULL;
                    $this->db->select('*');
                    $this->db->from('dt_pencocokan');
                    $this->db->join('criteria', 'dt_pencocokan.id_kriteria = criteria.id');
                    $this->db->where([
                        'dt_pencocokan.id_pencocokan' => $alt->id_pencocokan,
                        'dt_pencocokan.id_kriteria' => $crt->id,
                    ]);

                    if ($crt->isian != 1) {
                        $this->db->join('isian', 'isian.id = criteria.isian');
                        $this->db->join('nilai_isian', '(nilai_isian.id_isian = isian.id AND nilai_isian.nilai = dt_pencocokan.nilai)');

                        $result = $this->db->get()->result();
                        $value = sizeof($result) > 0 ? $result[0]->parameter: NULL;
                    }else{
                        $result = $this->db->get()->result();
                        $value = sizeof($result) > 0 ? $result[0]->nilai : NULL;
                    }
                    
                    if ($header_check === $alt->id_alt) {
                        $header[] =  $crt->criteria;
                    }
                    
                    $idx = strtolower(str_replace(" ", "_", $crt->criteria));
                    if ($value !== NULL OR isset($value)) {
                        $data[$i][$idx] = $value != "Selain itu" ? $value : $alt->merk;
                        $data_hitung[$i]['pencocokan'][]= [
                            "nama_criteria" => $idx, 
                            'criteria' => $value,
                            "bobot" => $crt->bobot, 
                            "nilai" => $result[0]->nilai
                            ] ;
                    }else{
                        $data[$i][$idx] = "NULL";
                        $data_hitung[$i][$idx] = "NULL"; 
                    }

                    $this->db->reset_query();
                }
                $i++;
            }
        }
        foreach ($data as $key => $value) {
            if (array_search("NULL", $data[$key])) {
                unset($data[$key]);
                array_values($data);
            }

            if (array_search( "NULL",$data_hitung[$key])) {
                unset($data_hitung[$key]);
                array_values($data_hitung);
            }
        }
        $_SESSION['data'] = $data_hitung;
        $_SESSION['header'] = $header;
        $_SESSION['criteria'] = $criteria;
        return ['header' => $header, 'data' => $data];
    }

}

/* End of file Selection_Model.php */

?>  