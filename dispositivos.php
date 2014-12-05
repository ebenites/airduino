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
                    beforeSubmit: function(data){
                        $('input[type="submit"]').attr('disabled', 'disabled').after($('<span id="loader-1" />'));
                    },
                    success: function(data){
                        //console.log(data.message)
                        $('input[type="submit"]').removeAttr('disabled');
                        $('#loader-1').remove();
                        listar();
                        editar(data.id, function(){
                            info(data.message);
                        });
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
                        window.parent.listar();
                    }, 'json').fail(function(ajax) {
                        error(ajax.responseText);
                    }); 
                });
            }
            function editar(id, callback){
                $.get('dispositivos_editar.php', {'id': id}, function(data){
                    
                    $('<div/>').html(data).dialog({
                        title: 'Configuración',
                        modal: true,
                        resizable: false,
                        draggable: true,
                        closeOnEscape: false,
                        width: 430,
                        height: 270,
                        show: { effect: "fade", duration: 500 },
                        hide: { effect: "fade", duration: 500 },
                        close:function(){
                            $(this).dialog('destroy');
                            $(this).remove();
                            window.parent.listar();
                        }
                    });
                    
                    $('input[type="checkbox"]').button();
                    
                    var dispositivo_id = $('#form-update [name="dispositivo_id"]').val();
                    
                    $('#form-update [name="pin[]"]').each(function(i){
                        var pin_id = $(this).val();
                        $('#form-update [name="nombre[]"]').eq(i).change(function(){
                            if(!$('#form-update [name="nombre[]"]').eq(i).val() && $('#form-update [name="estado[]"]').eq(i).is(':checked')){
                                $('#form-update [name="estado[]"]').eq(i).trigger('click');
                            }
                            $.post('dispositivos_actualizar.php', {'action': 'nombre', 'dispositivo_id': dispositivo_id, 'pin_id': pin_id, 'nombre': $(this).val()}, function(data){
                                showFlash(data.message);
                            }, 'json').fail(function(ajax) {
                                error(ajax.responseText);
                            }); 
                        });
                        $('#form-update [name="grupo[]"]').eq(i).change(function(){
                            if(!$('#form-update [name="grupo[]"]').eq(i).val() && $('#form-update [name="estado[]"]').eq(i).is(':checked')){
                                $('#form-update [name="estado[]"]').eq(i).trigger('click');
                            }
                            $.post('dispositivos_actualizar.php', {'action': 'grupo', 'dispositivo_id': dispositivo_id, 'pin_id': pin_id, 'grupo': $(this).val()}, function(data){
                                showFlash(data.message);
                            }, 'json').fail(function(ajax) {
                                error(ajax.responseText);
                            }); 
                        });
                        
                        $('#form-update [name="estado[]"]').eq(i).change(function(e){
                            if($(this).is(':checked') && (!$('#form-update [name="nombre[]"]').eq(i).val() || !$('#form-update [name="grupo[]"]').eq(i).val())){
                                $(this).removeAttr('checked');
                                $(this).button('refresh');
                                error('Debe especificar un nombre y un grupo antes de activar');
                                return;
                            }
                            $.post('dispositivos_actualizar.php', {'action': 'estado', 'dispositivo_id': dispositivo_id, 'pin_id': pin_id, 'estado': $(this).is(':checked')}, function(data){
                                showFlash(data.message);
                            }, 'json').fail(function(ajax) {
                                error(ajax.responseText);
                            }); 
                        });
                        
                    });
                    
                    if(callback)callback();
                    
                }).fail(function(ajax) {
                    error(ajax.responseText);
                }); 
            }
            var timer;
            function showFlash(message) {
                clearTimeout(timer);
//                $('.flash-message').hide();
                $('.flash-message').html(message).fadeIn();
                timer = setTimeout(function(){
                    $('.flash-message').fadeOut();
                }, 2000)
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