<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sistema de Programacion Operativa Anual (POA)
 * Modulo Rest
 *
 * Modulo API Rest
 *
 * @author Oficina de Desarrollo de Software / Universidad Politecnica de Tlaxcala
 */
class Rest extends CI_Controller {

    /**
     * Renderiza vista de login y crea session de usuario
     *
     * @return  render view
     */
    public function index()
    {
        
    }
    // --------------------------------------------------------------------
    
    /**
     * Obtiene el listado de areas segun la unidad
     *
     * @param   Int
     * @return  render view
     */
    public function getareas($unidad_id)
    {
        if(!$unidad_id)
            $this->alerts->_403();

        $areas = $this->mareas->listar($unidad_id);
        echo json_encode($areas);
    }
    // --------------------------------------------------------------------
    
    /**
     * Muestra el listado de usuarios
     *
     * @param   Int
     * @return  String
     */
    public function getpersonas($area_id=NULL)
    {
        if(!$area_id)
            $this->alerts->_403();

        $personas = $this->mpersonas->listar($area_id);

        echo json_encode($personas);
    }
    // --------------------------------------------------------------------
}
/* Final del archivo Rest.php 
 * Ubicacion: .app_user/application/controllers/Rest.php
 */