<?php

date_default_timezone_set('America/Lima');

require_once('lib/httpful.phar');

/* classes autoload */
foreach(glob('classes/*.php') as $file) {
    require_once $file;
}

session_start();
