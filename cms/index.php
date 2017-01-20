<?php
include_once('vendor/autoload.php');
include_once('src/core.php');

// get version and check if installed
$v = json_decode(@file_get_contents('v/.version'));

if(true === $v->installed) {
    
    
}else{
    // if not installed...then install
    \Gluon\Core::install();
}