<?php

class Imagenes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Articulos_model');
    }

    function index() {
        $datos['titulo'] = "Imagen subida";
        $datos['contenido'] = "subir_imagen";
        $this->load->view('Plantillas/back_end/anadir_art_be', $datos);
    }

    function procesar_imagen() {
        //cargar Imagen
        print_r($_FILES);
        //
        $nombre_imagen = $_FILES['userfile']['name'];
        $config['max_size'] = 10000;
        $config['quality'] = '90%';
        $config['upload_path'] = './assets/images/471x374/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|JPG';
        $config['file_name'] = $nombre_imagen;
        $this->load->library('upload', $config);
        $this->upload->do_upload();
       
    }

}
