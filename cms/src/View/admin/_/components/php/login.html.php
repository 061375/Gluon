<html>
    <head>
        <?php include('head.php'); ?>
    </head>
    <body class="admin login">
        <div class="container">
            <div class="body">
                <form action="<?php echo CURRENT_URL; ?>/admin/login" method="post">
                    <div class="message hidden"></div>
                    <div>
                        <label for="username">
                            User Name
                            <input type="text" name="username" />
                        </label>
                        <label for="username">
                            Password
                            <input type="password" name="password" />
                        </label>
                        <input type="submit" value="Login" />
                    </div>
                </form>
            </div>
            <?php include('footer.php'); ?>
        </div>
    </body>
</html>