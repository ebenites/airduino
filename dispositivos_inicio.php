<!DOCTYPE HTML>
<html>
    <head>
        <title>AirDuino</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link href="style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>

        <link href="js/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/jquery-ui/jquery-ui.min.js"></script>
                
        <script src="js/jquery.form.min.js"></script>

        <script src="js/jquery.placeholder.min.js"></script>
        
        <script src="js/script.js"></script>
        
        <script type="text/javascript">
            $(function(){
                
                listar();
                
                $('#form').ajaxForm({
                    clearForm: true,
                    dataType: 'json',
                    beforeSubmit: function(){
                        $('input[type="submit"]').attr('disabled', 'disabled').after($('<span id="loader-1" />'));
                    },
                    success: function(data){
                        //console.log(data.message)
                        $('input[type="submit"]').removeAttr('disabled');
                        $('#loader-1').remove();
                        info(data.message);
                        listar();
                    },
                    error: function(ajax){
                        $('input[type="submit"]').removeAttr('disabled');
                        $('#loader-1').remove();
                        error(ajax.responseText);
                    }
                });
                
            });
            
            function listar(){
                $('#lista').load('dispositivos_listar.php');
            }
            function eliminar(id){
                confirm('¿Realmente desea eliminar el registro?<br/>(Se eliminarán los pines asociados)', function(){
                    $.get('dispositivos_eliminar.php', {'id': id}, function(data){
                        info(data.message);
                        listar();
                    }, 'json').fail(function(ajax) {
                        error(ajax.responseText);
                    }); 
                });
            }
            function editar(input){
                $(input).hide().next().show().focus().select();
            }
            function actualizar(input, id){
                $.post('dispositivos_actualizar.php', {'id': id, 'nombre': $(input).val()}, function(data){
                    $(input).hide().prev().show().text($(input).val());
                }, 'json');
            }
        </script>
        
    </head>
    <body>
        <form id="form" method="post" action="dispositivos_crear.php" class="ligthform">
            <fieldset>
                <legend>Registro de dispositivo</legend>
                <input type="text" name="ip" size="20" maxlength="15" autocomplete="on" placeholder="Dirección IP" required=""/>
                <input type="submit" value="Registrar"/>
            </fieldset>
        </form>
        
        <div id="lista"></div>
        
    </body>
</html>