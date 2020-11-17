$(document).ready(function(){

    $('#clave').css('display','none');

    $('#formulario').bind('submit',function(e){
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url:'datos.php',
            data: $('#formulario').serialize(),
            success: function(b){
                $('#resultados').html(b);
                $('#myModal').modal('show');
            }
        });
        // return false;
    });

    $('#encdec').on('click',function(){
        if($(this).prop('checked')){
            $('#clave').css('display','block');
            $('#numeros').css('display','none');
            $('#ultimo').load('decrypt.php');
            $('#btn-Submit').html('Descifrar');
            $('#title').html('Descifrar');
            $('#exampleModalLabel').html('Descifrando mensaje');
        }else{
            $('#clave').css('display','none');
            $('#numeros').css('display','block');
            $('#btn-Submit').html('Encriptar');
            $('#title').html('Encriptar');
            $('#exampleModalLabel').html('Encriptando mensaje');
        }
    });

});