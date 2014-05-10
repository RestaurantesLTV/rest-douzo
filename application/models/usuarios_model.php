<?php

class Usuarios_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    /**
     *  - Metodo que comprueba si existe un email en la tabla usuario de la BD
     * @param type $email -- email introducido
     * @return boolean -- TRUE si encuentra un email igual al introducido // False sino. TRUE == ERROR
     */
    function check_email($email) {
        $this->db->select('email_user')
                ->where('email_user', $email);
        $consulta = $this->db->get('usuario');
        
        if($consulta -> num_rows() > 0){
            return true; //Si existe el email
        }else{
            return false; // Si no existe
        }
    }

}
