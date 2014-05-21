<?php

class Categorias extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Categorias_model');
    }

    function index() {
        $datos['categoria'] = $this->Categorias_model->get_categoria();
        $datos['contenido'] = "anadir_entrada";
        $this->load->view('Plantillas/back_end/anadir_art_be', $datos);
    }

    function listar_recetas() {
        $datos['categoria'] = $this->Categorias_model->listar_recetas();
        $datos['titulo'] = 'BackEnd|Categorias';
        $datos['contenido'] = 'contentRecetas';
        $this->load->view('Plantillas/back_end/recetas_cat', $datos);
    }

    function listar_reservas() {
        $datos['categoria'] = $this->Categorias_model->listar_reservas();
        $datos['titulo'] = 'BackEnd|Categorias';
        $datos['contenido'] = 'contentReservas';
        $this->load->view('Plantillas/back_end/reservas_cat', $datos);
    }

    function listar_noticias() {
        $datos['categoria'] = $this->Categorias_model->listar_noticias();
        $datos['titulo'] = 'BackEnd|Categorias';
        $datos['contenido'] = 'contentNoticias';
        $this->load->view('Plantillas/back_end/noticias_cat', $datos);
    }

    function listar_offtopic() {
        $datos['categoria'] = $this->Categorias_model->listar_offtopic();
        $datos['titulo'] = 'BackEnd|Categorias';
        $datos['contenido'] = 'contentOfftopic';
        $this->load->view('Plantillas/back_end/offtopic_cat', $datos);
    }

}
