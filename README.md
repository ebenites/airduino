airduino
========

Sistema de control de ahorro de energía con arduino.

### Requerimientos

* PHP 5.3 o superior
* php_curl extension    (*sudo apt-get install php5-curl*)
* php_ldap extension    (*sudo apt-get install php5-ldap*)
* MySQL 5.4 o superior

### Seguridad

Las cuentas de usuario serán registradas en el servidor LDAP y deben ser miembros de un grupo especìfico.

Los parámetros de configuración del servidor LDAP están en **config.php*.

### Base de datos

Los parámetros de configuración de la base de datos está en **config.php*

### Créditos

[Erick Benites](https://github.com/ebenites)