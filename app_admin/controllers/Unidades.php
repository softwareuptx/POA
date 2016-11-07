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
        $data['instituciones'] = $this->minstituciones->listar();
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
        //Validamos conexion al SII
        conexion_sii();
        $this->load->model('mpersonas');

        // Validaciones de Formulario
        $this->form_validation->set_rules('institucion', 'Nombre de la institución', 'required|callback_validarinstitucion');
        $this->form_validation->set_rules('nombre', 'Unidad', 'required|is_unique[Unidades.uni_nombre]');
        $this->form_validation->set_rules('responsable', 'Responsable', 'required|callback_validarpersona|callback_validarresponsable');

        if( $this->form_validation->run() && $this->input->post() )
        {   
            $responsable = $this->input->post('responsable');

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
                    'u_institucion' => $this->input->post('institucion',TRUE),
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
            $data_unidades = array(
                'uni_institucion' => $this->input->post('institucion',TRUE),
                'uni_nombre'      => $this->input->post('nombre',TRUE),
                'uni_responsable' => $idpersona,
                'uni_create'      => date('Y:m:d')
                );

            $this->munidades->agregar($data_unidades);
            $this->alerts->success('unidades');
        }

        $data['personas']        = $this->mpersonas->listar_sii();
        $data['instituciones']   = $this->minstituciones->listar();
        
        $this->load->view('unidades/agregar',$data);
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
        if($this->munidades->validar_id($id))
            $this->alerts->danger('unidades',$this->alerts->db_404);

        // Validaciones de Formulario
        $this->form_validation->set_rules('institucion', 'Nombre de la institución', 'required|callback_validarinstitucion');
        $this->form_validation->set_rules('nombre', 'Nombre de la Unidad', 'required');
        $this->form_validation->set_rules('responsable', 'Nombre del responsable', 'required|callback_validarpersona|callback_validares['.$id.']');

        if( $this->form_validation->run() && $this->input->post() )
        {   
            $responsable  = $this->input->post('responsable');

            //Si el responsable es diferente isnertammos una nueva persona
            if($this->munidades->obtener($id)->u_refsii!=$responsable){

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
                        'u_institucion' => $this->input->post('institucion',TRUE),
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
                $idpersona = $this->mpersonas->obtener_refsii($responsable)->u_id;     
            }

            $data_unidad = array(
                'uni_institucion' => $this->input->post('institucion',TRUE),
                'uni_nombre'      => $this->input->post('nombre',TRUE),
                'uni_responsable' => $idpersona,
                'uni_update'      => date('Y:m:d')
                );

            $this->munidades->editar($id, $data_unidad);
            $this->alerts->success('unidades');
        }

        $data['personas']       = $this->mpersonas->listar_sii();
        $data['instituciones']  = $this->minstituciones->listar();
        $data['unidad']         = $this->munidades->obtener($id);

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
        if($this->munidades->validar_id($id))
            $this->alerts->danger('unidades',$this->alerts->db_404);

        //Validamos si la operacion de realizo con éxito
        if($this->munidades->eliminar($id))
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
    
    /**
     * Valida si la persona ya tiene una unidad a su cargo
     *
     * @param   Int
     * @return  boolean
     */
    public function validarresponsable($id)
    {
        if($this->mpersonas->obtener_unidad($id))
        {
            $this->form_validation->set_message('validarresponsable', 'Esta persona ya tiene una unidad a su cargo, por favor selecione otro responsable');
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
    public function validares($responsable_id,$unidad_id)
    {
        if($this->munidades->obtener($unidad_id)->u_refsii!=$responsable_id)
        {
            if($this->mpersonas->obtener_unidad($responsable_id))
            {
                $this->form_validation->set_message('validares', 'Esta persona ya tiene una unidad a su cargo, por favor selecione otro responsable');
                return FALSE;
            }
            return TRUE;
        }
        return TRUE; 
    }
    // --------------------------------------------------------------------
    
    /**
     * Valida la institución
     *
     * @param   Int
     * @return  boolean
     */
    public function validarinstitucion($id)
    {
        if($this->minstituciones->validar_id($id))
        {
            $this->form_validation->set_message('validarinstitucion', 'Seleccione una institución valida por favor');
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