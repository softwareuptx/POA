<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sistema de Programacion Operativa Anual (POA)
 * Modelos / Modelo Instituciones
 *
 * Acciones para el modulo Instituciones
 *
 * @author Oficina de Desarrollo de Software / Universidad Politecnica de Tlaxcala
 */
class Minstituciones extends CI_Model
{   
    /**
     * Agrega un nuevo registro a la base de datos
     *
     * @param   Array
     * @return  Boolean
     */
    public function agregar($data)
    {
        return $this->db->insert('Instituciones',$data);
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
        $this->db->where('in_id',(int)$id);
        return $this->db->update('Instituciones',$data);
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
        $this->db->where('in_id',(int)$id);
        $this->db->limit(1);
        return $this->db->get('Instituciones')->row();
    }
    // --------------------------------------------------------------------
    
    /**
     * Obtiene la lista de las instituciones
     *
     * @return  list object
     */
    public function listar()
    {
        return $this->db->get('Instituciones')->result();
    }
    // --------------------------------------------------------------------
    
    /**
     * Valida si existe un registro en la base de datos
     *
     * @param   Int
     * @return  Boolean
     */
    public function validar($id)
    {
        $this->db->where('in_id',(int)$id);
        $num = $this->db->get('Instituciones')->num_rows();

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
        $this->db->where('in_id',(int)$id);
        return $this->db->delete('Instituciones');
    }
    // --------------------------------------------------------------------
}
/* Final del archivo Minstituciones.php 
 * Ubicacion: ./app_admin/models/Minstituciones.php
 */