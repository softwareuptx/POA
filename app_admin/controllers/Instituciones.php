<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sistema de Programacion Operativa Anual (POA)
 * Controllers / Modulo Instituciones
 *
 * Modulo CRUD para Instituciones 
 *
 * @author Oficina de Desarrollo de Software / Universidad Politecnica de Tlaxcala
 */
class Instituciones extends CI_Controller
{
    /**
     * Muestra el listado de instituciones
     *
     * @return void
     */
    public function index()
    {
        $data['instituciones'] = $this->minstituciones->listar();
        $data['instituciones_num'] = $this->minstituciones->listar_num();
        $this->load->view('instituciones/listar',$data);
    }
    // --------------------------------------------------------------------
    
    /**
     * Agrega un registro nuevo
     *
     * @return void
     */
    public function agregar()
    {
        if($this->minstituciones->listar_num()>0)
            $this->alerts->danger('instituciones','Ya se agrego una institución');

        // Validaciones de Formulario
        $this->form_validation->set_rules('nombre', 'Nombre de la institución', 'required');
        $this->form_validation->set_rules('vision', 'Visión', 'required');
        $this->form_validation->set_rules('mision', 'Misión', 'required');
        $this->form_validation->set_rules('politicas', 'Políticas', 'required');

        if( $this->form_validation->run() && $this->input->post() )
        {
            //Preparamos la información para insertar
            $data = array(
                'in_nombre'     => $this->input->post('nombre',TRUE),
                'in_vision'     => $this->input->post('vision',TRUE),
                'in_mision'     => $this->input->post('mision',TRUE),
                'in_politicas'  => $this->input->post('politicas',TRUE),
                'in_pagina'     => $this->input->post('pagina',TRUE),
                'in_telefono'   => $this->input->post('telefono',TRUE),
                'in_direccion'  => $this->input->post('direccion',TRUE),
                'in_create'     => date('Y:m:d')
                );

            $this->minstituciones->agregar($data);
            $this->alerts->success('instituciones');
        }

        $this->load->view('instituciones/agregar');
    }
    // --------------------------------------------------------------------
    
    /**
     * Edita un registro
     *
     * @param   Int
     * @return  void
     */
    public function editar($id=NULL)
    {
        //Validamos id
        if(!$id)
            $this->alerts->_403();
        //Validos la informacion
        if($this->minstituciones->validar($id))
            $this->alerts->danger('instituciones',$this->alerts->db_404);

        // Validaciones de Formulario
        $this->form_validation->set_rules('nombre', 'Nombre de la institución', 'required');
        $this->form_validation->set_rules('vision', 'Visión', 'required');
        $this->form_validation->set_rules('mision', 'Misión', 'required');
        $this->form_validation->set_rules('politicas', 'Políticas', 'required');

        if( $this->form_validation->run() && $this->input->post() )
        {
            //Preparamos la información para insertar
            $data = array(
                'in_nombre'     => $this->input->post('nombre',TRUE),
                'in_vision'     => $this->input->post('vision',TRUE),
                'in_mision'     => $this->input->post('mision',TRUE),
                'in_politicas'  => $this->input->post('politicas',TRUE),
                'in_pagina'     => $this->input->post('pagina',TRUE),
                'in_telefono'   => $this->input->post('telefono',TRUE),
                'in_direccion'  => $this->input->post('direccion',TRUE),
                'in_update'     => date('Y:m:d')
                );

            $this->minstituciones->editar($id, $data);
            $this->alerts->success('instituciones');
        }

        $data['institucion'] = $this->minstituciones->obtener($id);

        $this->load->view('instituciones/editar',$data);
    }
    // --------------------------------------------------------------------
    
    /**
     * Elimina un registro
     *
     * @param   Int
     * @return  Void
     */
    public function eliminar($id=NULL)
    {
        //Validamos id
        if(!$id)
            $this->alerts->_403();
        //Validos la informacion
        if($this->minstituciones->validar($id))
            $this->alerts->danger('instituciones',$this->alerts->db_404);

        //Validamos si la operacion de realizo con éxito
        if($this->minstituciones->eliminar($id))
        {
            //si se realizo con exito mandamos mensaje satisfactorio
            $this->alerts->success('instituciones');
        }
        else
        {
            //Comparamos el codigo de error de la base de datos
            if($this->db->error()['code']==1451)
                $this->alerts->danger('instituciones',$this->alerts->db_nodelete);
            else
                $this->alerts->danger('instituciones',$this->alerts->db_error);
        }
    }
    // --------------------------------------------------------------------
}
/* Final del archivo Instituciones.php 
 * Ubicacion: ./app_admin/controllers/Instituciones.php
 */