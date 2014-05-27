<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Clase para tratar todas las imagenes de la web
 * @author Victor Arnau
 */
Class Imagenes {

    private $CI = null;

    function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model('imagenes_model');
    }

    /**
     * Funcion que configura los parametros de la imagen, la sube a la carpeta assets, y a la bd
     * @param type $file_p -> puntero a los datos de la imagen
     * @return false si no esta logged
     * @author Victor Arnau
     */
    function procesar_imagen($file_p) {
        $nombre_imagen = $file_p['userfile']['name'];
        $config['max_size'] = 100000;
        $config['quality'] = '90%';
        $config['upload_path'] = './assets/images/471x374/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|JPG';

        $config['file_name'] = $nombre_imagen;
        $this->CI->load->library('upload', $config);

        if (!$this->CI->upload->do_upload()) {
            echo 'error --> no se ha subido la imagen';
        } else {
            // Si se ha subido a la carpeta assets, paso a insertarla en BD
            $file_info = $this->CI->upload->data();
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

    /**
     * 
     * @param type $titulo --> titulo puesto a la imagen
     * @param type $imagen --> ruta de la imagen
     * @return type insert --> Devuelve un insert en la bd
     * @author Victor Arnau
     */
    function subir($titulo, $imagen) {
        $data = array(
            'titulo' => $titulo,
            'ruta' => 'http://localhost/douzo/assets/images/471x374' . $imagen
        );
        return $this->CI->db->insert('imagenes', $data);
    }

    /**
     * Funcion que recoge la ruta de la ultima imagen introducida en la bd
     * @return true si obtiene la fila de la url de la imagen
     * @return false si no la obtiene
     * @author Victor Arnau
     */
    function obtener_ruta_ultima_imagen() {
        $query = $this->CI->db->query('SELECT ruta FROM imagenes WHERE id_img = ( SELECT MAX( id_img ) FROM imagenes )');
        if ($query->num_rows() > 0) {
            $row = $query->row();

            return $row->ruta;
        } else {
            return false;
        }
    }

    /**
     * Función que obtiene el ultimo articulo introducido en la base de datos
     * @return true si obtiene la fila
     * @return false si no la obtiene
     * @author Victor Arnau
     */
    function obtener_ultimo_id_art() {
        $query = $this->CI->db->query('SELECT MAX( id_art ) as id_art FROM articulo ');
        if ($query->num_rows() > 0) {
            $row = $query->row();

            return $row->id_art;
        } else {
            return false;
        }
    }

    /**
     * Relaciona una imagen de la tabla de imagenes con el ultimo articulo insertado en la BD.
     * @return true si obtiene la fila 
     * @return false si no la obtiene
     * @author Victor Arnau
     */
    function set_imagen() {
        //Una vez insertado el articulo en la base de datos seguimos por aqui...
        $ruta = $this->obtener_ruta_ultima_imagen(); //Cogo la ruta de la tabla imagenes de la imagen subida con el articulo 
        $id = $this->obtener_ultimo_id_art(); //obtengo ultimo id = ultima noticia 

        if ($ruta && $id) {
            echo "RUta: {$ruta}, con ID {$id} ";
            $this->CI->db->query("UPDATE articulo SET imagen_art ='{$ruta}' WHERE id_art = {$id}"); //Actualizo la ultima entrada, añadiendole la ruta de la imagen. 
            return true;
        }
        return false;
    }

}
