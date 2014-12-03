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

        <script src="js/script.js"></script>

        <script type="text/javascript">
            $(function () {

                $('#menu a').colorbox({iframe:true, width:'520px', height:'75%', opacity: 0.5});

                $("#content").smartupdater({
                        url : 'getdata.php?IP=192.168.116.23', //this.id
                        minTimeout: 3000, // 3 seconds
                        dataType: 'json',
                        maxFailedRequests: 5,
                        maxFailedRequestsCb: function(xhr, textStatus, errorThrown){
                                alert("Problemas en la conexion");
                        }
                        }, function (data) {
                                //console.log(data)
                                if(data != null){
                                        if(data.status == 0){ //corregir no deberia afectar a todos los .cb-enable y .cb-disable
                                                var parent = $(".cb-enable").parents('.switch');
                                                $('.cb-disable', parent).removeClass('selected');
                                                $(".cb-enable").addClass('selected');
                                                var container = $(".cb-enable").parents('.container');
                                                $('.container-header', container).addClass('selected');
                                        }else{
                                                var parent = $(".cb-disable").parents('.switch');
                                                $('.cb-enable', parent).removeClass('selected');
                                                $(".cb-disable").addClass('selected');
                                                var container = $(".cb-disable").parents('.container');
                                                $('.container-header', container).removeClass('selected');
                                        }
                                }
                        }
                );


                $(".cb-enable").click(function(){
                        var btn = $(this);
                        $.getJSON('setdata.php', {'IP': '192.168.116.23', 'CMD': 'lighton'}, function(data){
                                if(data!= null && data.status == 1){
                                        var parent = $(btn).parents('.switch');
                                        $('.cb-disable', parent).removeClass('selected');
                                        $(btn).addClass('selected');
                                        var container = $(btn).parents('.container');
                                        $('.container-header', container).addClass('selected');
                                }
                        });
                });
                $(".cb-disable").click(function(){
                    var btn = $(this);
                    $.getJSON('setdata.php', {'IP': '192.168.116.23', 'CMD': 'lightoff'}, function(data){
                            if(data!= null && data.status == 1){
                                    var parent = $(btn).parents('.switch');
                                    $('.cb-enable', parent).removeClass('selected');
                                    $(btn).addClass('selected');
                                    var container = $(btn).parents('.container');
                                    $('.container-header', container).removeClass('selected');
                            }
                    });
                });

            });
									
	</script>
    </head>
    <body>
        
        <div id="header">
            <img alt="logo" src="logo.png" height="60"/>
            <div class="welcome">Bienvenido: Dr. Arduino</div>
        </div>

        <div id="menu">
            <ul>
                <li><a href="#">Inicio</a></li>
                <li><a href="grupos_inicio.php" >Grupos</a></li>
                <li><a href="dispositivos_inicio.php" >Dispositivos</a></li>
            </ul>
        </div>
        
        <div id="content">

            <?php for($g=0; $g<3; $g++){ ?>
                <div class="group">
                    <div class="group-header">Pabellón</div>
                    <?php for($i=0; $i<10; $i++){ ?>
                    <div class="container" id="ID-192.168.116.23-12">
                        <div class="container-header">Airduino #1</div>
                        <div class="container-body">
                            <div class="ligth"></div>
                            <div class="switch">
                                <label for="radio1" class="cb-enable"><span>ON</span></label>
                                <label for="radio2" class="cb-disable"><span>OFF</span></label>
                            </div>
                        </div>
                        <div class="container-footer">
                                <img class="float-left" src="img/detail.png" title="IP:192.168.116.23 - PIN:12">
                                <img class="float-left" src="img/report.png">
                                <img class="float-right" src="img/trash.png">
                                <img class="float-right" src="img/edit.png">
                                <img class="float-right" src="img/schedule.png">
                        </div>
                    </div>
                    <?php } ?>
                </div>
            <?php } ?>

        </div>
        
        <div id="footer">
            Todos los Derechos Reservados <?php echo date('Y')?>
        </div>

    </body>
</html>