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
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="btn-group pull-right">
                                <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"> Reportes <span class="caret"></span></button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="<?=base_url('reportes/marco')?>">Marco institucional</a></li>
                                </ul>
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
                                            <div class="m-t-20">
                                                <a href="<?=base_url('area')?>" class="btn btn-white waves-effect waves-light btn-sm">Editar información de área</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="progress progress-md">
                                <div class="progress-bar progress-bar-default" role="progressbar" aria-valuenow="96" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">
                                    Avance programatico / 96%
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-inline m-b-20">
                                        <div class="row">
                                            <div class="col-sm-6 text-xs-center">
                                                <div class="form-group">
                                                    <a href="<?=base_url('objetivos/agregar')?>" class="btn btn-default btn-rounded waves-effect waves-light">
                                                        <span class="btn-label">
                                                            <i class="fa fa-plus m-r-5"></i>
                                                        </span>
                                                        Agregar objetivo
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 text-xs-center text-right">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-actions-bar">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Objetivo particular</th>
                                                    <th style="width: 120px;border: 1px solid #ebeff2">Presupuesto</th>
                                                    <th style="width:80px;">Evaluación</th>
                                                    <th></th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <strong>Objetivo 1</strong>
                                                    </td>
                                                    <td>
                                                        Coordinar, Integrar, dar seguimiento y evaluar el programa operativo anual
                                                    </td>
                                                    <td align="center" style="border: 1px solid #ebeff2;">$ 5000.00</td>
                                                    <td align="center">0 %</td>
                                                    <td style="width:80px;">
                                                        <a href="#" class="table-action-btn" data-toggle="tooltip" data-placement="top" title="Editar registro"><i class="fa fa-pencil-square-o"></i></a>
                                                        <a href="#" class="table-action-btn" data-toggle="tooltip" data-placement="top" title="Eliminar registro"><i class="fa fa-trash-o"></i></a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td><strong>Objetivo 2</strong></td>

                                                    <td>
                                                        Coordinar, Integrar, dar seguimiento y evaluar el programa operativo anual
                                                    </td>
                                                    <td align="center" style="border: 1px solid #ebeff2;">$ 5000.00</td>
                                                    <td align="center">0 %</td>
                                                    <td style="width:80px;">
                                                        <a href="#" class="table-action-btn" data-toggle="tooltip" data-placement="top" title="Editar registro"><i class="fa fa-pencil-square-o"></i></a>
                                                        <a href="#" class="table-action-btn" data-toggle="tooltip" data-placement="top" title="Eliminar registro"><i class="fa fa-trash-o"></i></a>
                                                    </td>
                                                </tr>

                                                <!-- Gran total-->
                                                <tr>
                                                    <td colspan="2" align="right" style="border-right: 1px solid #ebeff2;border-bottom: none;"><strong>Total del presupuesto programado</strong></td>
                                                    <td style="border-right: 1px solid #ebeff2;" align="center"> <p class="text-danger"> <strong>$ 1,000.00</strong></p></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
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