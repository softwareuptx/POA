<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sistema de Programacion Operativa Anual (POA)
 * Controllers / Modulo Revisiones
 *
 * Modulo para revisiones 
 *
 * @author Oficina de Desarrollo de Software / Universidad Politecnica de Tlaxcala
 */
class Revisiones extends CI_Controller
{
    /**
     * Muestra el listado de las revisiones
     *
     * @return void
     */
    public function index()
    {
        $data['subareas']   = $this->mrevisiones->listar();
        
        $revision = NULL;
        
        $index = 0;

        //obtenemos el numero de objetivos de cada subárea
        foreach ($data['subareas'] as $key => $subarea)
        {
            $subarea->responsable = $this->mrevisiones->obtener_responsable($subarea->sub_id);

            $numobjetivos = $this->mrevisiones->obtener_objetivos($subarea->sub_id)->num_rows();
            
            if($numobjetivos > 0)
            {
                
                $subarea->numobjetivo = $numobjetivos; 
                
                $revision[$index] = $subarea;
                
                $index++; 
            }
        }

        $data['subareas'] = $revision;

        $this->load->view('revisiones/listar',$data);
    }
    // --------------------------------------------------------------------
    /**
     * Muestra el listado de los objetivos a revisar
     *
     * @return void
     */
    public function objetivos($subarea = NULL)
    {

        $data['objetivos'] = $this->mrevisiones->obtener_objetivos($subarea)->result();

        //Validos el id de la subarea, si es incorrecto mostramos alerta
        if(!$this->mrevisiones->validar_subarea($subarea))
            $this->alerts->danger('revisiones',$this->alerts->db_404);

        foreach ($data['objetivos'] as $key => $objetivo)
        {
            
            $cuatrimestres = $this->mrevisiones->obtener_subtotal($objetivo->ob_id);
            
            $presupuesto = 0;
            
            //se obtienen los subtotales de cada cuatrimestre
            foreach ($cuatrimestres as $key1 => $cuatrimestre)
            {
                
                //total de cuatrimestres
                $presupuesto = $presupuesto + $cuatrimestre->cu_mes1 + $cuatrimestre->cu_mes2 + $cuatrimestre->cu_mes3 + $cuatrimestre->cu_mes4;
            }

            $data['objetivos'][$key]->presupuestoprogramado = number_format($presupuesto, 2);
        }

        $data['subarea'] = $subarea;

        $this->load->view('revisiones/objetivos',$data);    
    }
    // --------------------------------------------------------------------
    /**
     * Muestra el listado de las acciones de cada objetivo
     *
     * @return void
     */
    public function acciones($objetivo, $subarea = NULL)
    {
        $data['subarea'] = $subarea;

        $data['acciones'] = $this->mrevisiones->obtener_acciones($objetivo)->result();

        //Validos el id de la subarea y del objetivo, si son incorrectos mostramos alerta
        if(!$this->mrevisiones->validar_objetivo($objetivo, $subarea))
            $this->alerts->danger('revisiones',$this->alerts->db_404);

        foreach ($data['acciones'] as $key => $accion){

            $accion->status = '';

            if($accion->ac_status==1)
            {
                $accion->status .= "
                    <button type='button' class='btn btn-success btn-custom waves-effect waves-light'>
                        <span class='btn-label'>Aprobada</span>
                        <i class='fa fa-check-circle'></i>
                    </button>
                ";
            }
            else
            {
                $accion->status .= "
                    <button type='button' class='btn btn-danger btn-custom waves-effect waves-light'>
                        <span class='btn-label'>Pendiente</span>
                        <i class='fa fa-clock-o'></i> 
                    </button>
                ";
            }
        }

        $this->load->view('revisiones/acciones',$data);
    }
    // --------------------------------------------------------------------
    /**
     * Muestra los totales del cuatrimestre relacionado con su acción
     *
     * @return void
     */
    public function cuatrimestres($idaccion=NULL, $objetivo=NULL, $subarea = NULL)
    {
        //Validos el id de la subarea, objetivo y acción, si son incorrectos mostramos alerta
        if(!$this->mrevisiones->validar_accion($idaccion, $objetivo, $subarea))
            $this->alerts->danger('revisiones',$this->alerts->db_404);

        // Validaciones de Formulario
        $this->form_validation->set_rules('comentarios', 'comentarios', 'required');

        if( $this->form_validation->run() && $this->input->post() )
        {               
            $objetivo     = $this->input->post('rev_objetivo');
            
            $subarea      = $this->input->post('subarea');
            
            $accion       = $this->input->post('accion');

            //Preparamos la información para insertar 
            $data = array(
                'com_comentario'        => $this->input->post('comentarios'),
                'com_status'            => 1,
                'com_fechasys'          => date('Y:m:d'),
                'com_revision'          => $objetivo,
                'com_accion'            => $accion
                );

            $this->mrevisiones->agregar($objetivo, $data);
            
            $this->alerts->success('revisiones/cuatrimestres/'.$accion.'/'.$objetivo.'/'.$subarea);
        }

        //obtenemos las partidas de cada accion
        $data['idaccion']     = $idaccion;
        $data['subarea']      = $subarea;
        $data['partidas']     = $this->mrevisiones->obtener_partidas($objetivo,$idaccion);
        $data['accion']       = $this->mrevisiones->obtener_accion($idaccion);
        $data['cuatrimestres']= $this->mrevisiones->obtener_cuatrimestre($idaccion);
        $data['objetivo']     = $this->mrevisiones->obtener_objetivo($objetivo);
        $data['mensajes']     = $this->mrevisiones->obtener_mensajes($idaccion);

        $this->load->view('revisiones/cuatrimestres',$data);
    }
    // --------------------------------------------------------------------    
    /**
     * Aprueba el objetivo
     *
     * @return void
     */
    public function aprobar_objetivo($objetivo=NULL, $subarea = NULL)
    {

        //Validos el id de la subarea, objetivo y acción, si son incorrectos mostramos alerta
        if(!$this->mrevisiones->validar_objetivo($objetivo, $subarea))
            $this->alerts->danger('revisiones',$this->alerts->db_404);

        //Preparamos la información para insertar
        $data_revision = array(
            'rev_status'            => 1,
            'rev_fechaRevisado'     => date('Y:m:d'),
            'rev_objetivo'          => $objetivo,
            'rev_periodo'           => user()->periodo->p_status
            );

        $data_objetivo = array(
            'ob_status'            => 1
            );

        // obtenemos el numero total de acciones del objetivo
        $acciones           = $this->mevaluaciones->obtener_acciones($objetivo)->num_rows();
        
        // obtenemos el numero de acciones aprobadas del objetivo
        $acciones_aprobadas = $this->mrevisiones->obtener_acciones_aprobadas($objetivo);

        // si existe una accion no aprobada mandamos alerta
        if($acciones != $acciones_aprobadas)
            $this->alerts->danger('revisiones','Lo sentimos, para aprobar un objetivo tienes que aprobar todas las acciones.');
        
        // actualizamos la informacion del objetvo revisado
        if($this->mrevisiones->editar_revision($objetivo, $data_revision)
           && $this->mrevisiones->editar_objetivo($objetivo, $data_objetivo))        
        
        $this->alerts->success('revisiones');
    }
    // --------------------------------------------------------------------
    /**
     * Desaprueba el objetivo
     *
     * @return void
     */
    public function desaprobar_objetivo($objetivo=NULL, $subarea = NULL)
    {

        //Validos el id de la subarea, objetivo y acción, si son incorrectos mostramos alerta
        if(!$this->mrevisiones->validar_objetivo($objetivo, $subarea))
            $this->alerts->danger('revisiones',$this->alerts->db_404);

        //Preparamos la información para insertar 
        $data_revision = array(
            'rev_status'            => 3,
            'rev_fechaRevisado'     => date('Y:m:d'),
            'rev_objetivo'          => $objetivo,
            'rev_periodo'           => user()->periodo->p_status
            );

        $data_objetivo = array(
            'ob_status'            => 3
            );

        // actualizamos la informacion del objetvo revisado
        if($this->mrevisiones->editar_revision($objetivo, $data_revision)
           && $this->mrevisiones->editar_objetivo($objetivo, $data_objetivo))
        
        $this->alerts->success('revisiones');
    
    }
    // --------------------------------------------------------------------
    /**
     * Aprueba la acción seleccionada
     *
     * @return void
     */
    public function aprobar_accion($accion=NULL, $objetivo=NULL, $subarea=NULL)
    {
        //Validos el id de la subarea y del objetivo, si son incorrectos mostramos alerta
        if(!$this->mrevisiones->validar_accion($accion, $objetivo, $subarea))
            $this->alerts->danger('revisiones',$this->alerts->db_404);

        if($this->mrevisiones->aprobar($accion))
            $this->alerts->success('revisiones'.'/'.'cuatrimestres'.'/'.$accion.'/'.$objetivo.'/'.$subarea); 
    }
    // --------------------------------------------------------------------
    /**
     * Desaprueba la accón seleccionada
     *
     * @return void
     */
    public function desaprobar_accion($accion=NULL, $objetivo=NULL, $subarea=NULL)
    {
        //Validos el id de la subarea y del objetivo, si son incorrectos mostramos alerta
        if(!$this->mrevisiones->validar_accion($accion, $objetivo, $subarea))
            $this->alerts->danger('revisiones',$this->alerts->db_404);

        if($this->mrevisiones->desaprobar($accion))
            $this->alerts->success('revisiones'.'/'.'cuatrimestres'.'/'.$accion.'/'.$objetivo.'/'.$subarea);    
    }
    // --------------------------------------------------------------------
}
/* Final del archivo Revisiones.php 
 * Ubicacion: ./app_admin/controllers/Revisiones.php
 */