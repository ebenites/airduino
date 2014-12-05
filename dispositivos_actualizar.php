<?php
require_once './config.php';
try{
    
    if(!isset($_POST['action']) || !isset($_POST['dispositivo_id']) || (int)$_POST['dispositivo_id']==0 || !isset($_POST['pin_id']) || (int)$_POST['pin_id']==0)
        throw new Exception("No se especificado los parametros requeridos");
    
    switch ($_POST['action']) {
        case 'nombre':
            DispositivoDAO::actualizarNombre((int)$_POST['dispositivo_id'], (int)$_POST['pin_id'], $_POST['nombre']);
            break;
        
        case 'grupo':
            $grupo = ((int)$_POST['grupo'])!=0?(int)$_POST['grupo']:NULL;
            DispositivoDAO::actualizarGrupo((int)$_POST['dispositivo_id'], (int)$_POST['pin_id'], $grupo);
            break;
        
        case 'estado':
            $estado = ($_POST['estado']=='true')?1:0;
            DispositivoDAO::actualizarEstado((int)$_POST['dispositivo_id'], (int)$_POST['pin_id'], $estado);
            break;
        
        default:
            throw new Exception("Operación no válida");
            break;
    }
        
    echo json_encode($data = array('type' => 'success', 'message' => 'Se ha guardado los cambios'));
    
}catch(Exception $e){
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    die($e->getMessage());
}
?>