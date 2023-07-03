<?php include('./includes/header.php'); ?>
<?php
    include('../connection.php');
    
    $record = [];


    if (isset($_POST['signup'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = password_hash($password, PASSWORD_DEFAULT);
        $city = $_POST['city'];
        $sql = "SELECT * FROM users where email='$email'";

        $row = mysqli_query($conn, $sql);
        if (mysqli_num_rows($row) > 0) {
        $_SESSION['flash_message'] = 'email already exist';
        $_SESSION['isSuccess'] = false;
        }
        
        else {
        $sql = "INSERT INTO users (name, email, password,role_id) VALUES ('$name', '$email', '$password',2)";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['flash_message'] = 'user created successfully';
            $_SESSION['isSuccess'] = true;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        }
        
    }?>
<body class="page-body  page-fade" data-url="http://neon.dev">

    <div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
        <?php include('./includes/sidebar.php') ?>


        <div class="main-content">
            <?php include('./includes/top-navbar.php') ?>

            <hr />

            <div class="row">
                <div class="panel-body">
                    <?php
                    if (isset($_SESSION['flash_message'])) {
                    ?>
                        <div class="alert <?php echo $_SESSION['isSuccess']==true ? 'alert-success' : 'alert-danger' ?>" >
                            <?php echo $_SESSION['flash_message'] ?>
                        </div>
                    <?php
                        unset($_SESSION['flash_message']);
                        unset($_SESSION['isSuccess']);
                    }
                    ?>
                    <div class="col-sm-3 col-xs-12 col-lg-12">
                        <form role="form" action="personal.php" method="post" class="form-horizontal form-groups-bordered">
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Name</label>
                                <div class="col-sm-5">
                                    <input type="text" name="name" required class="form-control input-lg" id="field-1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Email</label>

                                <div class="col-sm-5">
                                    <input type="email" name="email" required class="form-control input-lg" id="field-1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Password</label>

                                <div class="col-sm-5">
                                    <input type="password" required name="password" class="form-control input-lg" id="field-1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">City</label>

                                <div class="col-sm-5">
                                    <input type="text" name="city" required class="form-control input-lg" id="field-1">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-5 col-lg-8 col-md-12">
                                    <input type="submit" class="form-control input-lg" value="Sign Up" name="signup" id="field-1">
                                </div>
                            </div>

                    </div>
                    </form>
                </div>

            </div>


        </div>

        <br />


        <br />

    </div>
    <?php include('./includes/footer.php') ?>

    
