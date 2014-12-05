<?php
/*** Parámetros de configuración ***/

define('DATABASE_HOST', 'localhost');
define('DATABASE_DBNAME', 'airdruino');
define('DATABASE_USERNAME', 'root');
define('DATABASE_USERPASS', '');

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
