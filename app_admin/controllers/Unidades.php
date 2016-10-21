<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sistema de Programacion Operativa Anual (POA)
 * Controllers / Modulo Unidades
 *
 * Modulo CRUD para Unidades 
 *
 * @author Oficina de Desarrollo de Software / Universidad Politecnica de Tlaxcala
 */
class Unidades extends CI_Controller
{
    /**
     * Muestra el listado de unidades
     *
     * @return void
     */
    public function index()
    {
        $data['unidades'] = $this->munidades->listar();
        $this->load->view('unidades/listar',$data);
    }
    // --------------------------------------------------------------------
    
    /**
     * Agrega un registro nuevo
     *
     * @return void
     */
    public function agregar()
    {
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
            $this->alerts->success('unidades');
        }

        $this->load->view('unidades/agregar');
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
            $this->alerts->danger('unidades',$this->alerts->db_404);

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
            $this->alerts->success('unidades');
        }

        $data['institucion'] = $this->minstituciones->obtener($id);

        $this->load->view('unidades/editar',$data);
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
            $this->alerts->danger('unidades',$this->alerts->db_404);

        //Validamos si la operacion de realizo con éxito
        if($this->minstituciones->eliminar($id))
        {
            //si se realizo con exito mandamos mensaje satisfactorio
            $this->alerts->success('unidades');
        }
        else
        {
            //Comparamos el codigo de error de la base de datos
            if($this->db->error()['code']==1451)
                $this->alerts->danger('unidades',$this->alerts->db_nodelete);
            else
                $this->alerts->danger('unidades',$this->alerts->db_error);
        }
    }
    // --------------------------------------------------------------------
}
/* Final del archivo Unidades.php 
 * Ubicacion: ./app_admin/controllers/Unidades.php
 */