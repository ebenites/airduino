<?php
require_once './config.php';
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>AirDuino</title>
        <link href="favicon.ico" rel="icon" type="image/x-icon" />

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
        
        <script src="js/preloaders/jquery.preloaders.js"></script>

        <script src="js/script.js"></script>

        <script type="text/javascript">
            $(function () {

                $('#menu-grupos, #menu-dispositivos').colorbox({iframe:true, width:'520px', height:'75%', opacity: 0.5});

                listar();
                
            });
	
            function listar(){
                $('#lista').load('portal_listar.php', function(){
                   
                    $('#lista .dispositivos').each(function(){
                        
                        var id = $(this).val();
                        var ip = $(this).attr('id');
                        var dp = $(this);
                        var flag_error = false;
                        
                        dp.smartupdater(
                            {
                                url : 'portal_getdata.php?id='+id, 
                                minTimeout: 3000,
                                dataType: 'json',
                                maxFailedRequests: 3,
                                maxFailedRequestsCb: function(xhr, textStatus, errorThrown){
//                                    console.log(xhr);
                                    error('Problemas con el dispositivo ' + ip + ':<br/>' + xhr.responseText + '<br/>', function(){
//                                        window.location.reload();
                                         if(flag_error){
                                            $('.id-'+id).find('.loading').fadeTo('slow', 0.1).remove();
                                            $('.id-'+id).fadeTo('slow', 1);
                                         }
                                         $('.id-'+id).append($('<div/>').addClass('disable'));
                                         setTimeout(function(){
                                                $('.id-'+id).each(function(){
                                                   $(this).append($('<div/>').addClass('loading').preloader({src:'js/preloaders/sprites.png'}));
                                                });
                                                $('.id-'+id).fadeTo('slow', 0.3);
                                             $('.id-'+id).find('div.disable').remove();
                                             dp.smartupdater('restart');
                                         }, 60000);
                                    });
                                    flag_error = true;
                                },
                                onSuccess: function(data){ //on always success (implementado por EBC)
                                    if(flag_error){
                                        $('.id-'+id).find('.loading').fadeTo('slow', 0.1).remove();
                                        $('.id-'+id).fadeTo('slow', 1);
                                    }
                                }
                            }, function (data) { //onchange data
//                                console.log(data)
                                if(data !== null){
                                    
                                    $(data).each(function(){
                                        
                                        var terminal = $('#id-'+id+'-'+this.pin);
                                        
                                        if(this.status == 0){
                                            $(".cb-enable", terminal).addClass('selected').parents('.switch').find('.cb-disable').removeClass('selected');
                                            $(".cb-enable", terminal).parents('.container').find('.container-header').addClass('selected');
                                        }else{
                                            $(".cb-disable", terminal).addClass('selected').parents('.switch').find('.cb-enable').removeClass('selected');
                                            $(".cb-disable", terminal).parents('.container').find('.container-header').removeClass('selected');
                                        }
                                        
                                    });
                                    
                                }
                            }
                        );
                
                    });
                    
                    $('.container').each(function(){
                        
                        var ids = $(this).attr('id').split("-");
                        var dispositivo_id = ids[1];
                        var pin_id = ids[2];
                        
                        $(".cb-enable", $(this)).click(function(){
                            var btn = $(this);
                            $.post('portal_setdata.php', {'dispositivo_id': dispositivo_id, 'pin_id': pin_id, 'cmd': 'lighton'}, function(data){
                                if(data!== null && data.status == 1){
                                    $(btn).addClass('selected').parents('.switch').find('.cb-disable').removeClass('selected');
                                    $(btn).parents('.container').find('.container-header').addClass('selected');  
                                }
                            }, 'json').fail(function(ajax) {
                                error(ajax.responseText);
                            }); 
                        });
                        
                        $(".cb-disable", $(this)).click(function(){
                            var btn = $(this);
                            $.post('portal_setdata.php', {'dispositivo_id': dispositivo_id, 'pin_id': pin_id, 'cmd': 'lightoff'}, function(data){
                                if(data!== null && data.status == 1){
                                    $(btn).addClass('selected').parents('.switch').find('.cb-enable').removeClass('selected');
                                    $(btn).parents('.container').find('.container-header').removeClass('selected');
                                }
                            }, 'json').fail(function(ajax) {
                                error(ajax.responseText);
                            }); 
                        });
                        
                    });
                    
                });
            }
	</script>
    </head>
    <body>
        
        <div id="header">
            <img alt="logo" src="img/logo.png" height="60"/>
            <div class="welcome">Bienvenido: <?php $user = $_SESSION['usuario']; echo $user->nombres;?></div>
        </div>

        <div id="menu">
            <ul>
                <li><a id="menu-portal" href="portal.php">Inicio</a></li>
                <li><a id="menu-grupos" href="grupos.php" >Grupos</a></li>
                <li><a id="menu-dispositivos" href="dispositivos.php" >Dispositivos</a></li>
                <li><a id="menu-salir" href="logout.php">Salir</a></li>
            </ul>
        </div>
        
        <div id="content">
            
            <div id="lista"></div>
            
        </div>
        
        <div id="footer">
            <a href="https://github.com/ebenites/airduino" target="_blank">AirDuino</a> &COPY; <?php echo date('Y')?> <a href="mailto:erick.benites@gmail.com">erick.benites</a>
        </div>

    </body>
</html>