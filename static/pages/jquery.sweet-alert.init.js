
/**
* Theme: Ubold Admin Template
* Author: Coderthemes
* SweetAlert
*/

!function($) {
    "use strict";

    var SweetAlert = function() {};

    //examples 
    SweetAlert.prototype.init = function() {
        
    //Basic
    $('#sa-basic').click(function(){
        swal("Here's a message!");
    });

    //A title with a text under
    $('#sa-title').click(function(){
        swal("Here's a message!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat, tincidunt vitae ipsum et, pellentesque maximus enim. Mauris eleifend ex semper, lobortis purus sed, pharetra felis")
    });

    //Success Message
    $('#sa-success').click(function(){
        swal("Good job!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat, tincidunt vitae ipsum et, pellentesque maximus enim. Mauris eleifend ex semper, lobortis purus sed, pharetra felis", "success")
    });

    //Warning Message
    $('#sa-warning').click(function(){
        swal({   
            title: "¿Estas seguro de aprobar este objetivo?",   
            text: "El objetivo será aprobado y no aparecerá nuevamente en la lista de revisiones",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",
            cancelButtonColor: "#FF0000",   
            confirmButtonText: "Aprobar",
            cancelButtonText: "Cancelar",   
            closeOnConfirm: false 
        }, function(){   
            swal("Aprobado!", "El objetivo ha sido aprobado con éxito.", "success"); 
        });
    });

    //Warning Message
    $('#sa-warning2').click(function(){
        swal({   
            title: "¿Estas seguro de no aprobar este objetivo?",   
            text: "El objetivo no será aprobado y volverá a aparecer nuevamente en la lista de revisiones cuando se encuentre disponible",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",
            cancelButtonColor: "#FF0000",   
            confirmButtonText: "No Aprobar",
            cancelButtonText: "Cancelar",   
            closeOnConfirm: false 
        }, function(){   
            swal("No aprobado!", "El objetivo ha sido desaprobado con éxito.", "success"); 
        });
    });

    //Parameter
    $('#sa-params').click(function(){
        swal({   
            title: "Are you sure?",   
            text: "You will not be able to recover this imaginary file!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes, delete it!",   
            cancelButtonText: "No, cancel plx!",   
            closeOnConfirm: false,   
            closeOnCancel: false 
        }, function(isConfirm){   
            if (isConfirm) {     
                swal("Deleted!", "Your imaginary file has been deleted.", "success");   
            } else {     
                swal("Cancelled", "Your imaginary file is safe :)", "error");   
            } 
        });
    });

    //Custom Image
    $('#sa-image').click(function(){
        swal({   
            title: "Sweet!",   
            text: "Here's a custom image.",   
            imageUrl: "assets/plugins/sweetalert/thumbs-up.jpg" 
        });
    });

    //Auto Close Timer
    $('#sa-close').click(function(){
         swal({   
            title: "Auto close alert!",   
            text: "I will close in 2 seconds.",   
            timer: 2000,   
            showConfirmButton: false 
        });
    });


    },
    //init
    $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert
}(window.jQuery),

//initializing 
function($) {
    "use strict";
    $.SweetAlert.init()
}(window.jQuery);