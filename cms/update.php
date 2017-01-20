<?php
/**
 *
 *
 * Update for Gluon
 * performs maintenance operations
 *
 * @author Jeremy Heminger <j.heminger@061375.com>
 * 
 *
 *
 * */

 ini_set('display_errors', 1); 
error_reporting(E_ALL);
// include Symfony components as necessary
include_once('vendor/autoload.php');
use Symfony\Component\Yaml\Yaml;


$task = isset($_GET['task']) ? $_GET['task'] : false;
if(false === $task)$task = trim($argv[1]);

$verbose = isset($argv[2]) ? $argv[2] : false;
if('-v' == $verbose)define('VERBOSE',true);;

$help =
'
cc - clear application cache
up - update to the latest version
';
switch($task)
{
    case 'cc':
        gluon_clear_cache($verbose);
        break;
    case 'up':
        break;
    default:
        if (php_sapi_name() !== 'cli') {
            $err = json_encode(array(
                'success'=>false,
                'message'=>'Requested task unrecognized'
            ));
        }else{
            $err = "\nError: task not recognized.\n";
            $err .= $help;
        }
        die($err);
}
/**
 * clears the cache
 * */
function gluon_clear_cache($verbose) {
         
        // init vars
        $classes_path = 'cache/classes.yml.php';
        
        $app_path = 'config/app.yml';
        $app_cpath = 'cache/app.yml.php';
        
        $database_path = 'config/database.yml';
        $database_cpath = 'cache/database.yml.php';
        
        $messages_path = 'config/messages.yml';
        $messages_cpath = 'cache/messages.yml.php';
        
        // init classes
        require_once('src/Libraries/gl_Cache.class.php');
        require_once('src/Libraries/gl_ErrorHandler.class.php');
        require_once('src/Libraries/gl_General.class.php');
        $error = new \Libraries\gl_ErrorHandler;
        $cache = new \Libraries\gl_Cache($error);
        
        // delete previous cache
        $cache->delete_cache();
        
        /******   MESSAGES YML   ******/
            // parse and deal with the messages config file
            $app = Yaml::parse(file_get_contents($messages_path));
            // create messages.yml.php
            if(false === $cache->add_config($app,$messages_cpath))
                $error->display_errors(true,true);
                if(defined('VERBOSE'))print \Libraries\gl_General::message('notice',array('notice','verbose','added'),array(__LINE__,$messages_cpath));
        /******   ./MESSAGES YML   ******/
        
        // get all files in the src folder
        $src = $cache->recurse_get_files(getcwd().'/src','.class.php');
        
        // create the cache for the src folder 
        if(false === $cache->put_classes($src,$classes_path))
            $error->display_errors(true,true);
        
        /******   APP YML   ******/   
            // parse and deal with the application config file
            $app = Yaml::parse(file_get_contents($app_path));
            
            // if an alt src folder is specified
            if(isset($app['src_alt']) AND '' != trim($app['src_alt'])) {
                
                    // get all files in the src folder
                    $src = $cache->recurse_get_files(getcwd().'/src','.php');
                    
                    // TODO: its likely there will be non-class files and such
                    // there needs to be a procedure to resolve these
                    if(false === $cache->put_classes($src,$classes_path)) {
                        $error->display_errors(true,true);       
                    }else{
                        $cache->add_tail($classes_path);
                    }
            }else{
                $cache->add_tail($classes_path);
            } //-- alt_src
           
            // create app.yml.php
            if(false === $cache->add_config($app,$app_cpath))
                $error->display_errors(true,true);
                if(defined('VERBOSE'))print \Libraries\gl_General::message('notice',array('notice','verbose','added'),array(__LINE__,$app_cpath));
        /******   ./APP YML   ******/  
            
        /******   DATABASE YML   ******/
            // parse and deal with the database config file
            $app = Yaml::parse(file_get_contents($database_path));
            // create database.yml.php
            if(false === $cache->add_config($app,$database_cpath))
                $error->display_errors(true,true);
                if(defined('VERBOSE'))print \Libraries\gl_General::message('notice',array('notice','verbose','added'),array(__LINE__,$database_cpath));
        /******   ./DATABASE YML   ******/
        
        /******   GATHER THEMES YML   ******/
            if(false === $cache->themes())
                $error->display_errors(true,true);    
        /******   ./GATHER THEMES YML   ******/
        
        /******   BUILD THEMES   ******/
            $rendered = $cache->build_themes();
            if(false === $rendered)
                $error->display_errors(true,true);
        /******   ./BUILD THEMES   ******/
        
        // add admin themes to cache
        foreach($rendered['admintheme'] as $key => $theme) {
            if(false === $cache->add_config($theme,'cache/admintheme.'.$key.'.yml.php'))
                $error->display_errors(true,true);
                if(defined('VERBOSE'))print \Libraries\gl_General::message('notice',array('notice','verbose','added'),array(__LINE__,'cache/admintheme.'.$key.'.yml.php'));
        }
        
        // add admin themes to cache
        foreach($rendered['theme'] as $key => $theme) {
            if(false === $cache->add_config($theme,'../upload/cache/theme.'.$key.'.yml.php'))
                $error->display_errors(true,true);
                if(defined('VERBOSE'))print \Libraries\gl_General::message('notice',array('notice','verbose','added'),array(__LINE__,'../upload/cache/theme.'.$key.'.yml.php'));
        }

}
