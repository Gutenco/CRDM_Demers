<?php
require_once 'config/db_config.php';
require_once 'auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/demers_login_style.css?<?= filemtime('css/demers_login_style.css') ?>"">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>


<div class="login-container">

        <div class="form-content">
            <div class="login-form">
                <div class="title">Login</div>
                <p>  <?php include('message.php');?>  </p>
                <form action="auth.php" method="post">
                    <div class="input-boxes">

                        <div class="input-box">
                            <i class="fas fa-envelope"></i>
                            <label>
                                <input id="input-username" type="text" name="username" placeholder="Enter your username" required>
                            </label>
                        </div>

                        <div class="input-box">
                            <i class="fas fa-lock"></i>
                            <label>
                                <input id="input-pass" type="password" name="password" placeholder="Enter your password" required>
                            </label>
                        </div>

                        <div class="text"><a href="#">Forgot password?</a></div>
                        <div class="button input-box">
                            <input type="submit" name="login_btn" value="Enter">
                        </div>

                    </div>
                </form>
            </div>
        </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="script_demers.js"></script>
</body>
</html>



