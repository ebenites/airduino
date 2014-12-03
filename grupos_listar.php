<?php
require_once './config.php';
try{
    
    $lista = GrupoDAO::listar();
    
}catch(Exception $e){
    die("ERROR: " . $e->getMessage());
}
?>
<table border="1" class="gridtable">
    <colgroup>
        <col width="50"/>
        <col/>
        <col width="50"/>
    </colgroup>
    <tr>
        <td>ID</td>
        <td>NOMBRE</td>
        <td><img src="img/reload.png" onclick="listar()" title="Recargar"/></td>
    </tr>
  <?php
    foreach($lista as $grupo){
  ?>
    <tr>
        <td style="text-align: center"><?php echo $grupo->id?></td>
        <td><span onclick="editar(this)"><?php echo $grupo->nombre?></span><input type="text" value="<?php echo $grupo->nombre?>" size="40" maxlength="40" onblur="actualizar(this, '<?php echo $grupo->id?>')" style="display: none"/></td>
        <td style="text-align: center"><img src="img/trash.png" onclick="eliminar('<?php echo $grupo->id?>')" title="Eliminar"/></td>
    </tr>
  <?php
    }
  ?>
</table>
