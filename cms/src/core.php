<?php
namespace Gluon;

class Core {
    public static function install()
    {
        // verbose any errors experienced during an installation
        ini_set('display_errors', 1);
        error_reporting(E_ALL);

        // autoload
        include('cache/classes.yml.php');
        foreach($return as $class) {
            require_once($class);
        }
        // init classes
        $error = new \Libraries\gl_ErrorHandler;
        $cache = new \Libraries\gl_Cache($error);
        
        $ajax = isset($_POST['method']) ? $_POST['method'] : false;
        if(false === $ajax) {
            $install_template = \Libraries\gl_Cache::get_cache_byfile('admintheme.admin.yml.php',array('install.html.php'));
            \View\Render::_echo($install_template,array('page.title'=>'Welcome to Gluon!'));
        }else{
            switch($_POST['method'])
            {
                case 'install_database':
                    $conn = array('mysql:host='.$_POST['data']['dbhost'].';dbname='.$_POST['data']['dbname'],$_POST['data']['dbusername'],$_POST['data']['dbpassword']);
                    $db = new \Libraries\gl_pdoDatabase(new \Libraries\gl_ErrorHandler(),array(),false,0);
                    $db->connect($conn);
                    $sqls = \Libraries\gl_Cache::get_cache_byfile('schema.sql.php',false);

                    foreach($sqls as $sql){
                        $db->Query($sql);
                    }
                    break;
                case 'test_ftp':
                    
                    if($_POST['data']['ftpprotocol'] == 'ftp') {
                        if('' == trim($_POST['data']['ftpport']))$_POST['data']['ftpport'] = 21;
                        $con = ftp_connect($_POST['data']['ftphost'],$_POST['data']['ftpport']);
                        $login_result = ftp_login($con,$_POST['data']['ftpusername'],$_POST['data']['ftppassword']);
                    }else{
                        
                    }
                    break;
                case 'add_user':
                    $enc = new \Libraries\gl_Encrypt();
                    $conn = array('mysql:host='.$_POST['data']['dbhost'].';dbname='.$_POST['data']['dbname'],$_POST['data']['dbusername'],$_POST['data']['dbpassword']);
                    $db = new \Libraries\gl_pdoDatabase(new \Libraries\gl_ErrorHandler(),array(),false,0);
                    $db->connect($conn);
                    //$sql = "INSERT INTO `users` (`username`,`password`,)"
                    break;
                default:
            }

            echo json_encode(array('success' => 1,'message'=>'Success!'));
            die();
            
        }
    }
}