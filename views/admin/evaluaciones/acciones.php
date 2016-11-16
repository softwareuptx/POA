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
                            <div class="table-rep-plugin">
                                <div class="table-responsive" data-pattern="priority-columns">
                                    <table id="demo-foo-filtering" class="table table-hover table-actions-bar toggle-circle m-b-0" data-page-size="10">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Acción</th>
                                                <th data-hide="phone, tablet">Meta</th>
                                                <th data-toggle="true">Status</th>
                                                <th data-toggle="true">Valor</th>
                                                <th style="width: 40px;"></th>
                                            </tr>
                                        </thead>
                                        <div class="form-inline m-b-20">
                                            <div class="row">
                                                <div class="col-sm-6 text-xs-right text-right pull-right">
                                                    <div class="form-group">
                                                        <select id="demo-foo-filter-status" class="form-control">
                                                            <option value="">Mostrar todo</option>
                                                        </select>
                                                    </div>
                                                    <div class="input-group">
                                                        <input type="text" id="demo-foo-search" name="example-input1-group2" class="form-control" placeholder="Buscar">
                                                        <span class="input-group-btn">
                                                            <button type="button" class="btn waves-effect waves-light btn-default"><i class="fa fa-search"></i></button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <tbody>
                                            <!-- Contenido de la tabla -->
                                            <?php
                                            if ($acciones != FALSE){
                                                foreach ($acciones as $key => $accion){
                                                    echo "<tr>";
                                                    echo "<td>".($key+1)."</td>";
                                                    echo "<td>".$accion->ac_descripcion."</td>";
                                                    echo "<td>".$accion->m_descripcion."</td>";
                                                    echo "<td>".$accion->evaluacion."</td>";
                                                    if($accion->ac_evaluacion==2){
                                                        echo "<td>".'N/A'."</td>";
                                                    }
                                                    else{
                                                        echo "<td>".$accion->ac_evaluacion.' %'."</td>";
                                                    }
                                                    echo '
                                                        <td>
                                                            <a href="'.base_url('evaluaciones/evaluar/'.$accion->ac_id.'/'.$accion->ob_id.'/'.$subarea).'" class="table-action-btn" data-toggle="tooltip" data-placement="top" title="Revisar"><i class="fa fa-pencil-square-o"></i></a>
                                                        </td>
                                                    ';
                                                    echo "</tr>";
                                                }
                                            }
                                            ?>
                                            <!-- ./Contenido de la tabla -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 text-xs-center text-right">
                                    <ul class="pagination pagination-split m-t-30 m-b-0"></ul>
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
</div>
<!-- END wrapper -->
<script>
    var resizefunc = [];
</script>
<!-- ========== Base JS ========== -->
<?=$this->load->view('includes/base_js','',TRUE)?>
</body>
</html>