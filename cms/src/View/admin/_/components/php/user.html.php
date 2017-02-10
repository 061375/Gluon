<html>
    <head>
        <?php include('head.php'); ?>
    </head>
    <body class="admin user [#form.username#]">
        <div class="container">
            <?php include('nav.php'); ?>
            <?php include('header.php'); ?>
            <div class="body">
                <section>
                    <div>
                        <div class="left">Username (cannot be changed)</div>
                        <div class="right">[#form.username#]</div>
                    </div>
                    <div>
                        <div class="left">User Display Name</div>
                        <div class="right"><input type="text" name="usernice" value="[#form.usernice#]" /></div>
                    </div>
                    <div>
                        <div class="left">Change Password</div>
                        <div class="right">
                            <input type="text" name="password" />
                            <br />
                            <input type="text" name="password2" placeholder="confirm" />
                        </div>
                    </div>
                </section>
            </div>
            <?php include('media.php'); ?>
            <?php include('footer.php'); ?>
        </div>
        <?php include('scripts.php'); ?>
    </body>
</html>