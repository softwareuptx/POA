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
                            <?=form_open('unidades/agregar')?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="institucion">Nombre de la Institución<span class="text-danger">*</span></label>
                                        <select class="form-control selectpicker" data-live-search="true"  id="institucion" name="institucion" data-style="btn-white">
                                            <?php
                                            foreach ($instituciones as $key => $institucion){
                                                echo '<option value="'.$institucion->in_id.'" '.set_select('institucion', $institucion->in_id).'>'.$institucion->in_nombre.'</option>';
                                            }
                                            ?>
                                        </select>
                                        <?=form_error('institucion')?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="persona">Nombre del responsable<span class="text-danger">*</span></label>
                                        <select class="form-control selectpicker" data-live-search="true"  id="persona" name="persona" data-style="btn-white">
                                            <?php
                                                foreach ($personas as $key => $persona){
                                                    echo '<option value="'.$persona->idpersonas.'" '.set_select('persona', $persona->idpersonas).'>'.$persona->nombre.' '.$persona->apellidopat.' '.$persona->apellidomat.'</option>';
                                                }
                                            ?>
                                        </select>
                                        <?=form_error('persona')?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="unidad">Nombre de la Unidad<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="unidad" name="unidad" value="<?=set_value('unidad')?>">
                                        <?=form_error('unidad')?>
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