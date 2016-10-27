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

         $partida->pa_indicador = number_format($partida->pa_indicador, 2, '.',',');
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
        $this->form_validation->set_rules('clave', 'Clave del concepto', 'required|numeric|exact_length[4]|is_unique[Partidas.pa_clave]');
        $this->form_validation->set_rules('descripcion', 'Descripcioón', 'required');
        $this->form_validation->set_rules('tipo', 'Tipo', 'required|numeric|exact_length[1]|in_list[1,2]');
        $this->form_validation->set_rules('concepto', 'Concepto', 'required|numeric|callback_validarconcepto');
        $this->form_validation->set_rules('indicador', 'Presupuesto');

        if( $this->form_validation->run() && $this->input->post() )
        {

            //Quitamos signo de pesos y comas
            $indicador = (float)str_replace(array('$','$ ',','),'',$this->input->post('indicador',TRUE));

            //Preparamos la información para insertar
            $data = array(
                'pa_clave'          => $this->input->post('clave',TRUE),
                'pa_descripcion'    => $this->input->post('descripcion',TRUE),
                'pa_tipo'           => $this->input->post('tipo',TRUE),
                'pa_indicador'      => $indicador,
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
        if($this->mpartidas->validar_id($id))
            $this->alerts->danger('partidas',$this->alerts->db_404);

        // Validaciones de Formulario
        $this->form_validation->set_rules('clave', 'Clave del concepto', 'required|numeric|exact_length[4]|callback_actualizarclave['.$id.']');
        $this->form_validation->set_rules('descripcion', 'Descripcioón', 'required');
        $this->form_validation->set_rules('tipo', 'Tipo', 'required|numeric|exact_length[1]|in_list[1,2]');
        $this->form_validation->set_rules('concepto', 'Concepto', 'required|numeric|callback_validarconcepto');
        $this->form_validation->set_rules('indicador', 'Presupuesto');

        if( $this->form_validation->run() && $this->input->post() )
        {   
            //Quitamos signo de pesos y comas
            $indicador = (float)str_replace(array('$','$ ',','),'',$this->input->post('indicador',TRUE));

            //Preparamos la información para insertar
            $data = array(
                'pa_clave'          => $this->input->post('clave',TRUE),
                'pa_descripcion'    => $this->input->post('descripcion',TRUE),
                'pa_tipo'           => $this->input->post('tipo',TRUE),
                'pa_indicador'      => $indicador,
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
        if($this->mpartidas->validar_id($id))
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
    
    /**
     * Valida el concepto
     *
     * @param   Int
     * @return  boolean
     */
    public function validarconcepto($id)
    {
        if($this->mconceptos->validar_id($id))
        {
            $this->form_validation->set_message('validarconcepto', 'Seleccione un concepto valido por favor');
            return FALSE;
        }
        return TRUE; 
    }
    // --------------------------------------------------------------------
    
    /**
     * Validar clave al actualizar registro
     *
     * @param   String
     * @param   Int
     * @return  Boolean
     */
    public function actualizarclave($val, $id)
    {
        //Obtenes el partida
        $partida = $this->mpartidas->obtener($id);

        if($partida->pa_clave!=$val && $this->mpartidas->validar_clave($val))
        {
            $this->form_validation->set_message('actualizarclave', 'Clave de partida ya registrada, escriba otra por favor');
            return FALSE;
        }

        return TRUE;                
    }
    // --------------------------------------------------------------------
}
/* Final del archivo Partidas.php 
 * Ubicacion: ./app_admin/controllers/Partidas.php
 */