var Admin=function(){"use strict";var a=$(".button"),b=$(".body"),c=function(){a.on("click",d),b.sortable(),b.disableSelection()},d=function(){return $(this).hasClass("nav")&&$(this).closest("nav").toggleClass("hide"),$(this).hasClass("aside")&&$(this).closest("aside").toggleClass("hide"),$(this).hasClass("_media")&&$(this).closest("aside").find(".media").toggleClass("hide"),$(this).find("div").hasClass("rgt_arrow")?($(this).find("div").removeClass("rgt_arrow"),void $(this).find("div").addClass("lft_arrow")):$(this).find("div").hasClass("lft_arrow")?($(this).find("div").addClass("rgt_arrow"),void $(this).find("div").removeClass("lft_arrow")):$(this).find("div").hasClass("up_arrow")?($(this).find("div").removeClass("up_arrow"),void $(this).find("div").addClass("dwn_arrow")):$(this).find("div").hasClass("dwn_arrow")?($(this).find("div").addClass("up_arrow"),void $(this).find("div").removeClass("dwn_arrow")):void 0},e=function(){c()};return{init:e}}(),Ajax=function(){"use strict";var a,b=!1,c=!1,d=function(b,c,d){"undefined"==typeof d&&(d=a),$.logThis("send ajax "+d);var e={method:b,data:c};return $.ajax({url:d,data:e,type:"post",dataType:"json"})},e=function(a,b,c){a.done(function(a){if(1==a.success)"function"==typeof b&&b(a);else if("undefined"!=typeof a.errors){var d="";$.each(a.errors,function(a,b){d+=b+"\n"}),"function"==typeof c?c(d):alert("An error occured "+d)}else c(a.message)}),a.fail(function(a,b,c){var d="An Error occurred...";"undefined"!=typeof a&&$.logThis("xhr error "+a.status),"undefined"!=typeof c&&$.logThis("thrownError "+c),alert(d)})},f=function(a){$.logThis("Ajax::get_session_url");for(var b="",f=0;10>f;f++){var g=98+Math.floor(15*Math.random());b+=String.fromCharCode(g)}var h=ajaxpath+b+".init",i=d("create_session_url",{},h);e(i,function(b){"undefined"!=typeof b.message&&(c=b.message,"function"==typeof a&&a(c))})},g=function(a){$.logThis("Ajax::init_session");var f=ajaxpath+c+".s",g=d("create_session",{},f);e(g,function(c){"undefined"!=typeof c.message&&"function"==typeof a&&(b=c.message,a())})},h=function(){return $.logThis("Ajax::return_session_url"),c},i=function(){return $.logThis("Ajax::return_session"),b},j=function(b){$.logThis("Ajax::init"),"function"==typeof b?f(b):a=b};return{init:j,init_session:g,return_session:i,return_session_url:h,getData:d,dataResult:e}}(),Install=function(){"use strict";var a,b,c=$(".startb"),d=$(".next-step"),e=$(".prev-step"),f=$(".run-install"),g=$(".ftpskip"),h=!1,i=function(){var a=$(this);a.css("display","none"),$(".box").addClass("start"),setTimeout(function(){$(".box").addClass("startb"),setTimeout(function(){a.parent().css("display","none"),a.parent().next().css("display","block")},100)},1e3)},j=function(){var a=$(this),b=!0;$(this).parent().find("input,select",function(){$(this).hasClass("required")&&(""==$(this).val()?(b=!1,$(this).prev().css("display","block")):$(this).prev().css("display","none"))}),$(".box").hasClass("startb")?$(".box").removeClass("startb"):$(".box").addClass("startb"),setTimeout(function(){a.parent().css("display","none"),a.parent().next().css("display","block")},100)},k=function(){var a=$(this);$(".box").hasClass("startb")?$(".box").removeClass("startb"):$(".box").addClass("startb"),setTimeout(function(){a.parent().css("display","none"),a.parent().prev().css("display","block")},100)},l=function(){$(".running .prev-step").css("display","none"),h=!1,$(".install-pro").html("");var c=!1;return a=0,b=$(this).parent(),$("input").each(function(){$(this).hasClass("required")&!$(this).hasClass("skip")&&""==$(this).val()?(c=!0,$(this).prev().css("display","block")):$(this).prev().css("display","none")}),c?!1:void b.fadeOut("fast",function(){$(".running").fadeIn("fast",function(){$.logThis("Likes::runinstall");var a=n($(".step.two"));o("Checking database connection...","install_database",a,function(){a=n($(".step.three")),o("Testing FTP connection...","add_ftp",a,function(){a=n($(".step.one")),o("Adding admin user...","add_user",a,function(){o("Finalizing Install...","finalize",a,function(){h?alert("one or more errors occured during the install"):($(".container").addClass("fadeout"),window.location="admin")},m)},m)},m)},m)})})},m=function(a){h=!0;var b=document.createElement("div");$(b).css("color","red"),$(b).html(a),$(".install-pro").append(b),$(".running .prev-step").fadeIn("fast")},n=function(a){var b={};a.find("input,select").each(function(){"checkbox"==$(this).attr("type")?b[$(this).data("name")]=$(this).is(":checked"):b[$(this).data("name")]=$(this).val()});return b},o=function(a,b,c,d){var e=document.createElement("div");$(e).html(a),$(".install-pro").append(e);var f=Ajax.getData(b,c);Ajax.dataResult(f,function(a){var b=document.createElement("div");$(b).html(a.message),$(".install-pro").append(b),d()},function(a){m(a)})},p=function(){c.on("click",i),d.on("click",j),e.on("click",k),f.on("click",l),g.on("change",function(){$(".step.three").find("input").each(function(){$(this).toggleClass("skip")})})},q=function(){p()};return{init:q}}(),ajaxpath="/",show_log=!0;!function(a){a.logThis=function(a){show_log&&void 0!==window.console&&console.log(a)}}(jQuery),$(document).ready(function(){Ajax.init(),"undefined"!=typeof $("body.install").html()&&Install.init(),"undefined"!=typeof $("body.admin").html()&&Admin.init()});