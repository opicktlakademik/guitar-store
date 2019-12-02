<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Hitungwp extends CI_Controller {

    private $data = ["page" => "Hitungwp", "menu" => "hitungwp"];
    public $uri;

    
    public function __construct()
    {
        parent::__construct();
        $this->uri = uri_string() . "?" . http_build_query($_GET);
        is_login($this->uri);
        $this->load->model('Hitungwp_M', 'hitungmodel');
        
    }
    

    public function index()
    {
        $data = $this->hitungmodel->get_all_data();

        //ambil kriteria[bobot, normalisasi, jenis], alternative[nilai_kecocokan]
        $id_alt_1 = $data[0]->id_alt;
        $total_bobot = 0;
        $criteria = [];
        $alternative = [];
        $ids_alt = [];

        foreach ($data as $key => $value) {
            //get criteria only
            if ($id_alt_1 === $value->id_alt) {
                $total_bobot += $value->bobot;
                $criteria[] = [
                    'criteria' => $value->criteria,
                    'bobot' => $value->bobot,
                    'jenis' => $value->jenis,
                ];
            }
            //get alternative dan nilai kecockoan
            $alternative[$value->nama_alt][] = $value->nilai;
            $ids_alt[] = $value->id_alt;
        }
       
        //normalisasi bobot
        foreach ($criteria as $key => $value) {
            $nilai_normalisasi = $value['bobot'] / $total_bobot;
            $criteria[$key]['normalisasi'] = $criteria[$key]['jenis'] === 'Benefit' ? $nilai_normalisasi : - $nilai_normalisasi;
        }
        //hitung vector
        $data_alternative = [];
        $sum_all_vector = 0;
        $total_perankingan =0;
        foreach ($alternative as $key1 => $value1) {
            $vector = pow($value1[0], $criteria[0]['normalisasi']);
            $data_alternative[$key1][] = "<small>" .$vector . "</small>";
            for ($i=1; $i < sizeof($value1); $i++) { 
                $vector *= pow($value1[$i], $criteria[$i]['normalisasi']);
                $data_alternative[$key1][] = "<small>" . pow($value1[$i], $criteria[$i]['normalisasi']) . "</small>";
            }
            $data_alternative[$key1][] = $vector;
            $sum_all_vector += $vector;
            
        }
        //hitung perankingan
        foreach ($data_alternative as $key2 => $value2) {
            $data_alternative[$key2][] = $value2[sizeof($value2)-1] / $sum_all_vector;
            $total_perankingan += $value2[sizeof($value2) - 1] / $sum_all_vector;
        }

        $idx_id = 0;
        foreach ($data_alternative as $alt => $array) {
            $data_alternative[$alt][] = $ids_alt[$idx_id];
            $idx_id += sizeof($criteria);
        }
        $_SESSION[$this->input->ip_address()] = date('dmyHis').rand(10, 1000000000);
        $this->data['token'] = $_SESSION[$this->input->ip_address()];
        $this->data['id_alt'] = $ids_alt;
        $this->data['criteria'] = $criteria;
        $this->data['total_vektor'] = $sum_all_vector;
        $this->data['total_bobot'] = $total_bobot;
        $this->data['total_perankingan'] = $total_perankingan;
        $this->data['alternative'] = $data_alternative;
        $this->data['content'] = $this->load->view('hitungwp_v', $this->data, TRUE);
        $this->load->view('layout', $this->data, FALSE);
        
    }

    public function simpan($token)
    {
        if ($token === $_SESSION[$this->input->ip_address()]) {
            $data = $_SESSION['hasil_perhitungan'];
            $id_perhitungan = $data[0]['id_perhitungan'];
            
            $perhitungan = [
                'id' => $id_perhitungan,
                'tanggal' => date('Y-m-d'),
            ];

            $insert = $this->hitungmodel->insert_hasil($perhitungan, $data);
            if ($insert) {
                $message = "Hasil perhitungan berhasil disimpan";
                $action = TRUE;
            }else{
                $message = "Hasil perhitungan gagal disimpan";
                $action = FALSE;
            }
            $this->session->set_flashdata('message', $message);
            $this->session->set_flashdata('action', $action);
        }
        unset($_SESSION['hasil_perhitungan']);
        unset($_SESSION[$this->input->ip_address()]);
        redirect('Selection', 'refresh');
    }

}

/* End of file Hitungwp.php */

?>