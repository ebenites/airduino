<?php
require_once './config.php';
try{
    
    if(!isset($_GET['id']))
        throw new Exception("No se especificado los parametros requeridos");
    
    $dispositivo = DispositivoDAO::obtener((int)$_GET['id']);
    $grupos = GrupoDAO::listar();
    
//    print_r($dispositivo);
}catch(Exception $e){
    die("ERROR: " . $e->getMessage());
}
?>
<form id="form-update" method="post" action="#" class="ligthform" onsubmit="return false" style="margin-bottom: 0px;">
    <fieldset>
        <legend>Configuraci&oacute;n para <?php echo $dispositivo->ip?></legend>
        <input type="hidden" name="dispositivo_id" value="<?php echo $dispositivo->id?>"/>
        <?php foreach($dispositivo->pines as $pin){ ?>
        <input type="hidden" name="pin[]" value="<?php echo $pin->id?>"/>
        <label>PIN #<?php echo $pin->id?></label>
        <input type="text" name="nombre[]" size="20" maxlength="20" autocomplete="off" placeholder="Nombre de terminal" value="<?php echo $pin->nombre?>" style="width: 100px;"/>
        <select name="grupo[]" style="width: 110px;">
            <option value=""></option>
            <?php foreach($grupos as $grupo){ ?>
            <option value="<?php echo $grupo->id?>" <?php if($pin->grupo_id == $grupo->id){?>selected=""<?php } ?>><?php echo $grupo->nombre?></option>
            <?php }?>
        </select>
        <input type="checkbox" name="estado[]" id="estado-<?php echo $pin->id?>" value="<?php echo $pin->id?>" <?php if($pin->estado == 1){?>checked=""<?php } ?>/><label for="estado-<?php echo $pin->id?>">Estado</label>
        <br/>
        <?php } ?>
        <hr/>
        <div style="height: 30px"><div class="flash-message" style="margin-bottom: 0px; display: none"></div></div>
<!--        <input type="submit" value="Registrar"/>-->
    </fieldset>
</form>