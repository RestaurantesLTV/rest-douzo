<?php
/**
 * Controlador que me redirige a la vista del equipo
 * @package	Creatalia
 * @subpackage	Frontend
 * @category	Controllers
 */
class Equipo extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    function index() {
        $this->load->view('Plantillas/equipo');
    }

}
