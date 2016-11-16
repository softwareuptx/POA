<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sistema de Programacion Operativa Anual (POA)
 * Modulo Login
 *
 * Modulo de sessiones para el sistema
 *
 * @author Oficina de Desarrollo de Software / Universidad Politecnica de Tlaxcala
 */
class Login extends CI_Controller {
    /**
     * Renderiza vista de login y crea session de usuario
     *
     * @return  render view
     */
    public function index()
    {
        // Validaciones de Formulario
        $this->form_validation->set_rules('periodo', 'Año', 'required|numeric|callback_validarperiodo');
        $this->form_validation->set_rules('unidad', 'Unidad', 'required|numeric|callback_validarunidad');
        $this->form_validation->set_rules('area', 'Área', 'required|numeric|callback_validararea');
        $this->form_validation->set_rules('responsable', 'Responsable', 'required|numeric|callback_validarpersona');
        $this->form_validation->set_rules('password', 'Contraseña', 'required');

        if( $this->form_validation->run() && $this->input->post() )
        {
            $responsable  = $this->input->post('responsable',TRUE);
            $password  = $this->input->post('password',TRUE);
            $periodo  = $this->input->post('periodo',TRUE);

            $this->mlogin->login($responsable,$password,$periodo);
            redirect();
        }

        $data['unidades'] = $this->munidades->listar(); 
        $data['periodos'] = $this->mperiodos->listar(); 
        foreach ($data['periodos'] as $key => $periodo)
        {
            if($periodo->p_status==1)
            {
                $periodo->etiqueta = $periodo->p_anio." (activo)";
            }else
            {
                $periodo->etiqueta = $periodo->p_anio;
            }
        }

        $this->load->view('login',$data);
    }
    // --------------------------------------------------------------------
    
    /**
     * Destrulle la session existente
     */
    public function logout()
    {    
        // Cerramos sesion de usuario
        $this->mlogin->cerrar_sesion();
        redirect();
    }
    // --------------------------------------------------------------------
    
    /**
     * Valida si el periodo existe en la base de datos
     *
     * @param   Int
     * @return  boolean
     */
    public function validarperiodo($periodo_id)
    {
        if($this->mperiodos->validar_id($periodo_id))
        {
            $this->form_validation->set_message('validarperiodo', 'Seleccione un periodo valido');
            return FALSE;
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
/* Final del archivo Login.php 
 * Ubicacion: ./application/controllers/Login.php
 */