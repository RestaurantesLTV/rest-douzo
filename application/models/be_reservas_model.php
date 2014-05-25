<?php

/**
 * Description of be_reservas_model
 *
 * @author unscathed18
 */
class be_reservas_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    
    /**
     * Devuelve las reservas que son nuevas y el administrador no ha visto hasta la fecha.
     * @return QueryResult
     */
    public function getReservasNoVistas(){
        $query = "SELECT * FROM reserva WHERE checked_by_admin = 0";
        $resultados = $this->db->query($query);
        return $resultados;
    }
    
    public function getReservasNoVerificadas(){
        $query = "SELECT * FROM reserva WHERE fecha_reservada >= DATE(NOW()) AND verificado = 0 ORDER BY fecha_reservada ASC";
        $resultados = $this->db->query($query);
        return $resultados;
    }
    
    public function getProximasReservas(){
        $query = "SELECT * FROM reserva WHERE fecha_reservada >= DATE(NOW()) ";
        $resultados = $this->db->query($query);
        return $resultados;
    }
    
    public function getReservasDeHoy(){
        return $this->getReservasPorFecha(new DateTime());
    }
    
    public function getTurnos(){
        $query = "SELECT * FROM turno";
        $resultados = $this->db->query($query);
        return $resultados;
    }
    
    /**
     * 
     * @param DateTime $d Fecha especifica
     * @return QueryResult
     */
    public function getReservasPorFecha(DateTime $d){
        $fecha = $d->format('Y-m-d');
        $query = "SELECT * FROM reserva WHERE fecha_reservada = {$fecha}";
        $resultados = $this->db->query($query);
        return $resultados;
    }
    
    
    
    public function getReservasUltimos7Dias(){
        //MySQL: La funcion "NOW", devuelve la fecha y el tiempo actual.
        //MySQL: La funcion "DATE", devuelve la fecha sin el tiempo.
        $query = "SELECT * FROM reserva WHERE fecha_reservada BETWEEN DATE(NOW()) AND date_add(DATE(NOW()), INTERVAL 7 DAY)";
        $resultados = $this->db->query($query);
        return $resultados;
    }
    
    /**
     * 
     * @param int $desde_index
     * @param int $reservas_por_pag
     * @param boolean $orderByDesc
     * @return QueryResult
     */
    public function getReservasCompletadas($desde_index=0, $reservas_por_pag = 10, $orderByDesc = true){
        //en MYSQL, la primera row es 0.
        $ayer = new DateTime(); // Se inicializa un objeto 'Fecha_tiempo' como fecha la de hoy.
        $ayer->sub(new DateInterval('P1D')); // Restamos un dia (Dia de ayer)
        $ayer = $ayer->format("Y-m-d"); // Obtenemos un String igual al formato de fechas de MYSQL.
        
        
        $orden = ($orderByDesc == true) ? "DESC" : "ASC";
        
        $query = "SELECT * FROM reserva WHERE fecha_reservada <= '{$ayer}' ORDER BY fecha_reservada {$orden}  LIMIT {$desde_index}, {$reservas_por_pag}";
        $resultados = $this->db->query($query);
        return $resultados;
    }
    
    public function getTodasLasReservas(){
        $query = "SELECT * FROM reserva";
        $resultados = $this->db->query($query);
        return $resultados;
    }
    
    public function marcarComoVisto($ids){
        $where_string = "WHERE id IN(";
        $length = count($ids);
        
        foreach($ids as $index => $id){
            $where_string = $where_string .$id;
            if($index+1 != $length){
                $where_string .= ",";
            }else{
                $where_string .= ")";
            }
        }
        
        $query = "UPDATE reserva SET checked_by_admin = 1 ".$where_string;
        $this->db->query($query);
        
        
        if($this->db->affected_rows() <= 0){
            return false;
        }
        
        return true;
        
    }
    
    
}
