<html>
    <head>
        <style>.login .container{transition:all 2s cubic-bezier(0.23, 1, 0.32, 1);width:100vw;max-width:320px;position:relative;margin:20vh auto;perspective:1000px;opacity:1}.login .container.fadeout{max-width:90vw;opacity:0}.login .container.fadeout .box{height:320px}.login .container.fadeout img{height:320px;width:320px}.login .box{transition:all 0.6s cubic-bezier(0.23, 1, 0.32, 1);width:100%;position:absolute;box-sizing:border-box;animation:flyin .5s normal forwards ease-in-out;padding:10px;text-align:center;border:solid 1px #d8d8d8;border-radius:5px;transform:rotateX(30deg)}.login .label{margin:10px}.login footer{position:absolute;bottom:0}@-webkit-keyframes flyin{from{top:0px;opacity:0;box-shadow:0px 1px 5px #7d7d7d}to{top:-50px;opacity:1;box-shadow:0px 100px 100px #7d7d7d}}@-moz-keyframes flyin{from{top:0px;opacity:0;box-shadow:0px 1px 5px #7d7d7d}to{top:-50px;opacity:1;box-shadow:0px 100px 100px #7d7d7d}}@-ms-keyframes flyin{from{top:0px;opacity:0;box-shadow:0px 1px 5px #7d7d7d}to{top:-50px;opacity:1;box-shadow:0px 100px 100px #7d7d7d}}@keyframes flyin{from{top:0px;opacity:0;box-shadow:0px 1px 5px #7d7d7d}to{top:-50px;opacity:1;box-shadow:0px 100px 100px #7d7d7d}}@-webkit-keyframes spinup{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}@-moz-keyframes spinup{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}@-ms-keyframes spinup{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}@keyframes spinup{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}body{font-family:Helvetica}</style>
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