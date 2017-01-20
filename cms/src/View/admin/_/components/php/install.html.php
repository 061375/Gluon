<html>
    <head>
        <?php include('head.php'); ?>
    </head>
    <body>
        <div class="container">
            <div class="box">
                <img src="_/svg/logo.svg" class="logo" />
                <div class="step stepone">
                    <h1>
                        Welcome!
                    </h1>
                    to the
                    <h2>Gluon Content Management System</h2>
                    <button class="startb">Get Started</button>
                </div>
                <div class="step">
                    <h2>
                        Let's setup your login
                    </h2>
                    <div class="hidden required">* required</div>
                    <input type="text" class="username required" placeholder="USER NAME" />
                    <br />
                    <div class="hidden required">* required</div>
                    <input type="text" class="email required" placeholder="EMAIL" />
                    <br />
                    <div class="hidden required">* required</div>
                    <input type="password" class="password required" placeholder="PASSWORD" />
                    <br />
                    <button class="next-step">Next Step --></button>
                </div>
                <div class="step">
                    <h2>
                        Database Connection
                    </h2>
                    <div class="hidden required">* required</div>
                    <input type="text" class="dbhost required" placeholder="HOST" />
                    <br />
                    <div class="hidden required">* required</div>
                    <input type="text" class="dbname required" placeholder="DATABASE" />
                    <br />
                    <div class="hidden required">* required</div>
                    <input type="text" class="dbusername required" placeholder="USER NAME"/>
                    <br />
                    <div class="hidden required">* required</div>
                    <input type="password" class="dbpassword required" placeholder="PASSWORD" />
                    <br />
                    <button class="prev-step"><-- Prev Step</button>
                    <button class="next-step">Next Step --></button>
                </div>
                <div class="step">
                    <h2>
                        FTP Connection
                    </h2>
                    <div class="hidden required">* required</div>
                    <input type="text" class="ftphost required" placeholder="HOST" />
                    <br />
                    <input type="text" class="ftpport" placeholder="PORT" />
                    <select class="ftpprotocol">
                        <option value="ftp">FTP - File Transfer Protocol</option>
                        <option value="sftp">SFTP - SSH File Transfer Protocol</option>
                    </select>
                    <br />
                    <div class="hidden required">* required</div>
                    <input type="text" class="ftpusername required" placeholder="USER NAME"/>
                    <br />
                    <div class="hidden required">* required</div>
                    <input type="password" class="ftppassword required" placeholder="PASSWORD" />
                    <br />
                    <button class="prev-step"><-- Prev Step</button>
                    <button class="run-install">Install</button>
                </div>
                <div class="running">
                    <h2>
                        Please wait...
                    </h2>
                    <div class="install-pro"></div>
                </div>
            </div>
        </div>
        <?php include('footer.php'); ?>
    </body>
</html>