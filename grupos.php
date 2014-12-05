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
                    success: function(data){
                        //console.log(data.message)
                        info(data.message);
                        listar();
                    },
                    error: function(ajax){
                        error(ajax.responseText);
                    }
                });
                
            });
            
            function listar(){
                $('#lista').load('grupos_listar.php');
            }
            function eliminar(id){
                confirm('¿Realmente desea eliminar el registro?', function(){
                    $.get('grupos_eliminar.php', {'id': id}, function(data){
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
                $.post('grupos_actualizar.php', {'id': id, 'nombre': $(input).val()}, function(data){
                    
                }, 'json');
                $(input).hide().prev().show().text($(input).val());
            }
        </script>
        
    </head>
    <body>
        <form id="form" method="post" action="grupos_crear.php" class="ligthform">
            <fieldset>
                <legend>Registro de grupo</legend>
                <input type="text" name="nombre" size="40" maxlength="40" autocomplete="off" placeholder="Nombre de grupo" required=""/>
                <input type="submit" value="Registrar"/>
            </fieldset>
        </form>
        
        <div id="lista"></div>
        
    </body>
</html>