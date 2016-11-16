<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sistema de Programacion Operativa Anual (POA)
 * Modelos / Modelo revisiones
 *
 * Acciones para el modulo revisiones
 *
 * @author Oficina de Desarrollo de Software / Universidad Politecnica de Tlaxcala
 */
class Mrevisiones extends CI_Model
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
     * Agrega un nuevo registro a la base de datos
     *
     * @param   Array
     * @return  Boolean
     */
    public function agregar($objetivo, $data)
    {
        return $this->db->insert("Comentarios", $data);
    }
    // --------------------------------------------------------------------
    /**
     * Actualiza la información de un determinado registro
     *
     * @param   Int
     * @param   Array
     * @return  Boolean
     */
    public function editar_objetivo($id, $data)
    {
        $this->db->where("ob_id",(int)$id);
        return $this->db->update("Objetivos", $data);
    }
    // --------------------------------------------------------------------
    /**
     * Actualiza la información de un determinado registro
     *
     * @param   Int
     * @param   Array
     * @return  Boolean
     */
    public function editar_revision($id, $data)
    {
        $this->db->where("rev_objetivo",(int)$id);
        return $this->db->update("Revisiones", $data);
    }
    // --------------------------------------------------------------------
    /**
     * Obtiene el resposable de una subarea
     *
     * @param   Int
     * @return  Object
     */
    public function obtener_responsable($subarea)
    {
        $this->db->join('Usuarios','Usuarios.u_id=Colaboradores.co_usuario');
        $this->db->where('Colaboradores.co_subarea',(int)$subarea);
        $this->db->where('Colaboradores.co_responsable',1);
        return $this->db->get('Colaboradores')->row();
    }
    // --------------------------------------------------------------------
    /**
     * Obtiene la lista de acciones de un objetivo
     *
     * @return  list object
     */
    public function obtener_acciones($objetivo)
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
     * Obtiene las partidas de una accion
     *
     * @return  list object
     */
    public function obtener_partidas($objetivo, $accion)
    {
        $this->db->from('SubAreas');
        $this->db->join('Objetivos','Objetivos.ob_area = SubAreas.sub_id');
        $this->db->join('Metas','Metas.m_objetivo = Objetivos.ob_id');
        $this->db->join('Acciones','Acciones.ac_meta = Metas.m_id');
        $this->db->join('Partidas_Acciones','Partidas_Acciones.pa_accion = Acciones.ac_id');
        $this->db->join('Partidas','Partidas.pa_id = Partidas_Acciones.pa_partida');
        $this->db->where('Metas.m_objetivo', (int)$objetivo);
        $this->db->where('Partidas_Acciones.pa_accion', (int)$accion);
        return $this->db->get()->result();
    }
    // --------------------------------------------------------------------
    /**
     * Obtiene el número de acciones aprobadas de un objetivo
     *
     * @return  list object
     */
    public function obtener_acciones_aprobadas($objetivo)
    {
        $this->db->from('Metas');        
        $this->db->join('Acciones','Acciones.ac_meta = Metas.m_id');
        $this->db->where('Metas.m_objetivo', (int)$objetivo);
        $this->db->where('Acciones.ac_status', 1);
        return $this->db->get()->num_rows();
    }
    // --------------------------------------------------------------------
    /**
     * Obtiene la lista de acciones de un objetivo
     *
     * @return  list object
     */
    public function obtener_mensajes($accion)
    {
        $this->db->from('Revisiones');        
        $this->db->join('Comentarios','Comentarios.com_revision = Revisiones.rev_id');
        $this->db->join('Acciones','Acciones.ac_id = Comentarios.com_accion');
        $this->db->where('Acciones.ac_id', (int)$accion);
        $this->db->order_by("com_fechasys", "desc");
        return $this->db->get();
    }
    // --------------------------------------------------------------------
    /**
     * Obtiene una accion en especifica
     *
     * @param Int
     * @return  Boolean
     */
    public function obtener_accion($accion)
    {
        $this->db->from('SubAreas');
        $this->db->join('Objetivos','Objetivos.ob_area = SubAreas.sub_id');
        $this->db->join('Metas','Metas.m_objetivo = Objetivos.ob_id');
        $this->db->join('Acciones','Acciones.ac_meta = Metas.m_id');
        $this->db->where('Acciones.ac_id', (int)$accion);
        return $this->db->get()->row();
    }
    // --------------------------------------------------------------------
    /**
     * Obtiene un cuatrimestre en especifico relacionado con una acción
     *
     * @param Int
     * @return  list object
     */
    public function obtener_cuatrimestre($cuatrimestre)
    {
        $this->db->where("cu_accion",(int)$cuatrimestre);
        return $this->db->get('Cuatrimestres')->result();
    }
    // --------------------------------------------------------------------
    /**
     * Obtiene los objetivos a revisar
     *
     * @param Int
     * @return  list object
     */
    public function obtener_objetivos($subarea)
    {
        $this->db->from('Objetivos');
        $this->db->join('Revisiones','Revisiones.rev_objetivo = Objetivos.ob_id');
        $this->db->where('Objetivos.ob_area',(int)$subarea);
        $this->db->where('Revisiones.rev_status',0);
        $this->db->where('Revisiones.rev_periodo',1);
        return $this->db->get();
    }
    // -------------------------------------------------------------------- 
    /**
     * Obtiene un objetivo en especifico en la lista de revision
     *
     * @param Int
     * @return  Boolean
     */
    public function obtener_objetivo($objetivo)
    {
        $this->db->from('Objetivos');
        $this->db->join('Revisiones','Revisiones.rev_objetivo = Objetivos.ob_id');
        $this->db->where('Revisiones.rev_objetivo', (int)$objetivo);
        return $this->db->get()->row();
    }
    // --------------------------------------------------------------------   
    /**
     * Obtiene los subtotales de cada cuatrimestre
     *
     * @param Int
     * @return  list object
     */
    public function obtener_subtotal($objetivo)
    {
        $this->db->from('Metas');        
        $this->db->join('Acciones','Acciones.ac_meta = Metas.m_id');
        $this->db->join('Cuatrimestres','Cuatrimestres.cu_accion = Acciones.ac_id');
        $this->db->where('Metas.m_objetivo', (int)$objetivo);
        return $this->db->get()->result();
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
        $this->db->where('Objetivos.ob_status', 0);
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
        $this->db->where('Objetivos.ob_status', 0);
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
        $this->db->where('Objetivos.ob_status', 0);
        return $this->db->get()->row();
    }
    // --------------------------------------------------------------------
    /**
     * Aprueba la acción seleccionada actualizando su status
     *
     * @param   Int
     * @return  Boolean
     */
    public function aprobar($accion)
    {
        return $this->db->update('Acciones', array('ac_status'=>1), array('ac_id'=>$accion));
    }
    // --------------------------------------------------------------------
    /**
     * Desaprueba la acción seleccionada actualizando su status
     *
     * @param   Int
     * @return  Boolean
     */
    public function desaprobar($accion)
    {
        return $this->db->update('Acciones', array('ac_status'=>0), array('ac_id'=>$accion));
    }
    // --------------------------------------------------------------------
}
/* Final del archivo Mrevisiones.php 
 * Ubicacion: ./app_admin/models/Mrevisiones.php
 */