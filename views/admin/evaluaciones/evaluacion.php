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
                    <div class="col-sm-12">
                        <div class="card-box">
                            <!-- Formulario -->
                            <?=form_open('evaluaciones/evaluar/'.$acciones->ac_id.'/'.$objetivo.'/'.$subarea, 'method="post" id=""', array ('ac_id'=>$acciones->ac_id))?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="subarea">Subárea</label>
                                        <p><?php echo $acciones->sub_nombre ?><p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="objetivo">Objetivo</label>
                                        <p><?php echo $acciones->ob_descripcion ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="meta">Meta</label>
                                        </p><?php echo $acciones->m_descripcion ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="descripcion">Acción</label>
                                        <p><?php echo $acciones->ac_descripcion ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="valor"><span class="text-danger">*</span>Valor</label>
                                        <select id="valor" class="form-control selectpicker" data-live-search="true" name="valor"  data-style="btn-white">                                            
                                            <option value="2"   <?=set_select('valor', '2')?>>  N/A</option>
                                            <option value="0"   <?=set_select('valor', '0')?>>  0</option>
                                            <option value="0.1" <?=set_select('valor', '0.1')?>>0.1</option>
                                            <option value="0.2" <?=set_select('valor', '0.2')?>>0.2</option>
                                            <option value="0.3" <?=set_select('valor', '0.3')?>>0.3</option>
                                            <option value="0.4" <?=set_select('valor', '0.4')?>>0.4</option>
                                            <option value="0.5" <?=set_select('valor', '0.5')?>>0.5</option>
                                            <option value="0.6" <?=set_select('valor', '0.6')?>>0.6</option>
                                            <option value="0.7" <?=set_select('valor', '0.7')?>>0.7</option>
                                            <option value="0.8" <?=set_select('valor', '0.8')?>>0.8</option>
                                            <option value="0.9" <?=set_select('valor', '0.9')?>>0.9</option>
                                            <option value="1"   <?=set_select('valor', '1')?>>1</option>
                                        </select>
                                        <?=form_error('valor')?>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-default btn-rounded waves-effect waves-light pull-right">
                                    <span class="btn-label">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    Guardar
                                </button>
                            </div>
                            <?=form_close()?>                       
                        </div>
                    </div>
                </div>
                <section class="content">
                    <div class="row">                
                        <div class="col-xs-12">  
                            <?php 
                            if ($cuatrimestres != FALSE)
                            {
                                $meses[] = array('Enero','Febrero','Marzo','Abril');
                                $meses[] = array('Mayo','Junio','Julio','Agosto');
                                $meses[] = array('Septiembre','Octubre','Noviembre','Diciembre');
                                $total = 0;
                                $ejecuciontotal = 0;
                                $saldototal = 0;
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
                                                    <th style="width: 170px;">Cuatrimestre</th>
                                                    <th style="width: 170px;"><?=$meses[$key][0];?></th>
                                                    <th style="width: 170px;"><?=$meses[$key][1];?></th>
                                                    <th style="width: 170px;"><?=$meses[$key][2];?></th>
                                                    <th style="width: 170px;"><?=$meses[$key][3];?></th>
                                                    <th style="width: 100px;">Subtotal</th>
                                                    <th style="width: 100px;">Ejecutado</th>
                                                    <th style="width: 100px;">Saldo</th>                       
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php                                  
                                                    $subTotal = $cuatrimestre->cu_mes1 + $cuatrimestre->cu_mes2 + $cuatrimestre->cu_mes3 + $cuatrimestre->cu_mes4;
                                                    $saldo = $subTotal - $cuatrimestre->cu_ejecutado;
                                                    $total += $subTotal; 
                                                    $saldototal += $saldo;
                                                    $ejecuciontotal += $cuatrimestre->cu_ejecutado;
                                                    echo "<tr>";
                                                        echo "<td>".$cuatrimestre->cu_cuid."</td>";
                                                        echo "<td>".'$'.number_format($cuatrimestre->cu_mes1,2)."</td>";
                                                        echo "<td>".'$'.number_format($cuatrimestre->cu_mes2,2)."</td>";
                                                        echo "<td>".'$'.number_format($cuatrimestre->cu_mes3,2)."</td>";
                                                        echo "<td>".'$'.number_format($cuatrimestre->cu_mes4,2)."</td>";
                                                        echo "<td><b>".'$'.number_format($subTotal,2)."</b></td>";
                                                        echo "<td><b>".'$'.number_format($cuatrimestre->cu_ejecutado,2)."</b></td>";
                                                        echo "<td><b>".'$'.number_format($saldo,2)."</b></td>";
                                                        if($cuatrimestre->cu_cuid == 3){
                                                            echo "<tr>";
                                                                echo "<td><span class='text-default'>'</span></td>";
                                                                echo "<td><span class='text-default'>'</span></td>";
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
                                                                echo "<td bgcolor='#f2f4f4'><b><span class='text-danger'>*</span><span class='text-inverse'>TOTALES: </b></span></td>";
                                                                echo "<td bgcolor='#f2f4f4'><b><span class='text-inverse'>"."$".number_format($total,2)."</span></td>";
                                                                echo "<td bgcolor='#f2f4f4'><b><span class='text-inverse'>"."$".number_format($ejecuciontotal,2)."</span></td>";
                                                                echo "<td bgcolor='#f2f4f4'><b><span class='text-inverse'>"."$".number_format($saldototal,2)."</span></td>";
                                                            echo "</tr>";
                                                        }
                                                    echo "</tr>";
                                                ?>
                                                <a href="<?=base_url('evidencias/evidencia/'.$cuatrimestre->cu_id.'/'.$accion.'/'.$objetivo.'/'.$subarea)?>" class="btn btn-default waves-effect waves-light"><span class="fa fa-folder-open-o" aria-hidden="true"> </span> Evidencia </a>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>                       
                        <?php
                                }//fin for                 
                            }//fin if    
                        ?> 
                    </div>
                </section>
            </div>
        </div>
    </div> <!-- container -->
    <!-- ========== Footer ========== -->
    <?=$this->load->view('includes/footer','',TRUE)?>
    <!-- ========== End Footer ========== -->
    <!-- END wrapper -->
    <script>
        var resizefunc = [];
    </script>
    <!-- ========== Base JS ========== -->
    <?=$this->load->view('includes/base_js','',TRUE)?>
</body>
</html>