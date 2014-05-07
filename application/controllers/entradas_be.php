<?php

class Entradas_be extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // $this->load->model('Articulos_model');
    }

    function añadir() {
        $this->load->helper('form');
        $this->load->view("añadir_entrada");
    }

}
