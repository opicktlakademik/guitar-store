<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Criteria extends CI_Controller {

    private $data = ["menu" => "criteria", "page" => "Criteria"];
    public $uri;

    public function __construct()
    {
        parent::__construct();
        $this->uri = uri_string() . "?" . http_build_query($_GET);
        is_login($this->uri);
        $this->load->model('Criteria_M', 'crud');
    }
    

    public function index()
    {
        $this->data['criteria'] = $this->crud->get_criteria();
        $this->data['content'] = $this->load->view('criteria_v', $this->data, TRUE);
        $this->load->view('top_layout', $this->data);
    }
}

/* End of file Criteria.php */

?>