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
                                                        <?php
                                                        foreach ($periodos as $key => $periodo){
                                                            echo '<option value="'.$periodo->p_id.'"'.set_select('periodo', $periodo->p_id).'>'.$periodo->etiqueta.'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <?=form_error('periodo')?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Unidad</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control input-sm selectpicker" data-live-search="true" data-style="btn-white" id="unidad" name="unidad">
                                                        <option></option>
                                                        <?php
                                                        foreach ($unidades as $key => $unidad){
                                                            echo '<option value="'.$unidad->uni_id.'"'.set_select('unidad', $unidad->uni_id).'>'.$unidad->uni_nombre.'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <?=form_error('unidad')?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Área</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control input-sm" data-live-search="true" id="area" name="area">
                                                    </select>
                                                    <?=form_error('area')?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Responsable</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control input-sm" data-live-search="true" id="responsable" name="responsable">
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
    <script type="text/javascript">

        jQuery(function($) {
            unidad_id = $('#unidad').val();

            if(unidad_id!='')
            {
                $.getJSON("<?=base_url('rest/getareas')?>/"+unidad_id)
                .done(function( data ){
                    $("#responsable").empty();
                    $("#area").empty();
                    $("#area").append('<option>Seleccione un área...</option>');
                    $.each(data, function(id,area){
                        $("#area").append('<option value="'+area.a_id+'">'+area.a_nombre+'sd</option>');
                    });
                });
            } 
        });
        //Funcion para sacar lista de areas
        $('#unidad').on('change', function(){
            unidad_id = $(this).find(":selected").val();
            $.getJSON("<?=base_url('rest/getareas')?>/"+unidad_id)
            .done(function( data ){
                $("#responsable").empty();
                $("#area").empty();
                $("#area").append('<option>Seleccione un área...</option>');
                $.each(data, function(id,area){
                    $("#area").append('<option value="'+area.a_id+'">'+area.a_nombre+'</option>');
                });
            });
        });

        //Funcion para sacar lista de usuarios
        $('#area').on('change', function(){
            area_id = $(this).find(":selected").val();
            $.getJSON("<?=base_url('rest/getpersonas')?>/"+area_id)
            .done(function( data ){
                $("#responsable").empty();
                $.each(data, function(id,responsable){
                    $("#responsable").append('<option value="'+responsable.u_id+'">'+responsable.u_refsii+'-'+responsable.u_nombre+' '+responsable.u_appaterno+' '+responsable.u_apmaterno+'</option>');
                });
            });
        });
    </script>
</body>
</html>