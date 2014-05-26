<?php

/**
 * Pensado para el backend del sistema de reservas.
 * Este controlador esta preparado para responder a peticiones AJAX.
 * Cada funcion del modelo "be_reservas_model" tiene su equivalente con prefijo "ajax",
 * la cual convierte todos los resultados de la BD en format JSON. Esto permite
 * la directa manipulacion en el navegador con JS.
 * @author unscathed18
 */
class Ajax_reserva extends CI_Controller{
    
    /**
     *
     * @var modelo
     */
    private $model = null;
    
    public function __construct(){
        parent::__construct();
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        $this->load->library('ReservasManager');
        $this->model = $this->reservasmanager->getModel();
    }
    
    public function ajaxReservasNoVistas(){
        $no_vistas = $this->model->getReservasNoVistas();
        
        echo $this->dbResult_toJSON($no_vistas);
    }
    
    public function ajaxTodasLasReservas(){
        $todas = $this->model->getTodasLasReservas();
        
        echo $this->dbResult_toJSON($todas);
    }
    
    public function ajaxReservasCompletadas(){
        $completadas = $this->model->getReservasCompletadas();
        
        echo $this->dbResult_toJSON($completadas);
    }
    
    public function ajaxNoVerificadas(){
        $noVerificadas = $this->model->getReservasNoVerificadas();
        echo $this->dbResult_toJSON($noVerificadas);
    }
    
    public function ajaxReservasUltimos7Dias(){
        $ultimos_dias = $this->model->getReservasUltimos7Dias();
        echo $this->dbResult_toJSON($ultimos_dias);
    }
    
    public function ajaxProximasReservas(){
        $proximas_reservas = $this->model->getProximasReservas();
        echo $this->dbResult_toJSON($proximas_reservas);
    }
    
    public function ajaxBorrarReserva(){
        $ids_marcados = $this->input->get('borrar');
        if(count($ids_marcados) == 0){
            die("No hay ni un solo id!");
        }
        
        $success = $this->model->borrarReserva($ids_marcados);
        echo $success;
        
        
    }
    
    public function getTurnos(){
        $turnos = $this->model->getTurnos();
        echo $this->dbResult_toJSON($turnos);
    }
    
    public function dbResult_toJSON($result, $incluirAsunto=""){
        $i = 0;
        $json = null; /* Si la query no da ningun resultado (Por lo tanto no entrara 
                        * por el 'foreach' de debajo), esto permanecera NULL.*/
        
        foreach($result->result_array() as $row){
            foreach($row as $key => $value){
                $json[$i][$key] = $value;
                if(!empty($incluirAsunto)){
                    $json[$i]["asunto"] = "Nueva reserva";
                }
            }
            $i++;
        }
        
        return json_encode($json);
    }
    
    public function ajaxModificarConfig(){
        
        $request = $this->input->get("req");
        $valor = $this->input->get("valor");
        
        if($valor == ""){
            die("El nombre no ha sido cambiado: esta vacio");
        }
        $success = true;
        
        
        
        switch($request){
            case "nombre":
                $success = $this->reservasmanager->modifyConfigFile($request, $valor);
                break;
            case "email":
                $success = $this->reservasmanager->modifyConfigFile($request, $valor);
                break;
            default:
                echo "Request invalida.";
        }
        
        
        if($success){
            echo "Modificado con exito!";
        }else{
            die("Ha ocurrido un problema modificando el parametro");
        }
        
        
    }
    public function ajaxNotificaciones(){
        $no_vistas = $this->model->getReservasNoVistas();
        echo $this->dbResult_toJSON($no_vistas, "Nueva reserva");
    }
    
    public function ajaxMarcarComoVisto(){
        $ids_marcados = $this->input->get('marcar');
        if(count($ids_marcados) == 0){
            die("No hay ni un solo id!");
        }
        
        $success = $this->model->marcarComoVisto($ids_marcados);
        echo $success;
        
    }
}
