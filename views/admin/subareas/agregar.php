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
                            <?=form_open('subareas/agregar')?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="area">Nombre del Área<span class="text-danger">*</span></label>
                                        <select class="form-control selectpicker" data-live-search="true"  id="area" name="area" data-style="btn-white">
                                            <?php
                                            foreach ($areas as $key => $area){
                                                echo '<option value="'.$area->a_id.'" '.set_select('area', $area->a_id).'>'.$area->a_nombre.'</option>';
                                            }
                                            ?>
                                        </select>
                                        <?=form_error('area')?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="responsable">Nombre del responsable<span class="text-danger">*</span></label>
                                        <select class="form-control selectpicker" data-live-search="true"  id="responsable" name="responsable" data-style="btn-white">
                                            <?php
                                            foreach ($personas as $key => $persona){
                                                echo '<option value="'.$persona->idpersonas.'" '.set_select('responsable', $persona->idpersonas).'>'.$persona->nombre.' '.$persona->apellidopat.' '.$persona->apellidomat.'</option>';
                                            }
                                            ?>
                                        </select>
                                        <?=form_error('responsable')?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre">Nombre de la Subárea<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?=set_value('nombre')?>">
                                        <?=form_error('nombre')?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <hr>
                                <div class="pull-left">
                                    <button type="submit" class="btn btn-default btn-rounded waves-effect waves-light">
                                        <span class="btn-label">
                                            <i class="fa fa-check"></i>
                                        </span>
                                        Guardar
                                    </button>
                                </div>
                            </div>
                            <?=form_close()?>
                            <!-- ./Formulario -->
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