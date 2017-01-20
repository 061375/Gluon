var Ajax=function(){"use strict";var a,b=!1,c=!1,d=function(b,c,d){"undefined"==typeof d&&(d=a),$.logThis("send ajax "+d);var e={method:b,data:c};return $.ajax({url:d,data:e,type:"post",dataType:"json"})},e=function(a,b,c){a.success(function(a){if(1==a.success)"function"==typeof b&&b(a);else if("undefined"!=typeof a.errors){var d="";$.each(a.errors,function(a,b){d+=b+"\n"}),"function"==typeof c?c(d):alert("An error occured "+d)}}),a.error(function(a,b,c){var d="An Error occurred...";"undefined"!=typeof a&&$.logThis("xhr error "+a.status),"undefined"!=typeof c&&$.logThis("thrownError "+c),alert(d)})},f=function(a){$.logThis("Ajax::get_session_url");for(var b="",f=0;10>f;f++){var g=98+Math.floor(15*Math.random());b+=String.fromCharCode(g)}var h=ajaxpath+b+".init",i=d("create_session_url",{},h);e(i,function(b){"undefined"!=typeof b.message&&(c=b.message,"function"==typeof a&&a(c))})},g=function(a){$.logThis("Ajax::init_session");var f=ajaxpath+c+".s",g=d("create_session",{},f);e(g,function(c){"undefined"!=typeof c.message&&"function"==typeof a&&(b=c.message,a())})},h=function(){return $.logThis("Ajax::return_session_url"),c},i=function(){return $.logThis("Ajax::return_session"),b},j=function(b){$.logThis("Ajax::init"),"function"==typeof b?f(b):a=b};return{init:j,init_session:g,return_session:i,return_session_url:h,getData:d,dataResult:e}}(),Install=function(){"use strict";var a,b=!1,c=$(".startb"),d=$(".next-step"),e=$(".prev-step"),f=$(".run-install"),g=function(a){$.logThis("Install::init_session"),Ajax.init_session(a)},h=function(){var a=$(this);$(".box").addClass("start"),setTimeout(function(){$(".box").addClass("startb"),setTimeout(function(){a.css("display","none"),a.css("display","block")},100)},1e3)},i=function(){var a=$(this),b=!0;$(this).parent().find("input,select",function(){$(this).hasClass("required")&&(""==$(this).val()?(b=!1,$(this).prev().css("display","block")):$(this).prev().css("display","none"))}),$(".box").hasClass("startb")?$(".box").removeClass("startb"):$(".box").addClass("startb"),setTimeout(function(){a.parent().css("display","none"),a.parent().next().css("display","block")},100)},j=function(){var a=$(this);$(".box").hasClass("startb")?$(".box").removeClass("startb"):$(".box").addClass("startb"),setTimeout(function(){a.parent().css("display","block"),a.parent().next().css("display","none")},100)},k=function(){a=0,$(this).parent().fadeOut("fast",function(){$(".running").fadeIn("fast",function(){$.logThis("Likes::runinstall"),l("Checking database connection...","install_database",{dbhost:$(".dbhost").val(),dbname:$(".dbname").val(),dbusername:$(".dbusername").val(),password:$(".password").val()},function(){l("Testing FTP connection...","test_ftp",{ftphost:$(".ftphost").val(),dbname:$(".dbname").val(),ftpport:$(".ftpport").val(),ftpprotocol:$(".ftpprotocol").val(),ftpusername:$(".ftpusername").val(),ftppassword:$(".ftppassword").val()},function(){l("Adding admin user...","add_user",{username:$(".username").val(),email:$(".email").val(),password:$(".password").val()},function(){setTimeout(function(){$(".container").addClass("fadeout")},2e3)})})})})})},l=function(a,b,c,d){var e=document.createElement("div");$(e).html(a),$(".install-pro").append(e);var f=Ajax.getData(b,c);Ajax.dataResult(f,function(a){var b=document.createElement("div");$(b).html(a.message),$(".install-pro").append(b),d()},function(a){var b=document.createElement("div");$(b).css("color","red"),$(b).html(a),$(".install-pro").append(b),d()})},m=function(){c.on("click",h),d.on("click",i),e.on("click",j),f.on("click",k)},n=function(a){b=a,g(),m()};return{init:n}}(),ajaxpath="/",show_log=!0;!function(a){a.logThis=function(a){show_log&&void 0!==window.console&&console.log(a)}}(jQuery),$(document).ready(function(){Ajax.init()});