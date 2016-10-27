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
                            <table id="demo-foo-filtering" class="table table-hover table-actions-bar toggle-circle m-b-0" data-page-size="10">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th data-hide="phone, tablet">Unidad</th>
                                        <th data-hide="phone, tablet">Area</th>
                                        <th data-toggle="true">Subárea</th>
                                        <th>Responsable</th>
                                        <th data-hide="phone, tablet">Institución</th>
                                        <th style="width: 80px;"></th>
                                    </tr>
                                </thead>
                                <div class="form-inline m-b-20">
                                    <div class="row">
                                        <div class="col-sm-6 text-xs-center">
                                            <div class="form-group">
                                                <a href="<?=base_url('subareas/agregar')?>" type="button" class="btn btn-default btn-rounded waves-effect waves-light">
                                                    <span class="btn-label">
                                                        <i class="fa fa-plus m-r-5"></i>
                                                    </span>
                                                    Agregar
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 text-xs-center text-right">
                                            <div class="form-group">
                                                <label class="control-label m-r-5">Filtrar por área</label>
                                                <select id="demo-foo-filter-status" class="form-control">
                                                    <option value="">Ver todo</option>
                                                    <?php
                                                    foreach ($areas as $key => $area){
                                                        echo '<option value="'.$area->a_nombre.'">'.$area->a_nombre.'</option>';
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
                                    foreach ($subareas as $key => $subarea){
                                        echo "<tr>";
                                        echo "<td>".($key+1)."</td>";
                                        echo "<td><a href='".base_url('unidades/editar/'.$subarea->uni_id)."'>".$subarea->uni_nombre."</td>";
                                        echo "<td><a href='".base_url('areas/editar/'.$subarea->a_id)."'>".$subarea->a_nombre."</td>";
                                        echo "<td>".$subarea->sub_nombre."</td>";
                                        echo "<td>".$subarea->u_nombre." ".$subarea->u_appaterno." ".$subarea->u_apmaterno."</td>";
                                        echo "<td><a href='".base_url('instituciones/editar/'.$subarea->in_id)."'>".$subarea->in_nombre."</a></td>";
                                        echo '
                                        <td>
                                            <a href="'.base_url('subareas/editar/'.$subarea->sub_id).'" class="table-action-btn" data-toggle="tooltip" data-placement="top" title="Editar registro"><i class="fa fa-pencil-square-o"></i></a>
                                            <a href="'.base_url('subareas/eliminar/'.$subarea->sub_id).'" class="table-action-btn" data-toggle="tooltip" data-placement="top" title="Eliminar registro"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                        ';
                                        echo "</tr>";
                                    }
                                    ?>
                                    <!-- ./Contenido de la tabla -->
                                </tbody>
                            </table>
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