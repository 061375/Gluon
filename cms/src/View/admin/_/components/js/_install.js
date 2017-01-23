/**
 *
 * Install
 * 
 * @author Jeremy Heminger  <j.heminger@061375.com>
 *
 *
 * @requires Ajax to setup a session and to send the install
 * 
 * */
var Install = (function() { 
    
    "use strict";
    
    var session_url = false;
    
    var start = $('.startb');
    
    var next_step = $('.next-step');
    
    var prev_step = $('.prev-step');
    
    var run_install = $('.run-install'); 
    
    var id, i;
    
    /**
    * creates a session
    * @returns {Void}
    * */
    var init_session = function(callback) {
        $.logThis('Install::init_session');
        Ajax.init_session(callback);   
    }
    
    /**
    * when an email is submitted checks if a session is set if false ask Ajax to set one
    * @returns {Void}
    * */
    var is_session = function(callback) {
        $.logThis('Install::is_session');
        if (!Ajax.return_session())  {
            init_session(callback);
        }else{
            session_url = Ajax.return_session_url();
            return true;
        }
        return false;
    }
    /**
    * @returns {Void}
    * */
    var start_install = function() {
        var $this = $(this);
        $this.css('display','none');
        $('.box').addClass('start');
        setTimeout(function(){
            $('.box').addClass('startb');
            setTimeout(function(){
                $this.parent().css('display','none');
                $this.parent().next().css('display','block');
            },100);
        },1000);
    }
    /**
    * @returns {Void}
    * */
    var next = function() {
        var $this = $(this);
        var valid = true;
        $(this).parent().find('input,select',function(){
            if($(this).hasClass("required")) {
                if ($(this).val() == '') {
                    valid = false;
                    $(this).prev().css('display','block');
                }else{
                    $(this).prev().css('display','none');
                }
            }
        });
        if($('.box').hasClass('startb')) {
            $('.box').removeClass('startb');
        }else{
            $('.box').addClass('startb');
        }
        setTimeout(function(){
            $this.parent().css('display','none');
            $this.parent().next().css('display','block');
        },100);
    }
    /**
    * @returns {Void}
    * */
    var prev = function() {
        var $this = $(this);
        var valid = true;
        if($('.box').hasClass('startb')) {
            $('.box').removeClass('startb');
        }else{
            $('.box').addClass('startb');
        }
        setTimeout(function(){
            $this.parent().css('display','none');
            $this.parent().prev().css('display','block');
        },100);
    }
    /**
    * @returns {Void}
    * */
    var runinstall = function() {
        var err = false;
        $('input').each(function(){
            if($(this).hasClass('required') && $(this).val() == ''){
                err = true;
                $(this).prev().css('display','block');
            }else{
                $(this).prev().css('display','none');
            }
        });
        if (err) return false;
        i = 0;
        //$(this).parent().fadeOut("fast",function(){
            //$('.running').fadeIn("fast",function(){
                $.logThis('Likes::runinstall');
                var d = getData($('.step.two'));
                runAjax('Checking database connection...',
                        'install_database',
                        d,function(){
                    d = getData($('.step.three'));
                    runAjax('Testing FTP connection...',
                        'test_ftp',
                        d,function(){
                        d = getData($('.step.one'));
                        runAjax('Adding admin user...',
                            'add_user',
                            d,function(){
                            runAjax('Finalizing Install...',
                            'finalize',
                            d,function(){
                                setTimeout(function(){
                                    $('.container').addClass('fadeout');
                                    // redirect to admin
                                },2000);
                            });
                        });    
                    });       
                });
            //});
        //});
    }
    var getData = function($t) {
        var r = {};
        var data = $t.find('input,select').each(function(){
            r[$(this).data('name')] = $(this).val();            
        });
        return r;
    }
    var runAjax = function(message,method,data,callback) {
        var d = document.createElement('div');
            $(d).html(message);
        $('.install-pro').append(d);
        var p = Ajax.getData(method,data);
        // result
        Ajax.dataResult(p,function(data) {
            var d = document.createElement('div');
                $(d).html(data.message);
            $('.install-pro').append(d);
            callback();
        },function(error){
            var d = document.createElement('div');
                $(d).css('color','red');
                $(d).html(error);
            $('.install-pro').append(d);
            callback();
        });   
    }
    /**
     *
     *
     * */
    var bindActions = function() {
        start.on('click', start_install);
        next_step.on('click', next);
        prev_step.on('click', prev);
        run_install.on('click', runinstall);
    };
    /**
    * initialize
    * @returns {Void}
    * */
    var init = function() {
        bindActions();
    };
    
    return {
      init: init,
    };   
}());