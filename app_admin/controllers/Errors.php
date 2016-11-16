<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sistema de Programacion Operativa Anual (POA)
 * Controllers / Modulo Errors
 *
 * Modulo de Errores
 *
 * @author Oficina de Desarrollo de Software / Universidad Politecnica de Tlaxcala
 */
class Errors extends CI_Controller
{
    /**
     * Muestra el error principal
     *
     * @return void
     */
    public function index()
    {

    }
    // --------------------------------------------------------------------
    
    /**
     * Muestra el error de base de datos del sii
     *
     * @return void
     */
    public function db_sii()
    {
        $this->alerts->_500('ERROR AL CONECTAR AL SII','ESTE MODULO DEL SISTEMA REQUIERE UNA CONEXIÓN CON LA BASE DE DATOS DEL SII, POR FAVOR INTENTELO MAS TARDE O CONSULTE AL ADMINISTRADOR DEL SISTEMA.',base_url());
    }
    // --------------------------------------------------------------------
}
/* Final del archivo Errors.php 
 * Ubicacion: ./app_admin/controllers/Errors.php
 */