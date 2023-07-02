<?php echo include('includes/header.php') ?>

<div class="login-container">

    <div class="login-header login-caret">

        <div class="login-content">

            <a href="index.html" class="logo">
                <img src="assets/images/logo@2x.png" width="120" alt="" />
            </a>

            <p class="description">Dear user, log in to access the admin area!</p>

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

                        <input type="text" class="form-control" name="name" id="username" placeholder="Username" autocomplete="off" />
                    </div>

                </div>

                <div class="form-group">

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="entypo-key"></i>
                        </div>

                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" />
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
<?php
if (isset($_POST['login'])) {
    echo $_POST['name'] . $_POST['password'];
}
?>
<?php echo include('includes/footer.php') ?>