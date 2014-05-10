<?php

class Form extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        //$this->load->model('Articulos_model');
    }

    function index() {
        $datos['titulo'] = 'Validacion de formularios';
        $datos['contenido'] = 'anadir_entrada';
        $this->load->view('Plantillas/back_end/anadir_art_be', $datos);
    }

    function validar() {

        /*         * ************** CODIGO NO NECESARIO ---> VER config/form_validation.php ***************************** */
        //$this->form_validation->set_rules('titulo','Titulo','required|max_length[15]|alpha|min_length[8]');
        //$this->form_validation->set_rules('cabecera','Cabecera','required|max_length[40]|alpha|min_length[15]');
        //$this->form_validation->set_rules('autor','Autor','required|max_length[25]|alpha|min_length[8]');
        //$this->form_validation->set_rules('opciones','Categoria','required');
        //$this->form_validation->set_rules('contenido', 'Contenido', 'required|max_length[300]|alpha|min_length[150]');
        /*         * **************************************************************************************************** */

        $this->form_validation->set_message('required', 'Es obligatorio rellenar el campo %s'); //Cambio mensaje de error
        $this->form_validation->set_error_delimiters('<div class="mensaje_error_form" >', '</div>'); //Pone el mensaje de error al lado del div

        if ($this->form_validation->run() === FALSE) {
            $datos['titulo'] = 'Validacion de formularios';
            $datos['contenido'] = 'anadir_entrada';
            $this->load->view('Plantillas/back_end/anadir_art_be', $datos);
        } else {
            $datos['titulo'] = 'Validacion OK';
            $datos['contenido'] = 'entrada_ok';
            $this->load->view('Plantillas/back_end/anadir_art_be', $datos);
        }
    }

    /**
     * - Metodo que una vez introducido el email dira si es valido o no
     * @param type $email
     * @return boolean TRUE -->TODO OK! ----  FALSE -->ERROR 
     * 
     */
    function check_email($email) {
        $this->load->model('Usuarios_model');

        if ($this->Usuarios_model->check_email($email)) { //Si el usuario existe // Si devuelve true...
            $this->form_validation->set_message('check_email', 'El correo ' . $email . ' ya esta en la base de datos');
            return false; // Error al validar
        } else {
            return true; // Campo validado!
        }
    }

}
