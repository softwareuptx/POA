<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sistema de Programacion Operativa Anual (POA)
 * Controllers / Modulo Subareas
 *
 * Modulo CRUD para Subareas 
 *
 * @author Oficina de Desarrollo de Software / Universidad Politecnica de Tlaxcala
 */
class Subareas extends CI_Controller
{
    /**
     * Muestra el listado de unidades
     *
     * @return void
     */
    public function index()
    {
        $data['areas'] = $this->mareas->listar();
        $data['subareas'] = $this->msubareas->listar();
        $this->load->view('subareas/listar',$data);
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
        $this->form_validation->set_rules('area', 'Nombre del área', 'required|callback_validararea');
        $this->form_validation->set_rules('subarea', 'Nombre de la Subárea', 'required');
        $this->form_validation->set_rules('persona', 'Nombre del responsable', 'required|callback_validarpersona');
        $this->form_validation->set_rules('colaborador', 'Colaborador', 'required|numeric|exact_length[1]|in_list[1,2]');

        if( $this->form_validation->run() && $this->input->post() )
        {   
            $personas = $this->input->post('persona');

            $area = $this->input->post('area');

            $areas = $this->mareas->obtener($area);

            $institucion = $this->munidades->obtener($areas->a_unidad);

            $persona = $this->mpersonas->obtener($personas);

            //Preparamos la información para insertar en la tabla usuarios
            $data_persona = array(
                'u_refsii'      => $persona->idpersonas,
                'u_institucion' => $institucion->uni_institucion,
                'u_nombre'      => $persona->nombre,
                'u_appaterno'   => $persona->apellidopat,
                'u_apmaterno'   => $persona->apellidomat,
                'u_password'    => $persona->password,
                'u_create'      => date('Y:m:d')
                );

            //Agregamos la información en la tabla usuarios
            $idpersona = $this->mpersonas->agregar($data_persona);

            //Preparamos la información para insertar
            $data_subareas = array(
                'sub_nombre'    => $this->input->post('subarea',TRUE),
                'sub_area'      => $this->input->post('area',TRUE),
                'sub_create'    => date('Y:m:d')
                );

            //Agregamos la información en la tabla subareas
            $idsubarea = $this->msubareas->agregar($data_subareas);

            //Preparamos la información para insertar
            $data_colaboradores = array(
                'co_usuario'    => $idpersona,
                'co_subarea'    => $idsubarea,
                'co_responsable'=> $this->input->post('colaborador',TRUE),
                'co_create'     => date('Y:m:d')
                );

            $this->mcolaboradores->agregar($data_colaboradores);
            $this->alerts->success('subareas');
        }

        $data['personas']  = $this->mpersonas->listar();

        $data['areas']     = $this->mareas->listar();
        
        $this->load->view('subareas/agregar',$data);
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
        if($this->msubareas->validar($id))
            $this->alerts->danger('subareas',$this->alerts->db_404);

        // Validaciones de Formulario
        $this->form_validation->set_rules('area', 'Nombre del área', 'required|callback_validararea');
        $this->form_validation->set_rules('subarea', 'Nombre de la Subárea', 'required');
        $this->form_validation->set_rules('persona', 'Nombre del responsable', 'required');
        $this->form_validation->set_rules('colaborador', 'Colaborador', 'required|numeric|exact_length[1]|in_list[1,2]');

        if( $this->form_validation->run() && $this->input->post() )
        {
            
           
            $personas = $this->input->post('persona');

            $area = $this->input->post('area');

            $areas = $this->mareas->obtener($area);

            $institucion = $this->munidades->obtener($areas->a_unidad);

            $persona = $this->mpersonas->obtener($personas);

                    //Preparamos la información para insertar en la tabla usuarios
            $data_persona = array(
                'u_refsii'      => $persona->idpersonas,
                'u_institucion' => $institucion->uni_institucion,
                'u_nombre'      => $persona->nombre,
                'u_appaterno'   => $persona->apellidopat,
                'u_apmaterno'   => $persona->apellidomat,
                'u_password'    => $persona->password,
                'u_create'      => date('Y:m:d')
                );

                    //Agregamos la información en la tabla usuarios
            $idpersona = $this->mpersonas->agregar($data_persona);

                    //Preparamos la información para insertar
            $data_subareas = array(
                'sub_nombre'    => $this->input->post('subarea',TRUE),
                'sub_area'      => $this->input->post('area',TRUE),
                'sub_update'    => date('Y:m:d')
                );

                    //Agregamos la información en la tabla subareas
            $subareas = $this->msubareas->editar($id, $data_subareas);

                    //Preparamos la información para insertar
            $data_colaboradores = array(
                'co_usuario'    => $idpersona,
                'co_subarea'    => $id,
                'co_responsable'=> $this->input->post('colaborador',TRUE),
                'co_create'     => date('Y:m:d')
                );

            $this->mcolaboradores->editar($personas, $id, $data_colaboradores);
            $this->alerts->success('subareas');
            
            
        }

        $data['personas']       = $this->mpersonas->listar();

        $data['colaboradores']  = $this->mcolaboradores->obtener($id);

        $data['areas']          = $this->mareas->listar();

        $data['subarea']        = $this->msubareas->obtener($id);

        $this->load->view('subareas/editar',$data);
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
        if($this->msubareas->validar($id))
            $this->alerts->danger('subareas',$this->alerts->db_404);

        //Validamos si la operacion de realizo con éxito
        if($this->msubareas->eliminar($id))
        {
            //si se realizo con exito mandamos mensaje satisfactorio
            $this->alerts->success('subareas');
        }
        else
        {
            //Comparamos el codigo de error de la base de datos
            if($this->db->error()['code']==1451)
                $this->alerts->danger('subareas',$this->alerts->db_nodelete);
            else
                $this->alerts->danger('subareas',$this->alerts->db_error);
        }
    }
    // --------------------------------------------------------------------
    /**
     * Valida la unidad
     *
     * @param   Int
     * @return  boolean
     */
    public function validararea($id)
    {
        if($this->mareas->validar($id))
        {
            $this->form_validation->set_message('validararea', 'Seleccione una área valida por favor');
            return FALSE;
        }
        return TRUE; 
    }
    // --------------------------------------------------------------------
    /**
     * Valida la persona
     *
     * @param   Int
     * @return  boolean
     */
    public function validarpersona($id)
    {
        if($this->mpersonas->validar($id))
        {
            $this->form_validation->set_message('validarpersona', 'Seleccione un usuario valido por favor');
            return FALSE;
        }
        return TRUE; 
    }
    // --------------------------------------------------------------------
}
/* Final del archivo Subareas.php 
 * Ubicacion: ./app_admin/controllers/Subareas.php
 */