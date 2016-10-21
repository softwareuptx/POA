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
                            <?=form_open('partidas/editar/'.$partida->pa_id)?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="clave">Clave de la partida<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="clave" name="clave" value="<?php if(set_value('clave')==''){ echo $partida->pa_clave; }else{ echo set_value('clave'); } ?>">
                                        <?=form_error('clave')?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tipo">Tipo<span class="text-danger">*</span></label>
                                        <select class="form-control selectpicker" id="tipo" name="tipo" data-style="btn-white">
                                            <option value="1" <?=set_select('tipo', '1',FALSE,$partida->pa_tipo)?>>Genérica</option>
                                            <option value="2" <?=set_select('tipo', '2',FALSE,$partida->pa_tipo)?>>Específica</option>
                                        </select>
                                        <?=form_error('tipo')?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="descripcion">Descripción<span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="descripcion" name="descripcion"><?php if(set_value('descripcion')==''){ echo $partida->pa_descripcion; }else{ echo set_value('descripcion'); } ?></textarea>
                                        <?=form_error('descripcion')?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="indicador">Presupuesto autorizado</label>
                                        <input type="text" class="form-control" id="indicador" name="indicador" value="<?php if(set_value('indicador')==''){ echo $partida->pa_indicador; }else{ echo set_value('indicador'); } ?>">
                                        <?=form_error('indicador')?>
                                    </div>
                                    <div class="form-group">
                                        <label for="concepto">Concepto<span class="text-danger">*</span></label>
                                        <select class="form-control selectpicker" data-live-search="true"  id="concepto" name="concepto" data-style="btn-white">
                                            <?php
                                            foreach ($conceptos as $key => $concepto){
                                                echo '<option value="'.$concepto->co_id.'" '.set_select('concepto', $concepto->co_id,FALSE,$partida->pa_concepto).'>'.$concepto->co_clave.'-'.$concepto->co_descripcion.'</option>';
                                            }
                                            ?>
                                        </select>
                                        <?=form_error('concepto')?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <hr>
                                <div class="pull-left">
                                    <button type="submit" class="btn btn-default btn-rounded waves-effect waves-light">
                                        <span class="btn-label">
                                            <i class="fa fa-refresh"></i>
                                        </span>
                                        Actualizar
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