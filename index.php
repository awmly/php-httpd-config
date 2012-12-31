<?php

/**
 * php-httpd-config
 * 
 * A PHP based http request handler
 * 
 */

/** Set path to vhosts directory */
$vhosts='/var/www/php-httpd-config.aw1.me/vhosts/';

/** Get requested domain */
$domain=$_SERVER['SERVER_NAME'];

/** Get requested path */
$req=explode("?",$_SERVER['REQUEST_URI']);
$path=$req[0];
$query=$req[1];

/** Check domain path exists */
if(!is_dir($vhosts.$domain)){ echo "Error: Domain not found"; exit; }

/** add domain dir to include path */
set_include_path(get_include_path().PATH_SEPARATOR.$vhosts.$domain);

/** Load config file */
if(is_file($vhosts.$domain."/php-httpd-config.php")) include("php-httpd-config.php");

/** Check rules */
if(is_array($Config)){
    
    foreach($Config as $conf){
        
        
        
    }
    
}

/** Check file exists - else load default index */
if(!is_file($vhosts.$domain.$path)) $path=(is_file($vhosts.$domain.'/index.php')) ? '/index.php' : '/index.html';

/** Set full file path */
$file=$vhosts.$domain.$path;

/** Get file extension */
$ext=strtolower(substr(strrchr($file,"."),1));

/** Load mimetypes list */
include("mimetypes.php");

/** Set header - content type */
header("Content-Type: ".$ctype);

/** Init output */
if($ext=='php'){
    
    /** Include file */
    include($file);
    
}else if($ext=='js' || $ext=='css' || $ext=='html' || $ext=='htm' || $ext=='txt'){
    
    /** Open file */
    $c=file_get_contents($file,FILE_USE_INCLUDE_PATH);
    
    /** Gzip contents if supported by browser */
    if(strstr($_SERVER['HTTP_ACCEPT_ENCODING'],'gzip')){
        $c=gzencode($c);
		header("Content-Encoding: gzip");
    }
    
    /** Set header - content length */
    header("Content-Length: ".strlen($c));
    
    /** Output content */
    echo $c;

}else{
    
    /** Set header - content length */
    header("Content-Length: ".filesize($file));
    
    /** Open file */
    $handle=fopen($file,'rb'); 
    
    /** Read file in 1mb chunks */
    while (!feof($handle)) echo fread($handle,(1*1048576));
    
    /** Close file handler */
    fclose($handle); 
    
}