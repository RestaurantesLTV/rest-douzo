<?php
$this->load->view('Plantillas/front_end/index/header');
$this->load->view('Plantillas/front_end/index/top');
$this->load->view('Plantillas/front_end/index/'.$contenido);
$this->load->view('Plantillas/front_end/index/lema');
$this->load->view('Plantillas/front_end/index/packs');
$this->load->view('Plantillas/front_end/index/eventos');
//$this->load->view('Dinamicas/'.$contenido);
$this->load->view('Plantillas/front_end/index/footer');
?>
