<html>
    <head>
        <?php include('head.php'); ?>
        <style>
            @font-face {
            font-family: 'gluon';
            src: url('<?php echo CURRENT_URL; ?>_/fonts/Gluon.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        </style>
    </head>
    <body class="admin">
        <div class="container">
            <nav class="hide">
                <div class="menu_header">
                    <div class="button nav right">
                        <div class="lft_arrow"></div>
                    </div>
                </div>
                <ul>
                    <li><a href="admin">Dashboard <span title="Dashboard">F</span></a></li>
                    <li><a href="pages">Pages  <span title="Pages">C</span></a></li>
                    <li><a href="blog">Blog  <span title="Blog">J</span></a></li>
                    <li><a href="plugins">Plugins  <span title="Plugins">D</span></a></li>
                    <li><a href="themes">Themes  <span title="Themes">E</span></a></li>
                    <li><a href="admin">Settings <span title="Settings">A</span></a></li>
                    <li><a href="updates">Updates <span title="Updates">B</span></a></li>
                </ul>
            </nav>
            <header>
                <div class="left">
                    <img src="<?php echo CURRENT_URL; ?>_/svg/logo.svg" class="logo" />
                    Gluon Content Management System
                </div>
                <div class="right">
                    Welcome Jeremy
                </div>
            </header>
            <div class="body">
                <!-- activity.section.ajax -->
                <!-- analytics.section.ajax -->
            </div>
            <aside class="hide">
                <div class="menu_header">
                    <div class="button aside left">
                        <div class="rgt_arrow"></div>   
                    </div>
                </div>
                <div class="media">
                    <form>
                        <p>
                            Drag Image Here
                        </p>
                    </form>    
                </div>
                <div class="menu_header">
                    <span title="Media">G</span>
                    <div class="button _media right">
                        <div class="dwn_arrow"></div>   
                    </div>
                </div>
                <div class="mediac">
                    <div class="image"></div>
                    <div class="image"></div>
                    <div class="image"></div>
                    <div class="image"></div>
                    <div class="image"></div>
                    <div class="image"></div>
                    <div class="image"></div>
                    <div class="image"></div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </aside>
            <footer>
                Copyright &copy; 2017 All Rights Reserved 
            </footer>
        </div>
        <?php include('footer.php'); ?>
    </body>
</html>