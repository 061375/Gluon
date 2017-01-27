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
     * */
    var show_nav = function() {
        if($(this).hasClass('nav'))$(this).closest('nav').toggleClass('hide');
        if($(this).hasClass('aside'))$(this).closest('aside').toggleClass('hide');
        $(this).find('div').toggleClass('arrow');
    }
    /**
     *
     * */
    var init = function() {
        bindActions();   
    };

    return {
      init: init,
    };   
}());