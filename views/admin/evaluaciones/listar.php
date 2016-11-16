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
                                                <th data-toggle="true">Área</th>
                                                <th data-toggle="true">Ejecutor</th>
                                                <th data-toggle="true">Objetivo Particular</th>
                                                <th style="width: 80px;"></th>
                                            </tr>
                                        </thead>
                                        <div class="form-inline m-b-20">
                                            <div class="row">
                                                <div class="col-sm-6 text-xs-center pull-right text-right">
                                                    <div class="form-group">
                                                        <label class="control-label m-r-5">Filtrar por Subárea</label>
                                                        <select id="demo-foo-filter-status" class="form-control">
                                                            <option value="">Mostrar todo</option>
                                                            <?php
                                                            foreach ($subareas as $key => $subarea){
                                                                echo '<option value="'.$subarea->sub_nombre.'">'.$subarea->sub_nombre.'</option>';
                                                            }

                                                            ?>
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
                                            if ($subareas != FALSE){
                                                foreach ($subareas as $key => $subarea){
                                                    echo "<tr>";
                                                    echo "<td>".($key+1)."</td>";
                                                    echo "<td>".$subarea->sub_nombre."</td>";
                                                    echo "<td>".$subarea->responsable->u_nombre." ".$subarea->responsable->u_appaterno." ".$subarea->responsable->u_apmaterno."</td>";
                                                    echo "<td><button type='button' class='btn btn-success btn-custom waves-effect waves-light'><span class='btn-label'>Objetivo(s)</span><i>".$subarea->numobjetivo."</i></td>";
                                                    echo '
                                                    <td>
                                                        <a href="'.base_url('evaluaciones/objetivos/'.$subarea->sub_id).'" class="table-action-btn" data-toggle="tooltip" data-placement="top" title="Revisar"><i class="fa fa-edit"></i></a>
                                                    </td>
                                                    ';
                                                    echo "</tr>";
                                                }
                                            }
                                            else{
                                                echo "<tr>";
                                                echo "<td>No hay registros</td>";
                                                echo "</tr>";
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