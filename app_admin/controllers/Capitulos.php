<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sistema de Programacion Operativa Anual (POA)
 * Controllers / Modulo Capitulos
 *
 * Modulo CRUD para Capitulos 
 *
 * @author Oficina de Desarrollo de Software / Universidad Politecnica de Tlaxcala
 */
class Capitulos extends CI_Controller
{
    /**
     * Muestra el listado
     *
     * @return void
     */
    public function index()
    {
        $data['capitulos'] = $this->mcapitulos->listar();
        $this->load->view('capitulos/listar',$data);
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
        $this->form_validation->set_rules('clave', 'Clave del capitulo', 'required|numeric|exact_length[4]|is_unique[Capitulos.ca_clave]');
        $this->form_validation->set_rules('descripcion', 'Descripcioón', 'required');

        if( $this->form_validation->run() && $this->input->post() )
        {
            //Preparamos la información para insertar
            $data = array(
                'ca_clave'          => $this->input->post('clave',TRUE),
                'ca_descripcion'    => $this->input->post('descripcion',TRUE),
                'ca_create'         => date('Y:m:d')
                );

            $this->mcapitulos->agregar($data);
            $this->alerts->success('capitulos');
        }

        $this->load->view('capitulos/agregar');
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
        if($this->mcapitulos->validar_id($id))
            $this->alerts->danger('capitulos',$this->alerts->db_404);

        // Validaciones de Formulario
        $this->form_validation->set_rules('clave', 'Clave del capitulo', 'required|numeric|exact_length[4]|callback_actualizarclave['.$id.']');
        $this->form_validation->set_rules('descripcion', 'Descripcioón', 'required');

        if( $this->form_validation->run() && $this->input->post() )
        {
            //Preparamos la información para insertar
            $data = array(
                'ca_clave'          => $this->input->post('clave',TRUE),
                'ca_descripcion'    => $this->input->post('descripcion',TRUE),
                );

            $this->mcapitulos->editar($id, $data);
            $this->alerts->success('capitulos');
        }

        $data['capitulo'] = $this->mcapitulos->obtener($id);

        $this->load->view('capitulos/editar',$data);
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
        if($this->mcapitulos->validar_id($id))
            $this->alerts->danger('capitulos',$this->alerts->db_404);

        //Validamos si la operacion de realizo con éxito
        if($this->mcapitulos->eliminar($id))
        {
            //si se realizo con exito mandamos mensaje satisfactorio
            $this->alerts->success('capitulos');
        }
        else
        {
            //Comparamos el codigo de error de la base de datos
            if($this->db->error()['code']==1451)
                $this->alerts->danger('capitulos',$this->alerts->db_nodelete);
            else
                $this->alerts->danger('capitulos',$this->alerts->db_error);
        }
    }
    // --------------------------------------------------------------------
    
    /**
     * Validar status al actualizar registro
     *
     * @param   Int
     * @param   Int
     * @return  Boolean
     */
    public function actualizarclave($val, $id)
    {
        //Obtenes el capitulo
        $capitulo = $this->mcapitulos->obtener($id);

        if($capitulo->ca_clave!=$val && $this->mcapitulos->validar_clave($val))
        {
            $this->form_validation->set_message('actualizarclave', 'Clave de capítulo ya registrada, escriba otra por favor');
            return FALSE;
        }

        return TRUE;                
    }
    // --------------------------------------------------------------------
}
/* Final del archivo Capitulos.php 
 * Ubicacion: ./app_admin/controllers/Capitulos.php
 */