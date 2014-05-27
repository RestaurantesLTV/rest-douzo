<?php

/**
 * @package	Creatalia
 * @subpackage	Frontend
 * @category	Controllers
 */
class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Articulos_model');
    }

    /**
     * Funcion por defecto
     */
    function index() {
       
        //$query = $this->Articulos_model->ultimo_articulo();
        //$datos['articulo'] = $query;
        $datos['articulo'] = $this->Articulos_model->ultimo_articulo();
        $datos['contenido'] = "presentacion";
        $this->load->view('Plantillas/index', $datos);
    }
    /**
     * Recibe el numero de pagina en el que se encuentra
     * @param type $pagina 
     */
    function entradas($pagina = FALSE) {
        $inicio = 0;
        $limite = 5;
        if ($pagina){
            $inicio = ($pagina -1) * $limite; 
        }
        $this->load->library('pagination');   //--> Cargo libreria
        $datos['articulo'] = $this->Articulos_model->lista_articulos($inicio,$limite);
        $config['base_url'] = base_url().'blog/pagina/';
        $config['total_rows'] = count($this->Articulos_model->lista_articulos());
        $config['per_page'] = $limite;
        $config['uri_segment'] = 3;
        $config['first_url'] = base_url().'blog';
        $config['last_link'] = 'Ultima &rsaquo;';
        $config['first_link'] = '&lsaquo; Primera';
        $this->pagination->initialize($config);
        $datos['titulo'] = "Douzo|Blog";
        $datos['contenido'] = "content";
        $this->load->view('Plantillas/blog', $datos);
    }
    
    /**
     * Funcion que carga la vista en detalle de cada articulo segun el que se haya seleccionado
     * @param type $url_art
     * 
     * @return view Vista detalle
     */
     function detalle_articulo($url_art) {
        //$this->output->enable_profiler(TRUE);
        $url_limpia = $this->security->xss_clean($url_art);
        $datos['detalle'] = $this->Articulos_model->detalle_articulo($url_limpia);
        $datos['titulo'] = $datos['detalle']->titulo_art;
        $datos['contenido'] = "detalle";
        //echo"hola";
        $this->load->view('Plantillas/detalle_art', $datos);
    }

}
