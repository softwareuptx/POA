<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sistema de Programacion Operativa Anual (POA)
 * Modelos / Modelo unidades
 *
 * Acciones para el modulo unidades
 *
 * @author Oficina de Desarrollo de Software / Universidad Politecnica de Tlaxcala
 */
class Munidades extends CI_Model
{   
    
    /**
     * Obtiene un registro en especifico
     *
     * @param   Int
     * @return  Object
     */
    public function obtener($id)
    {
        $this->db->join('Usuarios','Usuarios.u_id=Unidades.uni_responsable');
        $this->db->where('uni_id',(int)$id);
        return $this->db->get('Unidades')->row();
    }
    // --------------------------------------------------------------------
    
    /**
     * Obtiene la lista de las unidades
     *
     * @return  list object
     */
    public function listar()
    {
        $this->db->join('Instituciones','Instituciones.in_id=Unidades.uni_institucion');
        $this->db->join('Usuarios','Usuarios.u_id=Unidades.uni_responsable');
        return $this->db->get('Unidades')->result();
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
        $this->db->where('uni_id',(int)$id);
        $num = $this->db->get('Unidades')->num_rows();

        return ($num==0);
    }
    // --------------------------------------------------------------------
}
/* Final del archivo Munidades.php 
 * Ubicacion: ./app_user/models/Munidades.php
 */