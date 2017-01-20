<?php
namespace Gluon;

class Core {
    public static function install()
    {
        // init classes
        // these should be in the cache at this point so I will be rewriting this 
        require_once('src/View/Render.class.php');
        require_once('src/Libraries/gl_Cache.class.php');
        require_once('src/Libraries/gl_ErrorHandler.class.php');
        require_once('src/Libraries/gl_General.class.php');
        require_once('src/Libraries/gl_pdoDatabase.class.php');
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
                    $schema = \Libraries\gl_Cache::get_cache_byfile('schema.yml.php',array('*'));
                    $conn = array('mysql:host='.$_POST['data']['dbhost'].';dbname='.$_POST['data']['dbname'],$_POST['data']['dbusername'],$_POST['data']['dbpassword']);
                    $db = new \Libraries\gl_pdoDatabase($conn);
                    $l = count($schema);
                    for($i=0;$i<$l;$i++) {
                        $db->Query($schema[$i]);
                    }
                    break;
                case 'test_ftp':
                    
                    if($_POST['data']['ftpprotocol'] == 'ftp') {  
                        $con = ftp_connect($_POST['data']['ftphost'],$_POST['data']['ftpport']);
                        $login_result = ftp_login($con,$_POST['data']['ftpusername'],$_POST['data']['ftppassword']);
                    }else{
                        
                    }
                    break;
                case 'add_user':
                    $conn = array('mysql:host='.$_POST['data']['dbhost'].';dbname='.$_POST['data']['dbname'],$_POST['data']['dbusername'],$_POST['data']['dbpassword']);
                    $db = new \Libraries\gl_pdoDatabase($conn);
                    break;
                default:
            }

            echo json_encode(array('success' => 1,'message'=>'Success!'));
            die();
            
        }
    }
}