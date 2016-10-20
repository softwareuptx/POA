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
    <title>POA | Editar Institución</title>
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
                <!-- Menu de navegacion -->
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Agregar Institución</h4>
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?=base_url()?>">poa.uptlax</a>
                            </li>
                            <li>
                                <a href="<?=base_url('instituciones')?>">Instituciones</a>
                            </li>
                            <li class="active">
                                Editar
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- ./Menu de navegacion -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <!-- Formulario -->
                            <?=form_open('instituciones/editar/'.$institucion->in_id)?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre">Nombre de la institución<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php if(set_value('nombre')==''){ echo $institucion->in_nombre; }else{ echo set_value('nombre'); } ?>">
                                        <?=form_error('nombre')?>
                                    </div>
                                    <div class="form-group">
                                        <label for="pagina">Página web</label>
                                        <input type="text" class="form-control" id="pagina" name="pagina" value="<?php if(set_value('pagina')==''){ echo $institucion->in_pagina; }else{ echo set_value('pagina'); } ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono">Teléfono</label>
                                        <input type="text" class="form-control" id="telefono" name="telefono" value="<?php if(set_value('telefono')==''){ echo $institucion->in_telefono; }else{ echo set_value('telefono'); } ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="direccion">Dirección</label>
                                        <textarea class="form-control" name="direccion"><?php if(set_value('direccion')==''){ echo $institucion->in_direccion; }else{ echo set_value('direccion'); } ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vision">Visión<span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="vision" name="vision"><?php if(set_value('vision')==''){ echo $institucion->in_vision; }else{ echo set_value('vision'); } ?></textarea>
                                        <?=form_error('vision')?>
                                    </div>
                                    <div class="form-group">
                                        <label for="mision">Misión<span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="mision" name="mision"><?php if(set_value('mision')==''){ echo $institucion->in_mision; }else{ echo set_value('mision'); } ?></textarea>
                                        <?=form_error('mision')?>
                                    </div>
                                    <div class="form-group">
                                        <label for="politicas">Políticas<span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="politicas" name="politicas"><?php if(set_value('politicas')==''){ echo $institucion->in_politicas; }else{ echo set_value('politicas'); } ?></textarea>
                                        <?=form_error('politicas')?>
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