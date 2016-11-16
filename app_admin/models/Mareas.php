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
     * Agrega un nuevo registro a la base de datos
     *
     * @param   Array
     * @return  Boolean
     */
    public function agregar($data)
    {
        return $this->db->insert('Areas',$data);
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
        $this->db->where('a_id',(int)$id);
        return $this->db->update('Areas',$data);
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
    public function listar()
    {
        $this->db->join('Instituciones','Instituciones.in_id=Unidades.uni_institucion');
        $this->db->join('Areas','Areas.a_unidad=Unidades.uni_id');
        $this->db->join('Usuarios','Usuarios.u_id=Areas.a_director');
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
        $this->db->where('a_id',(int)$id);
        $num = $this->db->get('Areas')->num_rows();

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
        $this->db->where('a_id',(int)$id);
        return $this->db->delete('Areas');
    }
    // --------------------------------------------------------------------
}
/* Final del archivo Mareas.php 
 * Ubicacion: ./app_admin/models/Mareas.php
 */