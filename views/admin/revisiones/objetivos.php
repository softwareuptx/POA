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
    <script type="text/javascript">

        function aprobar(objetivo,subarea){
            swal({   
                title: '¿Estas seguro de aprobar este objetivo?',   
                text: "El objetivo será aprobado y no aparecerá nuevamente en la lista de revisiones",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",
                cancelButtonColor: "#FF0000",   
                confirmButtonText: "Aprobar",
                cancelButtonText: "Cancelar",   
                closeOnConfirm: false,
                closeOnCancel: false 
            }, function(isConfirm){
                if (isConfirm){
                    swal("Bien!", "La peticion se ha mandado con éxito, consulta la notificación.", "success");
                    window.location.href="<?php echo base_url(); ?>revisiones/aprobar_objetivo/"+objetivo+"/"+subarea;
                }
                else{
                    swal("No aprobado!", "No se aprobo ningun objetivo", "error");   
                }
            });   
        }

        function desaprobar(objetivo,subarea){
            swal({   
                title: "¿Estas seguro de desaprobar este objetivo?",   
                text: "El objetivo será desaprobado y se volverá a mostrar cuando este disponible a revisión",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",
                cancelButtonColor: "#FF0000",   
                confirmButtonText: "Desaprobar",
                cancelButtonText: "Cancelar",   
                closeOnConfirm: false,
                closeOnCancel: false 
            }, function(isConfirm){
                if (isConfirm){
                    swal("Bien!", "La peticion se ha mandado con éxito, consulta la notificación.", "success");
                    window.location.href="<?php echo base_url(); ?>revisiones/desaprobar_objetivo/"+objetivo+"/"+subarea;
                }
                else{
                    swal("Sin desaprobar!", "No se desaprobo ningun objetivo", "error");   
                }
            });    
        }

        !function($) {
            "use strict";

            var SweetAlert = function() {};
            
            SweetAlert.prototype.init = function() {

            },
            //init
            $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert
        }(window.jQuery),

        //initializing 
        function($) {
            "use strict";
            $.SweetAlert.init()
        }(window.jQuery);
    </script>
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
                            <table id="demo-foo-filtering" class="table table-hover table-actions-bar toggle-circle m-b-0" data-page-size="10">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Objetivo particular</th>
                                        <th data-toggle="true">Presupuesto programado</th>
                                        <th style="width: 120px;"></th>
                                    </tr>
                                </thead>
                                <div class="form-inline m-b-20">
                                    <div class="row">
                                        <div class="col-sm-6 text-xs-right text-right pull-right">
                                            <div class="form-group">
                                                <select id="demo-foo-filter-status" class="form-control">
                                                    <option value="">Mostrar todo</option>
                                                </select>
                                            </div>
                                            <div class="input-group">
                                                <input type="text" id="demo-foo-search" name="example-input1-group2" class="form-control" placeholder="Buscar">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn waves-effect waves-light btn-default"><i class="fa fa-search"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <tbody>
                                    <!-- Contenido de la tabla -->
                                    <?php
                                    if ($objetivos != FALSE){
                                        foreach ($objetivos as $key => $objetivo){
                                            echo "<tr>";
                                            echo "<td>".($key+1)."</td>";
                                            echo "<td>".$objetivo->ob_descripcion."</td>";
                                            echo "<td>".$objetivo->presupuestoprogramado."</td>";
                                            echo '
                                            <td class="middle-align">
                                                <a href="'.base_url('revisiones/acciones/'.$objetivo->ob_id.'/'.$subarea).'" class="table-action-btn2" data-toggle="tooltip" data-placement="top" title="Revisar"><i class="fa fa-edit"></i></a>
                                                <button class="btn btn-success waves-effect waves-light btn-sm" id="sa-warning" onclick="aprobar('.$objetivo->ob_id.','.$subarea.')" data-toggle="tooltip" data-placement="top" title="Aprobar"><span class="fa fa-thumbs-up" aria-hidden="true"> </span> </button>
                                                <button class="btn btn-danger waves-effect waves-light btn-sm" id="sa-warning" onclick="desaprobar('.$objetivo->ob_id.','.$subarea.')" data-toggle="tooltip" data-placement="top" title="Desaprobar"><span class="fa fa-thumbs-down" aria-hidden="true"> </span> </button>
                                            </td>
                                            ';
                                            echo "</tr>";
                                        }
                                    }
                                    ?>
                                    <!-- ./Contenido de la tabla -->
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-sm-12 text-xs-center text-right">
                                    <ul class="pagination pagination-split m-t-30 m-b-0"></ul>
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
    <script>
        var resizefunc = [];
    </script>
    <!-- ========== Base JS ========== -->
    <?=$this->load->view('includes/base_js','',TRUE)?>
</body>
</html>