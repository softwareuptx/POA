<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sistema de Programacion Operativa Anual (POA)
 * Controllers / Modulo Login
 *
 * Modulo de sessiones para el sistema
 *
 * @author Oficina de Desarrollo de Software / Universidad Politecnica de Tlaxcala
 */
class Login extends CI_Controller
{
    /**
     * Renderiza vista de login y crea session de usuario
     *
     * @return  void
     */
    public function index()
    {
        // Validaciones de Formulario
        $this->form_validation->set_rules('periodo', 'Año', 'required|numeric|callback_valperiodo');
        $this->form_validation->set_rules('numero', 'No. en SII', 'required|numeric');
        $this->form_validation->set_rules('password', 'Contraseña', 'required');

        if( $this->form_validation->run() && $this->input->post() )
        {
            $periodo    = $this->input->post('periodo',TRUE);
            $numero     = $this->input->post('numero',TRUE);
            $password   = $this->input->post('password',TRUE);

            $this->mlogin->login($periodo,$numero,$password);
            redirect();
        }

        $data['periodos'] = $this->mperiodo->getlist();
        $this->load->view('login',$data);
    }
    // --------------------------------------------------------------------
    
    /**
     * Destrulle la session existente
     * 
     * @return  void
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
    public function valperiodo($periodo_id)
    {
        if($this->mperiodo->check($periodo_id)<1)
        {
            $this->form_validation->set_message('valperiodo', 'Seleccione un periodo valido');
            return FALSE;
        }
        return TRUE; 
    }
    // --------------------------------------------------------------------
}
/* Final del archivo Login.php 
 * Ubicacion: ./app_admin/controllers/Login.php
 */