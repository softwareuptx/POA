<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sistema de Programacion Operativa Anual (POA)
 * Modulo Objetivos
 *
 * Modulo de cuenta para ejecutor poa
 *
 * @author Oficina de Desarrollo de Software / Universidad Politecnica de Tlaxcala
 */
class Objetivos extends CI_Controller {
    /**
     * Muestra una lista de los objetivos y los detalles de la cuenta
     *
     * @return  render view
     */
    public function index()
    {
        $this->load->view('objetivos/listar');
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
        $this->form_validation->set_rules('descripcion', 'Descripcion del objetivo', 'required');

        if( $this->form_validation->run() && $this->input->post() )
        {   
            $descripcion = $this->input->post('descripcion');

            //Preparamos la información para insertar
            $data_objetivo = array(
                'ob_descripcion'    => $descripcion,
                'ob_area'           => user()->sub_id,
                'ob_status'         => 1,
                'ob_create'          => date('Y:m:d')
                );

            $this->mobjetivos->agregar($data_objetivo);
            $this->alerts->success('cuenta');
        }

        $this->load->view('objetivos/agregar');
    }
    // --------------------------------------------------------------------
}
/* Final del archivo Objetivos.php 
 * Ubicacion: .app_user/application/controllers/Objetivos.php
 */