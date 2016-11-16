<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sistema de Programacion Operativa Anual (POA)
 * Controllers / Modulo Areas
 *
 * Modulo CRUD para Areas 
 *
 * @author Oficina de Desarrollo de Software / Universidad Politecnica de Tlaxcala
 */
class Areas extends CI_Controller
{
    /**
     * Muestra el listado de unidades
     *
     * @return void
     */
    public function index()
    {
        $data['areas'] = $this->mareas->listar();
        $data['unidades'] = $this->munidades->listar();
        $this->load->view('areas/listar',$data);
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
        $this->form_validation->set_rules('nombre', 'Nombre del Área', 'required|is_unique[Areas.a_nombre]');
        $this->form_validation->set_rules('unidad', 'Nombre de la Unidad', 'required|callback_validarunidad');
        $this->form_validation->set_rules('director', 'Nombre del Responsable', 'required|callback_validarpersona|callback_validarresponsable');

        if( $this->form_validation->run() && $this->input->post() )
        {   
            $director = $this->input->post('director');
            $unidad = $this->input->post('unidad');

            $unidad = $this->munidades->obtener($unidad);

            if($persona = $this->mpersonas->obtener_refsii($director)){

                $idusuario = $persona->u_id;
            }else{

                $persona = $this->mpersonas->obtener_sii($director);
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
                $idusuario = $this->mpersonas->agregar($data_persona);
            }

            //Preparamos la información para insertar
            $data_area = array(
                'a_nombre'      => $this->input->post('nombre',TRUE),
                'a_director'    => $idusuario,
                'a_unidad'      => $unidad->uni_id,
                'a_create'      => date('Y:m:d')
                );

            $this->mareas->agregar($data_area);
            $this->alerts->success('areas');
        }

        $data['personas'] = $this->mpersonas->listar_sii();
        $data['unidades'] = $this->munidades->listar();
        
        $this->load->view('areas/agregar',$data);
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
        //Validamos conexion al SII
        conexion_sii();
        $this->load->model('mpersonas');
        
        //Validamos id
        if(!$id)
            $this->alerts->_403();
        //Validos la informacion
        if($this->mareas->validar_id($id))
            $this->alerts->danger('areas',$this->alerts->db_404);

        // Validaciones de Formulario
        $this->form_validation->set_rules('nombre', 'Nombre del Área', 'required');
        $this->form_validation->set_rules('unidad', 'Nombre de la Unidad', 'required|callback_validarunidad');
        $this->form_validation->set_rules('responsable', 'Nombre del Responsable', 'required|callback_validarpersona|callback_validares['.$id.']');

        if( $this->form_validation->run() && $this->input->post() )
        {
            $responsable    = $this->input->post('responsable');
            $unidad         = $this->munidades->obtener($this->input->post('unidad'));

            //Si el responsable es diferente isnertammos una nueva persona
            if($this->mareas->obtener($id)->u_refsii!=$responsable)
            {

                if( $persona = $this->mpersonas->obtener_refsii($responsable) )
                {
                    $idpersona = $persona->u_id;
                }
                else
                {
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
            else{

                $idpersona = $this->mpersonas->obtener_refsii($responsable)->u_id;
            }

            $data_area = array(
                'a_nombre'      => $this->input->post('nombre',TRUE),
                'a_director'    => $idpersona,
                'a_unidad'      => $unidad->uni_id,
                'a_update'      => date('Y:m:d')
                );

            $this->mareas->editar($id, $data_area);
            $this->alerts->success('areas');
        }

        $data['personas'] = $this->mpersonas->listar_sii();
        $data['unidades'] = $this->munidades->listar();
        $data['area']     = $this->mareas->obtener($id);

        $this->load->view('areas/editar',$data);
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
        if($this->mareas->validar_id($id))
            $this->alerts->danger('areas',$this->alerts->db_404);

        //Validamos si la operacion de realizo con éxito
        if($this->mareas->eliminar($id))
        {
            //si se realizo con exito mandamos mensaje satisfactorio
            $this->alerts->success('areas');
        }
        else
        {
            //Comparamos el codigo de error de la base de datos
            if($this->db->error()['code']==1451)
                $this->alerts->danger('areas',$this->alerts->db_nodelete);
            else
                $this->alerts->danger('areas',$this->alerts->db_error);
        }
    }
    // --------------------------------------------------------------------
    
    /**
     * Valida la unidad
     *
     * @param   Int
     * @return  boolean
     */
    public function validarunidad($id)
    {
        if($this->munidades->validar_id($id))
        {
            $this->form_validation->set_message('validarunidad', 'Seleccione una unidad valida por favor');
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
    
    /**
     * Valida si la persona ya tiene una unidad a su cargo cuando se esa modificando
     *
     * @param   Int
     * @return  boolean
     */
    public function validares($responsable_id,$area_id)
    {
        if($this->mareas->obtener($area_id)->u_refsii!=$responsable_id)
        {
            if($this->mpersonas->obtener_area($responsable_id))
            {
                $this->form_validation->set_message('validares', 'Esta persona ya tiene una área a su cargo, por favor selecione otro responsable');
                return FALSE;
            }
            return TRUE;
        }
        return TRUE; 
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
        if($this->mpersonas->obtener_area($id))
        {
            $this->form_validation->set_message('validarresponsable', 'Esta persona ya tiene una area a su cargo, por favor selecione otro responsable');
            return FALSE;
        }
        return TRUE; 
    }
    // --------------------------------------------------------------------
}
/* Final del archivo Unidades.php 
 * Ubicacion: ./app_admin/controllers/Unidades.php
 */