<?php

/**
 * 
 */
class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Articulos_model');
    }

    function index() {
        $this->output->enable_profiler(TRUE);
        //$query = $this->Articulos_model->ultimo_articulo();
        //$datos['articulo'] = $query;
        $datos['articulo'] = $this->Articulos_model->ultimo_articulo();
        $datos['contenido'] = "presentacion";
        $this->load->view('Plantillas/index', $datos);
      
    }

    function ultimo_articulo() {
        
    }

}
