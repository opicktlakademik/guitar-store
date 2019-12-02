<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_M', 'loginm');
    }
    

    public function index()
    {
        has_login();
        $this->load->view('login_v');
    }

    public function login()
    {
        if ($username = $this->input->post('username') AND $password = $this->input->post('password')) {

            $uri = $this->session->flashdata('uri') !== NULL ? $this->session->flashdata('uri') : 'Dashboard';
            $login = $this->loginm->login($username, $password);

            if (sizeof($login) > 0) {
                
                $array = array(
                    'nama'  => $login[0]->nama,
                    'photo' => $login[0]->foto,
                    'is_login' => TRUE,
                );
                
                $this->session->set_userdata( $array );
                redirect($uri);
            }else{
                $this->session->set_flashdata('message', 'Username atau password salah');
                $this->session->set_flashdata('action', FALSE);

                redirect('login', 'refresh');
            }
        }else{
            $this->session->set_flashdata('message', 'hmmmmmmmm...............');
            $this->session->set_flashdata('action', FALSE);
            redirect('Login', 'refresh');
        }
    }

    public function logout()
    {
        session_destroy();
        redirect('Login', 'refresh');
    }

}

/* End of file Login.php */

?>