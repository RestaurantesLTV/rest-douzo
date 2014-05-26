<?php

class Home_be extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Articulos_model');
        $this->load->library("Aauth");
    }

    /**
     * @author unscathed21@hotmail.com Leonardo
     */
    public function validarLogin() {
        $user = $this->input->post('login');
        $password = $this->input->post('password');

        if (!$this->aauth->login($user, $password)) {
            $this->session->set_flashdata('bad_login', "Sus credenciales son err&oacute;neas.");
        }
        redirect("back_end", 'refresh');
    }

    function index() {
        if (!$this->aauth->is_loggedin()) {
            //$this->aauth->create_user('admin@admin.com', 'admin', 'Mr. Sharingan');
            $this->load->view('login');
            return;
        }

        $this->load->view('Plantillas/back_end/index_be');
    }

    /**
     * Recoge la lista de articulos
     * Carga la vista lista_entradas ----> $this->load->view('Dinamicas/back_end/'.$contenido);
     */
    function entradas() {
        if (!$this->aauth->is_loggedin()) {
            $this->load->view('login');
            return;
        }

        $datos['articulo'] = $this->Articulos_model->lista_articulos();
        $datos['titulo'] = "Douzo|Entradas";
        $datos['contenido'] = "lista_entradas";
        $this->load->view('Plantillas/back_end/entradas_be', $datos);
    }

    function subir_imagen() {
        if (!$this->aauth->is_loggedin()) {
            $this->load->view('login');
            return;
        }
        $this->load->view('Plantillas/back_end/subir_foto');
    }

    function anadirEntrada() {
        if (!$this->aauth->is_loggedin()) {
            $this->load->view('login');
            return;
        }
        $this->load->view('Plantillas/back_end/anadir_art_be');
    }

    function modificarEntrada($url_art) {
        if (!$this->aauth->is_loggedin()) {
            $this->load->view('login');
            return;
        }
        $url_limpia = $this->security->xss_clean($url_art);
        $datos['detalle'] = $this->Articulos_model->detalle_articulo($url_limpia);
        $datos['titulo'] = $datos['detalle']->titulo_art;
        $datos["id_art"] = $this->input->post('id_art');
        $datos['contenido'] = "modificar_entrada";
        $this->load->view('Plantillas/back_end/modificar_art_be', $datos);
    }

    function entradaModificada() {
        if (!$this->aauth->is_loggedin()) {
            $this->load->view('login');
            return;
        }
        $this->Articulos_model->actualizar_entrada();
        $datos['titulo'] = "Douzo|Entradas";
        $datos['contenido'] = "lista_entradas";
        $this->load->view('Plantillas/back_end/entradas_be', $datos);
    }

    function borrar_entrada($url_art) {
        if (!$this->aauth->is_loggedin()) {
            $this->load->view('login');
            return;
        }
        $this->Articulos_model->borrar_entrada($url_art);
        $datos['titulo'] = "Douzo|Entradas";
        $datos['contenido'] = "lista_entradas";
        //$this->load->view('Plantillas/back_end/entradas_be', $datos);
        redirect('back_end/entradas', 'refresh');
    }

    function categorias() {
        if (!$this->aauth->is_loggedin()) {
            $this->load->view('login');
            return;
        }
        $this->load->view('Plantillas/back_end/categorias_be');
    }

    /**
     * @author unscathed18
     */
    function reserva() {
        if (!$this->aauth->is_loggedin()) {
            $this->load->view('login');
            return;
        }
        $datos['contenido'] = "reservas";

        $this->load->view('Plantillas/back_end/reservas_be', $datos);
    }

    function web() {
        if (!$this->aauth->is_loggedin()) {
            $this->load->view('login');
            return;
        }
        $this->load->view('Plantillas/back_end/web_be');
    }

    /**
     * - Enlace a la pagina de login
     * @todo implementar el sistema de usuarios para hacer logout
     */
    function salir() {
        $this->aauth->logout();
        $datos['articulo'] = $this->Articulos_model->ultimo_articulo();
        $datos['contenido'] = "presentacion";
        $this->load->view('Plantillas/index', $datos);
    }

}
