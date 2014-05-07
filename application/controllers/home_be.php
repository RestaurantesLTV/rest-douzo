<?php

class Home_be extends CI_Controller {

    public function __construct() {
        parent::__construct();
       $this->load->model('Articulos_model');
    }

    function index() {
        $this->load->view('Plantillas/back_end/index_be');
    }
    
    function entradas(){
        $datos['articulo'] = $this->Articulos_model->lista_articulos();
        $datos['titulo'] = "Douzo|Entradas";
        $datos['contenido'] = "lista_entradas";
        $this->load->view('Plantillas/back_end/entradas_be',$datos);
    }
    function añadirEntrada(){
        $this->load->view('Plantillas/back_end/categorias_be/añadir_art');
    }
            
    function categorias(){
        $this->load->view('Plantillas/back_end/categorias_be');
    }
    function reservas(){
        $this->load->view('Plantillas/back_end/reservas_be');
    }
    function menu(){
        $this->load->view('Plantillas/back_end/menu_be');
    }
    function web(){
        $this->load->view('Plantillas/back_end/web_be');
    }
    
    /**
     * - Enlace a la pagina de login
     * @todo implementar el sistema de usuarios para hacer logout
     */
    function salir(){
        $this->load->view('Plantillas/index');
    }
}
