<?php include('./includes/header.php'); ?>
<?php
include('../connection.php');
$id = null;
function query($conn, $sql)
{
    $row1 = mysqli_query($conn, $sql);
    if (mysqli_num_rows($row1) <= 0) {
        return [];
    }
    $record1 = mysqli_fetch_assoc($row1);
    return $record1;
}
$record = [];
$userData = [];

if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_DEFAULT);
    $city = $_POST['city'];
    $sql = "SELECT * FROM users where email='$email'";
    if (isset($_GET['id']) && $_GET['id'] !== '') {
        $id = $_GET['id'];
        $sql = "SELECT * FROM users WHERE email = '$email' AND id != '$id'";
    }


    $row = mysqli_query($conn, $sql);
    if (mysqli_num_rows($row) > 0) {
        $_SESSION['flash_message'] = 'email already exist';
        $_SESSION['isSuccess'] = false;
    } else {
        if (isset($_GET['id']) && $_GET['id'] !== '') {
            $sql = "UPDATE users SET name = '$name', email = '$email', password = '$password', role_id = 2 WHERE id = '$id'";
        } else {
            $sql = "INSERT INTO users (name, email, password,role_id) VALUES ('$name', '$email', '$password',2)";
        }

        if (mysqli_query($conn, $sql)) {
            $_SESSION['flash_message'] = 'user created successfully';
            $_SESSION['isSuccess'] = true;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
if (isset($_GET['id']) && $_GET['id'] !== '') {
    $id = $_GET['id'];
    $q = "select * from users where id =$id";
    $userData = query($conn, $q);
    if (count($userData) <= 0 || $userData['role_id'] == 1) {
        echo '<h1 align="center">User Not Found</h1>';
        die();
    }
}
?>


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
                        <div class="alert <?php echo $_SESSION['isSuccess'] == true ? 'alert-success' : 'alert-danger' ?>">
                            <?php echo $_SESSION['flash_message'] ?>
                        </div>
                    <?php
                        unset($_SESSION['flash_message']);
                        unset($_SESSION['isSuccess']);
                    }
                    ?>
                    <div class="col-sm-3 col-xs-12 col-lg-12">
                        <form role="form" action=<?php echo  $id ? "user.php?id=$id" : 'user.php' ?> method="post" class="form-horizontal form-groups-bordered">
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Name</label>
                                <div class="col-sm-5">
                                    <input type="text" name="name" required class="form-control input-lg" value="<?php echo count($userData) > 0 ? $userData['name'] : '' ?>"">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Email</label>

                                <div class="col-sm-5">
                                    <input type="email" name="email" required class="form-control input-lg" value="<?php echo count($userData) > 0 ? $userData['email'] : '' ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Password</label>

                                <div class="col-sm-5">
                                    <input type="password" <?php echo  $id ? '' : 'required' ?> name="password" class="form-control input-lg">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">City</label>

                                <div class="col-sm-5">
                                    <input type="text" name="city"  required value="<?php echo count($userData) > 0 ? $userData['city'] : '' ?>" class="form-control input-lg">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-5 col-lg-8 col-md-12">
                                    <input type="submit" class="form-control input-lg" value="Sign Up" name="signup">
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