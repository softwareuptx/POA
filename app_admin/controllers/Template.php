<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sistema de Programacion Operativa Anual (POA)
 * Controllers / Modulo Template
 *
 * Template para todo el sistema
 *
 * @author Oficina de Desarrollo de Software / Universidad Politecnica de Tlaxcala
 */
class Template extends CI_Controller
{
    /**
     * Renderiza la vista template
     *
     * @return  void
     */
    public function index()
    {

        $this->load->view('template');
    }
    // --------------------------------------------------------------------
}
/* Final del archivo Template.php 
 * Ubicacion: ./app_admin/controllers/Template.php
 */