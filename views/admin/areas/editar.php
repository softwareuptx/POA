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
                            <?=form_open('areas/editar/'.$area->a_id)?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="institucion">Nombre de la Unidad<span class="text-danger">*</span></label>
                                        <select class="form-control selectpicker" data-live-search="true"  id="unidad" name="unidad" data-style="btn-white">
                                            <?php
                                            foreach ($unidades as $key => $unidad){
                                                echo '<option value="'.$unidad->uni_id.'" '.set_select('unidad', $unidad->uni_id,FALSE,$area->a_unidad).'>'.$unidad->uni_nombre.'</option>';
                                            }
                                            ?>
                                        </select>
                                        <?=form_error('unidad')?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="persona">Nombre del responsable<span class="text-danger">*</span></label>
                                        <select class="form-control selectpicker" data-live-search="true"  id="persona" name="persona" data-style="btn-white">
                                            <?php
                                            foreach ($personas as $key => $persona){
                                                echo '<option value="'.$persona->idpersonas.'" '.set_select('persona', $persona->idpersonas,FALSE,$area->u_refsii).'>'.$persona->nombre.' '.$persona->apellidopat.' '.$persona->apellidomat.'</option>';
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
                                        <label for="unidad">Nombre del Área<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="area" name="area" value="<?php if(set_value('area')==''){ echo $area->a_nombre; }else{ echo set_value('area'); } ?>">
                                        <?=form_error('area')?>
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