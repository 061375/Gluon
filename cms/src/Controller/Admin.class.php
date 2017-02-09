<?php
namespace Gluon\Controller;
use Gluon\Libraries\Cache;
use Gluon\Libraries\Ajax;
use Gluon\Libraries\User;
use Gluon\Libraries\General;
use Gluon\Libraries\Encrypt;
use Gluon\View\Render;
/**
 *  
 *  Admin
 *  @author By Jeremy Heminger <j.heminger@061375.com>
 *  @copyright © 2017 
 *
 * */
class admin {
    
    private $ajax;
    
    function __construct() {
        $this->ajax = new Ajax();    
    }
    /**
     * @param array
     * @return void
     * */
    function index()
    {
        $install_template = Cache::get_cache_byfile('admintheme.admin.yml.php',array('admin.html.php'));
        Render::_echo($install_template,array('page.title'=>'Welcome to Gluon Admin!'));
    }
    function login() {
        $s = User::get_session();
        $username = General::post_variable('username',false);
        $password = General::post_variable('password',false);
        $credentials = User::check_credentials($username,$password);
        if(false !== $credentials) {
            User::update_session($username,true);
            General::set_session('user',$credentials);
            header('location: '.CURRENT_URL.'admin');
            die();
        }else{
            if(false !== $username OR false !== $password) 
            $error = "User Name or Password Incorrect";
        }
        $install_template = Cache::get_cache_byfile('admintheme.admin.yml.php',array('login.html.php'));
        Render::_echo($install_template,array('page.title'=>'Login - Gluon','page.error'=>$error));
    }
    function logout() {
        
    }
    function pages()
    {
        $install_template = Cache::get_cache_byfile('admintheme.admin.yml.php',array('pages.html.php'));
        Render::_echo($install_template,array('page.title'=>'Pages - Gluon'));
    }
    function blog()
    {
        $install_template = Cache::get_cache_byfile('admintheme.admin.yml.php',array('blog.html.php'));
        Render::_echo($install_template,array('page.title'=>'Blog - Gluon'));
    }
    function plugins()
    {
        $install_template = Cache::get_cache_byfile('admintheme.admin.yml.php',array('plugins.html.php'));
        Render::_echo($install_template,array('page.title'=>'Plugins - Gluon'));
    }
    function themes()
    {
        $install_template = Cache::get_cache_byfile('admintheme.admin.yml.php',array('themes.html.php'));
        Render::_echo($install_template,array('page.title'=>'Themes - Gluon'));
    }
    function settings()
    {
        $install_template = Cache::get_cache_byfile('admintheme.admin.yml.php',array('settings.html.php'));
        Render::_echo($install_template,array('page.title'=>'Settings - Gluon'));
    }
    function updates()
    {
        $install_template = Cache::get_cache_byfile('admintheme.admin.yml.php',array('updates.html.php'));
        Render::_echo($install_template,array('page.title'=>'Updates - Gluon'));
    }
    
    
    /**
     * Ajax
     * */
    function test()
    {
        if(false === $this->ajax->validate('')) {
            return false;
        }
        //if(false === defined('ISAJAX'))die();
        //echo '<p>Got Here</p>';
    }
}