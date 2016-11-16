<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sistema de Programacion Operativa Anual (POA)
 * Modulo Area
 *
 * Modulo de cuenta para ejecutor poa
 *
 * @author Oficina de Desarrollo de Software / Universidad Politecnica de Tlaxcala
 */
class Area extends CI_Controller {
    /**
     * Muestra la informacion del area
     *
     * @return  render view
     */
    public function index()
    {
        // Validaciones de Formulario
        $this->form_validation->set_rules('mision', 'Misión', 'required');
        $this->form_validation->set_rules('funcion', 'Función', 'required');
        $this->form_validation->set_rules('vision', 'Visión', 'required');
        $this->form_validation->set_rules('autoevaluacion', 'Autoevaluación', 'required');

        $this->form_validation->set_rules('fortalezas', 'Fortalezas', 'required');
        $this->form_validation->set_rules('debilidades', 'Debilidades', 'required');
        $this->form_validation->set_rules('oportunidades', 'Oportunidades', 'required');
        $this->form_validation->set_rules('amenazas', 'Amenazas', 'required');

        $this->form_validation->set_rules('oestatal', 'Objetivos del Plan', 'required');
        $this->form_validation->set_rules('opid', 'Objetivos del PID', 'required');

        if( $this->form_validation->run() && $this->input->post() )
        {
            //Preparamos la información para insertar
            $data_subarea = array(
                'sub_mision'            => $this->input->post('mision'),
                'sub_vision'            => $this->input->post('vision'),
                'sub_funcion'           => $this->input->post('funcion'),
                'sub_autoevaluacion'    => $this->input->post('autoevaluacion'),
                'sub_oestatal'          => $this->input->post('oestatal'),
                'sub_opid'              => $this->input->post('opid'),
                'sub_fortalezas'        => $this->input->post('fortalezas'),
                'sub_debilidades'       => $this->input->post('debilidades'),
                'sub_oportunidades'     => $this->input->post('oportunidades'),
                'sub_amenazas'          => $this->input->post('amenazas'),
                'sub_update'            => date('Y:m:d')
                );

            $this->msubareas->editar(user()->sub_id,$data_subarea);
            $this->alerts->success('area');
        }

        $this->load->view('area/informacion');
    }
    // --------------------------------------------------------------------
}
/* Final del archivo Area.php 
 * Ubicacion: .app_user/application/controllers/Area.php
 */