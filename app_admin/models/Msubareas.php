<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sistema de Programacion Operativa Anual (POA)
 * Modelos / Modelo unidades
 *
 * Acciones para el modulo subareas
 *
 * @author Oficina de Desarrollo de Software / Universidad Politecnica de Tlaxcala
 */
class Msubareas extends CI_Model
{   

    /**
     * Agrega un nuevo registro a la base de datos
     *
     * @param   Array
     * @return  Int
     */
    public function agregar($data)
    {
        $this->db->insert('SubAreas',$data);
        return $this->db->insert_id();
    }
    // --------------------------------------------------------------------    
    /**
     * Actualiza la información de un determinado registro
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
    
    /**
     * Obtiene un registro en especifico
     *
     * @param   Int
     * @return  Object
     */
    public function obtener($id)
    {
        $this->db->join('Areas','Areas.a_id=SubAreas.sub_area');
        $this->db->where('SubAreas.sub_id',(int)$id);
        return $this->db->get('SubAreas')->row();
    }
    // --------------------------------------------------------------------
    /**
     * Obtiene la lista de las subareas
     *
     * @return  list object
     */
    public function listar()
    {
        $this->db->join('Areas','Areas.a_id=SubAreas.sub_area');
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
        $this->db->where('sub_id',(int)$id);
        $num = $this->db->get('SubAreas')->num_rows();

        return ($num==0);
    }
    // --------------------------------------------------------------------
    
    /**
     * Elimina un registro en especifico
     *
     * @param   Int
     * @return  Boolean
     */
    public function eliminar($id)
    {
        $this->db->where('sub_id',(int)$id);
        return $this->db->delete('SubAreas');
    }
    // --------------------------------------------------------------------
}
/* Final del archivo Munidades.php 
 * Ubicacion: ./app_admin/models/Msubareas.php
 */