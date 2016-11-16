<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema de Progrmacion Operativa Anual">
    <meta name="author" content="Oficina de Desarrollo de Software / Universidad Politecnica de Tlaxcala">
    <!-- ========== Icon  ========== -->
    <?=$this->load->view('includes/base_favicon','',TRUE)?>
    <!-- ========== /Icon  ========== -->
    <title><?=title()?></title>
    <!-- ========== Base CSS ========== -->
    <?=$this->load->view('includes/base_css','',TRUE)?>
    <!-- ========== /Base CSS ========== -->
</head>
<body class="fixed-left">
    <!-- Begin page -->
    <div id="wrapper">
      <!-- ========== Menu Top  ========== -->
      <?=$this->load->view('includes/menutop','',TRUE)?>
      <!-- ========== End Menu Top  ========== -->

      <!-- ========== Menu Top  ========== -->
      <?=$this->load->view('includes/menuleft','',TRUE)?>
      <!-- ========== End Menu Top  ========== -->

      <!-- ============================================================== -->
      <!-- Start right Content here -->
      <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <!-- ========== Alertas ========== -->
                <?=$this->alerts->get()?>
                <!-- ========== /Alertas ========== -->
                <div class="container">
                    <!-- ========== Menu de navegacion  ========== -->
                    <?=navegacion()?>
                    <!-- ========== End Menu de navegacion  ========== -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="subarea">Subárea</label>
                                            <p><?php echo $accion->sub_nombre ?><p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="objetivo">Objetivo</label>
                                            <p><?php echo $accion->ob_descripcion ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <p>
                                                <?php
                                                    if($accion->ac_status == 0){
                                                        echo '
                                                            <p><label for="objetivo"><span class="text-danger">*</span>¿Deseas aprobar esta acción?</label></p>
                                                            <td>
                                                                <a href="'.base_url('revisiones/aprobar_accion/'.$accion->ac_id.'/'.$accion->ob_id.'/'.$subarea).'" class="text-muted m-b-15 font-30"><font color="gray">Si </font><i class="fa fa-check"></i></a>
                                                            </td>
                                                        ';
                                                    }
                                                    if($accion->ac_status == 1){
                                                        echo '
                                                            <p><label for="objetivo"><span class="text-danger">*</span>¿Deseas desaprobar esta acción?</label></p>
                                                            <td>
                                                                <a href="'.base_url('revisiones/desaprobar_accion/'.$accion->ac_id.'/'.$accion->ob_id.'/'.$subarea).'" class="text-muted m-b-15 font-30"><font color="gray">Si </font><i class="fa fa-times-circle"></i></a>
                                                            </td>
                                                        ';
                                                    }
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>    
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="meta">Meta</label>
                                            <p><?php echo $accion->m_descripcion ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="descripcion">Acción</label>
                                            </p><?php echo $accion->ac_descripcion ?> </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="objetivo">Status actual</label>
                                            <p>
                                                <?php
                                                    if($accion->ac_status == 1){
                                                        echo " 
                                                            <button class='btn btn-success btn-custom waves-effect waves-light'>
                                                                <span class='btn-label'>Aprobada</span>
                                                                <i class='fa fa-check-circle'></i>
                                                            </button>
                                                        ";
                                                    }
                                                    else{
                                                        echo " 
                                                            <button class='btn btn-danger btn-custom waves-effect waves-light'>
                                                                <span class='btn-label'>Pendiente</span>
                                                                <i class='fa fa-clock-o'></i>
                                                            </button>
                                                        ";
                                                    }
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="indicador">Indicador presupuestal por partida(s)</label>
                                            <p>
                                                <?php
                                                    if($partidas != FALSE){
                                                        $total_indicador = 0;
                                                        foreach ($partidas as $partida){
                                                            $total_indicador += $partida->pa_indicador;
                                                        }
                                                    }
                                                    if($total_indicador == 0){
                                                        echo "<p>No hay un indicador presupuestal por partida(s)</p>";
                                                    }
                                                    else{
                                                        echo "<p>".'$'.number_format($total_indicador,2)."</p>";
                                                    }
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="partida">Partida(s)</label>
                                            <p>
                                                <?php
                                                    if ($partidas != FALSE){
                                                        foreach ($partidas as $key => $partida){
                                                            echo $key+1;
                                                            echo ".- ".$partida->pa_clave.' - '.$partida->pa_descripcion."</p>";
                                                        }
                                                    }
                                                    else{
                                                        echo "La acción no tiene partida(s)";
                                                    }
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>                            
                            </div>
                        </div>
                    </div>
                    <section class="content">
                        <div class="row">                
                            <div class="col-md-12">  
                                <?php 
                                if ($cuatrimestres != FALSE)
                                {
                                    $meses[] = array('Enero','Febrero','Marzo','Abril');
                                    $meses[] = array('Mayo','Junio','Julio','Agosto');
                                    $meses[] = array('Septiembre','Octubre','Noviembre','Diciembre');
                                    $total = 0;
                                    foreach ($cuatrimestres as $key => $cuatrimestre)
                                    {
                                ?>
                                <div class="box">
                                    <div class="card-box">
                                        <div class="table-rep-plugin">
                                            <div class="table-responsive" data-pattern="priority-columns"> 
                                                <table id="demo-foo-filtering" class="table table-hover table-actions-bar toggle-circle m-b-0" data-page-size="10">
                                                    <thead>
                                                        <tr>
                                                            <th>Cuatrimestre</th>
                                                            <th style="width: 170px;"><?=$meses[$key][0];?></th>
                                                            <th style="width: 170px;"><?=$meses[$key][1];?></th>
                                                            <th style="width: 170px;"><?=$meses[$key][2];?></th>
                                                            <th style="width: 170px;"><?=$meses[$key][3];?></th>
                                                            <th style="width: 170px;">Subtotal</th>                          
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php                                  
                                                            $subTotal = $cuatrimestre->cu_mes1 + $cuatrimestre->cu_mes2 + $cuatrimestre->cu_mes3 + $cuatrimestre->cu_mes4;
                                                            $saldo = $subTotal - $cuatrimestre->cu_ejecutado; 
                                                            $total += $subTotal;
                                                            echo "<tr>";
                                                                echo "<td>".$cuatrimestre->cu_cuid."</td>";
                                                                echo "<td>".'$'.number_format($cuatrimestre->cu_mes1,2)."</td>";
                                                                echo "<td>".'$'.number_format($cuatrimestre->cu_mes2,2)."</td>";
                                                                echo "<td>".'$'.number_format($cuatrimestre->cu_mes3,2)."</td>";
                                                                echo "<td>".'$'.number_format($cuatrimestre->cu_mes4,2)."</td>";
                                                                echo "<td><b>".'$'.number_format($subTotal,2)."</b></td>";
                                                                if($cuatrimestre->cu_cuid == 3 && $total_indicador >= $total || $total_indicador == 0){
                                                                    echo "<tr>";
                                                                        echo "<td><span class='text-default'>'</span></td>";
                                                                        echo "<td><span class='text-default'>'</span></td>";
                                                                        echo "<td><span class='text-default'>'</span></td>";
                                                                        echo "<td><span class='text-default'>'</span></td>";
                                                                        echo "<td><span class='text-default'>'</span></td>";
                                                                        echo "<td><span class='text-default'>'</span></td>";
                                                                    echo "</tr>";
                                                                    echo "<tr>";
                                                                        echo "<td></td>";
                                                                        echo "<td></td>";
                                                                        echo "<td></td>";
                                                                        echo "<td></td>";
                                                                        echo "<td><b><span class='text-danger'>*</span>TOTAL:</b></td>";
                                                                        echo "<td><b><span class='text-custom'>"."$".number_format($total,2)."</span></b></td>";
                                                                    echo "</tr>";
                                                                    echo "<tr>";
                                                                        echo "<td></td>";
                                                                        echo "<td></td>";
                                                                        echo "<td></td>";
                                                                        echo "<td colspan='10' align='right'><b><span class='text-danger'>*</span>NOTA: </b>El total se encuentra dentro del indicador por partida(s).</td>";
                                                                    echo "</tr>";
                                                                }
                                                                if($cuatrimestre->cu_cuid == 3 && $total_indicador < $total){
                                                                    echo "<tr>";
                                                                        echo "<td><span class='text-default'>'</span></td>";
                                                                        echo "<td><span class='text-default'>'</span></td>";
                                                                        echo "<td><span class='text-default'>'</span></td>";
                                                                        echo "<td><span class='text-default'>'</span></td>";
                                                                        echo "<td><span class='text-default'>'</span></td>";
                                                                        echo "<td><span class='text-default'>'</span></td>";
                                                                    echo "</tr>";
                                                                    echo "<tr>";
                                                                        echo "<td></td>";
                                                                        echo "<td></td>";
                                                                        echo "<td></td>";
                                                                        echo "<td></td>";
                                                                        echo "<td><b><span class='text-danger'>*</span>TOTAL:</b></td>";
                                                                        echo "<td><span class='text-danger'>"."$".number_format($total,2).".</span></td>";
                                                                    echo "</tr>";
                                                                    echo "<tr>";
                                                                        echo "<td></td>";
                                                                        echo "<td></td>";
                                                                        echo "<td></td>";
                                                                        echo "<td></td>";
                                                                        echo "<td colspan='10'><b><span class='text-danger'>*</span>NOTA: </b>El total excede el indicador por partida(s).</td>";
                                                                    echo "</tr>";
                                                                }                
                                                            echo "</tr>";                         
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>                       
                                <?php
                                    }//fin for                 
                                }//fin if    
                                ?>
                                </div> 
                            </div>
                        </div>
                    </section>
                    <div class="row">                
                        <div class="col-md-12">
                            <div class="box">
                                <div class="card-box">
                                <?=form_open('revisiones/cuatrimestres/'.$idaccion.'/'.$objetivo->rev_objetivo.'/'.$subarea,'method="post" id="form_comentarios" ', array ('rev_objetivo'=>$objetivo->rev_objetivo, 'accion'=>$idaccion, 'subarea'=>$subarea) )?>
                                    <button type="submit" class="btn btn-default waves-effect waves-light"> <span class="fa fa-check-square" aria-hidden="true"> </span> Enviar </button>                                          
                                    <p><h3 class="box-title">Comentarios<span class="text-danger">*</span></h3></p>
                                    <textarea id="comentarios" name="comentarios" class="form-control" rows="3" placeholder="Agrega las observaciones pertinentes sobre la acción y comenta si deseas que el usuario realize un cambio en ella "><?=set_value('comentarios')?></textarea>
                                    <?=form_error('comentarios')?>
                                <?=form_close()?>                                     
                                <div class="box-header">
                                    <h3><br>Historial de Comentarios</h3>
                                </div>
                                <div class="table-rep-plugin">
                                    <div class="table-responsive" data-pattern="priority-columns"> 
                                        <table id="example1" class="table table-hover table-actions-bar toggle-circle m-b-0" data-page-size="10">                    
                                            <thead>
                                                <tr>
                                                    <th width="200">Fecha</th>                   
                                                    <th>Descripción</th> 
                                                </tr>
                                            </thead>
                                            <tbody>                      
                                                <?php 
                                                    if ($mensajes != FALSE){
                                                        foreach ($mensajes->result() as $mensaje )
                                                        {
                                                            echo "<tr>";
                                                                echo "<td>".$mensaje->com_fechasys."</td>";
                                                                echo "<td>".$mensaje->com_comentario."</td>";
                                                            echo "</tr>";
                                                        }
                                                    }                         
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- container -->
    </div> <!-- content -->
    <!-- ========== Footer ========== -->
    <?=$this->load->view('includes/footer','',TRUE)?>
    <!-- ========== End Footer ========== -->
    <script>
        var resizefunc = [];
    </script>
    <!-- ========== Base JS ========== -->
    <?=$this->load->view('includes/base_js','',TRUE)?>
</body>
</html>