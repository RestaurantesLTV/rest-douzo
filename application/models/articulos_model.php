<?php

class Articulos_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function lista_articulos() {
        $this->db->order_by('id_art', 'desc');
        $consulta = $this->db->get('articulo');
        return $consulta->result();
    }

}
