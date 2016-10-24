<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sistema de Programacion Operativa Anual (POA)
 * Modelos / Modelo Periodo
 *
 * Lista los periodos registrados
 *
 * @author Oficina de Desarrollo de Software / Universidad Politecnica de Tlaxcala
 */
class Mperiodo extends CI_Model
{
    /**
     * Obtiene el periodo activo registrado
     *
     * @return  object
     */
    public function actual()
    {
        return $this->db->get_where('Periodos',array('p_activo'=>1))->row();
    }
    // --------------------------------------------------------------------
    
    /**
     * Obtiene un perido en espescifico
     *
     * @param   Int
     * @return  object
     */
    public function get($periodo_id)
    {
        return $this->db->get_where('Periodos',array('p_id'=>(int)$periodo_id))->row();
    }
    // --------------------------------------------------------------------
    
    /**
     * Obtiene todos los periodos registrados
     *
     * @return  object list
     */
    public function getlist()
    {    
        return $this->db->get('Periodos')->result();
    }
    // --------------------------------------------------------------------
    
    /**
     * Obtiene un periodo en especifico
     *
     * @param   Int
     * @return  Int
     */
    public function validar($periodo_id)
    {    
        $this->db->where('p_id',(int)$periodo_id);
        $num = $this->db->get('Periodos')->num_rows();

        return ($num==0);
    }
    // --------------------------------------------------------------------
}
/* Final del archivo Mperiodo.php 
 * Ubicacion: ./app_admin/models/Mperiodo.php
 */