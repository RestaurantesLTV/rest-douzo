<?php

//Load dependencies. Necesario para cargar la clase padre "Reserva".
get_instance()->customautoloader->load("Reserva");

/**
 * Reserva mas especifica para restaurantes que hagan reservas a partir
 * diversos turnos diarios.
 * @author unscathed18
 */
class ReservaPorTurnos extends Reserva{
    
    /**
     * Los numeros de turnos deben estar almacenados en algun sitio. Esto cambia segun
     * el restaurante y el numero de turnos que tiene.
     * @var int
     */
    private $turno = -1;
    
    public function __construct($turno, $telefono, $email, $fecha_hora, 
            $numPersonas, $observaciones,$nombre, $apellido){
        parent::__construct();
        
        
        /* Las variables estan limpias y con su formato gracias al trabajo
         * ejercicido por el controlador de tratar de limpiarlas
         * y establecer el formato adecuado.
         */
        $this->turno = $turno;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->fecha_hora = $fecha_hora;
        $this->numPersonas = $numPersonas;
        $this->observaciones = $observaciones;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }
    
    /**
     * Funcion que sirve para debugear el contenido del objeto
     * @return string
     */
    public function dumpObject(){
        $value  = "<p>Turno: ".$this->turno."</p>";
        $value .= "<p>Telefono: ".$this->telefono."</p>";
        $value .= "<p>Email: ".$this->email."</p>";
        $value .= "<p>Fecha: ".$this->fecha->format("Y-m-d H:i:s")."</p>";
        $value .= "<p>Numero de personas: ".$this->numPersonas."</p>";
        $value .= "<p>Observaciones: ".$this->observaciones."</p>";
        return $value;
    }
    
    /**
     * @param int $turno
     */
    public function setTurno($turno){
        $this->turno = $turno;
    }
    
    /**
     * 
     * @return string
     */
    public function getTurno(){
        return $this->turno;
    }
    
    public function __toString() {
        return $this->dumpObject();
    }
}
