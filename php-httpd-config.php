<?php

/**
 * php-httpd-config
 * 
 * Map of rules for http requests
 * This acts as a virtual .htaccess and is only needed if http rewrites are required
 * Place this file in the httpdocs root for site
 * 
 * @param string rule - rule to catch http requests
 * @param string ext  - file extenstions to apply redirect to
 * @param string path - the directory to which the rule applies
 * @param string file - the file to send requests to
 * 
 * 
 * ==================
 * Rule Types
 * ==================
 * 
 * all      - all files and directories
 * off      - turn off redirects for current directory
 * file     - all files
 * dir      - all directories
 * !file    - not file
 * !dir     - not a directory
 */
 
$Config=array(
    array('rule'=>'all',    'ext'=>'',              'path'=>'/',            'file'=>'/index.php'),
    array('rule'=>'off',    'ext'=>'ico xml txt',   'path'=>'/',            'file'=>''),
);