<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sistema de Programacion Operativa Anual (POA)
 * Modelos / Modelo Areas
 *
 * Acciones para el modulo areas
 *
 * @author Oficina de Desarrollo de Software / Universidad Politecnica de Tlaxcala
 */
class Msubareas extends CI_Model
{   
    /**
     * Actualiza la información de una subarea
     *
     * @param   Int
     * @param   Array
     * @return  Boolean
     */
    public function editar($id, $data)
    {
        $this->db->where('sub_id',(int)$id);
        return $this->db->update('SubAreas',$data);
    }
    // --------------------------------------------------------------------
}
/* Final del archivo Msubareas.php 
 * Ubicacion: ./app_admin/models/Msubareas.php
 */