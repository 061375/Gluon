# Gluon

## Subatomic particle

Gluons /ˈɡluːɒnz/ are elementary particles that act as the exchange particles for the strong force between quarks, analogous to the exchange of photons in the electromagnetic force between two charged particles.

## About

NOTICE - Unless otherwise stated, this is in very early production. It is currenly, "unusable", as a web-solution. But I am making nice progress and anticipate a usable release by mid-February 2017.

This is meant to be a simple project for my own learning purposes, but I think its kind of a neat solution for very light-weight personal blog. The CMS is unique in that the CMS actually runs on a local server and changes are uploaded post render. The idea being that since there is very little need for logic in a simple blog, why not pre-render everything, but it would still be nice to manage content through a GUI interface instead of writing HTML. .. REALLY,.. its like a simple version of Dreamweaver written in PHP.


### History

1.0.10 - If the Gluon core is in the Gluon namespace then what's with all the prefixes..."old habits", so I reorganized things.
         - further building and debugging the install process
         - added the Encrypt class for storing passwords
         - added operation to set permissions
         - install clears cache before install begins (the base code should be small, so this should be fine)
        
1.0.9 - create core and installation process
        the base version should have the cache filled and will have all the paths setup to run the PHP
        the installation will install the database connection and the FTP connection to upload the
        necessary running files and create the upload hash.

1.0.8 - add Symfony YAML parser so shared VPN users won't have to request YAML php extension installation 

1.0.7 - render themes to cache

1.0.6 - add media upload class - this un-tested

1.0.5 - continue work on install screen

1.0.4 - start work on install template

1.0.3 - add .htaccess to block access to certain files

1.0.2 - continue work on cache and start work on rendering the themes
        the themes will be gathered and will export minified script if NOT in debug mode
        otherwise each script file will be rendered for debug purposes
        when debug is off white-space will be stripped from output html

1.0.1 - add the basics of how the cache will work

1.0.0 - setup the basic folder structure


