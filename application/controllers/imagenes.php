<?php

class Imagenes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('articulos_model');
        $this->load->model('imagenes_model');
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
        $config['max_size'] = 100000;
        $config['quality'] = '90%';
        $config['upload_path'] = './assets/images/471x374/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|JPG';
        //$config['max_width'] = '471';
        //$config['max_height'] = '374';
        $config['file_name'] = $nombre_imagen;
        $this->load->library('upload', $config);

        $this->upload->do_upload(); //--> Subo la imagen a la carpeta assets

        if (!$this->upload->do_upload()) {
            // $error = array('error' => $this->upload->display_errors());
            // $this->load->view('Plantillas/back_end/anadir_art_be', $error);
            echo 'error --> no se ha subido la imagen';
        } else {
            // Si se ha subido a la carpeta assets, paso a insertarla en BD
            $file_info = $this->upload->data();
           // $this->_create_thumbnail($file_info['file_name']);
            $datos = array('upload_data' => $this->upload->data());
            $titulo = $this->input->post('titulo');
            $imagen = $file_info['file_name'];
            $this->imagenes_model->subir($titulo, $imagen);
            
          /*  if ($this->imagenes_model->subir($titulo, $imagen)){
                //si se ha subido
                 $rutaUltFoto = $this->imagenes_model->obtener_ruta_ultima_imagen();
                 
            }  else {
                //si no se ha subido
            }*/
            $datos['titulo'] = $titulo;
            $datos['imagen'] = $imagen;
            $datos['contenido'] = 'imagen_ok';
            $this->load->view('Plantillas/back_end/anadir_art_be', $datos);
        }
    }
    
    
/*
    function _create_thumbnail($filename) {
        $config['image_library'] = 'gd2';
        //CARPETA EN LA QUE ESTÁ LA IMAGEN A REDIMENSIONAR
        $config['source_image'] = 'http://localhost/douzo/assets/images/471x374/' . $filename;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        //CARPETA EN LA QUE GUARDAMOS LA MINIATURA
        $config['new_image'] = './assets/images/thumbs/';
        $config['width'] = 150;
        $config['height'] = 150;
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
    }

    /*function ver_foto() {
        $datos['articulo'] = $this->imagenes_model->cargar_foto();
        $datos['titulo'] = "Douzo|Entradas";
        $datos['contenido'] = "lista_entradas";
        $this->load->view('Plantillas/back_end/entradas_be', $datos);
    }*/

}
