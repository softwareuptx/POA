<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sistema de Programacion Operativa Anual (POA)
 * Modelos / Modelo Login
 *
 * Tareas necesarias para crear el login y logout del sistema
 *
 * @author Oficina de Desarrollo de Software / Universidad Politecnica de Tlaxcala
 */
class Mlogin extends CI_Model
{
    /**
     * Optiene el usuario de la base de datos y crea la sesion
     *
     * @param   Int
     * @param   Int
     * @param   String
     * @return  void
     */
    public function login($periodo,$numero,$password)
    {
        //Obtenemos el uario de la base de datos local
        $this->db->select('u_id,u_refsii,u_password,u_admin');
        $this->db->where('u_refsii', (int)$numero);
        $this->db->limit(1);
        $usuario = $this->db->get('Usuarios')->row();

        //Validamos usuario
        if(!$usuario)
            $this->alerts->danger('login','Número de SII incorrecto.');

        //Validamos permisos
        if($usuario->u_admin!=1)
            $this->alerts->danger('login','Lo sentimos, no tiene permisos para entrar a esta parte del sistema.');

        //Validamos contraseña
        if ( strcasecmp(md5($password),$usuario->u_password)!=0 )
            $this->alerts->danger('Contraseña incorrecta.','login');

        //Creamos la session de usuario
        $this->crear_sesion($usuario,$periodo);
    }
    // --------------------------------------------------------------------
    
    /**
     * Optiene un usuario en especifico
     *
     * @param   Int
     * @return  Object
     */
    public function getUsuario($usuario_id)
    {
        //Obtenemos el uario de la base de datos local
        $this->db->where('u_id', (int)$usuario_id);
        $this->db->limit(1);
        
        return $this->db->get('Usuarios')->row();
    }
    // --------------------------------------------------------------------
    
    /**
     * Crea la sesion en cookies
     *
     * @param   Object
     * @param   Object
     * @return  void
     */
    private function crear_sesion($usuario,$periodo)
    {

        $session_data = array(
            "logged"    => TRUE,
            "usuario"   => $usuario,
            "periodo"   => $periodo,
            );

        $this->session->set_userdata($session_data);
    }
    // --------------------------------------------------------------------
    
    /**
     * Cerrar la sesion en cookies
     *
     * @return  void
     */
    public function cerrar_sesion()
    {
        $this->session->unset_userdata( array('logged' => '', 'usuario' => '', 'periodo' => '') );
        $this->session->sess_destroy();
        $this->session->sess_regenerate(TRUE);
    }
    // --------------------------------------------------------------------
}
/* Final del archivo Mlogin.php 
 * Ubicacion: ./app_admin/models/Mlogin.php
 */