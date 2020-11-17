$(document).ready(function(){

    // Se esconde el bloque que contiene el input de clave
    $('#clave').css('display','none');

    // Acciones al enviar formulario
    $('#formulario').bind('submit',function(e){
        e.preventDefault();

        // Envio datos del formulario
        $.ajax({
            type: 'POST',
            url:'datos.php',
            data: $('#formulario').serialize(),
            success: function(b){
                // Recibo los datos de php, vuelco los resultados al modal y muestro
                $('#resultados').html(b);
                $('#myModal').modal('show');
            }
        });
        // return false;
    });

    // Acciones al cliquear el switch Encriptar/Descifrar
    $('#encdec').on('click',function(){
        if($(this).prop('checked')){
            // Muestra bloque clave y esconde bloque numeros
            $('#clave').css('display','block');
            $('#numeros').css('display','none');
            // Carga ultimo mensaje guardado en la bd
            $('#ultimo').load('decrypt.php');
            // Cambio textos de boton, titulo y titulo del modal
            $('#btn-Submit').html('Descifrar');
            $('#title').html('Descifrar');
            $('#exampleModalLabel').html('Descifrando mensaje');
        }else{
            // Muestra bloque numeros y esconde bloque clave
            $('#clave').css('display','none');
            $('#numeros').css('display','block');
            // Cambio textos de boton, titulo y titulo del modal
            $('#btn-Submit').html('Encriptar');
            $('#title').html('Encriptar');
            $('#exampleModalLabel').html('Encriptando mensaje');
        }
    });

});