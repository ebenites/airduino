<?php

class Seguridad {
    
    public static function CSRFGenerate(){ //Recomendado solo para sitios publicos
        if(isset($_SESSION['time'])){
            $time = $_SESSION['time'];
        }else{
            $time = time();
            $_SESSION['time'] = $time;
        }
        $token = sha1(SECURITY_SALT . $time);
        echo "<input type='hidden' name='token' value='$token' />";
    }
    
    public static function CSRFCheck($tokenTest) {
        $token = sha1(SECURITY_SALT . $_SESSION['time']);
        if($token != $tokenTest){
            throw new Exception('Error de seguridad');
        }
    }
    
}
