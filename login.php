<?php
session_start();
/**
 * Login code
 */
include('./connection.php');

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password =  $_POST['password'];
    $sql = "SELECT * FROM users where email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['auth'] = $row;
            if ($row['role_id'] == 1) {
                header('Location:admin');
                die();
            } else {
                header('Location:./');
                die();
            }
        } else {
            echo 'Credentials are incorrect - p';
            die();
        }
    } else {
        echo 'Credentials are incorrect';
        die();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Neon Admin Panel" />
    <meta name="author" content="" />

    <link rel="icon" href="./assets/images/favicon.ico">

    <title>LMS | Login</title>

    <link rel="stylesheet" href="./assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
    <link rel="stylesheet" href="./assets/css/font-icons/entypo/css/entypo.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/css/neon-core.css">
    <link rel="stylesheet" href="./assets/css/neon-theme.css">
    <link rel="stylesheet" href="./assets/css/neon-forms.css">
    <link rel="stylesheet" href="./assets/css/custom.css">

    <script src="./assets/js/jquery-1.11.3.min.js"></script>

    <!--[if lt IE 9]><script src="./assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->


</head>

<body class="page-body login-page login-form-fall" data-url="http://neon.dev">

    <div class="login-container">

        <div class="login-header login-caret">

            <div class="login-content">

                <a href="index.php" class="logo">
                    <img src="assets/images/logo-horizontal.png" width="120" alt="" style="filter: invert(1);" />
                </a>


                <!-- progress bar indicator -->
                <div class="login-progressbar-indicator">
                    <h3>43%</h3>
                    <span>logging in...</span>
                </div>
            </div>

        </div>

        <div class="login-progressbar">
            <div></div>
        </div>

        <div class="login-form">

            <div class="login-content">

                <div class="form-login-error">
                    <h3>Invalid login</h3>
                    <p>Enter <strong>demo</strong>/<strong>demo</strong> as login and password.</p>
                </div>

                <form action='login.php' method="post" role="form" id="form_login">

                    <div class="form-group">

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="entypo-user"></i>
                            </div>

                            <input type="text" class="form-control" name="email" id="username" value="admin@gmail.com" placeholder="Username" autocomplete="off" />
                        </div>

                    </div>

                    <div class="form-group">

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="entypo-key"></i>
                            </div>

                            <input type="password" class="form-control" name="password" value="admin123" id="password" placeholder="Password" autocomplete="off" />
                        </div>

                    </div>

                    <div class="form-group">
                        <!-- <button type="submit" name="login" class="btn btn-primary btn-block btn-login">
                        <i class="entypo-login"></i>
                        Login In
                    </button> -->
                        <input type="submit" name="login" value="login" class="btn btn-primary btn-block btn-login">
                    </div>

                </form>
            </div>

        </div>

    </div>


    <!-- Bottom scripts (common) -->
    <script src="./assets/js/gsap/TweenMax.min.js"></script>
    <script src="./assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
    <script src="./assets/js/bootstrap.js"></script>
    <script src="./assets/js/joinable.js"></script>
    <script src="./assets/js/resizeable.js"></script>
    <script src="./assets/js/neon-api.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/neon-login.js"></script>


    <!-- JavaScripts initializations and stuff -->
    <script src="./assets/js/neon-custom.js"></script>


    <!-- Demo Settings -->
    <script src="./assets/js/neon-demo.js"></script>

</body>

</html>