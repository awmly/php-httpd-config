<?php

switch($ext) {
    case "pdf": $ctype="application/pdf"; break;
	case "exe": $ctype="application/octet-stream"; break;
	case "zip": $ctype="application/zip"; break;
	case "doc": $ctype="application/msword"; break;
	case "xls": $ctype="application/vnd.ms-excel"; break;
	case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
	case "gif": $ctype="image/gif"; break;
	case "png": $ctype="image/png"; break;
	case "jpeg":
	case "jpg": $ctype="image/jpg"; break;
	case "mp3": $ctype="audio/mpeg"; break;
	case "wav": $ctype="audio/x-wav"; break;
	case "mpeg":
	case "mpg":
	case "mpe": $ctype="video/mpeg"; break;
	case "mov": $ctype="video/quicktime"; break;
	case "avi": $ctype="video/x-msvideo"; break;
	case "woff": $ctype="application/x-font-woff"; break;
	case "ttf": $ctype="application/x-font-ttf"; break;
	case "js": $ctype="application/javascript"; break;
	case "css": $ctype="text/css"; break;
	case "ico": $ctype="image/x-icon"; break;
	case "php": $ctype="text/html"; break;
	case "html": $ctype="text/html"; break;
	case "ajax": $ctype="text/html"; break;
    case "txt": $ctype="text/plain"; break;
	default: $ctype="application/force-download";
}