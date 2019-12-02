<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    private $data = ["menu" => "dashboard", "page" => "Dashboard"];
    public $uri;

    
    public function __construct()
    {
        parent::__construct();
        $this->uri = uri_string()."?".http_build_query($_GET);
        is_login($this->uri);
        $this->load->model('STDCRUD', 'crud');
        $this->load->model('Selection_M', 'selmod');
    }
    

    public function index()
    {
        $data = $this->selmod->get_perhitungan('Last', 0, FALSE, FALSE)->result();
        $bar_data = [];
        $x_axis = [];
        foreach ($data as $key => $value) {
            $bar_data[] = [$key+1, $value->hasil];
            $x_axis[] = [$key+1, $value->nama_alt];
            $this->data['tanggal_terakhir'] = $value->tanggal;
        }
        $this->data['bar_data'] = $bar_data;
        $this->data['x_axis'] = $x_axis;
        $this->data['riwayat'] = $this->crud->count('perhitungan');
        $this->data['criteria'] = $this->crud->count('criteria');
        $this->data['alternative'] = $this->crud->count('alternative');
        $this->data['content'] = $this->load->view('dashboard_v',$this->data, TRUE);
        $this->load->view('top_layout', $this->data);
    }

}

/* End of file Dashboard.php */
?>