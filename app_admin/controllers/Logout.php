<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sistema de Programacion Operativa Anual (POA)
 * Controllers / Modulo Logout
 *
 * Modulo Logout
 *
 * @author Oficina de Desarrollo de Software / Universidad Politecnica de Tlaxcala
 */
class Logout extends CI_Controller
{
    /**
     * Cierrala session y redirige al inicio
     *
     * @return void
     */
    public function index()
    {
        // Cerramos sesion de usuario
        $this->mlogin->cerrar_sesion();
        redirect();
    }
    // --------------------------------------------------------------------
}
/* Final del archivo Logout.php 
 * Ubicacion: ./app_admin/controllers/Logout.php
 */