<?php
namespace Gluon;
// include Symfony components as necessary
use Symfony\Component\Yaml\Yaml;
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
 *  @copyright � 2017 
 *
 * */
class Core {
    
    
    public $global;
    
    public $classes;
    
    public $messages;
    
    
    function __construct() {
        // initilize the base classes
        require_once('src/Libraries/General.class.php');
        require_once('src/Libraries/ErrorHandler.class.php');
        require_once('src/Libraries/Cache.class.php');
        // init classes
        $this->classes['error'] = new \Gluon\Libraries\ErrorHandler;
        $this->classes['cache'] = new \Gluon\Libraries\Cache($this->classes['error']);
        $this->messages = $this->classes['cache']->get_cache_byfile('messages.yml.php');
        $GLOBALS['app'] = $this->classes['cache']->get_cache_byfile('app.yml.php');
    }
    /**
     * includes all classes that are stored in cache
     * @return void
     * */
    public static function autoload() {
        // autoload
        include('cache/classes.yml.php');
        foreach($return as $class) {
            require_once($class);
        }
    }
    
    /**
     *  admin/blah/a/b/c
     *  
     *  class Admin {
            function blah($param) {
                $param[0] = 'a'
                $param[1] = 'b'
                $param[2] = 'c'
                ...
                ...
            }
        }
     * @param mixed $a
     * @return void
     * */
    public function run($a) {
        // connect to database
        $GLOBALS['db'] = \Gluon\Libraries\Database::connect();
        
        // make sure the user isn't below the admin at least
        if(!isset($a[0]) OR trim($a[0]) == '') {
            header('location: '.CURRENT_URL.'admin');
            die();
        }
        
        // destroy any old sessions
        \Gluon\Libraries\User::destroyold_sessions();

        // permissions
        $s = \Gluon\Libraries\User::get_session();

        // if fail set $a[1] == 'login'
        if(false !== $s) {
            if(true === $this->classes['error']->has_error()) 
                $this->classes['error']->display_errors(true);
            if(count($s) < 1) {
                $a[1] = 'login';
            }else{
                if($s[0]['username'] != \Gluon\Libraries\General::get_session(array('user','username'),false))
                    $a[1] = 'login';
            }
        }

        if(!isset($a[1]) OR trim($a[1]) == '')$a[1] = 'index';
        
        // if method exists - run it
        if(method_exists("\Gluon\Controller\\".$a[0],$a[1])) {
            $m = "\Gluon\Controller\\".$a[0];
            $m = new $m();
            $m->$a[1]($a);
            if(true === $this->classes['error']->has_error()) {
                $this->classes['error']->display_errors(true);
            }
        }else{
            /**
             * @todo this should check for plugins then fall off to pages
             * */
            
            
            // check if this is a simple page within the admin
            // via sql
            
            /**
             *  @todo if no page found this should pass to a 404 page
             *  */
            header('HTTP/1.0 404 Not Found');
            die('METHOD DOES NOT EXIST');
        } // ./method_exists
    }
    /**
     *  admin/blah/a/b/c
     *  
     *  class Admin {
            function blah($param) {
                $param[0] = 'a'
                $param[1] = 'b'
                $param[2] = 'c'
                ...
                ...
            }
        }
     * @param mixed $a
     * @return void
     * */
    public function ajax($a) {
        
        define('ISAJAX',true);
        
        /**
         * @todo this should check against the login. the URL should contain a hash from the database based on IP
         * */
        if(method_exists("\Gluon\Controller\\".$a[1],$a[2])) {
            $m = "\Gluon\Controller\\".$a[1];
            $m = new $m();
            $result = $m->$a[2]();
            if(true === $this->classes['error']->has_error()) {
                $this->classes['error']->display_errors();
            }else{
                \Gluon\View\Render::ajax($result);
            }
        }else{
            $this->classes['error']->set_error_message('method does not exist');
            $this->classes['error']->display_errors();
        }  // ./method_exists 
    }
    
    
    
    
    
    
    
    
    
    
    
