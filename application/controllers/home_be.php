<?php

class Home_be extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Articulos_model');
        /*$this->load->library(array('user', 'user_manager'));
        
        $this->user->onvalid_session('Plantillas/back_end/index_be');
        $this->user->on_invalid_session('login');*/

        
    }

    function index() {
        $this->load->view('Plantillas/back_end/index_be');
    }

    /**
     * Recoge la lista de articulos
     * Carga la vista lista_entradas ----> $this->load->view('Dinamicas/back_end/'.$contenido);
     */
    function entradas() {
        $datos['articulo'] = $this->Articulos_model->lista_articulos();
        $datos['titulo'] = "Douzo|Entradas";
        $datos['contenido'] = "lista_entradas";
        $this->load->view('Plantillas/back_end/entradas_be', $datos);
    }

    function anadirEntrada() {
        $this->load->view('Plantillas/back_end/anadir_art_be');
    }

    function modificarEntrada($url_art) {
        $url_limpia = $this->security->xss_clean($url_art);
        $datos['detalle'] = $this->Articulos_model->detalle_articulo($url_limpia);
        $datos['titulo'] = $datos['detalle']->titulo_art;
        $datos["id_art"] = $this->input->post('id_art');
        $datos['contenido'] = "modificar_entrada";
        $this->load->view('Plantillas/back_end/modificar_art_be', $datos);
    }

    function entradaModificada() {
        $this->Articulos_model->actualizar_entrada();
        $datos['titulo'] = "Douzo|Entradas";
        $datos['contenido'] = "lista_entradas";
        $this->load->view('Plantillas/back_end/entradas_be', $datos);
    }

    function borrar_entrada($url_art) {
        $this->Articulos_model->borrar_entrada($url_art);
        $datos['titulo'] = "Douzo|Entradas";
        $datos['contenido'] = "lista_entradas";
        //$this->load->view('Plantillas/back_end/entradas_be', $datos);
        redirect('back_end/entradas', 'refresh');
    }

    function categorias() {
        $this->load->view('Plantillas/back_end/categorias_be');
    }

    /**
     * @author unscathed18
     */
    function reserva() {

        $datos['contenido'] = "reservas";

        $this->load->view('Plantillas/back_end/reservas_be', $datos);
    }

    function web() {
        $this->load->view('Plantillas/back_end/web_be');
    }

    /**
     * - Enlace a la pagina de login
     * @todo implementar el sistema de usuarios para hacer logout
     */
    function salir() {
        $this->load->view('Plantillas/index');
    }

    //LOGIN
    /*     * ********************************************************************** */
    function validate() {
        // Receives the login data
        $login = $this->input->post('login');
        $password = $this->input->post('password');

        /*
         * Validates the user input
         * The user->login returns true on success or false on fail.
         * It also creates the user session.
         */
        if ($this->user->login($login, $password)) {
            // Success
            redirect('login/private_page');
        } else {
            // Oh, holdon sir.
            redirect('login');
        }
    }

    // Simple logout function
    function logout() {
        // Removes user session and redirects to login
        $this->user->destroy_user('login');
    }

    // FUNCIONES DE RESERVA: @author unscathed18
    /*     * ********************************************************************** */
}
