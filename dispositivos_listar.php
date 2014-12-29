<?php
require_once './config.php';
try{
    
    $lista = DispositivoDAO::listar();
    
}catch(Exception $e){
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    die("ERROR: " . $e->getMessage());
}
?>
<table border="1" class="gridtable">
    <colgroup>
        <col width="50"/>
        <col/>
        <col width="50"/>
        <col width="50"/>
    </colgroup>
    <tr>
        <td>ID</td>
        <td>IP</td>
        <td></td>
        <td><img src="img/reload.png" onclick="listar()" title="Recargar"/></td>
    </tr>
  <?php
    foreach($lista as $dispositivo){
  ?>
    <tr>
        <td style="text-align: center"><?php echo $dispositivo->id?></td>
        <td><?php echo $dispositivo->ip?></td>
        <td style="text-align: center"><img src="img/detail.png" onclick="editar('<?php echo $dispositivo->id?>')" title="Configurar"/></td>
        <td style="text-align: center"><img src="img/trash.png" onclick="eliminar('<?php echo $dispositivo->id?>')" title="Eliminar"/></td>
    </tr>
  <?php
    }
  ?>
</table>
