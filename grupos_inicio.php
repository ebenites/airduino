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

        <script src="js/bpopup/jquery.bpopup.min.js"></script>

        <script src="js/ion.sound/jquery.ion.sound.min.js"></script>

        <link href="js/colorbox/colorbox.css" rel="stylesheet" type="text/css" />
        <script src="js/colorbox/jquery.colorbox-min.js"></script>

        <script src="js/smartupdater.4.0.js"></script>

        <script src="js/jquery.placeholder.min.js"></script>
        
        <script src="js/script.js"></script>
        
        <script type="text/javascript">
            $(function(){
                
                listarGrupo();
                
                $('#form-grupo').ajaxForm({
                    clearForm: true,
                    dataType: 'json',
                    success: function(data){
                        //console.log(data.message)
                        popup(data.message);
                        listarGrupo();
                    }
                });
                
            });
            
            function listarGrupo(){
                $('#lista').load('grupos_listar.php');
            }
            function eliminarGrupo(id){
                $('<div/>').html('¿Realmente desea eliminar el registro?').dialog({
                    modal: true,
                    resizable: false,
                    title: 'Confirmacion',
                    width: 300,
                    height: 120,
                    buttons: {
                        "OK": function() {

                            $.get('grupos_eliminar.php', {'id': id}, function(data){

//                                $('<div/>').html(data.message).dialog({
//                                    modal: true,
//                                    resizable: false
//                                });
                                popup(data.message);
                                listarGrupo();

                            }, 'json'); 

                            $(this).dialog('close');
                        },
                        "Cancelar": function(){
                            $(this).dialog('close');
                        }
                    },
                    close:function(){
                        $(this).dialog('destroy');
                        $(this).remove();
                    }
                });
            }
            function editarGrupo(input){
                $(input).hide().next().show().focus().select();
            }
            function actualizarGrupo(input, id){
                $.post('grupos_actualizar.php', {'id': id, 'nombre': $(input).val()}, function(data){
                    $(input).hide().prev().show().text($(input).val());
                }, 'json');
            }
        </script>
        
    </head>
    <body>
        <form id="form-grupo" method="post" action="grupos_crear.php" class="ligthform">
            <fieldset>
                <legend>Registro de grupo</legend>
                <input type="text" name="nombre" size="40" maxlength="40" autocomplete="off" placeholder="Nombre de grupo" required=""/>
                <input type="submit" value="Registrar"/>
            </fieldset>
        </form>
        
        <div id="lista"></div>
        
    </body>
</html>