<?php include('./includes/header.php') ?>
<?php include('./connection.php'); ?>
<?php
if (isset($_POST['apply'])) {
    $geSql = "Select * from leaves";
    $data = mysqli_query($conn, $geSql);
    $record = mysqli_fetch_assoc($data);
    $casualLeaves = $record['casual_leaves'];
    $componsatoryLeaves = $record['componsatory_leaves'];
    $medicalLeaves = $record['medical_leaves'];


    $leaveType = $_POST['leave_type'];
    $from = $_POST['from'];
    $to = $_POST['to'];
    $daysCount = getDaysCount($from, $to);
    $auth = $_SESSION['auth'];
    $id = $auth['id'];
    if($from > $to){
        $_SESSION['flash_message'] = 'From Date should be Lower than to';
        $_SESSION['isSuccess'] = false;    
    }else {
        $geSql = "Select sum(leave_count) from employee_leaves where user_id='$id' AND leave_type='$leaveType'";
        $data = mysqli_query($conn,$geSql);
        $record = mysqli_fetch_all($data);
        $sql = "INSERT INTO employee_leaves (leave_type, start_date,end_date,status,user_id,leave_count) VALUES ('$leaveType', '$from', '$to','pending','$id','$daysCount')";
        if($leaveType=='casual'){
            if (($daysCount + $record[0][0]) >= $casualLeaves) {
                $_SESSION['flash_message'] = 'you have used all '. $leaveType. "Leaves";
                $_SESSION['isSuccess'] = false;    
            }else {
                saveLeaves($conn,$sql);
            }
        }else if($leaveType == 'sick') {
            if (($daysCount + $record[0][0]) >= $medicalLeaves) {
                $_SESSION['flash_message'] = 'you have used all ' . $leaveType . "Leaves";
                $_SESSION['isSuccess'] = false;
            } else {
                saveLeaves($conn, $sql);
            }
        } else if ($leaveType == 'compensatory') {
            if (($daysCount + $record[0][0]) >= $componsatoryLeaves) {
                $_SESSION['flash_message'] = 'you have used all ' . $leaveType . "Leaves";
                $_SESSION['isSuccess'] = false;
            } else {
                saveLeaves($conn, $sql);
            }
        }
        
        
    }
    
}
function getDaysCount($startDate, $endDate)
{
    // Create DateTime objects from the date strings
    $startDateTime = DateTime::createFromFormat('Y-m-d', $startDate);
    $endDateTime = DateTime::createFromFormat('Y-m-d', $endDate);

    // Calculate the difference between the two dates
    $interval = $endDateTime->diff($startDateTime);

    // Return the number of days as an integer
    return $interval->days;
}
function saveLeaves($conn,$sql){

    if (mysqli_query($conn, $sql)) {
        $_SESSION['flash_message'] = 'Leave Applied Successfully';
        $_SESSION['isSuccess'] = true;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<body class="page-body" data-url="http://neon.dev">

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
                        <div class="alert <?php echo $_SESSION['isSuccess'] == true ? 'alert-success' : 'alert-danger' ?>">
                            <?php echo $_SESSION['flash_message'] ?>
                        </div>
                    <?php
                        unset($_SESSION['flash_message']);
                        unset($_SESSION['isSuccess']);
                    }
                    ?>
                    <div class="col-sm-3 col-xs-12 col-lg-12">
                        <form role="form" class="form-horizontal form-groups-bordered" method="post" action="leaves.php">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Leave Type</label>

                                <div class="col-sm-5">
                                    <select class="form-control" name="leave_type" required>
                                        <option value="">Select Type</option>
                                        <option value="casual">Casual</option>
                                        <option value="sick">Sick</option>
                                        <option value="compensatory">Compensatory</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">From</label>

                                <div class="col-sm-5">
                                    <input type="date" required name="from" class="form-control input-lg" id="field-1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">To</label>

                                <div class="col-sm-5">
                                    <input type="date" required name="to" class="form-control input-lg" id="field-1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Apply</label>

                                <div class="col-sm-5">
                                    <input type="submit" value="Apply Leave" name="apply" class="form-control input-lg btn btn-primary" id="field-1">
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