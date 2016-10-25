<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sistema de Programacion Operativa Anual (POA)
 * Controllers / Modulo Periodos
 *
 * Modulo CRUD para Periodos 
 *
 * @author Oficina de Desarrollo de Software / Universidad Politecnica de Tlaxcala
 */
class Periodos extends CI_Controller
{
    /**
     * Muestra el listado de periodos
     *
     * @return void
     */
    public function index()
    {
        $data['periodos'] = $this->mperiodos->listar();

        foreach ($data['periodos'] as $key => $periodo){

            $periodo->status = '';

            if($periodo->p_status==1)
            {
                $periodo->status .= "<button type='button' class='btn btn-success btn-xs waves-effect waves-light'>
                <span class='btn-label'>activo</span>";
            }
            else
            {
                $periodo->status .= "<button type='button' class='btn btn-danger btn-xs waves-effect waves-light'>
                <span class='btn-label'>cerrado</span>";
            }

            //Verificamos el periodo en sesion
            if(user()->periodo->p_id==$periodo->p_id)
            {
                $periodo->status .= "<i class='fa fa-eye'></i> EN SESIÓN</button>";
            }else
            {
                $periodo->status .= "</button>";
            }
        }

        $this->load->view('periodos/listar',$data);
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
        $this->form_validation->set_rules('anio', 'Año del periodo', 'required|numeric|exact_length[4]|is_unique[Periodos.p_anio]');
        $this->form_validation->set_rules('descripcion', 'Descripción', 'required');
        $this->form_validation->set_rules('inicio', 'Fecha de inicio', 'required');
        $this->form_validation->set_rules('fin', 'Fecha de fin', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required|exact_length[1]|in_list[1,2]|callback_validaractivo');

        if( $this->form_validation->run() && $this->input->post() )
        {
            //Preparamos la información para insertar
            $data = array(
                'p_anio'           => $this->input->post('anio',TRUE),
                'p_descripcion'    => $this->input->post('descripcion',TRUE),
                'p_inicio'         => $this->input->post('inicio',TRUE),
                'p_fin'            => $this->input->post('fin',TRUE),
                'p_status'         => $this->input->post('status',TRUE),
                'p_create'         => date('Y:m:d')
                );

            $this->mperiodos->agregar($data);
            $this->alerts->success('periodos');
        }

        $this->load->view('periodos/agregar');
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
        if($this->mperiodos->validar_id($id))
            $this->alerts->danger('periodos',$this->alerts->db_404);

        // Validaciones de Formulario
        $this->form_validation->set_rules('anio', 'Año del periodo', 'required|numeric|exact_length[4]');
        $this->form_validation->set_rules('descripcion', 'Descripción', 'required');
        $this->form_validation->set_rules('inicio', 'Fecha de inicio', 'required');
        $this->form_validation->set_rules('fin', 'Fecha de fin', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required|exact_length[1]|in_list[1,2]');

        if( $this->form_validation->run() && $this->input->post() )
        {
            //Preparamos la información para insertar
            $data = array(
                'p_anio'           => $this->input->post('anio',TRUE),
                'p_descripcion'    => $this->input->post('descripcion',TRUE),
                'p_inicio'         => $this->input->post('inicio',TRUE),
                'p_fin'            => $this->input->post('fin',TRUE),
                'p_status'         => $this->input->post('status',TRUE),
                );

            $this->mperiodos->editar($id, $data);
            $this->alerts->success('periodos');
        }

        $data['periodo'] = $this->mperiodos->obtener($id);

        $this->load->view('periodos/editar',$data);
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
        if($this->mperiodos->validar_id($id))
            $this->alerts->danger('periodos',$this->alerts->db_404);

        //Validamos si estw en sesion
        if(user()->periodo->p_id==$id)
            $this->alerts->danger('periodos','Este periodo no se puede eliminar por que esta en sesión');

        //Validamos si la operacion de realizo con éxito
        if($this->mperiodos->eliminar($id))
        {
            //si se realizo con exito mandamos mensaje satisfactorio
            $this->alerts->success('periodos');
        }
        else
        {
            //Comparamos el codigo de error de la base de datos
            if($this->db->error()['code']==1451)
                $this->alerts->danger('periodos',$this->alerts->db_nodelete);
            else
                $this->alerts->danger('periodos',$this->alerts->db_error);
        }
    }
    // --------------------------------------------------------------------
    
    /**
     * Validar el periodo activo
     *
     * @param   Int
     * @return  Void
     */
    public function validaractivo($val)
    {
        if($val==1)
        {
            if($this->mperiodos->actual())
            {  
                $this->form_validation->set_message('validaractivo', 'Ya existe un periodo activo, por favor seleccione como periodo no activo');
                return FALSE;
            }
        }

        return TRUE; 
    }
    // --------------------------------------------------------------------
}
/* Final del archivo Periodos.php 
 * Ubicacion: ./app_admin/controllers/Periodos.php
 */