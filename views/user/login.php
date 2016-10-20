<!DOCTYPE html>
<html style="background-image: url(<?=images('textura_uptx.png')?>);">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema de Progrmacion Operativa Anual">
    <meta name="author" content="Oficina de Desarrollo de Software / Universidad Politecnica de Tlaxcala">
    <!-- ========== Icon  ========== -->
    <?=$this->load->view('includes/base_favicon','',TRUE)?>
    <!-- ========== /Icon  ========== -->
    <title>Programacion Operativa Anual</title>
    <!-- ========== Base CSS ========== -->
    <?=$this->load->view('includes/base_css','',TRUE)?>
    <!-- ========== /Base CSS ========== -->
</head>
<body style="background-color:transparent !important">
    <div class="wrapper">
        <div class="container-alt container-heead">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <div class="wrapper-page signup-signin-page">
                        <div class="card-box">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="p-20">
                                            <img src="<?=images('logo_poa.png')?>" class="img-responsive" style="margin:0 auto">
                                            <hr>
                                            <!-- ========== Alertas ========== -->
                                            <?=$this->alerts->get()?>
                                            <!-- ========== /Alertas ========== -->
                                            <?=form_open(base_url('login'),'class="form-horizontal m-t-20" data-parsley-validate novalidate')?>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Año</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control input-sm" name="periodo">
                                                        <option value="1" <?=set_select('periodo', '1')?> >2014</option>
                                                    </select>
                                                    <?=form_error('periodo')?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Unidad</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control input-sm" name="unidad">
                                                        <option value="1" <?=set_select('unidad', '1')?> >Secretaria Academica</option>
                                                    </select>
                                                    <?=form_error('unidad')?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Responsable</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control input-sm" name="responsable">
                                                        <option value="1" <?=set_select('responsable', '1')?> >15782- Edwin Oscar Mendez Perez</option>
                                                    </select>
                                                    <?=form_error('responsable')?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Contraseña</label>
                                                <div class="col-sm-8">
                                                    <input name="password" class="form-control input-sm" type="password" value="<?=set_value('password')?>">
                                                    <?=form_error('password')?>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group text-right m-t-20">
                                                <div class="col-xs-12">
                                                    <button type="submit" class="btn btn-default btn-rounded btn-lg btn-block waves-effect waves-light"> Entrar <i class="fa fa-arrow-right"></i> </button>
                                                </div>
                                            </div>
                                            <div class="form-group m-t-20 m-b-0">
                                                <div class="col-sm-12">
                                                    <a href="#" class="text-dark" data-toggle="modal" data-target="#form-contra-modal"><i class="fa fa-lock m-r-5"></i> Olvidaste tu contraseña?</a>
                                                </div>
                                            </div>
                                            <?=form_close()?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="p-20">
                                            <img src="<?=images('back_01.png')?>" class="img-responsive">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <center>
                        <img src="<?=images('logo_uptx_white.png')?>" alt="" style="margin:0 auto; max-width: 200px;opacity: .8">
                    </center>
                </div>
            </div>
        </div>
    </div>
    <!-- ========== Modal Contra  ========== -->
    <?=$this->load->view('includes/recuperarcontra','',TRUE)?>
    <!-- ========== /Modal Contra  ========== -->
    <script>
        var resizefunc = [];
    </script>
    <!-- ========== Base JS ========== -->
    <?=$this->load->view('includes/base_js','',TRUE)?>
    <!-- ========== /Base JS ========== -->
</body>
</html>