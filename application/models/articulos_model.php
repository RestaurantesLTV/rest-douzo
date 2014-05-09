<?php

class Articulos_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    /**
     * Devuelve la lista de articulos
     * @return array
     */
    function lista_articulos() {
        $this->db->order_by('id_art', 'desc');
        $consulta = $this->db->get('articulo');
        return $consulta->result();
    }
    /**
     * Retorna la fila con el ultimo articulo
     * @return array
     */
   function ultimo_articulo(){
      // $consulta = $this->db->query('SELECT * FROM articulo WHERE id_art = (select max(id_art) from articulo)');
        $this->db->order_by('id_art','desc');
        $consulta = $this->db->get('articulo',1);
        return $consulta->result();
        
    }

}
