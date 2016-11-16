<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sistema de Programacion Operativa Anual (POA)
 * Controllers / Modulo Evaluaciones
 *
 * Modulo para evaluaciones 
 *
 * @author Oficina de Desarrollo de Software / Universidad Politecnica de Tlaxcala
 */
class Evaluaciones extends CI_Controller
{
    /**
     * Muestra el listado de las revisiones
     *
     * @return void
     */
    public function index()
    {
        
        $data['subareas']   = $this->mevaluaciones->listar();
        
        $evaluacion = NULL;
        
        $index = 0;

        //obtenemos el numero de objetivos aprobados de cada subárea
        foreach ($data['subareas'] as $key => $subarea)
        {
            $subarea->responsable = $this->mevaluaciones->obtener_responsable($subarea->sub_id);
            
            $numobjetivos = $this->mevaluaciones->obtener_objetivos($subarea->sub_id)->num_rows();
            
            if($numobjetivos > 0)
            {
                
                $subarea->numobjetivo = $numobjetivos; 
                
                $evaluacion[$index] = $subarea;
                
                $index++; 
            }
        }

        $data['subareas'] = $evaluacion;

        $this->load->view('evaluaciones/listar',$data);
    }
    // --------------------------------------------------------------------
    /**
     * Muestra el listado de los objetivos aprobados
     *
     * @return void
     */
    public function objetivos($subarea = NULL)
    {

        $data['objetivos'] = $this->mevaluaciones->obtener_objetivos($subarea)->result();

        $data['subarea'] = $subarea;

        //Validos el id de la subarea, si es incorrecto mostramos alerta
        if(!$this->mevaluaciones->validar_subarea($subarea))
            $this->alerts->danger('evaluaciones',$this->alerts->db_404);

        foreach ($data['objetivos'] as $key => $objetivo)
        {
            // obtiene el número de acciones de un objetivo
            $numacciones    = $this->mevaluaciones->obtener_acciones($objetivo->ob_id)->num_rows();
            
            // obtiene el número de acciones no aprobadas de un objetivo
            $numacciones_na = $this->mevaluaciones->obtener_acciones_na($objetivo->ob_id);

            // obtiene el total de acciones de un objetivo, restando las acciones no aprobadas
            $total_acciones = $numacciones - $numacciones_na;

            // obtiene el listado de las acciones
            $acciones       = $this->mevaluaciones->obtener_acciones($objetivo->ob_id)->result();

            $evaluacion = 0;

            //otiene la evaluacion de las acciones del objetivo
            foreach ($acciones as $key2 => $accion)
            {
                if($accion->ac_evaluacion <= 1)
                {
                    
                    $evaluacion = round($evaluacion + $accion->ac_evaluacion / $total_acciones * 100);
                }
                else
                {
                    
                    $evaluacion = "N/A";
                }
            }

            $data['objetivos'][$key]->evaluaciones = $evaluacion;
        }

        $this->load->view('evaluaciones/objetivos',$data);      
    }
    // --------------------------------------------------------------------
    /**
     * Muestra el listado de las acciones evaluadas de cada objetivo
     *
     * @return void
     */
    public function acciones($objetivo, $subarea = NULL)
    {
        $data['subarea'] = $subarea;

        $data['acciones'] = $this->mevaluaciones->listar_acciones($objetivo)->result();

        //Validos el id de la subarea y objetivo, si es incorrecto mostramos alerta
        if(!$this->mevaluaciones->validar_objetivo($objetivo, $subarea))
            $this->alerts->danger('evaluaciones',$this->alerts->db_404);

        foreach ($data['acciones'] as $key => $accion){

            $accion->evaluacion = '';

            if($accion->ac_evaluacion==NULL && $accion->ac_evaluacion!=2)
            {
                $accion->evaluacion .= "
                    <button type='button' class='btn btn-inverse btn-custom waves-effect waves-light'>
                        <span class='btn-label'>Pendiente</span>
                        <i class='fa fa-clock-o'></i> 
                    </button>
                ";
            }
            else
            {
                $accion->evaluacion .= "
                    <button type='button' class='btn btn-success btn-custom waves-effect waves-light'>
                        <span class='btn-label'>Evaluada</span>
                        <i class='fa fa-check-circle'></i> 
                    </button>
                ";
            }
        }

        $this->load->view('evaluaciones/acciones',$data);
    }
    // --------------------------------------------------------------------
    /**
     * Evalua la acción y muestra los totales de cada cuatrimestre
     *
     * @return void
     */
    public function evaluar($accion=NULL, $objetivo=NULL, $subarea = NULL)
    {

        //Validos el id de la subarea, accion y objetivo, si es incorrecto mostramos alerta
        if(!$this->mevaluaciones->validar_accion($accion, $objetivo, $subarea))
            $this->alerts->danger('evaluaciones',$this->alerts->db_404);
        // Validaciones de Formulario
        $this->form_validation->set_rules('valor', 'evaluacion', 'required|in_list[0,0.1,0.2,0.3,0.4,0.5,0.6,0.7,0.8,0.9,1,2]');

        if( $this->form_validation->run() && $this->input->post() )
        {               
            $valor  = $this->input->post('valor');
            
            $accion = $this->input->post('ac_id');

            //Preparamos la información para insertar 
            $data =  array( 
                'ac_evaluacion' => $valor
                );

            $this->mevaluaciones->evaluar($accion, $data);
            
            $this->alerts->success('evaluaciones/acciones/'.$objetivo.'/'.$subarea);
        }

        $data['accion']       = $accion;
        $data['subarea']      = $subarea;
        $data['objetivo']     = $objetivo;
        $data['acciones']     = $this->mrevisiones->obtener_accion($accion);
        $data['cuatrimestres']= $this->mrevisiones->obtener_cuatrimestre($accion);
        $data['partidas']     = $this->mrevisiones->obtener_partidas($objetivo,$accion);

        $this->load->view('evaluaciones/evaluacion',$data);
    }
    // --------------------------------------------------------------------    
}
/* Final del archivo Evluaciones.php 
 * Ubicacion: ./app_admin/controllers/Evaluaciones.php
 */