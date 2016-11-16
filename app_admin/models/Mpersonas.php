<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sistema de Programacion Operativa Anual (POA)
 * Modelos / Modelo personas
 *
 * Acciones para el modulo personas
 *
 * @author Oficina de Desarrollo de Software / Universidad Politecnica de Tlaxcala
 */
class Mpersonas extends CI_Model
{   
    
    protected $sii;
    function __construct()
    {
        parent::__construct();
        $this->sii = $this->load->database('sii', TRUE);
    }

    /**
     * Obtiene un registro especifico
     *
     * @param   Int
     * @return  Object
     */
    public function obtener_refsii($id)
    {
        //$this->db->join('Usuarios','Usuarios.u_id=Unidades.uni_responsable');
        $this->db->where("u_refsii", (int)$id);
        return $this->db->get('Usuarios')->row();
    }
    // --------------------------------------------------------------------
    
    /**
     * Obtiene un usuario encargado de area
     *
     * @param   Int
     * @return  Object
     */
    public function obtener_area($id)
    {
        $this->db->join('Usuarios','Usuarios.u_id=Areas.a_director');
        $this->db->where("Usuarios.u_refsii", (int)$id);
        return $this->db->get('Areas')->row();
    }
    // --------------------------------------------------------------------
    
    /**
     * Obtiene un usuario encargado de una subarea
     *
     * @param   Int
     * @return  Object
     */
    public function obtener_subarea($id)
    {   
        $this->db->join('Colaboradores','Colaboradores.co_subarea=SubAreas.sub_id');
        $this->db->join('Usuarios','Usuarios.u_id=Colaboradores.co_usuario');
        $this->db->where("Usuarios.u_refsii", (int)$id);
        return $this->db->get('SubAreas')->row();
    }
    // --------------------------------------------------------------------
    
    /**
     * Obtiene un usuario encargado de una unidad
     *
     * @param   Int
     * @return  Object
     */
    public function obtener_unidad($id)
    {
        $this->db->join('Usuarios','Usuarios.u_id=Unidades.uni_responsable');
        $this->db->where("Usuarios.u_refsii", (int)$id);
        return $this->db->get('Unidades')->row();
    }
    // --------------------------------------------------------------------

    /**
     * Agrega un nuevo registro en la tabla Usuarios a la base de datos
     *
     * @param   Array
     * @return  Int
     */
    public function agregar($data)
    {
        $this->db->insert('Usuarios',$data);
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
        $this->db->where("u_id",(int)$Id);
        return $this->db->update("Usuarios", $data);
    }
    // --------------------------------------------------------------------
    
    /**
     * Obtiene un registro especifico de usuarios del SII
     *
     * @return  list object
     */
    public function obtener_sii($id)
    {
        $this->sii->select('idpersonas,nombre,apellidopat,apellidomat,password,email');
        $this->sii->where("idpersonas", $id);
        $this->sii->where("admin", 1);
        $this->sii->where("admin_activo", 1);
        return $this->sii->get('persona')->row();
    }
    // --------------------------------------------------------------------
    
    /**
     * Obtiene la lista de usuarios del SII
     *
     * @return  list object
     */
    public function listar_sii()
    {
        $this->sii->select('idpersonas,nombre,apellidopat,apellidomat');
        $this->sii->where("admin", 1);
        $this->sii->where("admin_activo", 1);
        return $this->sii->get('persona')->result();
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
        $this->sii->select('idpersonas,nombre,apellidopat,apellidomat');
        $this->sii->where('idpersonas',(int)$id);
        $num = $this->sii->get('persona')->num_rows();

        return ($num==0);
    }
    // --------------------------------------------------------------------
}
/* Final del archivo Mpersonas.php 
 * Ubicacion: ./app_admin/models/Mpersonas.php
 */