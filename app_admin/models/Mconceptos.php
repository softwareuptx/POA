<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sistema de Programacion Operativa Anual (POA)
 * Modelos / Modelo Capitulos
 *
 * Acciones para el modulo Conceptos
 *
 * @author Oficina de Desarrollo de Software / Universidad Politecnica de Tlaxcala
 */
class Mconceptos extends CI_Model
{   
    /**
     * Agrega un nuevo registro a la base de datos
     *
     * @param   Array
     * @return  Boolean
     */
    public function agregar($data)
    {
        return $this->db->insert('Conceptos',$data);
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
        $this->db->where('co_id',(int)$id);
        return $this->db->update('Conceptos',$data);
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
        $this->db->join('Capitulos','Capitulos.ca_id=Conceptos.co_capitulo');
        $this->db->where('co_id',(int)$id);
        $this->db->limit(1);
        return $this->db->get('Conceptos')->row();
    }
    // --------------------------------------------------------------------
    
    /**
     * Obtiene la lista
     *
     * @return  list object
     */
    public function listar()
    {
        $this->db->join('Capitulos','Capitulos.ca_id=Conceptos.co_capitulo');
        return $this->db->get('Conceptos')->result();
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
        $this->db->where('co_id',(int)$id);
        return $this->db->delete('Conceptos');
    }
    // --------------------------------------------------------------------
    
    /**
     * Valida si existe un registro en la base de datos con un id especifico
     *
     * @param   Int
     * @return  Boolean
     */
    public function validar_id($id)
    {
        $this->db->where('co_id',(int)$id);
        $num = $this->db->get('Conceptos')->num_rows();

        return ($num==0);
    }
    // --------------------------------------------------------------------
}
/* Final del archivo Mconceptos.php 
 * Ubicacion: ./app_admin/models/Mconceptos.php
 */