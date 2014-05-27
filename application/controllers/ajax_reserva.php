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
     * @var CI_Model modelo
     */
    private $model = null;
    
    public function __construct(){
        parent::__construct();
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        $this->load->library('ReservasManager');
        $this->model = $this->reservasmanager->getModel();
    }
    
    /**
     * Devuelve las reservas no vistas por el administrador en formato JSON.
     */
    public function ajaxReservasNoVistas(){
        $no_vistas = $this->model->getReservasNoVistas();
        
        echo $this->dbResult_toJSON($no_vistas);
    }
    
    /**
     * Devuelve todas las reservas en formato JSON
     */
    public function ajaxTodasLasReservas(){
        $todas = $this->model->getTodasLasReservas();
        
        echo $this->dbResult_toJSON($todas);
    }
    
    /**
     * Devuelve todas aquellas reservas completadas en formato JSON.
     */
    public function ajaxReservasCompletadas(){
        $completadas = $this->model->getReservasCompletadas();
        
        echo $this->dbResult_toJSON($completadas);
    }
    
    /**
     * Devuelve las reservas que no han sido verificados por los clientes en formato JSON.
     */
    public function ajaxNoVerificadas(){
        $noVerificadas = $this->model->getReservasNoVerificadas();
        echo $this->dbResult_toJSON($noVerificadas);
    }
    
    /**
     * Devuelve las reservas comprendidas en un periodo de una semana en formato JSON.
     */
    public function ajaxReservasUltimos7Dias(){
        $ultimos_dias = $this->model->getReservasUltimos7Dias();
        echo $this->dbResult_toJSON($ultimos_dias);
    }
    
    /**
     * Devuelve todas las reservas desde el dia actual en adelante en formato JSON.
     */
    public function ajaxProximasReservas(){
        $proximas_reservas = $this->model->getProximasReservas();
        echo $this->dbResult_toJSON($proximas_reservas);
    }
    
    /**
     * Borra una reserva. Obtiene el ID de la reserva
     * a partir de un parametro GET.
     */
    public function ajaxBorrarReserva(){
        $ids_marcados = $this->input->get('borrar');
        if(count($ids_marcados) == 0){
            die("No hay ni un solo id!");
        }
        
        $success = $this->model->borrarReserva($ids_marcados);
        echo $success;
        
        
    }
    
    /**
     * Devuelve los Strings de los turnos disponibles en el restaurante en formato JSON.
     */
    public function getTurnos(){
        $turnos = $this->model->getTurnos();
        echo $this->dbResult_toJSON($turnos);
    }
    
    /**
     * Convierte a JSON los resultados de un query.
     * @param CI_DB_OBJECT $result
     * @param string $incluirAsunto Parametro que permite aniadir un comentario adicional a alguna columna de la reserva
     * @return json
     */
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
    
    /**
     * Modifica un parametro del fichero de configuracion del sistema de reservas.
     * 
     */
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
    
    /**
     * Devuelve 'mensajes' no vistos por el administrador del restaurante en formato JSON.
     */
    public function ajaxNotificaciones(){
        $no_vistas = $this->model->getReservasNoVistas();
        echo $this->dbResult_toJSON($no_vistas, "Nueva reserva");
    }
    
    /**
     * Marca como vistos los 'mensajes'. Toma los IDs de los mensajes
     * pasado por parametro GET para llevarlo a cabo.
     */
    public function ajaxMarcarComoVisto(){
        $ids_marcados = $this->input->get('marcar');
        if(count($ids_marcados) == 0){
            die("No hay ni un solo id!");
        }
        
        $success = $this->model->marcarComoVisto($ids_marcados);
        echo $success;
        
    }
}
