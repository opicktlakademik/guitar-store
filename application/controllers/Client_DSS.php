<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Client_DSS extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Selection_M', 'selmod');
    }
    
    

    public function index()
    {
        $data = $this->selmod->get_pencocokan_case_study();
        $data['page'] = "dss-client";
        $data['content'] = $this->load->view('dss_v',$data, TRUE);
        $this->load->view('top_layout_client', $data, FALSE);
        //var_dump($_SESSION['data']);
        
    }

    public function pilih()
    {
       if (isset($_GET['hmmm']) AND $_GET['hmmm'] !== NULL AND isset($_SESSION['data'])) {

            $alt = preg_replace("/[^0-9,]/", "", $_GET['hmmm']);
            $alternative = array_unique(explode(",", $alt));
            $alt_session = $_SESSION['data'];

            $data_alt = [];

            foreach ($alternative as $key => $value) {
                $data_alt[] = isset($alt_session[$value]) ? $alt_session[$value] : NULL;
                if (array_search(NULL ,$data_alt) OR sizeof($data_alt) <= 0) {
                    break;
                    redirect("dss");
                }
            }

            //normalisasi
            $normalisasi = [];
            $i = 0;
            foreach ($data_alt as $key => $value) {
                $normalisasi[$i] = [
                    $value['alternative']['merk'],
                ];
                //persiapan preferensi
                $nilai_preferensi = 0;
                
                foreach ($value['pencocokan'] as $key_pck => $value_pck) {

                    $nilai_normal = 0;

                    if ($value_pck['jenis'] === "Benefit") {
                        $nilai_normal = $value_pck['nilai'] / $value_pck['min_or_max'];
                    }else{
                        $nilai_normal = $value_pck['min_or_max'] / $value_pck['nilai'];
                    }

                    $normalisasi[$i][] = $nilai_normal;
                    //hitung preferensi
                    $nilai_preferensi += $nilai_normal * $value_pck['bobot'];
                }

                $normalisasi[$i][] = $nilai_preferensi;
                $i++;
            }

            // ambil preferensi tok
            $preferensi = [];
            $header_preferensi = [];
            $jml_crt = $this->db->get('criteria')->num_rows();
            $jml = sizeof($normalisasi[0]) - $jml_crt;
            
            foreach ($normalisasi as $key => $value) {
                for ($i=0; $i < $jml - 1; $i++) { 
                    $preferensi[$key][] = $value[$i];
                }
                $preferensi[$key][] = $value[sizeof($value) - 1];

            }
            
            $data['page'] = "dss-client";
            $data['criteria'] = $_SESSION['criteria'];
            $data['data_alt'] = $data_alt;
            $data['header'] = $_SESSION['header'];
            $data['normalisasi'] = $normalisasi;
            $data['preferensi'] = $preferensi;
            $data['jml_crt'] = $jml_crt;
            $data['content'] = $this->load->view('pilih_v', $data, TRUE);
            $this->load->view('top_layout_client', $data, FALSE);
       }else{
           redirect("dss");
       }
    }

    public function session()
    {
        print_r($_SESSION['data']);
    }

}

/* End of file Client_DSS.php */

?>