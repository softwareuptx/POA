<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sistema de Programacion Operativa Anual (POA)
 * Modelos / Modelo personas
 *
 * Acciones para el modulo personas
 *
 * @author Oficina de Desarrollo de Software / Universidad Politecnica de Tlaxcala
 */
class Mpersonas extends CI_Model
{   
    /**
     * Obtiene los responsalbes de subareas
     *
     * @param   Int
     * @return  Object
     */
    public function listar($area_id)
    {
        $this->db->join('Colaboradores','Colaboradores.co_subarea=SubAreas.sub_id');
        $this->db->join('Usuarios','Usuarios.u_id=Colaboradores.co_usuario');
        $this->db->where("SubAreas.sub_area", (int)$area_id);
        return $this->db->get('SubAreas')->result();
    }
    // --------------------------------------------------------------------
    
    /**
     * Valida si existe un registro en la base de datos
     *
     * @param   Int
     * @return  Boolean
     */
    public function validar_id($id)
    {
        $this->db->where('u_id',(int)$id);
        $num = $this->db->get('Usuarios')->num_rows();

        return ($num==0);
    }
    // --------------------------------------------------------------------
    
}
/* Final del archivo Mpersonas.php 
 * Ubicacion: ./app_user/models/Mpersonas.php
 */