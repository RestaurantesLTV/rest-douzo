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
        /*$data = array(
            'titulo' => $this->input->post($titulo),
            'ruta' => $this->input->post('http://localhost/douzo/assets/images/471x374' . $imagen)
        );*/
        return $this->db->insert('imagenes', $data);
    }
    
  /*  function cargar_foto(){
        $this->db->order_by('id_img', 'desc');
        $consulta = $this->db->get('imagenes');
        return $consulta->result();
    }*/
}
