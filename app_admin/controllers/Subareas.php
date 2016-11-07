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
class subareas extends CI_Controller
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

        //Obtenemos el responsable de la subarea
        foreach ($data['subareas'] as $key => $subarea) {
            $subarea->responsable = $this->mcolaboradores->obtener_responsable($subarea->sub_id);
        }

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
        //Validamos conexion al SII
        conexion_sii();
        $this->load->model('mpersonas');
        
        // Validaciones de Formulario
        $this->form_validation->set_rules('area', 'Nombre del área', 'required|callback_validararea');
        $this->form_validation->set_rules('nombre', 'Nombre de la Subárea', 'required|is_unique[SubAreas.sub_nombre]');
        $this->form_validation->set_rules('responsable', 'Nombre del responsable', 'required|callback_validarpersona|callback_validarresponsable');

        if( $this->form_validation->run() && $this->input->post() )
        {   
            $responsable    = $this->input->post('responsable');
            $area           = $this->mareas->obtener($this->input->post('area'));
            $unidad         = $this->munidades->obtener($area->a_unidad);

            //Si existe el usuario obtenes de la tabla
            if( $persona = $this->mpersonas->obtener_refsii($responsable))
            {
                $idpersona = $persona->u_id;
            }
            else
            {
                //Si no existe el usuario obtenemos del SII e insertamos en la tabla
                $persona = $this->mpersonas->obtener_sii($responsable);
                //Preparamos la información para insertar en la tabla usuarios
                $data_persona = array(
                    'u_refsii'      => $persona->idpersonas,
                    'u_institucion' => $unidad->uni_institucion,
                    'u_nombre'      => $persona->nombre,
                    'u_appaterno'   => $persona->apellidopat,
                    'u_apmaterno'   => $persona->apellidomat,
                    'u_password'    => $persona->password,
                    'u_email'       => $persona->email,
                    'u_create'      => date('Y:m:d')
                    );

                //Agregamos la información en la tabla usuarios
                $idpersona = $this->mpersonas->agregar($data_persona);
            }


            //Preparamos la información para insertar
            $data_subareas = array(
                'sub_nombre'    => $this->input->post('nombre',TRUE),
                'sub_area'      => $this->input->post('area',TRUE),
                'sub_create'    => date('Y:m:d')
                );

            //Agregamos la información en la tabla subareas
            $idsubarea = $this->msubareas->agregar($data_subareas);

            //Preparamos la información para insertar
            $data_colaboradores = array(
                'co_usuario'    => $idpersona,
                'co_subarea'    => $idsubarea,
                'co_responsable'=> 1,
                'co_create'     => date('Y:m:d')
                );

            $this->mcolaboradores->agregar($data_colaboradores);
            $this->alerts->success('subareas');
        }

        $data['personas']  = $this->mpersonas->listar_sii();
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
        if($this->msubareas->validar_id($id))
            $this->alerts->danger('subareas',$this->alerts->db_404);

        // Validaciones de Formulario
        $this->form_validation->set_rules('area', 'Nombre del área', 'required|callback_validararea');
        $this->form_validation->set_rules('nombre', 'Nombre de la Subárea', 'required');
        $this->form_validation->set_rules('persona', 'Nombre del responsable', 'required|callback_validarpersona|callback_validares['.$id.']');

        if( $this->form_validation->run() && $this->input->post() )
        {


            $responsable    = $this->input->post('persona');
            $areas          = $this->mareas->obtener($this->input->post('area'));
            $unidad         = $this->munidades->obtener($areas->a_unidad);

            $colaborador = $this->mcolaboradores->obtener_responsable($id);
            //Si el responsable es diferente isnertammos una nueva persona
            if($colaborador->u_refsii!=$responsable)
            {
                //Si existe el usuario obtenes de la tabla
                if( $persona = $this->mpersonas->obtener_refsii($responsable))
                {
                    $idpersona = $persona->u_id;
                }
                else
                {
                    //Obtenemos al responsable si es diferente
                    $persona = $this->mpersonas->obtener_sii($responsable);

                    //Preparamos la información para insertar en la tabla usuarios
                    $data_persona = array(
                        'u_refsii'      => $persona->idpersonas,
                        'u_institucion' => $unidad->uni_institucion,
                        'u_nombre'      => $persona->nombre,
                        'u_appaterno'   => $persona->apellidopat,
                        'u_apmaterno'   => $persona->apellidomat,
                        'u_email'       => $persona->email,
                        'u_password'    => $persona->password,
                        'u_create'      => date('Y:m:d')
                        );
                    //Agregamos la información en la tabla usuarios
                    $idpersona = $this->mpersonas->agregar($data_persona);
                }

            }
            else
            {
                $idpersona = $colaborador->u_id;
            }

                    //Preparamos la información para insertar
            $data_subarea = array(
                'sub_nombre'    => $this->input->post('nombre',TRUE),
                'sub_area'      => $this->input->post('area',TRUE),
                'sub_update'    => date('Y:m:d')
                );

                    //Agregamos la información en la tabla subareas
            $subareas = $this->msubareas->editar($id, $data_subarea);

                    //Preparamos la información para insertar
            $data_colaboradores = array(
                'co_usuario'    => $idpersona,
                'co_subarea'    => $id,
                'co_responsable'=> 1,
                );

            $this->mcolaboradores->editar($colaborador->u_id, $id, $data_colaboradores);
            $this->alerts->success('subareas');
        }

        $data['personas']       = $this->mpersonas->listar_sii();
        $data['areas']          = $this->mareas->listar();
        $data['subarea']        = $this->msubareas->obtener($id);
        $data['subarea']->responsable = $this->mcolaboradores->obtener_responsable($data['subarea']->sub_id);

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
        if($this->msubareas->validar_id($id))
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
     * Valida si la persona ya tiene una unidad a su cargo
     *
     * @param   Int
     * @return  boolean
     */
    public function validarresponsable($id)
    {
        if($this->mpersonas->obtener_subarea($id))
        {
            $this->form_validation->set_message('validarresponsable', 'Esta persona ya tiene una subarea a su cargo, por favor selecione otro responsable');
            return FALSE;
        }
        return TRUE; 
    }
    // --------------------------------------------------------------------
    
    /**
     * Valida si la persona ya tiene una unidad a su cargo cuando se esa modificando
     *
     * @param   Int
     * @return  boolean
     */
    public function validares($responsable_id,$subarea_id)
    {   
        if($this->mcolaboradores->obtener_responsable($subarea_id)->u_refsii!=$responsable_id)
        {
            if($this->mpersonas->obtener_subarea($responsable_id))
            {
                $this->form_validation->set_message('validares', 'Esta persona ya tiene una subarea a su cargo, por favor selecione otro responsable');
                return FALSE;
            }
            return TRUE;
        }
        return TRUE; 
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
        if($this->mareas->validar_id($id))
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
        if($this->mpersonas->validar_id($id))
        {
            $this->form_validation->set_message('validarpersona', 'Seleccione un usuario valido por favor');
            return FALSE;
        }
        return TRUE; 
    }
    // --------------------------------------------------------------------
}
/* Final del archivo Unidades.php 
 * Ubicacion: ./app_admin/controllers/Unidades.php
 */