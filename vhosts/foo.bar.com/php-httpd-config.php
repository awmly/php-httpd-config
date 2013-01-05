<?php

/**
 * php-httpd-config
 * 
 * Map of rules for http requests
 * This acts as a virtual .htaccess and is only needed if http rewrites are required
 * 
 * @param string $rule - rule to catch http requests
 * @param string $path - the directory to which the rule applies
 * @param string $file - the file to send requests to
 * 
 * 
 * ==================
 * Rule Types
 * ==================
 * 
 * all      - all files and directories
 * file     - all files
 * dir      - all directories
 * !file    - not file
 * !dir     - not a directory
 * .ext     - file extension (replace ext with required extension)
 */
 
$Config=array(
    array('rule'=>'all',        'path'=>'/',        'file'=>'/index.php')
);