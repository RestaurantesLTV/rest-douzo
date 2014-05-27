<?php

/**
 * Controlador que me redirige a la vista del blog
 * @package	Creatalia
 * @subpackage	Frontend
 * @category	Controllers
 */
class Blog extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    function index() {
        $this->load->view('Plantillas/blog');
    }

}
