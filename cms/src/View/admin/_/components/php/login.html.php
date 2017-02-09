<html>
    <head>
        <?php include('head.php'); ?>
    </head>
    <body class="login">
        <div class="container">
            <div class="box">
                <form action="<?php echo CURRENT_URL; ?>/admin/login" method="post">
                    <div class="message">[#page.error#]</div>
                    <div class="label">
                        <input type="text" name="username" placeholder="User Name" />
                    </div>
                    <div class="label">
                        <input type="password" name="password" placeholder="Password" />
                    </div>
                    <input type="submit" value="Login" />
                </form>
            </div>
        </div>
        <?php include('footer.php'); ?>
    </body>
</html>