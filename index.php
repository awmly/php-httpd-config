<?php

/**
 * php-httpd-config
 * 
 * A PHP based http request handler
 * 
 */

/** Get requested domain */
$domain='/var/www/php-httpd-config.aw1.me/vhosts/'.$_SERVER['SERVER_NAME'];

/** Check domain path exists */
if(!is_dir($domain)){ echo "Error: Domain not found"; exit; }

/** add domain dir to include path */
set_include_path(get_include_path().PATH_SEPARATOR.$domain);

/** Get requested path */
$path=(strpos($_SERVER['REQUEST_URI'],'?')) ? substr($_SERVER['REQUEST_URI'],0,strpos($_SERVER['REQUEST_URI'],'?')) : $_SERVER['REQUEST_URI'];

/** Get file extension for requested file */
$ext=(strpos($path,'.')) ? strtolower(substr(strrchr($path,"."),1)) : 'php';

/** Get content type */
switch($ext) {
    case "gif":     $ctype="image/gif"; break;
    case "png":     $ctype="image/png"; break;
    case "jpg":     $ctype="image/jpg"; break;
    case "js":      $ctype="application/javascript"; break;
    case "css":     $ctype="text/css"; break;
    case "ico":     $ctype="image/x-icon"; break;
    case "html":    $ctype="text/html"; break;
    case "htm":     $ctype="text/html"; break;
    case "txt":     $ctype="text/plain"; break;
    default:        $ctype="application/force-download";
}

/** Load config file */
if(is_file($domain."/php-httpd-config.php")) include("php-httpd-config.php");

/** Check rules */
if(is_array($Config)){
    
    foreach($Config as $conf){
        
        $rule=$extension=$redirect_path=false;
        
        /** Check rules */
        if($conf['rule']=='all'){           $rule=true; }
        
        else if($conf['rule']=='off'){      $rule=true; }
        
        else if($conf['rule']=='file'){     if(strstr($path,'.')) $rule=true; }
            
        else if($conf['rule']=='dir'){      if(!strstr($path,'.')) $rule=true; }
            
        else if($conf['rule']=='!file'){    if(strstr($path,'.') && !is_file($vhosts.$domain.$path)) $rule=true; }
            
        else if($conf['rule']=='!dir'){     if(!strstr($path,'.') && !is_dir($vhosts.$domain.$path)) $rule=true; }
        
        /** Check extension */
        if($conf['ext']){
            foreach(explode(" ",$conf['ext']) as $e){ if($e==$ext) $extension=true; } 
        }else{
            $extension=true;
        }
        
        /** Set redirect file if rule, extension and path are true */
        if($rule && $extension && preg_match("/".preg_replace('/\\//','\\/',$conf['path'])."/i",$path)){
            if($conf['rule']=='off') $redirect_path=$path; else $redirect_path=$conf['file'];
        }
        
    }
    
    /** Set new path if redirect_path is set */
    if($redirect_path) $path=$redirect_path;
    
}

/** Check file exists - else load default index */
if(!is_file($domain.$path)) $path=(is_file($domain.'/index.php')) ? '/index.php' : '/index.html';

/** Get extension for dispatch file */
$ext=strtolower(substr(strrchr($path,"."),1));

/** Init output */
if($ext=='php'){
    
    /** Include file */
    include($domain.$path);
    
}else if($ext=='js' || $ext=='css' || $ext=='html' || $ext=='htm' || $ext=='txt'){
    
    /** Open file */
    $c=file_get_contents($domain.$path,FILE_USE_INCLUDE_PATH);
    
    /** Gzip contents if supported by browser */
    if(strstr($_SERVER['HTTP_ACCEPT_ENCODING'],'gzip')){
        $c=gzencode($c);
        header("Content-Encoding: gzip");
    }
    
    /** Set headers */
    header("Content-Length: ".strlen($c));
    header("Content-Type: ".$ctype);
    
    /** Output content */
    echo $c;

}else{
    
    /** Set headers */
    header("Content-Length: ".filesize($domain.$path));
    header("Content-Type: ".$ctype);
    
    /** Open file */
    $handle=fopen($domain.$path,'rb'); 
    
    /** Read file in 1mb chunks */
    while (!feof($handle)) echo fread($handle,(1*1048576));
    
    /** Close file handler */
    fclose($handle); 
    
}