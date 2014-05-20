<?php

class Categorias extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Categorias_model');
    }
    function index() {
       $datos['arrCategorias'] = $this->Categorias_model->get_categoria(); 
       $this->load->view('anadir_entrada', $datos);
       }
}
