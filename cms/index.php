<?php
/**
 * @todo this should be in an init file
 * */
$url = "http" . (($_SERVER['SERVER_PORT'] == 443) ? "s://" : "://") . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$url = str_replace(substr($url,strpos($url,'/cms')+5,strlen($url)),'',$url);
defined('CURRENT_URL') or define('CURRENT_URL',$url);

define('ROOT',getcwd());

include_once('vendor/autoload.php');
include_once('src/core.php');
$gluon = new \Gluon\Core();

/**
 * @todo this should be in the core
 * */
// get version and check if installed
$v = json_decode(@file_get_contents('v/.version'));

if(true === $v->installed) {
    
    
    \Gluon\Core::autoload();
    $action = \Gluon\Libraries\General::get_variable('q',false,true);
    switch((isset($action[0]) ? $action[0] : '')) {
        case 'ajax':
            $gluon->ajax($action);
            break; 
        default:
            // if action is not set then we will try to extract a page from the URL
            $gluon->run($action);
    }
    
    
    // the operation should never get here
    die(__LINE__);
}else{
    
    // if not installed...then install
    $gluon->install();
    
} // ./ifinstalled