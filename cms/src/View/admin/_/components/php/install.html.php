<html>
    <head>
        <?php include('head.php'); ?>
    </head>
    <body class="install">
        <div class="container">
            <div class="box">
                <img src="<?php echo CURRENT_URL; ?>_/svg/logo.svg" class="logo" />
                <div class="step stepone">
                    <h1>
                        Welcome!
                    </h1>
                    to the
                    <h2>Gluon Content Management System</h2>
                    <button class="startb">Get Started</button>
                </div>
                <div class="step one">
                    <h2>
                        Let's setup your login
                    </h2>
                    <div class="hidden required">* required</div>
                    <input type="text" data-name="friendlyname" class="required" placeholder="YOUR NAME" />
                    <br />
                    <div class="hidden required">* required</div>
                    <input type="text" data-name="username" class="required" placeholder="USER NAME" />
                    <br />
                    <div class="hidden required">* required</div>
                    <input type="text" data-name="email" class="required" placeholder="EMAIL" />
                    <br />
                    <div class="hidden required">* required</div>
                    <input type="password" data-name="password" class="required" placeholder="PASSWORD" />
                    <br />
                    <button class="next-step">Next Step --></button>
                </div>
                <div class="step two">
                    <h2>
                        Database Connection
                    </h2>
                    <div class="hidden required">* required</div>
                    <input type="text" data-name="dbhost" class="required" placeholder="HOST" />
                    <br />
                    <div class="hidden required">* required</div>
                    <input type="text" data-name="dbname" class="required" placeholder="DATABASE" />
                    <br />
                    <div class="hidden required">* required</div>
                    <input type="text" data-name="dbusername" class="required" placeholder="USER NAME"/>
                    <br />
                    <div class="hidden required">* required</div>
                    <input type="password" data-name="dbpassword" class="required" placeholder="PASSWORD" />
                    <br />
                    <button class="prev-step"><-- Prev Step</button>
                    <button class="next-step">Next Step --></button>
                </div>
                <div class="step three">
                    <h2>
                        FTP Connection
                    </h2>
                    <div class="hidden required">* required</div>
                    <input type="text" data-name="ftphost" class="required" placeholder="HOST" />
                    <br />
                    <input type="text" data-name="ftpport" class="ftpport" placeholder="PORT" />
                    <select data-name="ftpprotocol" class="ftpprotocol">
                        <option value="ftp">FTP - File Transfer Protocol</option>
                        <option value="sftp">SFTP - SSH File Transfer Protocol</option>
                    </select>
                    <br />
                    <div class="hidden required">* required</div>
                    <input type="text" data-name="ftpusername" class="required" placeholder="USER NAME"/>
                    <br />
                    <div class="hidden required">* required</div>
                    <input type="password" data-name="ftppassword" class="required" placeholder="PASSWORD" />
                    <br />
                    <input type="checkbox" data-name="ftpskip" class="fltleft ftpskip"/> <div class="ftpskip">Do not install FTP at this time</div>
                    <br />
                    <button class="prev-step"><-- Prev Step</button>
                    <button class="run-install">Install</button>
                </div>
                <div class="running">
                    <h2>
                        Please wait...
                    </h2>
                    <div class="install-pro"></div>
                    <button class="prev-step hidden"><-- Prev Step</button>
                </div>
            </div>
        </div>
        <?php include('footer.php'); ?>
    </body>
</html>