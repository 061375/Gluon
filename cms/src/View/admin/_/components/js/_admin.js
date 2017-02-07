/**
 *
 * Admin
 * @author Jeremy Heminger <j.heminger@061375.com>
 *
 * 
 * */
var Admin = (function() {
    
    "use strict";
    
    var button = $('.button');
    
    var sort = $('.body');
    
    /**
     *
     *
     * */
    var bindActions = function() {
        button.on('click', show_nav);
        sort.sortable();
        sort.disableSelection();
    };
    /**
     *
     *
     **/
    var initPage = function() {
        var $a = $('.admin');
        if ($a.hasClass('dashboard'))dashboard();
    }
    /**
     *
     * */
    var show_nav = function() {
        if($(this).hasClass('nav'))$(this).closest('nav').toggleClass('hide');
        if($(this).hasClass('aside'))$(this).closest('aside').toggleClass('hide');
        if($(this).hasClass('_media'))$(this).closest('aside').find('.media').toggleClass('hide');
        
        if($(this).find('div').hasClass('rgt_arrow')) {
           $(this).find('div').removeClass('rgt_arrow');
           $(this).find('div').addClass('lft_arrow');
           return;
        }
        
        if($(this).find('div').hasClass('lft_arrow')) {
           $(this).find('div').addClass('rgt_arrow');
           $(this).find('div').removeClass('lft_arrow');
           return;
        }
        if($(this).find('div').hasClass('up_arrow')) {
           $(this).find('div').removeClass('up_arrow');
           $(this).find('div').addClass('dwn_arrow');
           return;
        }
        if($(this).find('div').hasClass('dwn_arrow')) {
           $(this).find('div').addClass('up_arrow');
           $(this).find('div').removeClass('dwn_arrow');
           return;
        }
    }
    /**
     *
     * */
    var dashboard = function() {
        console.log('Dashboard'); 
    }
    /**
     *
     * */
    var init = function() {
        bindActions();
        initPage();
    };

    return {
      init: init,
    };   
}());