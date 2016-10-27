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
                            <?=form_open('conceptos/editar/'.$concepto->co_id)?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="clave">Clave del concepto<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="clave" name="clave" value="<?php if(set_value('clave')==''){ echo $concepto->co_clave; }else{ echo set_value('clave'); } ?>">
                                        <?=form_error('clave')?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="capitulo">Capitulo<span class="text-danger">*</span></label>
                                        <select class="form-control selectpicker" data-live-search="true"  id="capitulo" name="capitulo" data-style="btn-white">
                                            <?php
                                            foreach ($capitulos as $key => $capitulo){
                                                echo '<option value="'.$capitulo->ca_id.'" '.set_select('capitulo', $capitulo->ca_id,FALSE,$concepto->co_capitulo).'>'.$capitulo->ca_clave.'-'.$capitulo->ca_descripcion.'</option>';
                                            }
                                            ?>
                                        </select>
                                        <?=form_error('capitulo')?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="descripcion">Descripción<span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="descripcion" name="descripcion"><?php if(set_value('descripcion')==''){ echo $concepto->co_descripcion; }else{ echo set_value('descripcion'); } ?></textarea>
                                        <?=form_error('descripcion')?>
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