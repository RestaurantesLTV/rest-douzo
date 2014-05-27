<?php
/**
 * Controlador para las imagenes, hace uso de la libreria Imagenes. 
 */
class Imagenes_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('articulos_model');
        
        $this->load->library('Imagenes');
    }

    function index() {
        $datos['titulo'] = "Imagen subida";
        $datos['contenido'] = "subir_imagen";
        $this->load->view('Plantillas/back_end/anadir_art_be', $datos);
    }
    /**
     * Funcion que llama al metodo de la libreria para subir a las imagenes
     */
    function tratar_imagen() {
       // print_r($_FILES);
        $this->imagenes->procesar_imagen($_FILES);
        //$this->imagenes->_create_thumbnail($filename);
        
    }
    


}
