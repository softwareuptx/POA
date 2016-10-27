<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sistema de Programacion Operativa Anual (POA)
 * Controllers / Modulo Partidas
 *
 * Modulo CRUD para Partidas 
 *
 * @author Oficina de Desarrollo de Software / Universidad Politecnica de Tlaxcala
 */
class Partidas extends CI_Controller
{
    /**
     * Muestra el listado
     *
     * @return void
     */
    public function index()
    {
        $data['partidas']   = $this->mpartidas->listar();
        $data['conceptos']  = $this->mconceptos->listar();

        //Formateamos el tipode partida
        foreach ($data['partidas'] as $key => $partida) {

         switch ($partida->pa_tipo) {
             case 1:
             $partida->pa_tipo = 'Genérica';
             break;
             case 2:
             $partida->pa_tipo = 'Específica';
             break;
             default:
             $partida->pa_tipo = '--';
             break;
         }
     } 
     $this->load->view('partidas/listar',$data);
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
        $this->form_validation->set_rules('clave', 'Clave del concepto', 'required|numeric|min_length[4]|max_length[4]');
        $this->form_validation->set_rules('descripcion', 'Descripcioón', 'required');
        $this->form_validation->set_rules('tipo', 'Tipo', 'required|numeric|exact_length[1]');
        $this->form_validation->set_rules('concepto', 'Concepto', 'required|numeric');
        $this->form_validation->set_rules('indicador', 'Presupuesto', 'decimal');

        if( $this->form_validation->run() && $this->input->post() )
        {
            //Validos el capitulo
            if($this->mconceptos->validar($this->input->post('concepto',TRUE)))
                $this->alerts->danger('partidas',$this->alerts->db_404);

            //Preparamos la información para insertar
            $data = array(
                'pa_clave'          => $this->input->post('clave',TRUE),
                'pa_descripcion'    => $this->input->post('descripcion',TRUE),
                'pa_tipo'           => $this->input->post('tipo',TRUE),
                'pa_indicador'      => $this->input->post('indicador',TRUE),
                'pa_concepto'       => $this->input->post('concepto',TRUE),
                'pa_create'         => date('Y:m:d')
                );

            $this->mpartidas->agregar($data);
            $this->alerts->success('partidas');
        }

        $data['conceptos']  = $this->mconceptos->listar();
        $this->load->view('partidas/agregar',$data);
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
        if($this->mpartidas->validar($id))
            $this->alerts->danger('partidas',$this->alerts->db_404);

        // Validaciones de Formulario
        $this->form_validation->set_rules('clave', 'Clave del concepto', 'required|numeric|min_length[4]|max_length[4]');
        $this->form_validation->set_rules('descripcion', 'Descripcioón', 'required');
        $this->form_validation->set_rules('tipo', 'Tipo', 'required|numeric|exact_length[1]');
        $this->form_validation->set_rules('concepto', 'Concepto', 'required|numeric');
        $this->form_validation->set_rules('indicador', 'Presupuesto', 'decimal');

        if( $this->form_validation->run() && $this->input->post() )
        {   
            //Validos el capitulo
            if($this->mconceptos->validar($this->input->post('concepto',TRUE)))
                $this->alerts->danger('partidas',$this->alerts->db_404);

            //Preparamos la información para insertar
            $data = array(
                'pa_clave'          => $this->input->post('clave',TRUE),
                'pa_descripcion'    => $this->input->post('descripcion',TRUE),
                'pa_tipo'           => $this->input->post('tipo',TRUE),
                'pa_indicador'      => $this->input->post('indicador',TRUE),
                'pa_concepto'       => $this->input->post('concepto',TRUE),
                );

            $this->mpartidas->editar($id, $data);
            $this->alerts->success('partidas');
        }

        $data['partida']    = $this->mpartidas->obtener($id);
        $data['conceptos']  = $this->mconceptos->listar();
        $this->load->view('partidas/editar',$data);
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
        if($this->mpartidas->validar($id))
            $this->alerts->danger('partidas',$this->alerts->db_404);

        //Validamos si la operacion de realizo con éxito
        if($this->mpartidas->eliminar($id))
        {
            //si se realizo con exito mandamos mensaje satisfactorio
            $this->alerts->success('partidas');
        }
        else
        {
            //Comparamos el codigo de error de la base de datos
            if($this->db->error()['code']==1451)
                $this->alerts->danger('partidas',$this->alerts->db_nodelete);
            else
                $this->alerts->danger('partidas',$this->alerts->db_error);
        }
    }
    // --------------------------------------------------------------------
}
/* Final del archivo Partidas.php 
 * Ubicacion: ./app_admin/controllers/Partidas.php
 */