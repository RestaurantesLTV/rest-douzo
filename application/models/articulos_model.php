<?php

class Articulos_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Devuelve la lista de articulos
     * @return array
     */
    function lista_articulos($inicio = FALSE, $limite = FALSE) {
        $this->db->order_by('id_art', 'desc');
        if($inicio !== FALSE && $limite !== FALSE){
            $this->db->limit($limite,$inicio);
        }
        $consulta = $this->db->get('articulo');
        return $consulta->result();
    }

    /**
     * Retorna la fila con el ultimo articulo
     * @todo Cambiarlo query por una que me devuelva con id_art = 3
     * @return array
     */
    function ultimo_articulo() {
        $consulta = $this->db->query('SELECT * FROM articulo WHERE id_art = 28 '); //(select max(id_art) from articulo)');
        //$this->db->order_by('id_art', 'desc');
        // $consulta = $this->db->get('articulo', 1);  
        // $consulta = $this->db->where('id_art', '3'); 
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
            'id_cat' => $this->input->post('opciones'));

        return $this->db->insert('articulo', $data);
    }

    function actualizar_entrada($url_art) {
        //$this->output->enable_profiler(TRUE);
        $this->load->helper('url');
        $url = url_title($this->input->post('titulo'), TRUE);
        $data = array(
            // 'id_art' => $this->input->post('id_art'),
            'titulo_art' => $this->input->post('titulo'), //capturo los datos que me envian desde la vista
            'cabecera_art' => $this->input->post('cabecera'), //capturo los datos que me envian desde la vista
            'contenido_art' => $this->input->post('contenido'),
            'url_art' => $url, //capturo los datos que me envian desde la vista
            'autor_art' => $this->input->post('autor'),
            'id_cat' => $this->input->post('opciones'));

        $this->db->where('url_art', $url_art);
        return $this->db->update('articulo', $data);
    }

    function borrar_entrada($url_art) {
        $this->db->where('url_art', $url_art);
        return $this->db->delete('articulo');
    }

    function detalle_articulo($url_art) {
        $this->db->where('url_art', $url_art);
        $consulta = $this->db->get('articulo');
        return $consulta->row();
    }

}
