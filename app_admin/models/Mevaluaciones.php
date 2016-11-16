<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sistema de Programacion Operativa Anual (POA)
 * Modelos / Modelo evaluaciones
 *
 * Acciones para el modulo evaluaciones
 *
 * @author Oficina de Desarrollo de Software / Universidad Politecnica de Tlaxcala
 */
class Mevaluaciones extends CI_Model
{   
      
    /**
     * Obtiene la lista de revisiones
     *
     * @return  list object
     */
    public function listar()
    {
        return $this->db->get('SubAreas')->result();
    }
    // --------------------------------------------------------------------
    /**
     * Obtiene el resposable de una subarea
     *
     * @param   Int
     * @return  Object
     */
    public function obtener_responsable($id)
    {
        $this->db->join('Usuarios','Usuarios.u_id=Colaboradores.co_usuario');
        $this->db->where('Colaboradores.co_subarea',(int)$id);
        $this->db->where('Colaboradores.co_responsable',1);
        return $this->db->get('Colaboradores')->row();
    }
    // --------------------------------------------------------------------
    /**
     * Actualiza un registro de la tabla acciones a la base de datos
     *
     * @param   Array
     * @return  Boolean
     */
    public function evaluar($accion, $data)
    {
        $this->db->where("ac_id",(int)$accion);
        return $this->db->update("Acciones", $data);
    }
    // --------------------------------------------------------------------
    /**
     * Obtiene el número de acciones de un objetivo
     *
     * @return  list object
     */
    public function obtener_acciones($objetivo)
    {
        $this->db->from('Metas');        
        $this->db->join('Acciones','Acciones.ac_meta = Metas.m_id');
        $this->db->where('Metas.m_objetivo', (int)$objetivo);
        return $this->db->get();
    }
    // --------------------------------------------------------------------
    /**
     * Obtiene el número de acciones que no aplican
     *
     * @return  list object
     */
    public function obtener_acciones_na($objetivo)
    {
        $this->db->from('Metas');        
        $this->db->join('Acciones','Acciones.ac_meta = Metas.m_id');
        $this->db->where('Acciones.ac_evaluacion', 2);
        $this->db->where('Metas.m_objetivo', (int)$objetivo);
        return $this->db->get()->num_rows();
    }
    // --------------------------------------------------------------------
    /**
     * Lista las acciones de un objetivo
     *
     * @param Int
     * @return  Boolean
     */
    public function listar_acciones($objetivo)
    {
        $this->db->from('SubAreas');
        $this->db->join('Objetivos','Objetivos.ob_area = SubAreas.sub_id');
        $this->db->join('Metas','Metas.m_objetivo = Objetivos.ob_id');
        $this->db->join('Acciones','Acciones.ac_meta = Metas.m_id');
        $this->db->where('Metas.m_objetivo', (int)$objetivo);
        return $this->db->get();
    }
    // --------------------------------------------------------------------
    /**
     * Obtiene los objetivos aprobados
     *
     * @param Int
     * @return  list object
     */
    public function obtener_objetivos($subarea)
    {
        $this->db->from('Objetivos');
        $this->db->where('Objetivos.ob_area',(int)$subarea);
        $this->db->where('Objetivos.ob_status',1);
        return $this->db->get();
    }
    // --------------------------------------------------------------------   
    /**
     * Valida si existe un registro en la base de datos
     *
     * @param   Int
     * @return  Boolean
     */
    public function validar_subarea($subarea)
    {
        $this->db->from('SubAreas');
        $this->db->join('Objetivos', 'Objetivos.ob_area = SubAreas.sub_id');
        $this->db->where('Objetivos.ob_area', (int)$subarea);
        $this->db->where('Objetivos.ob_status', 1);
        return $this->db->get()->row();
    }
    // --------------------------------------------------------------------
    /**
     * Valida si existe un registro en la base de datos
     *
     * @param   Int
     * @return  Boolean
     */
    public function validar_objetivo($objetivo, $subarea)
    {
        $this->db->from('SubAreas');
        $this->db->join('Objetivos', 'Objetivos.ob_area = SubAreas.sub_id');
        $this->db->where('Objetivos.ob_id', (int)$objetivo);
        $this->db->where('SubAreas.sub_id', (int)$subarea);
        $this->db->where('Objetivos.ob_status', 1);
        return $this->db->get()->row();
    }
    // --------------------------------------------------------------------
    /**
     * Valida si existe un registro en la base de datos
     *
     * @param   Int
     * @return  Boolean
     */
    public function validar_accion($accion, $objetivo, $subarea)
    {
        $this->db->from('SubAreas');
        $this->db->join('Objetivos', 'Objetivos.ob_area = SubAreas.sub_id');
        $this->db->join('Metas','Metas.m_objetivo = Objetivos.ob_id');
        $this->db->join('Acciones', 'Acciones.ac_meta = Metas.m_id');
        $this->db->where('Acciones.ac_id', (int)$accion);
        $this->db->where('Objetivos.ob_id', (int)$objetivo);
        $this->db->where('SubAreas.sub_id', (int)$subarea);
        $this->db->where('Objetivos.ob_status', 1);
        return $this->db->get()->row();
    }
    // --------------------------------------------------------------------
}
/* Final del archivo Mevaluaciones.php 
 * Ubicacion: ./app_admin/models/Mevaluaciones.php
 */