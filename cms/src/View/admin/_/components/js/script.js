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

// initialize global variables

var ajaxpath = 'ajax';
 
var show_log = true;

// plugins
(function ( $ ) {
    $.logThis = function(m) {
        if (show_log) {
            if( (window['console'] !== undefined) ){
                console.log( m );
            }
        }
    }
}( jQuery ));

// initialize all the classes
$(document).ready(function(){
  Ajax.init(ajaxpath);
  if (typeof $('body.install').html() !== 'undefined') {
        Install.init();
  }
  if (typeof $('body.admin').html() !== 'undefined') {
        Admin.init();
  }
});//