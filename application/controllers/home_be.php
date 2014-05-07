<?php

class Home_be extends CI_Controller {

    public function __construct() {
        parent::__construct();
       
    }

    function index() {
       // echo "asdasdasd";
        $this->load->view('Plantillas/back_end/index_be');
    }

}
