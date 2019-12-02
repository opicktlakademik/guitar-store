<?php
if (! function_exists('is_login')) {
    function is_login($uri = NULL)
    {
        $ci = &get_instance();
        if ($ci->session->userdata('is_login') === NULL OR !$ci->session->userdata('is_login')) {
            
            $ci->session->set_flashdata('message', 'Hmmm... blom login!');
            $ci->session->set_flashdata('uri', $uri);
            
            redirect('Login?u='.$uri, 'refresh');
        }
    }
}
if (! function_exists('has_login')) {
    function has_login()
    {
        $ci = &get_instance();
        if ($ci->session->userdata('is_login') !== NULL AND $ci->session->userdata('is_login')) {
            redirect('Dashboard', 'refresh');
        }
    }
}


?>