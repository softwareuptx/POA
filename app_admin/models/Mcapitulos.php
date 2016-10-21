<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sistema de Programacion Operativa Anual (POA)
 * Modelos / Modelo Capitulos
 *
 * Acciones para el modulo Capitulos
 *
 * @author Oficina de Desarrollo de Software / Universidad Politecnica de Tlaxcala
 */
class Mcapitulos extends CI_Model
{   
    /**
     * Agrega un nuevo registro a la base de datos
     *
     * @param   Array
     * @return  Boolean
     */
    public function agregar($data)
    {
        return $this->db->insert('Capitulos',$data);
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
        $this->db->where('ca_id',(int)$id);
        return $this->db->update('Capitulos',$data);
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
        $this->db->where('ca_id',(int)$id);
        $this->db->limit(1);
        return $this->db->get('Capitulos')->row();
    }
    // --------------------------------------------------------------------
    
    /**
     * Obtiene la lista
     *
     * @return  list object
     */
    public function listar()
    {
        return $this->db->get('Capitulos')->result();
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
        $this->db->where('ca_id',(int)$id);
        $num = $this->db->get('Capitulos')->num_rows();

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
        $this->db->where('ca_id',(int)$id);
        return $this->db->delete('Capitulos');
    }
    // --------------------------------------------------------------------
}
/* Final del archivo Mcapitulos.php 
 * Ubicacion: ./app_admin/models/Mcapitulos.php
 */