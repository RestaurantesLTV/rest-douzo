<?php

class Categorias_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function get_categoria() {
        $query = $this->db->query('SELECT id_cat, nombre_cat FROM categoria');
        if ($query->num_rows() > 0) {
// almacenamos en una matriz bidimensional 
            echo $query;
            foreach ($query->result() as $row)
                $arrDatos[htmlspecialchars($row->id_cat, ENT_QUOTES)] = htmlspecialchars($row->nombre_cat, ENT_QUOTES);
            $query->free_result();
            return $arrDatos;
        }
    }

}