    /**
     *
     * */
    public function get($key) {
        return $this->global[$key];   
    }
    /**
     *
     * */
    public function set($key,$var) {
        $this->global[$key] = $var;   
    }
    /*
     *
     * */
    
    
    
    
    
    
    
    
    
    
    /**
     *  @todo this could be added to a class with a remap type operation
     *  @return void
     *  */
    public function install()
    {
        // verbose any errors experienced during an installation
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        
        require_once('src/Libraries/ErrorHandler.class.php');
        require_once('src/Libraries/Cache.class.php');
        // init classes
        $error = new \Gluon\Libraries\ErrorHandler;
        $cache = new \Gluon\Libraries\Cache($error);
        
        // if ajax call from setup form
        $ajax = isset($_POST['method']) ? $_POST['method'] : false;
        if(false === $ajax) { // ifajax
            
            // we need to edit the .htaccess file (if possible to meet the requirements of the local folder)
            $htaccess = @file_get_contents('.htaccess');
            if(false === $htaccess) {
                // error
                die("There was an error opening the .htaccess file in the cms folder");
            }else{
                $out = '';
                $lines = explode("\n",$htaccess);
                foreach($lines as $line) {
                    if(strpos($line,'index.php?q=$1 [L]') !== false) {
                        $out .= 'RewriteRule ^(.*)$ '.$_SERVER['REQUEST_URI']."index.php?q=$1 [L]\n";
                    }else{
                        $out .= $line."\n";
                    }
                }
                if(strpos($out,$htaccess) === false)
                if(false === @file_put_contents('.htaccess',$out)){
                    echo("There was an error editing the .htaccess file in the cms folder.<br />");
                    echo("Please update the file with these settings:<br />");
                    die("<pre>".$out."</pre>");
                }
            }// ./ edit .htaccess
            
            // clear the cache
            define('GLUON_RUN_INSTALL',true);
            include('update.php');
            
            // autoload
            include('cache/classes.yml.php');
            foreach($return as $class) {
                require_once($class);
            } // ./autoload
            
            $install_template = \Gluon\Libraries\Cache::get_cache_byfile('admintheme.admin.yml.php',array('install.html.php'));
            \Gluon\View\Render::_echo($install_template,array('page.title'=>'Welcome to Gluon!'));
        }else{
            
            
            // autoload
            include('cache/classes.yml.php');
            foreach($return as $class) {
                require_once($class);
            }// ./autoload
            
            switch($_POST['method'])
            {
                case 'install_database':
                    $_POST['method'] = 'test_database';
                    $result = \Gluon\Libraries\General::simpleCurl(CURRENT_URL,$_POST,false);
                    if(200 != $result) {
                        echo json_encode(array('success' => 0,'message'=>'Database connection failed'));
                        die();   
                    }
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
                    
                    \Gluon\Libraries\General::set_session('database',$_POST);
                    
                    break;
                case 'test_database':
                    $conn = array('mysql:host='.$_POST['data']['dbhost'].';dbname='.$_POST['data']['dbname'],
                                  $_POST['data']['dbusername'],
                                  $_POST['data']['dbpassword']);
                    $db = new \Gluon\Libraries\pdoDatabase(new \Gluon\Libraries\ErrorHandler(),array(),false,0);
                    $db->connect($conn);
                    die('200');
                    break;
                case 'test_ftp':
                    if($_POST['data']['ftpskip'] == true)die('200');
                    
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
                    die('200');
                    break;
                case 'add_ftp':
                    $_POST['method'] = 'test_ftp';
                    if(200 != \Gluon\Libraries\General::simpleCurl(CURRENT_URL,$_POST,false)) {
                        echo json_encode(array('success' => 0,'message'=>'FTP connection failed'));
                        die();   
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
                    $data = \Gluon\Libraries\General::post_variable('data',false);
                    if(false === $data) {
                        // set error
                        // die
                    }
                    //echo '<pre>';print_r( $data);exit();/*REMOVE ME*/
                    $enc = new \Gluon\Libraries\Encrypt();
                    $conn = \Gluon\Libraries\General::get_session('database');
                    $conn = array('mysql:host='.$conn['data']['dbhost'].';dbname='.$conn['data']['dbname'],
                                  $conn['data']['dbusername'],
                                  $conn['data']['dbpassword']);
                    $db = new \Gluon\Libraries\pdoDatabase(new \Gluon\Libraries\ErrorHandler(),array(),false,0);
                    $db->connect($conn);
                    $sql = "INSERT INTO `users`
                        (`username`,`usernice`,`password`,`permissions`,`ip`,`session`,`extra`,`date_created`)
                    VALUES
                        (:username,:usernice,:password,:permissions,:ip,:session,:extra,:date_created)";
                    $pass = $enc->encrypt($data['password'],true,true);
                    $db->Query($sql,array(
                        'username'    =>$data['username'],
                        'usernice'    =>$data['friendlyname'],
                        'password'    =>$pass,
                        'permissions' =>1,
                        'ip'          =>'',
                        'session'     =>'',
                        'extra'       =>'',
                        'date_created'=>date('Y-m-d H:i:s',strtotime('now'))
                    ));
                    unset($_SESSION['database']);
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
            
        } // ./ ifajax
    }
}