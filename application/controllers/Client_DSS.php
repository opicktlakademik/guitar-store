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
       if (isset($_GET['hmmm']) AND $_GET['hmmm'] !== NULL) {
            $alt = preg_replace("/[^0-9,]/", "", $_GET['hmmm']);
            $alternative = array_unique(explode(",", $alt));
            $alt_session = $_SESSION['data'];

            $data_alt = [];

            foreach ($alternative as $key => $value) {
                $data_alt[] = isset($alt_session[$value]) ? $alt_session[$value] : NULL;
            }

            if (array_search(NULL ,$data_alt) OR sizeof($data_alt) <= 0) {
                redirect("dss");
            }

            //$data_header_0 = $data_alt[0]['alternative'];
            //print_r($data_header_1 = $data_alt[0]['pencocokan']);

            
            $data['page'] = "dss-client";
            $data['criteria'] = $_SESSION['criteria'];
            $data['data_alt'] = $data_alt;
            $data['header'] = $_SESSION['header'];
            $data['content'] = $this->load->view('pilih_v', $data, TRUE);
            $this->load->view('top_layout_client', $data, FALSE);
       }
    }

    public function session()
    {
        print_r($_SESSION['data']);
    }

}

/* End of file Client_DSS.php */

?>