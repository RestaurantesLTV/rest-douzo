<?php

class Categorias_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function get_categoria() {

        $query = $this->db->query('SELECT id_cat, nombre_cat FROM categoria');
        return $query->result();
    }

    function listar_recetas() {
        $query = $this->db->query('Select * from articulo where id_cat = 1');
        return $query->result();
    }

    function listar_reservas() {
        $query = $this->db->query('Select * from articulo where id_cat = 2');
        return $query->result();
    }

    function listar_noticias() {
        $query = $this->db->query('Select * from articulo where id_cat = 3');
        return $query->result();
    }

    function listar_offtopic() {
        $query = $this->db->query('Select * from articulo where id_cat = 4');
        return $query->result();
    }

}
