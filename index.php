<?php

/**
 * php-httpd-config
 * 
 * A PHP based http request handler
 * 
 */

/** Set path to vhosts directory */
$vhosts_dir='/var/www/php-httpd-config.aw1.me/vhosts/';

/** Get requested domain */
$domain=$_SERVER['SERVER_NAME'];

/** Get requested path */
$path=$_SERVER['REQUEST_URI'];

/** Load requested file */
include($vhosts_dir.$domain.$path);