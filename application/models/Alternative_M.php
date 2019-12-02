<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Alternative_M extends CI_Model {

    public function insert_alternative($alternative, $pencockan, $dt_pencocokan)
    {
        $this->db->trans_start();
        $this->db->insert('alternative', $alternative);
        $this->db->insert('pencocokan', $pencockan);
        $this->db->insert_batch('dt_pencocokan', $dt_pencocokan);
        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function get_alternative_by_id($id)
    {
        $this->db->select('alternative.*, alternative.id as id_alt, criteria.*, pencocokan.*, pencocokan.id as id_pencocokan, dt_pencocokan.*');
        $this->db->from('alternative');
        $this->db->join('pencocokan', 'alternative.id = pencocokan.id_alternative', 'left');
        $this->db->join('dt_pencocokan', 'pencocokan.id = dt_pencocokan.id_pencocokan', 'left');
        $this->db->join('criteria', 'criteria.id = dt_pencocokan.id_kriteria', 'left');
        $this->db->where('alternative.id', $id);
        $data = $this->db->get();
        return $data->result();
        
    }

    public function update_alternative($alternative, $dt_pencocokan, $id_alt, $id_pck)
    {
        $this->db->trans_start();
        $this->db->update('alternative', $alternative, ['id' => $id_alt]);
        
        foreach ($dt_pencocokan as $key => $value) {
            
            $check = $this->db->get_where('dt_pencocokan', ['id_pencocokan' => $id_pck, 'id_kriteria' => $value['id_kriteria']]);
            if ($check->num_rows() > 0) {
                # code...
                $this->db->update('dt_pencocokan', ['nilai' => $value['nilai']], ['id_pencocokan' => $id_pck, 'id_kriteria' => $value['id_kriteria']]);
            }else{
                $this->db->insert('dt_pencocokan', [
                    'nilai' => $value['nilai'], 
                    'id_pencocokan' => $id_pck,
                    'id_kriteria' =>  $value['id_kriteria'],
                ]);
                
            }
            
        }
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function insert_pck($id_alt, $id_pck, $dt_pencocokan)
    {
        $this->db->trans_start();
        $this->db->insert('pencocokan', ['id_alternative' => $id_alt, 'id' => $id_pck]);
        $this->db->insert_batch('dt_pencocokan', $dt_pencocokan);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

}

/* End of file Alternative_M.php */

?>