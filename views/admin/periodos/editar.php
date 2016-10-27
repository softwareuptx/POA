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
    <link href="<?=plugins('timepicker/bootstrap-timepicker.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?=plugins('mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?=plugins('bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')?>" rel="stylesheet" type="text/css" />
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
                            <?=form_open('periodos/editar/'.$periodo->p_id)?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="anio">Año<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="anio" name="anio" value="<?php if(set_value('anio')==''){ echo $periodo->p_anio; }else{ echo set_value('anio'); } ?>">
                                        <?=form_error('anio')?>
                                    </div>
                                    <div class="form-group">
                                        <label for="descripcion">Descripción<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php if(set_value('descripcion')==''){ echo $periodo->p_descripcion; }else{ echo set_value('descripcion'); } ?>">
                                        <?=form_error('descripcion')?>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status<span class="text-danger">*</span></label>
                                        <select class="form-control selectpicker" id="status" name="status" data-style="btn-white">
                                            <option value="2" <?=set_select('status', '2',FALSE,$periodo->p_status)?>>Cerrado</option>
                                            <option value="1" <?=set_select('status', '1',FALSE,$periodo->p_status)?>>Activo</option>
                                        </select>
                                        <?=form_error('status')?>
                                        <span class="help-block"><small>El status del periodo indica si esta activo para integrar la programación o cerrado </small></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inicio">Fecha de inicio<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="inicio" name="inicio" value="<?php if(set_value('inicio')==''){ echo $periodo->p_inicio; }else{ echo set_value('inicio'); } ?>">
                                        <?=form_error('inicio')?>
                                    </div>
                                    <div class="form-group">
                                        <label for="fin">Fecha de fin<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="fin" name="fin" value="<?php if(set_value('fin')==''){ echo $periodo->p_fin; }else{ echo set_value('fin'); } ?>">
                                        <?=form_error('fin')?>
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
<script>
    jQuery(document).ready(function() {
        //Año
        jQuery('#anio').datepicker({
            autoclose: true,
            format: "yyyy",
            minViewMode:'years',
        });

        //Fecha
        jQuery('#inicio').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: "yyyy-mm-dd",
            language: 'es'
        });

        jQuery('#fin').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: "yyyy-mm-dd",
            language: 'es'
        });
    });
</script>
</body>
</html>