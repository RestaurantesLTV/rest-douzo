<?php

class Imagenes_model extends CI_Model {

    public function construct() {
        parent::__construct();
    }

    //FUNCIÓN PARA INSERTAR LOS DATOS DE LA IMAGEN SUBIDA
    function subir($titulo, $imagen) {
        $data = array(
            'titulo' => $titulo,
            'ruta' => 'http://localhost/douzo/assets/images/471x374' . $imagen
        );
        /* $data = array(
          'titulo' => $this->input->post($titulo),
          'ruta' => $this->input->post('http://localhost/douzo/assets/images/471x374' . $imagen)
          ); */
        return $this->db->insert('imagenes', $data);
    }

    function obtener_ruta_ultima_imagen() {
        $query = $this->db->query('SELECT ruta FROM imagenes WHERE id_img = ( SELECT MAX( id_img ) FROM imagenes )');
        return $query->result();
    }

    function obtener_ultimo_id_art() {
        $query = $this->db->query('SELECT MAX( id_art ) FROM articulo ');
        return $query->result();
    }

    function set_imagen() {
        //Una vez insertado el articulo en la base de datos seguimos por aqui...
        $ruta = $this->db->obtener_ruta_ultima_imagen(); //Cogo la ruta de la tabla imagenes de la imagen subida con el articulo 
        $id = $this->db->obtener_ultimo_id_art(); //obtengo ultimo id = ultima noticia 
        return $this->db->query('UPDATE articulo SET imagen_art =' . $ruta . 'WHERE id_art =' . $id); //Actualizo la ultima entrada, añadiendole la ruta de la imagen. 
    }

    /*  function cargar_foto(){
      $this->db->order_by('id_img', 'desc');
      $consulta = $this->db->get('imagenes');
      return $consulta->result();
      } */
}
