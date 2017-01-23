<?php
namespace Gluon;
/**
 *  
 *  Gluon
 *  
 *  
                         `                        
                 `'#@@@@@@@@@@@@'.                
              ;@@@'.`.;::::;.  .'@@@'`            
           .#@#.    ;::::::;::     .+@@,          
         .@@'      :::::::::;::       :@@,        
        #@;        ;;;:::::::::         :@@`      
      .@@          ;;;:::::::::           @@,     
     :@+           `;:::::::;:`            '@'    
    ,@'             `;;;::;::.              :@'   
   .@+               :;;;;:,;:`              ;@,  
   @@              `;: ;;,,  ,:.              #@` 
  '@.              :; ,;``:,.`:;              `@+ 
  @#              `,::;,   `,:,,`              '@`
 ,@,           `;;;;;;`      ;;.,,             `@'
 +@            ;;  ,:`       ;; `,,             @@
 #@           `;.  ;;        `;;,,,             #@
 @@          .;;:;;;           `,,;;:           #@
 @@         ;;.;.``            `,.``::,         #@
 +@      .:;;` ;,               ,:   ,:..`      @@
 :@.   ;;;;;;;;;                 ,,,,:,,,,,,   `@'
  @+  ;;;;;;;;;;`.,.   `..`   `.. .:,,,,,,,,,  '@`
  +@`;;;;;;;;;;;;;:;;,,,,,,,.;;;;',,:,,,,,,,,. @# 
   @#;;;;;;;;;;;; `,,;;   .,,,   `:,,,,,,,,,,,+@` 
   ,@';;;;;;;;;;;,,, `';;;;,,:,,,,,,,,,,,,,,:;@;  
    ;@;;;;;;;;;;                  `,,,,,,:,,,@+   
     '@';;;;;;;                    `,,:,:::;@+    
      :@#`.,`                         `..`+@'     
       `@@:                             .@@.      
         :@@,                         .@@'        
           :@@+`                    '@@;          
             `+@@@:`           `,#@@#.            
                 :#@@@@@@@@@@@@@#;`               
                        ```                       

 *  
 *  @author Jeremy Heminger <j.heminger@061375.com>
 *  @copyright © 2017 
 *
 * */
class Core {
    
    /**
     *  @todo this could be added to a class with a remap type operation
     *  @return void
     *  */
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
        $error = new \Gluon\Libraries\ErrorHandler;
        $cache = new \Gluon\Libraries\Cache($error);
        
        $ajax = isset($_POST['method']) ? $_POST['method'] : false;
        
        if(false === $ajax) {
            
            // clear the cache
            define('GLUON_RUN_INSTALL',true);
            include('update.php');
            
            $install_template = \Gluon\Libraries\Cache::get_cache_byfile('admintheme.admin.yml.php',array('install.html.php'));
            \Gluon\View\Render::_echo($install_template,array('page.title'=>'Welcome to Gluon!'));
        }else{
            switch($_POST['method'])
            {
                case 'install_database':
                    $conn = array('mysql:host='.$_POST['data']['dbhost'].';dbname='.$_POST['data']['dbname'],
                                  $_POST['data']['dbusername'],
                                  $_POST['data']['dbpassword']);
                    $db = new \Gluon\Libraries\pdoDatabase(new \Gluon\Libraries\ErrorHandler(),array(),false,0);
                    $db->connect($conn);
                    $sqls = \Gluon\Libraries\Cache::get_cache_byfile('schema.sql.php',false);
                    foreach($sqls as $sql){
                        $db->Query($sql);
                    }
                    
                    // update the database.yml file
                    $dsn = Yaml::parse(@file_get_contents('config/database.yml'));
                    $dsn['param']['dsn'] = 'mysql:host='.$_POST['data']['dbhost'].';dbname='.$_POST['data']['dbname'];
                    $dsn['param']['username'] = $_POST['data']['dbusername'];
                    $dsn['param']['password'] = $_POST['data']['dbpassword'];
                    @file_put_contents('config/database.yml',Yaml::dump($dsn));
                    
                    \Gluon\General::set_session(array('database'),$_POST);
                    
                    break;
                case 'test_ftp':
                    if($_POST['data']['ftpprotocol'] == 'ftp') {
                        if('' == trim($_POST['data']['ftpport']))$_POST['data']['ftpport'] = 21;
                        $con = ftp_connect($_POST['data']['ftphost'],$_POST['data']['ftpport']);
                        $login_result = ftp_login($con,$_POST['data']['ftpusername'],$_POST['data']['ftppassword']);
                    }else{
                        
                        /**
                         *
                         *
                         * @todo find SMTP class that doesn't require an additional PHP module
                         *
                         * 
                         * */
                    }
                    // success ... then update app.yml
                    // update the database.yml file
                    $conn = Yaml::parse(@file_get_contents('config/connect.yml'));
                    $conn['connect']['host'] = $_POST['data']['ftphost'];
                    $conn['connect']['port'] = $_POST['data']['ftpport'];
                    $conn['connect']['protocol'] = $_POST['data']['ftpprotocol'];
                    $conn['connect']['username'] = $_POST['data']['ftpusername'];
                    $conn['connect']['password'] = $_POST['data']['ftppassword'];
                    @file_put_contents('config/connect.yml',Yaml::dump($conn));
                    break;
                case 'add_user':
                    $data = \Gluon\General::post_variable('data',false);
                    if(false === $data) {
                        // set error
                        // die
                    }
                    $enc = new \Gluon\Libraries\Encrypt();
                    $conn = \Gluon\General::get_session(array('database'));
                    $conn = array('mysql:host='.$conn['data']['dbhost'].';dbname='.$conn['data']['dbname'],
                                  $conn['data']['dbusername'],
                                  $conn['data']['dbpassword']);
                    $db = new \Gluon\Libraries\pdoDatabase(new \Gluon\Libraries\ErrorHandler(),array(),false,0);
                    $db->connect($conn);
                    $sql = "INSERT INTO `users`
                        (`username`,`usernice`,`password`,`permissions`,`date_created`)
                    VALUES
                        (:username,:usernice,:password,:permissions,:date_created)";
                    $pass = $enc->encrypt($pass,true,true);
                    $db->Query($sql,array(
                        'username'    =>$data['username'],
                        'usernice'    =>$data['usernice'],
                        'password'    =>$data['password'],
                        'permissions' =>$data['permissions'],
                        'date_created'=>$data['date_created']
                    ));
                    break;
                case 'finalize':
                    // clear the cache
                    define('GLUON_RUN_INSTALL',true);
                    include('update.php');
                    // update the version file
                    $v = json_decode(@file_get_contents('v/.version'));
                    $v->installed = true;
                    @file_put_contents('v/.version',json_encode($v));
                    break;
                default:
                    echo json_encode(array('success' => 0,'message'=>'Method not recognised'));
                    die();
            }
            echo json_encode(array('success' => 1,'message'=>'Success!'));
            die();
            
        }
    }
}