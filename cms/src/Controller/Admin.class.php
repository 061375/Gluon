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
    
    private $vars = array();
    
    function __construct() {
        $user = General::get_session('user');
        foreach($user as $k => $v) {
            $this->vars['page.'.$k] = $v;
        }
        $this->ajax = new Ajax();    
    }
    /**
     * @param array
     * @return void
     * */
    function index()
    {
        $install_template = Cache::get_cache_byfile('admintheme.admin.yml.php',array('admin.html.php'));
        $this->vars['page.title'] = 'Admin - Gluon';
        Render::_echo($install_template,$this->vars);
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
        $this->vars['page.title'] = 'Login - Gluon';
        $this->vars['page.error'] = $error;
        Render::_echo($install_template,$this->vars);
    }
    function logout() {
        $s = User::get_session();
        General::set_session('user',array());
        if(!isset($s[0]['username']))$this->login();
        User::destroy_session($s[0]['username']);
        $this->login();
    }
    function pages()
    {
        $install_template = Cache::get_cache_byfile('admintheme.admin.yml.php',array('pages.html.php'));
        $this->vars['page.title'] = 'Pages - Gluon';
        Render::_echo($install_template,$this->vars);
    }
    function blog()
    {
        $install_template = Cache::get_cache_byfile('admintheme.admin.yml.php',array('blog.html.php'));
        $this->vars['page.title'] = 'Blog - Gluon';
        Render::_echo($install_template,$this->vars);
    }
    function plugins()
    {
        $install_template = Cache::get_cache_byfile('admintheme.admin.yml.php',array('plugins.html.php'));
        $this->vars['page.title'] = 'Plugins - Gluon';
        Render::_echo($install_template,$this->vars);
    }
    function themes()
    {
        $install_template = Cache::get_cache_byfile('admintheme.admin.yml.php',array('themes.html.php'));
        $this->vars['page.title'] = 'Themes - Gluon';
        Render::_echo($install_template,$this->vars);
    }
    function settings()
    {
        $install_template = Cache::get_cache_byfile('admintheme.admin.yml.php',array('settings.html.php'));
        $this->vars['page.title'] = 'Settings - Gluon';
        Render::_echo($install_template,$this->vars);
    }
    function updates()
    {
        $install_template = Cache::get_cache_byfile('admintheme.admin.yml.php',array('updates.html.php'));
        $this->vars['page.title'] = 'Updates - Gluon';
        Render::_echo($install_template,$this->vars);
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