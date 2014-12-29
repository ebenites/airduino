<?php
/*** Parámetros de configuración ***/

// Database
define('DATABASE_HOST', 'localhost');
define('DATABASE_DBNAME', 'airdruino');
define('DATABASE_USERNAME', 'root');
define('DATABASE_USERPASS', '');

// LDAP
define('LDAP_SERVER', '192.168.73.23');
define('LDAP_DOMAIN', 'tecsup.edu.pe');
define('LDAP_DN', 'dc=TECSUP-LIM,dc=LOCAL');
define('LDAP_GROUP', 'CN=AirDuino-Admin,OU=Sistemas,OU=Grupos,DC=TECSUP-LIM,DC=LOCAL');

// https://www.grc.com/passwords.htm
define('SECURITY_SALT', 'b79jsMaEzXMvCO2iWtzU2gT7rBoRmQzlvj5yNVgP4aGOrZ524pT5KoTDJ7vNiIN');

date_default_timezone_set('America/Lima');

/*** Bootstrap ***/

/* load libraries */
require_once('lib/httpful.phar');

/* autoload classes */
foreach(glob('classes/*.php') as $file) {
    require_once $file;
}

session_start();

/*** Seguridad ***/

if(basename($_SERVER['REQUEST_URI'], ".php") != 'login'){
    if(!isset($_SESSION['usuario'])){
        if(basename($_SERVER['REQUEST_URI'], ".php") == 'portal'){
            Flash::set('Acceso no autorizado, debe iniciar sesión');
            header('location: login.php');
            exit();
        }else{
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
            die('Acceso no autorizado, debe iniciar sesión');
        }
    }
}