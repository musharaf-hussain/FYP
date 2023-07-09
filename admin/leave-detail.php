<?php include('./includes/header.php'); ?>
<?php
$id = null;
if (isset($_GET['id']) && $_GET['id'] !== '') {
    $id = $_GET['id'];
} else {
    echo '<h1>Page Not found</h1>';
    die();
}
function query($conn, $sql)
{
    $row1 = mysqli_query($conn, $sql);
    if (mysqli_num_rows($row1) <= 0) {
        return [];
    }
    $record1 = mysqli_fetch_assoc($row1);
    return $record1;
}
include('../connection.php');
        if (isset($id) && isset($_GET['type'])) {
            $type = $_GET['type'];
            if ($type && ($type == 'approved' || $type == 'rejected')) {
                $type = ucfirst($type);
                $sql = "update employee_leaves set status='$type' where user_id='$id'";
                
                if ($row = mysqli_query($conn, $sql)) {
                    $_SESSION['flash_message'] = true;
                    
                }
            }
        }
        
?>

<body class="page-body  page-fade" data-url="http://neon.dev">

    <div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
        <?php include('./includes/sidebar.php') ?>


        <div class="main-content">
            <?php include('./includes/top-navbar.php') ?>

            <hr />


            <script type="text/javascript">
                function getRandomInt(min, max) {
                    return Math.floor(Math.random() * (max - min + 1)) + min;
                }
            </script>


            <div class="row">
                <div class="panel-body">
                    <?php
                    if (isset($_SESSION['flash_message'])) {
                    ?>
                        <div class="alert alert-success">Leave has been <?php echo isset($_GET['type']) ?  ucfirst($_GET['type']) : ''; ?> Successfully</div>
                    <?php
                        unset($_SESSION['flash_message']);
                    }
                    ?>
                    <?php
                    if ($id) {
                        $sql = "SELECT * FROM users JOIN employee_leaves ON users.id = employee_leaves.user_id where employee_leaves.user_id = '$id' AND employee_leaves.status='Pending'";
                        $user = query($conn, $sql);
                    }
                    ?>
                    <div class="col-sm-3 col-xs-12 col-lg-12">
                        <?php
                        if ($id && $user) {
                        ?>
                            <h3><?php echo $user['email']; ?> leave records</h3>
                        <?php } ?>


                        <div class="row">
                            <div class="col-md-12">

                                <table class="table table-bordered responsive">

                                    <thead>
                                        <tr>
                                            <th width="15%">#</th>
                                            <th>Start Date & Time</th>
                                            <th>End Date & Time</th>
                                            <th>Leave Count</th>
                                            <th>Leave Type</th>
                                            <th width="33%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;

                                        $row1 = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows($row1) > 0) {

                                            while ($record = mysqli_fetch_assoc($row1)) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $record['start_date']; ?></td>
                                                    <td><?php echo $record['end_date']; ?></td>
                                                    <td><?php echo $record['leave_count']; ?></td>
                                                    <td><?php echo $record['leave_type']; ?></td>
                                                    <td>
                                                        <a href="leave-detail.php?id=<?php echo $id ?>&type=approved" class="btn btn-sm btn-success">Accept</a>
                                                        <a href="leave-detail.php?id=<?php echo $id ?>&type=rejected" class="btn btn-sm btn-danger">Reject</a>
                                                    </td>
                                                </tr>
                                        <?php $i++;
                                            }
                                        }
                                        ?>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                </div>


            </div>

            <br />


            <br />



        </div>


       
        <?php include('includes/footer.php'); ?>