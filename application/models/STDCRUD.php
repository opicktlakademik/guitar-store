<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class STDCRUD extends CI_Model {

    public function getAll($table, $limit = 0, $offset = 0, $array = FALSE)
    {
        $data = NULL;
        $query = $this->db->get($table, $limit, $offset);
        
        $data = ($array) ? $query->result_array() : $query->result();
        return $data;
    }

    public function getById($table, $where, $limit = 1, $offset = 0, $array = FALSE)
    {
        $data = NULL;
        $query = $this->db->get_where($table, $where, $limit, $offset);
        $data = ($array) ? $query->result_array() : $query->result();
        return $data;
    }

    public function insert($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->affected_rows();        
    }

    public function update($table, $data, $where)
    {
        $this->db->update($table, $data, $where);
        return $this->db->affected_rows();
    }

    public function data_exists($table, $where)
    {
        $data = $this->db->get_where($table, $where);
        if($data->num_rows() > 0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function delete($table, $where)
    {
        $this->db->delete($table, $where);
        return $this->db->affected_rows();
    }

    public function count($table)
    {
        $query = $this->db->get($table);
        return $query->num_rows();
    }

    public function get_by($table, $where, $limit = 1, $offset = 0, $array = FALSE)
    {
        $data = NULL;
        $query = $this->db->get_where($table, $where, $limit, $offset);
        $data = ($array) ? $query->result_array() : $query->result();
        return $data;
    }

    public function get_join()
    {
        # code...
    }
    

}

/* End of file STDCRUD.php */

?>