<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sistema de Programacion Operativa Anual (POA)
 * Modelos / Modelo Partidas
 *
 * Acciones para el modulo Partidas
 *
 * @author Oficina de Desarrollo de Software / Universidad Politecnica de Tlaxcala
 */
class Mpartidas extends CI_Model
{   
    /**
     * Agrega un nuevo registro a la base de datos
     *
     * @param   Array
     * @return  Boolean
     */
    public function agregar($data)
    {
        return $this->db->insert('Partidas',$data);
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
        $this->db->where('pa_id',(int)$id);
        return $this->db->update('Partidas',$data);
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
        $this->db->join('Conceptos','Conceptos.co_id=Partidas.pa_concepto');
        $this->db->where('pa_id',(int)$id);
        $this->db->limit(1);
        return $this->db->get('Partidas')->row();
    }
    // --------------------------------------------------------------------
    
    /**
     * Obtiene la lista
     *
     * @return  list object
     */
    public function listar()
    {
        $this->db->join('Conceptos','Conceptos.co_id=Partidas.pa_concepto');
        return $this->db->get('Partidas')->result();
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
        $this->db->where('pa_id',(int)$id);
        $num = $this->db->get('Partidas')->num_rows();

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
        $this->db->where('pa_id',(int)$id);
        return $this->db->delete('Partidas');
    }
    // --------------------------------------------------------------------
}
/* Final del archivo MPartidas.php 
 * Ubicacion: ./app_admin/models/MPartidas.php
 */