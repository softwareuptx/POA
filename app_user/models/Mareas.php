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
class Mareas extends CI_Model
{   
    /**
     * Obtiene un registro en especifico
     *
     * @param   Int
     * @return  Object
     */
    public function obtener($id)
    {
        $this->db->join('Usuarios','Usuarios.u_id=Areas.a_director');
        $this->db->where('a_id',(int)$id);
        return $this->db->get('Areas')->row();
    }
    // --------------------------------------------------------------------
    /**
     * Obtiene la lista de las areas
     *
     * @return  list object
     */
    public function listar($unidad_id)
    {
        $this->db->where('a_unidad',(int)$unidad_id);
        return $this->db->get('Areas')->result();
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
        $this->db->where('a_id',(int)$id);
        $num = $this->db->get('Areas')->num_rows();

        return ($num==0);
    }
    // --------------------------------------------------------------------
}
/* Final del archivo Mareas.php 
 * Ubicacion: ./app_admin/models/Mareas.php
 */