<?php
$task = isset($_GET['task']) ? $_GET['task'] : false;
if(false === $task)$task = trim($argv[1]);


$help =
'
cc - clear application cache
up - update to the latest version
';
switch($task)
{
    case 'cc':
        gluon_clear_cache();
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

function gluon_clear_cache() {
            
        // init vars
        $classes_path = 'cache/classes.yml.php';
        
        $app_path = 'config/app.yml';
        $app_cpath = 'cache/app.yml.php';
        
        $database_path = 'config/database.yml';
        $database_cpath = 'cache/database.yml.php';
        
        // init classes
        require_once('src/Libraries/gl_Cache.class.php');
        require_once('src/Libraries/gl_ErrorHandler.class.php');
        require_once('src/Libraries/gl_General.class.php');
        $error = new \Libraries\gl_ErrorHandler;
        $cache = new \Libraries\gl_Cache($error);
        
        // delete previous cache
        $cache->delete_cache();
        // get all files in the src folder
        $src = $cache->recurse_get_files(getcwd().'/src','.class.php');
        
        // create the cache for the src folder 
        if(false === $cache->put_classes($src,$classes_path))
            $error->display_errors(true,true);
        
        /******   APP YML   ******/   
            // parse and deal with the application config file
            $app = @yaml_parse_file($app_path);
            
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
        /******   ./APP YML   ******/  
            
        /******   DATABASE YML   ******/
            // parse and deal with the database config file
            $app = @yaml_parse_file($database_path);
            // create database.yml.php
            if(false === $cache->add_config($app,$database_cpath))
                $error->display_errors(true,true);
        /******   ./DATABASE YML   ******/
        
        /******   GATHER THEMES YML   ******/
            if(false === $cache->themes())
                $error->display_errors(true,true);    
        /******   ./GATHER THEMES YML   ******/
        
        /******   BUILD THEMES   ******/
            if(false === $cache->build_themes())
                $error->display_errors(true,true);   
        /******   ./BUILD THEMES   ******/
}
