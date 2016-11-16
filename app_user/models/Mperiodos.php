<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sistema de Programacion Operativa Anual (POA)
 * Modelos / Modelo periodos
 *
 * Acciones para el modulo periodos
 *
 * @author Oficina de Desarrollo de Software / Universidad Politecnica de Tlaxcala
 */
class Mperiodos extends CI_Model
{   
    
    /**
     * Obtiene un registro en especifico
     *
     * @param   Int
     * @return  Object
     */
    public function obtener($id)
    {
        $this->db->where('p_id',(int)$id);
        $this->db->limit(1);
        return $this->db->get('Periodos')->row();
    }
    // --------------------------------------------------------------------
    
    /**
     * Obtiene el periodo activo registrado
     *
     * @return  object
     */
    public function actual()
    {
        return $this->db->get_where('Periodos',array('p_status'=>1))->row();
    }
    // --------------------------------------------------------------------
    
    /**
     * Obtiene la lista
     *
     * @return  list object
     */
    public function listar()
    {
        return $this->db->get('Periodos')->result();
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
        $this->db->where('p_id',(int)$id);
        $num = $this->db->get('Periodos')->num_rows();

        return ($num==0);
    }
    // --------------------------------------------------------------------
    
    /**
     * Valida si existe un registro en la base de datos deacuerdo al año
     *
     * @param   Int
     * @return  Boolean
     */
    public function validar_anio($anio)
    {
        $this->db->where('p_anio',$anio);
        $num = $this->db->get('Periodos')->num_rows();

        return ($num>0);
    }
    // --------------------------------------------------------------------
}
/* Final del archivo Mperiodos.php 
 * Ubicacion: ./app_admin/models/Mperiodos.php
 */