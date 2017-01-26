<?php
include_once('vendor/autoload.php');
include_once('src/core.php');

$url = "http" . (($_SERVER['SERVER_PORT'] == 443) ? "s://" : "://") . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
defined('CURRENT_URL') or define('CURRENT_URL',$url);

define('ROOT',getcwd());

// get version and check if installed
$v = json_decode(@file_get_contents('v/.version'));

if(true === $v->installed) {
    \Gluon\Core::autoload();
    $action = \Gluon\Libraries\General::get_variable('q',false,true);
    
    switch($action) {
        case 'ajax':
            \Gluon\Core::ajax();
            break;
        default:
            // if action is not set then we will try to extract a page from the URL
            \Gluon\Core::run($action);
    }
    // the operation should never get here
    die(__LINE__);
}else{
    // if not installed...then install
    \Gluon\Core::install();
}