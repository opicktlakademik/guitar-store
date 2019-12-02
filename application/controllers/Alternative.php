<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Alternative extends CI_Controller {

    private $data = ["page" => "Alternative", "menu" => "alternative"];
    private $response = ["status" => TRUE];
    public $uri;
    
    public function __construct()
    {
        parent::__construct();
        $this->uri = uri_string() . "?" . http_build_query($_GET);
        is_login($this->uri);
        $this->load->model('STDCRUD', 'crud');
        $this->load->model('Criteria_M', 'criteria_m');
        $this->load->model('Alternative_M', 'alt_m');
        
    }

    public function index()
    {
        $this->data['alternatives'] = $this->crud->getAll('alternative');
        $this->data['content'] = $this->load->view('alternative_v', $this->data, TRUE);
        $this->load->view('top_layout', $this->data);
    }

    public function getForm($id = NULL, $reqby = "", $id_dom = "")
    {
        $data = NULL;
        $title = "";
        if ($id === 'undefined') {
            $data['criteria'] = $this->get_criteria_kecocokan();
            if($data['criteria'] !== NULL){
                $title = "Tambah Data Alternative Pelanggan";
                $data['action'] = site_url('Alternative/add');
                $this->response['page'] = $this->load->view('forms/alternative_form', $data, TRUE);
            }else{
                $this->response['status'] = FALSE;
                $this->response['message'] = "Data kriteria tidak ditemukan";
                $this->response['action'] = FALSE;
            }
        } else { 

            $data_pencocokan = $this->alt_m->get_alternative_by_id($id);
            $data_kriteria = [];
            foreach ($data_pencocokan as $key => $value) {
                $data_kriteria[] = [$value->id_kriteria, $value->nilai, $value->isian];
            }

            $title = "Ubah Data Alternative";
            $data['data_kriteria'] = $data_kriteria;
            $data['action'] = site_url('Alternative/update/' . $reqby . "#" . $id_dom);
            $data['data'] = $data_pencocokan[0];
            $data['criteria'] = $this->get_criteria_kecocokan();
            $this->response['page'] = $this->load->view('forms/alternative_form', $data, TRUE);
        }
        $this->response['modal_title'] = $title;
        echo json_encode($this->response);
    }

    public function add()
    {   
        if ($this->input->post('merk') !== NULL AND $this->input->post('jenis_guitar')) {

            $id_alt = date('YmdHis');
            $id_pck = date('dmYHis');

            $alternative = [
                'id' => $id_alt,
                'merk' => $this->input->post('merk'),
                'jenis_guitar' => $this->input->post('jenis_guitar'),
                'harga' => $this->input->post('harga'),
                'stock' => $this->input->post('stock'),
            ];

            $pencocokan = [
                'id' => $id_pck,
                'id_alternative' => $id_alt,
            ];

            unset($_POST['merk']);
            unset($_POST['jenis_guitar']);
            unset($_POST['harga']);
            unset($_POST['stock']);
            unset($_POST['id_alt_hidden']);
            unset($_POST['id_pck_hidden']);

            $dt_pencocokan = [];
            foreach ($_POST as $key => $value) {
                # code...
                $dt_pencocokan[] = [
                    'id_kriteria' => $key,
                    'id_pencocokan' => $id_pck,
                    'nilai' => $value,
                ];
            }

            $insert = $this->alt_m->insert_alternative($alternative, $pencocokan, $dt_pencocokan);
            if ($insert) {
                $this->session->set_flashdata('message', "Input data alternative berhasil!");
                $this->session->set_flashdata('action', TRUE);
            } else {
                $this->session->set_flashdata('message', "Input data alternative gagal! silahkan menghubungi web administrator");
                $this->session->set_flashdata('action', FALSE);
            }
            redirect('Alternative', 'refresh');
        }else {
            redirect('Alternative', 'refresh');
        }
        
    }

    public function update($redirect = "Alternative")
    {
        if ($this->input->post('merk') !== NULL and $this->input->post('jenis_guitar')) {

            $id_alt = $this->input->post('id_alt_hidden');
            $id_pck = $this->input->post('id_pck_hidden');

            $alternative = [
                'merk' => $this->input->post('merk'),
                'jenis_guitar' => $this->input->post('jenis_guitar'),
                'harga' => $this->input->post('harga'),
                'stock' => $this->input->post('stock'),
            ];

            unset($_POST['merk']);
            unset($_POST['jenis_guitar']);
            unset($_POST['harga']);
            unset($_POST['stock']);
            unset($_POST['id_alt_hidden']);
            unset($_POST['id_pck_hidden']);

            $dt_pencocokan = [];
            

            if ($id_pck !== "") {
                foreach ($_POST as $key => $value) {
                    # code...
                    $dt_pencocokan[] = [
                        'id_kriteria' => $key,
                        'nilai' => $value,
                    ];
                }
                $update = $this->alt_m->update_alternative($alternative, $dt_pencocokan, $id_alt, $id_pck);
                if ($update) {
                    $message = "Update data alternative berhasil!";
                    $action = TRUE;
                }else {
                    $message = "Update data alternative Gagal!";
                    $action = FALSE;
                }
            }else{
                $id_pck = date('dmYHis');
                foreach ($_POST as $key => $value) {
                    # code...
                    $dt_pencocokan[] = [
                        'id_kriteria' => $key,
                        'id_pencocokan' => $id_pck,
                        'nilai' => $value,
                    ];
                }
                $insert = $this->alt_m->insert_pck($id_alt, $id_pck, $dt_pencocokan);
                if ($insert) {
                    $message = "Insert new data pencocokan berhasil!";
                    $action = TRUE;
                } else {
                    $message = "Insert new data pencocokan Gagal!";
                    $action = FALSE;
                }
            }

            $this->session->set_flashdata('message', $message);
            $this->session->set_flashdata('action', $action);
           
            redirect($redirect);
        } else {
            redirect('Alternative', 'refresh');
        }
    }

    public function delete($id = NULL)
    {
        $action = TRUE;
        $data_exist = $this->crud->data_exists('alternative', ['id' => $id]);
        if ($data_exist) {
            $delete = $this->crud->delete('alternative', ['id' => $id]);
            if ($delete > 0) {
                $message = "Delete data Berhasil. Data berhasil dihapus dari database";
            } else {
                $message = "Delete data Gagal. Hubungi web admin";
                $action = FALSE;
            }
        } else {
            $action = FALSE;
            $message = "Delete gagal dilakukan. Data tidak ditemukan. id: " . $id;
        }

        $this->session->set_flashdata('message', $message);
        $this->session->set_flashdata('action', $action);
        redirect('Alternative', 'refresh');
    }

    public function get_criteria_kecocokan()
    {
        $data = $this->criteria_m->get_criteria_with_detail();
        $option = NULL;
        if (sizeof($data) > 0) {
            $id = $data[0]->id_criteria;
            $option =
                "<div class='form-group'>" .
                "<label>" . $data[0]->nama_kriteria . "</label>" .
                "<select required class='custom-select' name = '" . $id . "'>" .
                "<option value='' disabled selected>Pilih Salah Satu</option>";
            foreach ($data as $key => $value) {
                # code...
                if ($id === $value->id_criteria) {
                    $option .= "<option value = '" . $value->nilai . "'>" . $value->parameter . "</option>";
                } else {
                    $option .= "</select>";
                    $id = $value->id_criteria;
                    $option .= "</select></div>";
                    $option .=
                        "<div class='form-group'>" .
                        "<label>" . $value->nama_kriteria . "</label>" .
                        "<select required class='custom-select' name = '" . $id . "'>" .
                        "<option value='' disabled selected>Pilih Salah Satu</option>";
                    $option .= "<option value = '" . $value->nilai . "'>" . $value->parameter . "</option>";
                }
            }
            $option .= "</select></div>";

            //select numeric criteria
            $numeric = $this->db->get_where('criteria', ['isian' => 1]);
            foreach ($numeric->result() as $key => $value) {
                $option .=
                    "<div class='form-group' id='" . $value->id . "'>" .
                    "<label>" . $value->criteria . "</label>" .
                    "<input required type='number' class='form-control' name='" . $value->id . "' value='' />" .
                    "</div>";
            }
        }else{
            $option = NULL;
        }
        

        return $option;
    }
}

/* End of file Alternative.php */

?> 