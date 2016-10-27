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
    public function obtener($id)
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
    public function listar()
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
    public function validar($id)
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