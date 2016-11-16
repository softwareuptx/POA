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
                <!-- Formulario -->
                <?=form_open('area')?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="btn-group pull-right">
                                <button type="submit" class="btn btn-default btn-rounded waves-effect waves-light">
                                    <span class="btn-label">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    Guardar
                                </button>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="contact-card">
                                        <a class="pull-left" href="#">
                                            <img class="img-circle" src="<?=images('avatar_poa.png')?>" alt="">
                                        </a>
                                        <div class="member-info">
                                            <h4 class="m-t-0 m-b-5 header-title"><b><code><span class="text-danger"> #<?=user()->u_refsii.'</span></code> / '.user()->u_nombre.' '.user()->u_appaterno.' '.user()->u_apmaterno?></b></h4>
                                            <p class="text-muted"><?=user()->u_email?></p>
                                            <p class="text-dark"><i class="fa  fa-asterisk"></i> <?=user()->uni_nombre.' / '.user()->a_nombre.' / <strong>'.user()->sub_nombre.'</strong>'?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!-- UNIDAD -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <h4 class="m-t-0 header-title"><b>Unidad académica o administrativa</b></h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mision">Misión<span class="text-danger">*</span></label>
                                        <textarea class="form-control" rows="4" name="mision"><?=set_value('mision',user()->sub_mision)?></textarea>
                                        <?=form_error('mision')?>
                                    </div>
                                    <div class="form-group">
                                        <label for="funcion">Función<span class="text-danger">*</span></label>
                                        <textarea class="form-control" rows="4" name="funcion"><?=set_value('funcion',user()->sub_funcion)?></textarea>
                                        <?=form_error('funcion')?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vision">Visión<span class="text-danger">*</span></label>
                                        <textarea class="form-control" rows="4" name="vision"><?=set_value('vision',user()->sub_vision)?></textarea>
                                        <?=form_error('vision')?>
                                    </div>
                                    <div class="form-group">
                                        <label for="autoevaluacion">Autoevaluación<span class="text-danger">*</span></label>
                                        <textarea class="form-control" rows="4" name="autoevaluacion"><?=set_value('autoevaluacion',user()->sub_autoevaluacion)?></textarea>
                                        <?=form_error('autoevaluacion')?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ./UNIDAD -->
                <!-- FODA -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fortalezas">Fortalezas<span class="text-danger">*</span></label>
                                        <textarea class="form-control" rows="4" name="fortalezas"><?=set_value('fortalezas',user()->sub_fortalezas)?></textarea>
                                        <?=form_error('fortalezas')?>
                                    </div>
                                    <div class="form-group">
                                        <label for="debilidades">Debilidades<span class="text-danger">*</span></label>
                                        <textarea class="form-control" rows="4" name="debilidades"><?=set_value('debilidades',user()->sub_debilidades)?></textarea>
                                        <?=form_error('debilidades')?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="oportunidades">Oportunidades<span class="text-danger">*</span></label>
                                        <textarea class="form-control" rows="4" name="oportunidades"><?=set_value('oportunidades',user()->sub_oportunidades)?></textarea>
                                        <?=form_error('oportunidades')?>
                                    </div>
                                    <div class="form-group">
                                        <label for="amenazas">Amenazas<span class="text-danger">*</span></label>
                                        <textarea class="form-control" rows="4" name="amenazas"><?=set_value('amenazas',user()->sub_amenazas)?></textarea>
                                        <?=form_error('amenazas')?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ./FODA -->
                <!-- PLAN -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="oestatal">Objetivos del Plan Estatal relacionados con la Unidad Académica o Administrativa<span class="text-danger">*</span></label>
                                        <textarea class="form-control" rows="4" name="oestatal"><?=set_value('oestatal',user()->sub_oestatal)?></textarea>
                                        <?=form_error('oestatal')?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="opid">Objetivos del PID relacionados con la función de la Unidad Académica o Administrativa<span class="text-danger">*</span></label>
                                        <textarea class="form-control" rows="4" name="opid"><?=set_value('opid',user()->sub_opid)?></textarea>
                                        <?=form_error('opid')?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ./PLAN -->
                </div>
                <?=form_close()?>
            </div> <!-- container -->
        </div> <!-- content -->
        <!-- ========== Footer ========== -->
        <?=$this->load->view('includes/footer','',TRUE)?>
        <!-- ========== End Footer ========== -->
    </div>

    <div id="form-objetivo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog"> 
            <div class="modal-content"> 
                <div class="modal-header"> 
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                    <h4 class="modal-title"> Recuperar contraseña </h4> 
                </div> 
                <div class="modal-body"> 
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <input type="text" class="form-control" id="field-3" placeholder=" Correo Electronico"> 
                            </div> 
                        </div> 
                    </div> 


                </div> 
                <div class="modal-footer"> 
                    <button type="button" class="btn btn-default btn-rounded waves-effect waves-light"> Solicitar</button> 
                </div> 
            </div> 
        </div>
    </div><!-- /.modal -->
    <!-- END wrapper -->
    <script>
        var resizefunc = [];
    </script>
    <!-- ========== Base JS ========== -->
    <?=$this->load->view('includes/base_js','',TRUE)?>
</body>
</html>