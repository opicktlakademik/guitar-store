<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_M extends CI_Model {

    public function login($username, $password)
    {
        return $this->db->get_where('users', [
            'username' => $username,
            'password' => md5($password)
        ], 1
        )->result();
        
    }

}

/* End of file Login_M.php */

?>