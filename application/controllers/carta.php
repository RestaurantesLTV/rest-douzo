<?php
/**
 * Controlador que me redirige a la vista de la carta
 * @package	Creatalia
 * @subpackage	Frontend
 * @category	Controllers
 */
class Carta extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    function index() {
        $this->load->view('Plantillas/carta');
    }

}
