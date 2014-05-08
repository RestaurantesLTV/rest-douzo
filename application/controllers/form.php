<?php

class Form extends CI_Controller {

    function index() {
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('Plantillas/back_end/anadir_art_be');
        } else {
            $this->load->view('pruebaForm');
        }
    }

}
