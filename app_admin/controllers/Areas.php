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
        // Validaciones de Formulario
        $this->form_validation->set_rules('nombre', 'Nombre del Área', 'required');
        $this->form_validation->set_rules('unidad', 'Nombre de la Unidad', 'required|callback_validarunidad');
        $this->form_validation->set_rules('director', 'Nombre del Responsable', 'required|callback_validarpersona');

        if( $this->form_validation->run() && $this->input->post() )
        {   
            $director = $this->input->post('director');
            $unidad = $this->input->post('unidad');

            $persona = $this->mpersonas->obtener_sii($director);
            $unidad = $this->munidades->obtener($unidades);

            //Preparamos la información para insertar en la tabla usuarios
            $data_persona = array(
                'u_refsii'      => $persona->idpersonas,
                'u_institucion' => $unidad->uni_institucion,
                'u_nombre'      => $persona->nombre,
                'u_appaterno'   => $persona->apellidopat,
                'u_apmaterno'   => $persona->apellidomat,
                'u_password'    => $persona->password,
                'u_create'      => date('Y:m:d')
                );

            //Agregamos la información en la tabla usuarios
            $idpersona = $this->mpersonas->agregar($data_persona);

            //Preparamos la información para insertar
            $data_areas = array(
                'a_nombre'      => $this->input->post('nombre',TRUE),
                'a_director'    => $idpersona,
                'a_unidad'      => $unidades,
                'a_create'      => date('Y:m:d')
                );

            $this->mareas->agregar($data_areas);
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
        //Validamos id
        if(!$id)
            $this->alerts->_403();
        //Validos la informacion
        if($this->mareas->validar($id))
            $this->alerts->danger('areas',$this->alerts->db_404);

        // Validaciones de Formulario
        $this->form_validation->set_rules('area', 'Nombre del Área', 'required');
        $this->form_validation->set_rules('unidad', 'Nombre de la Unidad', 'required|callback_validarunidad');
        $this->form_validation->set_rules('persona', 'Nombre del Responsable', 'required|callback_validarpersona');

        if( $this->form_validation->run() && $this->input->post() )
        {
            $personas = $this->input->post('persona');

            $unidades = $this->input->post('unidad');

            $persona = $this->mpersonas->obtener($personas);

            $institucion = $this->munidades->obtener($unidades);
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
            $data_area = array(
                'a_nombre'      => $this->input->post('area',TRUE),
                'a_director'    => $idpersona,
                'a_unidad'      => $this->input->post('unidad',TRUE),
                'a_update'      => date('Y:m:d')
                );

            $this->mareas->editar($id, $data_area);
            $this->alerts->success('areas');
        }

        $data['personas']        = $this->mpersonas->listar();

        $data['unidades']   = $this->munidades->listar();

        $data['area']        = $this->mareas->obtener($id);

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
        if($this->mareas->validar($id))
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
}
/* Final del archivo Unidades.php 
 * Ubicacion: ./app_admin/controllers/Unidades.php
 */