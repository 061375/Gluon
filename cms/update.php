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
if(false === $task)$task = isset($argv[1]) ? trim($argv[1]) : false;
if(defined('GLUON_RUN_INSTALL'))$task = '-c';

$option = isset($argv[2]) ? $argv[2] : false;
if('-v' == $option)define('VERBOSE',true);;

$help =
'
[-c] - clear application cache
[-u] - update to the latest version
[-p] - set permissions
[*] [-v] print processes verbose
';
switch($task)
{
    case '-c':
        gluon_clear_cache();
        break;
    case '-u':
        break;
    case '-p':
        if(false === $option)
            die("\nplease provide a user to assign to the updatable folders\n");
        shell_exec('chown -R '.$option.':'.$option.' ../../Gluon');
        shell_exec('chown -R '.$option.':'.$option.' cache');
        shell_exec('chown -R '.$option.':'.$option.' v');
        shell_exec('chown -R '.$option.':'.$option.' config');
        shell_exec('chown -R '.$option.':'.$option.' ../upload/cache');
        //
        shell_exec('chmod -R 755 ../../Gluon');
        shell_exec('chmod -R 777 cache');
        shell_exec('chmod -R 777 v');
        shell_exec('chmod -R 777 config');
        shell_exec('chmod -R 777 ../upload/cache');
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
function gluon_clear_cache() {
         
        // init vars
        $classes_path = 'cache/classes.yml.php';
        
        $app_path = 'config/app.yml';
        $app_cpath = 'cache/app.yml.php';
        
        $database_path = 'config/database.yml';
        $database_cpath = 'cache/database.yml.php';
        
        $schema_path = 'config/schema.sql';
        $schema_cpath = 'cache/schema.sql.php';
        
        $messages_path = 'config/messages.yml';
        $messages_cpath = 'cache/messages.yml.php';
        
        // init classes
        require_once('src/Libraries/Cache.class.php');
        require_once('src/Libraries/ErrorHandler.class.php');
        require_once('src/Libraries/General.class.php');
        $error = new \Gluon\Libraries\ErrorHandler;
        $cache = new \Gluon\Libraries\Cache($error);
        
        // delete previous cache
        $cache->delete_cache();
        
        /******   MESSAGES YML   ******/
            // parse and deal with the messages config file
            $app = Yaml::parse(file_get_contents($messages_path));
            // create messages.yml.php
            if(false === $cache->add_config($app,$messages_cpath))
                $error->display_errors(true,true);
                if(defined('VERBOSE'))
                    print \Gluon\Libraries\General::message('notice',array('notice','verbose','added'),array(__LINE__,$messages_cpath));
        /******   ./MESSAGES YML   ******/
        
        // get all files in the src folder
        $src = $cache->recurse_get_files(getcwd().'/src','.class.php');
        // create the cache for the src folder 
        if(false === $cache->put_classes($src,$classes_path))
            $error->display_errors(true,true);
        
        /******   APP YML   ******/   
            // parse and deal with the application config file
            $app = Yaml::parse(file_get_contents($app_path));
            
            define('WEBROOT',$app['webroot']);
            defined('CURRENT_URL') or define('CURRENT_URL',$app['webroot'].'/cms/');
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
                if(defined('VERBOSE'))
                    print \Gluon\Libraries\General::message('notice',array('notice','verbose','added'),array(__LINE__,$app_cpath));
        /******   ./APP YML   ******/  
            
            
        /******   DATABASE YML   ******/
            // parse and deal with the database config file
            $app = Yaml::parse(file_get_contents($database_path));
            // create database.yml.php
            if(false === $cache->add_config($app,$database_cpath))
                $error->display_errors(true,true);
                if(defined('VERBOSE'))
                    print \Gluon\Libraries\General::message('notice',array('notice','verbose','added'),array(__LINE__,$database_cpath));
        /******   ./DATABASE YML   ******/
    
            
        /******   DATABASE SQL   ******/
            $rebuild = '';
            $sql = @file_get_contents($schema_path);
            $sql = explode("\n",$sql);
            foreach($sql as $line) {
                if(substr(trim($line),0,2) == '--' OR trim($line) == '')continue;
                $rebuild .= $line;
            }
            
            $rebuild = addslashes($rebuild);
            
            $sql = explode(';',$rebuild);
            // create database.yml.php
            if(false === $cache->add_config($sql,$schema_cpath))
                $error->display_errors(true,true);
                if(defined('VERBOSE'))
                    print \Gluon\Libraries\General::message('notice',array('notice','verbose','added'),array(__LINE__,$schema_cpath));
        /******   ./DATABASE SQL   ******/
        
        
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
                if(defined('VERBOSE'))
                    print \Gluon\Libraries\General::message('notice',array('notice','verbose','added'),array(__LINE__,'cache/admintheme.'.$key.'.yml.php'));
        }
        
        // add admin themes to cache
        foreach($rendered['theme'] as $key => $theme) {
            if(false === $cache->add_config($theme,'../upload/cache/theme.'.$key.'.yml.php'))
                $error->display_errors(true,true);
                if(defined('VERBOSE'))
                    print \Gluon\Libraries\General::message('notice',array('notice','verbose','added'),array(__LINE__,'../upload/cache/theme.'.$key.'.yml.php'));
        }

}
