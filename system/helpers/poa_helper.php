<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sistema de Programacion Operativa Anual (POA)
 * Helpers / POA
 *
 * Funciones globales para el sistema
 *
 * @author Oficina de Desarrollo de Software / Universidad Politecnica de Tlaxcala
 */

/**
* Obitne el usuario logeado y valida si es correcto
*
* @return  Object
*/
if ( ! function_exists('user') )
{
	function user(){
		
		//Instaceamos las librerias
		$CI = &get_instance();
		$CI->load->library('session');

		//Validamos la sesion
		if($CI->session->userdata('logged'))
		{
			if( $usuario = $CI->mlogin->getUsuario( $CI->session->userdata('usuario')->u_id ))
			{	
				//Obtenemos el periodo selecionado
				$usuario->periodo = $CI->mperiodo->get( $CI->session->userdata('periodo') );

				//Validos la clase de periodo
				if($usuario->periodo->p_activo==1)
				{
					$usuario->periodo->status 	= 'activo';
					$usuario->periodo->class 	= 'success';
				}else{
					$usuario->periodo->status 	= 'cerrado';
					$usuario->periodo->class 	= 'danger';
				}

				//Validamos tipo de usuario
				switch ($usuario->u_admin)
				{
					case 1:
						$usuario->perfil 	= 'ADMINISTRADOR';
						break;
				
					default:
						$usuario->perfil 	= 'EJECUTOR';
						break;
				}

				$usuario->logged = TRUE;

				return $usuario;
			}
		}
		
		$usario->logged = FALSE;
		return $usuario;
	}
}
// --------------------------------------------------------------------

/**
* Obitne el periodo activo
*
* @return  Object
*/
if ( ! function_exists('periodo') )
{
	function periodo(){
		
		//Instaceamos las librerias
		$CI = &get_instance();
		$periodo = $CI->mperiodo->actual();

		return $periodo;
	}
}
// --------------------------------------------------------------------

/**
* Obitne el menu activo
*
* @param String
* @return  Object
*/
if ( ! function_exists('menu') )
{
	function menu($menu=''){
		
		//Instaceamos las librerias
		$CI = &get_instance();
		
		//Obtenes la clase a la cual se esta accesando
		$controller 	= $CI->router->class;
		//Obtenes el metodo la cual se esta accesando
		$metodo 		= $CI->router->method;

		if($controller==$menu)
		{
			return 'active';
		}

		return NULL;
	}
}
// --------------------------------------------------------------------