<?php
require_once './config.php';
try{
    
    if(!empty($_POST)){
        
        if(!isset($_POST['usuario']) || strlen($_POST['usuario']) == 0 || !isset($_POST['clave']))
            throw new Exception("No se especificado los parametros requeridos");
        
        $server_ip = LDAP_SERVER;
        $domain = LDAP_DOMAIN;
        $ldap_dn = LDAP_DN;
        $ldap_group = LDAP_GROUP;
        $username = $_POST['usuario'];
        $userpass = $_POST['clave'];
        
        $con = ldap_connect($server_ip);
        ldap_set_option($con, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($con, LDAP_OPT_REFERRALS, 0);
        
        $bind = ldap_bind($con); //Test connection (autenticación anónima)
        
        if ($bind) {
            
            $bind = ldap_bind($con, "$username@$domain", $userpass);
            
            if ($bind) {
                
                $filter = "(sAMAccountName=$username)";
                $attr = array("memberof","displayname","mail");   //http://www.kouti.com/tables/userattributes.htm
                $result = ldap_search($con, $ldap_dn, $filter, $attr);
                $entries = ldap_get_entries($con, $result);
                
//                echo '<pre>'; print_r($entries); die();
                
                $isAdmin = false;
                foreach($entries[0]['memberof'] as $grps) {
                    if (strpos($grps, $ldap_group) !== false) {
                        $isAdmin = true;
                        break;
                    }
                }
                
                if($isAdmin){
                    
                    $user = new stdClass();
                    $user->usuario = $username;
                    $user->nombres = $entries[0]['displayname'][0];
                    $user->correo = $entries[0]['mail'][0];
                    
                    $_SESSION['usuario'] = $user;
                    
                    header('location: portal.php');
                    exit();
                    
                }else{
                    throw new Exception('No tiene permisos para acceder al sistema');
                }
                
            }else{
                throw new Exception('Usuario y/o clave incorrectos');
            }
            
        }else{
            throw new Exception('No se ha podido realizar la conexión con el servidor LDAP');
        }
        
    }
    
}catch(Exception $e){
    Flash::set($e->getMessage());
    header('location: login.php');
    exit();
}
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
        
        <script src="js/jquery.placeholder.min.js"></script>
        
        <script src="js/script.js"></script>

        <script type="text/javascript">
            $(function () {

                $('form [name="usuario"]').focus();
                
            });
	</script>
    </head>
    <body>
        
        <div id="header">
            <img alt="logo" src="img/logo.png" height="60"/>
        </div>

        <div id="content">
            
            <div class="login-div">
            <?php Flash::show()?>
            <form method="post" action="login.php" class="ligthform">
                <fieldset>
                    <legend>Ingreso al Sistema</legend>
                    
                    <input type="text" name="usuario" size="12" maxlength="40" required="required" placeholder="Ingrese usuario" autocomplete="off"/>
                    
                    <input type="password" name="clave" size="12" maxlength="40" placeholder="Ingrese clave"/>
                    
                    <input type="submit" value="Ingresar"/>
                </fieldset>
            </form>
            </div>
            
        </div>
        
        <div id="footer">
            
        </div>

    </body>
</html>