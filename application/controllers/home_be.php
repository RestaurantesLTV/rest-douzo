<?php

class Home_be extends CI_Controller {

    public function __construct() {
        parent::__construct();
       
    }

    function index() {
       // echo "asdasdasd";
        $this->load->view('Plantillas/back_end/index_be');
    }
    
    function entradas(){
        $this->load->view('Plantillas/back_end/entradas_be');
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
    function salir(){
        $this->load->view('Plantillas/index');
    }
}
