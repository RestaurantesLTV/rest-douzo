<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Imagenes {

    private $CI = null;

    function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model('imagenes_model');
    }

    function procesar_imagen($file_p) {
        //cargar Imagen
        
        //
        $nombre_imagen = $file_p['userfile']['name'];
        $config['max_size'] = 100000;
        $config['quality'] = '90%';
        $config['upload_path'] = './assets/images/471x374/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|JPG';
        //$config['max_width'] = '471';
        //$config['max_height'] = '374';
        $config['file_name'] = $nombre_imagen;
        $this->CI->load->library('upload', $config);
        
 
        
        echo "<p>LLEGA AQUI</p>";

        if (!$this->CI->upload->do_upload()) {
            // $error = array('error' => $this->upload->display_errors());
            // $this->load->view('Plantillas/back_end/anadir_art_be', $error);
            echo 'error --> no se ha subido la imagen';
        } else {
            // Si se ha subido a la carpeta assets, paso a insertarla en BD
            $file_info = $this->CI->upload->data();
            // $this->_create_thumbnail($file_info['file_name']);
            $datos = array('upload_data' => $this->CI->upload->data());
            $titulo = $this->CI->input->post('titulo');
            $imagen = $file_info['file_name'];
            $this->CI->imagenes_model->subir($titulo, $imagen);
            $datos['titulo'] = $titulo;
            $datos['imagen'] = $imagen;
            $datos['contenido'] = 'imagen_ok';
            $this->CI->load->view('Plantillas/back_end/anadir_art_be', $datos);
        }
    }

   /* function _create_thumbnail($filename) {
        $config['image_library'] = 'gd2';
        //CARPETA EN LA QUE ESTÁ LA IMAGEN A REDIMENSIONAR
        $config['source_image'] = 'http://localhost/douzo/assets/images/471x374/' . $filename;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        //CARPETA EN LA QUE GUARDAMOS LA MINIATURA
        $config['new_image'] = './assets/images/thumbs/'; //'.$filename.'_thumb';
        $config['width'] = 150;
        $config['height'] = 150;
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
    }*/

    function subir($titulo, $imagen) {
        $data = array(
            'titulo' => $titulo,
            'ruta' => 'http://localhost/douzo/assets/images/471x374' . $imagen
        );
        /* $data = array(
          'titulo' => $this->input->post($titulo),
          'ruta' => $this->input->post('http://localhost/douzo/assets/images/471x374' . $imagen)
          ); */
        return $this->CI->db->insert('imagenes', $data);
    }

    function obtener_ruta_ultima_imagen() {
        $query = $this->CI->db->query('SELECT ruta FROM imagenes WHERE id_img = ( SELECT MAX( id_img ) FROM imagenes )');
        if($query->num_rows() > 0){
            $row = $query->row();
            
            return $row->ruta;
        }else{ return false; }
    }

    function obtener_ultimo_id_art() {
        $query = $this->CI->db->query('SELECT MAX( id_art ) as id_art FROM articulo ');
        if($query->num_rows() > 0){
            $row = $query->row();
            
            return $row->id_art;
        }else{ return false; }
    }
    
    /**
     * Relaciona una imagen de la tabla de imagenes
     * con el ultimo articulo insertado en la BD.
     * 
     */
    function set_imagen() {
        //Una vez insertado el articulo en la base de datos seguimos por aqui...
        $ruta = $this->obtener_ruta_ultima_imagen(); //Cogo la ruta de la tabla imagenes de la imagen subida con el articulo 
        $id = $this->obtener_ultimo_id_art(); //obtengo ultimo id = ultima noticia 
        
        if($ruta && $id){
            echo "RUta: {$ruta}, con ID {$id} ";
            $this->CI->db->query("UPDATE articulo SET imagen_art ='{$ruta}' WHERE id_art = {$id}"); //Actualizo la ultima entrada, añadiendole la ruta de la imagen. 
            return true;
        }
        return false;
    }

}
