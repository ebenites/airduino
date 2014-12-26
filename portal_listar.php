<?php
require_once './config.php';
try{
    
    $grupos = PortalDAO::load();
    $dispositivos = array();
    
}catch(Exception $e){
    die("ERROR: " . $e->getMessage());
}
?>
<?php if(!empty($grupos)){?>
    <?php foreach($grupos as $grupo){ ?>
        <div class="group">
            <div class="group-header"><?php echo $grupo->nombre ?></div>
            <?php foreach($grupo->pines as $pin){ ?>
            <?php   $dispositivos[$pin->dispositivo_id] = $pin->ip; ?>
            <div class="container id-<?php echo $pin->dispositivo_id?>" id="id-<?php echo $pin->dispositivo_id?>-<?php echo $pin->id?>">
                <div class="container-header"><?php echo $pin->nombre?></div>
                <div class="container-body">
                    <div class="ligth"></div>
                    <div class="switch">
                        <label for="radio1" class="cb-enable"><span>ON</span></label>
                        <label for="radio2" class="cb-disable"><span>OFF</span></label>
                    </div>
                </div>
                <div class="container-footer">
                    <img class="float-left" src="img/detail.png" title="IP:<?php echo $pin->ip?> - PIN:<?php echo $pin->id?>">
                    <!--<img class="float-left" src="img/report.png" title="Reporte">-->
                    <!--<img class="float-right" src="img/trash.png" title="Desactivar Terminal">-->
                    <!--<img class="float-right" src="img/edit.png" title="Configurar">-->
                    <!--<img class="float-right" src="img/schedule.png" title="Programador">-->
                </div>
            </div>
            <?php } ?>
        </div>
    <?php } ?>
    <?php foreach ($dispositivos as $dispositivo_id => $dispositivo_ip){ ?>
    <input type="hidden" class="dispositivos" id="<?php echo $dispositivo_ip ?>" value="<?php echo $dispositivo_id ?>"/>
    <?php } ?>
<?php }else{ ?>
    <div class="group empty">No se ha registrado ning&uacute;n dispositivo activo a&uacute;n</div>
<?php } ?>