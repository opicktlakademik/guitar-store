<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Selection extends CI_Controller {

    private $data = ["menu" => "selection", "page" => "Selection"];
    private $response = ["status" => TRUE];
    public $uri;
    
    public function __construct()
    {
        parent::__construct();
        $this->uri = uri_string() . "?" . http_build_query($_GET);
        is_login($this->uri);
        $this->load->model('STDCRUD', 'crud');
        $this->load->model('Selection_M', 'selmod');
        $this->load->model('Criteria_M', 'critm');
        
    }
    
    public function index()
    {
        $data_table = $this->selmod->get_pencocokan();
        $this->data['hasil_terakhir'] = $this->selmod->get_perhitungan()->result();
        $this->data['riwayat'] = $this->selmod->get_riwayat();
        $this->data['thead'] = $data_table['thead'];
        $this->data['tbody'] = $data_table['tbody'];
        $this->data['null_value'] = $data_table['null_value'];
        $this->data['content'] = $this->load->view('selection_v', $this->data, TRUE);
        $this->load->view('top_layout', $this->data);
    }

    public function delete($id = 'undefined')
    {
        if ($id !== 'undefined' AND $this->crud->data_exists('pencocokan', ['id' => $id])) {
            $action = TRUE;
            if ($this->crud->delete('pencocokan', ['id' => $id]) > 0) {
                $message = "Delete data Berhasil. Data berhasil dihapus dari database";
            }else {
                $message = "Delete data Gagal. Hubungi web admin";
                $action = FALSE;
            }
        }else {
            $action = FALSE;
            $message = "Data tidak ditemukan. atau data sudah dikosongkan. id: " . $id;
        }

        $this->session->set_flashdata('message', $message);
        $this->session->set_flashdata('action', $action);
        redirect('Selection', 'refresh');
    }

    public function get_criteria_detail($id = 'undefined', $nilai = 0)
    {
        if ($this->input->is_ajax_request()) {
            if ($id !== 1) {
                $criteria = $this->critm->get_criteria_with_detail_by_id($id);
                $element = "
                <div class='form-group'>
                <select class='form-control' autofocus name = '" . $criteria[0]->id_criteria . "'>";

                foreach ($criteria as $key => $value) {
                    $selected = "";
                    if ($nilai === $value->nilai) {
                        $selected = "selected";
                    }
                    $element .=
                        "<option value=' " . $value->nilai . "' " . $selected . ">" . $value->parameter . "</option>";
                }

                $element .= "</select></div>";
                $this->response['element'] = $element;

                echo json_encode($this->response);
            }

        }
    }

    public function get_data($id = 0)
    {
        $response = ['status' => TRUE];

        if ($id > 0) {
            $data = $this->selmod->get_perhitungan('id', $id);
            if ($data->num_rows() > 0) {
                $response['data'] = $data->result();
            }else{
                $response = ['status' => FALSE, 'message' => "Gagal mengambil data dengan id: " . $id];
            }
            echo json_encode($response);
        }else{
            redirect('Selection', 'refresh');
        }
    }
}
/* End of file Selection.php */

?> 