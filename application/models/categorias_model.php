<?php

class Categorias_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    /**
     * Funcion que obtiene la categoria del articulo/entrada
     * @return select
     * @author Victor Arnau
     */
    function get_categoria() {

        $query = $this->db->query('SELECT id_cat, nombre_cat FROM categoria');
        return $query->result();
    }
    /**
     * Funcion que obtiene una fila segun la categoria recetas
     * @return select
     * @author Victor Arnau
     */
    function listar_recetas() {
        $query = $this->db->query('Select * from articulo where id_cat = 1');
        return $query->result();
    }
     /**
     * Funcion que obtiene una fila segun la categoria reservas
     * @return select
     * @author Victor Arnau
     */
    function listar_reservas() {
        $query = $this->db->query('Select * from articulo where id_cat = 2');
        return $query->result();
    }
     /**
     * Funcion que obtiene una fila segun la categoria noticias
     * @return select
     * @author Victor Arnau
     */
    function listar_noticias() {
        $query = $this->db->query('Select * from articulo where id_cat = 3');
        return $query->result();
    }
     /**
     * Funcion que obtiene una fila segun la categoria offtopic
     * @return select
     * @author Victor Arnau
     */
    function listar_offtopic() {
        $query = $this->db->query('Select * from articulo where id_cat = 4');
        return $query->result();
    }

}
