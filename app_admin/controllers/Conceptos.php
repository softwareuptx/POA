<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sistema de Programacion Operativa Anual (POA)
 * Controllers / Modulo Conceptos
 *
 * Modulo CRUD para Conceptos 
 *
 * @author Oficina de Desarrollo de Software / Universidad Politecnica de Tlaxcala
 */
class Conceptos extends CI_Controller
{
    /**
     * Muestra el listado
     *
     * @return void
     */
    public function index()
    {
        $data['conceptos'] = $this->mconceptos->listar();
        $data['capitulos'] = $this->mcapitulos->listar();
        $this->load->view('conceptos/listar',$data);
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
        $this->form_validation->set_rules('clave', 'Clave del concepto', 'required|numeric|exact_length[4]|is_unique[Conceptos.co_clave]');
        $this->form_validation->set_rules('descripcion', 'Descripcioón', 'required');
        $this->form_validation->set_rules('capitulo', 'Capitulo', 'required|numeric|callback_validarcapitulo');

        if( $this->form_validation->run() && $this->input->post() )
        {
            //Preparamos la información para insertar
            $data = array(
                'co_clave'          => $this->input->post('clave',TRUE),
                'co_descripcion'    => $this->input->post('descripcion',TRUE),
                'co_capitulo'       => $this->input->post('capitulo',TRUE),
                'co_create'         => date('Y:m:d')
                );

            $this->mconceptos->agregar($data);
            $this->alerts->success('conceptos');
        }

        $data['capitulos'] = $this->mcapitulos->listar();
        $this->load->view('conceptos/agregar',$data);
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
        if($this->mconceptos->validar_id($id))
            $this->alerts->danger('conceptos',$this->alerts->db_404);

        // Validaciones de Formulario
        $this->form_validation->set_rules('clave', 'Clave del concepto', 'required|numeric|exact_length[4]|callback_actualizarclave['.$id.']');
        $this->form_validation->set_rules('descripcion', 'Descripcioón', 'required');
        $this->form_validation->set_rules('capitulo', 'Capitulo', 'required|numeric|callback_validarcapitulo');

        if( $this->form_validation->run() && $this->input->post() )
        {   
            //Preparamos la información para insertar
            $data = array(
                'co_clave'          => $this->input->post('clave',TRUE),
                'co_descripcion'    => $this->input->post('descripcion',TRUE),
                'co_capitulo'       => $this->input->post('capitulo',TRUE),
                );

            $this->mconceptos->editar($id, $data);
            $this->alerts->success('conceptos');
        }

        $data['concepto'] = $this->mconceptos->obtener($id);
        $data['capitulos'] = $this->mcapitulos->listar();
        $this->load->view('conceptos/editar',$data);
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
        if($this->mconceptos->validar_id($id))
            $this->alerts->danger('conceptos',$this->alerts->db_404);

        //Validamos si la operacion de realizo con éxito
        if($this->mconceptos->eliminar($id))
        {
            //si se realizo con exito mandamos mensaje satisfactorio
            $this->alerts->success('conceptos');
        }
        else
        {
            //Comparamos el codigo de error de la base de datos
            if($this->db->error()['code']==1451)
                $this->alerts->danger('conceptos',$this->alerts->db_nodelete);
            else
                $this->alerts->danger('conceptos',$this->alerts->db_error);
        }
    }
    // --------------------------------------------------------------------
    
    /**
     * Valida el capitulo
     *
     * @param   Int
     * @return  boolean
     */
    public function validarcapitulo($id)
    {
        if($this->mcapitulos->validar_id($id))
        {
            $this->form_validation->set_message('validarcapitulo', 'Seleccione un capítulo valido por favor');
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
        //Obtenes el concepto
        $concepto = $this->mconceptos->obtener($id);

        if($concepto->co_clave!=$val && $this->mconceptos->validar_clave($val))
        {
            $this->form_validation->set_message('actualizarclave', 'Clave del concepto ya registrada, escriba otra por favor');
            return FALSE;
        }

        return TRUE;                
    }
    // --------------------------------------------------------------------
}
/* Final del archivo Conceptos.php 
 * Ubicacion: ./app_admin/controllers/Conceptos.php
 */