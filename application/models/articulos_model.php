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
    function ultimo_articulo() {
        // $consulta = $this->db->query('SELECT * FROM articulo WHERE id_art = (select max(id_art) from articulo)');
        $this->db->order_by('id_art', 'desc');
        $consulta = $this->db->get('articulo', 1);
        return $consulta->result();
    }
    
    function guardar_entradas_bd() {
        $this->load->helper('url');
        $url = url_title($this->input->post('titulo'), TRUE);
        $data = array(
            'titulo_art' => $this->input->post('titulo'), //capturo los datos que me envian desde la vista
            'cabecera_art' => $this->input->post('cabecera'), //capturo los datos que me envian desde la vista
            'contenido_art' => $this->input->post('contenido'),
            'url_art' => $url, //capturo los datos que me envian desde la vista
            'autor_art' => $this->input->post('autor'),
            'categoria_art' => $this->input->post('categoria'));
            
        return $this->db->insert('articulo', $data);
    }
}
