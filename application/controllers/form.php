<?php

class Form extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('Imagenes');
        
    }

    function index() {
        $datos['titulo'] = 'Validacion de formularios';
        $datos['contenido'] = 'anadir_entrada';
        $this->load->view('Plantillas/back_end/anadir_art_be', $datos);
    }

    /*
     * - Valida todos los campos del formulario y carga la vista ok!
     */

    function validar() {
        $this->form_validation->set_message('required', 'Es obligatorio rellenar el campo %s'); //Cambio mensaje de error
        $this->form_validation->set_error_delimiters('<div class="mensaje_error_form" >', '</div>'); //Pone el mensaje de error al lado del div
        if ($this->form_validation->run() === FALSE) {
            $datos['titulo'] = 'Validacion de formularios';
            $datos['contenido'] = 'anadir_entrada';
            $this->load->view('Plantillas/back_end/anadir_art_be', $datos);
            return false;   
        } else {
            $this->load->model('Articulos_model');
            $this->Articulos_model->guardar_entradas_bd();
            
            if(!$this->imagenes->set_imagen()){
               
            }else{
            $datos['titulo'] = 'Validacion OK';
            $datos['contenido'] = 'entrada_ok';
            $this->load->view('Plantillas/back_end/anadir_art_be', $datos);
            }
        }
    }

    function validar_update($url_art) {
        //$this->form_validation->set_message('required', 'Es obligatorio rellenar el campo %s'); //Cambio mensaje de error
        //$this->form_validation->set_error_delimiters('<div class="mensaje_error_form" >', '</div>'); //Pone el mensaje de error al lado del div
        
       // if ($this->form_validation->run() === FALSE) {
          //  echo 'no valida';
            //$datos['titulo'] = 'Validacion de formularios';
           // $datos['contenido'] = 'modificar_entrada';
           // $this->load->view('Plantillas/back_end/modificar_art_be', $datos);
         //   return false;
      //  } else {
          //  echo 'valida';
            $this->load->model('Articulos_model');
            $this->Articulos_model->actualizar_entrada($url_art);
            $datos['articulo'] = $this->Articulos_model->lista_articulos();
            $datos['titulo'] = 'Lista Entradas';
            $datos['contenido'] = 'lista_entradas';
            //$this->load->view('Plantillas/back_end/modificar_art_be', $datos);
            redirect('back_end/entradas','refresh');
            
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

        if ($this->Usuarios_model->check_email($email)) { //Si el usuario existe // Si ha devuelto true...
            $this->form_validation->set_message('check_email', 'El correo ' . $email . ' ya esta en la base de datos');
            return false; // Error al validar
        } else {
            return true; // Campo validado!
        }
    }

    function anadir_entrada() {
        $this->load->model('Articulos_model');
        // if ($this->validar()) {
        $datos['titulo'] = 'Hola';
        $datos['contenido'] = $this->Articulos_model->guardar_entradas_bd();
        $this->load->view('Plantillas/back_end/anadir_art_be', $datos);
        // }
    }

    /**
     * --> print_r ---> imprime un array
     * server() ---> peticiones al servidor
     * ip_adress()---> nos devuelve la ip del usuario
     * user_agent()-----> recibe los datos el usuario(navegador,SO...)
     * get_request_header('Referer'); para saber desde donde viene (url)
     */
    function recibir_datos() {
        echo $this->input->post('titulo', TRUE);
        //print_r($this->input->post(null,TRUE)); //@param nombre del campo, @param TRUE APLICA FILTRO XSS 
        //print_r($this->input->server()); 
        //echo $this->input->get_request_header('Referer');
        /* if($this->input->is_ajax_request()){
          echo 'Es ajax';
          }else{
          echo 'No es ajax';
          } */
    }


