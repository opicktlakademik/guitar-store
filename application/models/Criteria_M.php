<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Criteria_M extends CI_Model {

  public function get_criteria()
  {
      $this->db->select('criteria.*, isian.nama as isian');
      $this->db->from('criteria');
      $this->db->join('isian', 'criteria.isian = isian.id', 'left');
      $data =$this->db->get();
      return $data->result(); 
  }
  
  public function get_criteria_with_detail()
  {
        $this->db->select('criteria.id as id_criteria, criteria.criteria as nama_kriteria, isian.nama as isian, nilai_isian.parameter as parameter, nilai_isian.nilai as nilai');
        $this->db->from('criteria');
        $this->db->join('isian', 'criteria.isian = isian.id', 'left');
        $this->db->join('nilai_isian', 'nilai_isian ON isian.id = nilai_isian.id_isian', 'right');
        $this->db->group_by('criteria.id, nilai_isian.id');
        

        $data = $this->db->get();
        return $data->result(); 
  }

  public function get_criteria_with_detail_by_id($id, $numeric = false)
  {
    # code...
    if (!$numeric) {
      $this->db->select('criteria.id as id_criteria, criteria.criteria as nama_kriteria, isian.nama as isian, nilai_isian.parameter as parameter, nilai_isian.nilai as nilai');
      $this->db->from('criteria');
      $this->db->join('isian', 'criteria.isian = isian.id', 'left');
      $this->db->join('nilai_isian', 'nilai_isian ON isian.id = nilai_isian.id_isian', 'right');
      $this->db->where('criteria.id', $id);
      $data = $this->db->get()->result();
    }
    

    
    return $data; 
    
  }

}

/* End of file Criteria_M.php */

?>