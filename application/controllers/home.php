<?php

/**
 * 
 */
class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Articulos_model');
    }

    /**
     * Funcion por defecto
     */
    function index() {
        $this->output->enable_profiler(TRUE);
        //$query = $this->Articulos_model->ultimo_articulo();
        //$datos['articulo'] = $query;
        $datos['articulo'] = $this->Articulos_model->ultimo_articulo();
        $datos['contenido'] = "presentacion";
        $this->load->view('Plantillas/index', $datos);
    }

    function entradas() {
        $datos['articulo'] = $this->Articulos_model->lista_articulos();
        $datos['titulo'] = "Douzo|Blog";
        $datos['contenido'] = "content";
        $this->load->view('Plantillas/blog', $datos);
    }

     function detalle_articulo($url_art) {
        //$this->output->enable_profiler(TRUE);
        $url_limpia = $this->security->xss_clean($url_art);
        $datos['detalle'] = $this->Articulos_model->detalle_articulo($url_limpia);
        $datos['titulo'] = $datos['detalle']->titulo_art;
        $datos['contenido'] = "detalle";
        //echo"hola";
        $this->load->view('Plantillas/detalle_art', $datos);
    }

}
