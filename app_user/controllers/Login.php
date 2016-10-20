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
        $this->form_validation->set_rules('numero', 'No. en SII', 'required|numeric');
        $this->form_validation->set_rules('password', 'Contraseña', 'required');
        $this->form_validation->set_rules('periodo', 'Año', 'required|numeric');

        if( $this->form_validation->run() && $this->input->post() )
        {
            $numero  = $this->input->post('numero',TRUE);
            $this->cuenta->login($numero);
            redirect();
        } 

       $this->load->view('login');
    }
    // --------------------------------------------------------------------
    
    /**
     * Destrulle la session existente
     */
    public function logout()
    {    
        // Cerramos sesion de usuario
        $this->model_login->logout();
        redirect();
    }
    // --------------------------------------------------------------------
}
/* Final del archivo Login.php 
 * Ubicacion: ./application/controllers/Login.php
 */