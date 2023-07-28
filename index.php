<?php include('./includes/header.php') ?>
<?php include('./connection.php');
$id = $_SESSION['auth']['id'];
$approved_leaves = "SELECT SUM(leave_count) AS count FROM employee_leaves where user_id='$id' AND status='Approved'";

$pending_leaves_query = "SELECT count(*) AS count FROM employee_leaves where user_id='$id' AND status='pending'";


function query($conn, $sql)
{
    $row1 = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($row1);
}

?>
<script type="text/javascript">
    function getRandomInt(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }
</script>

<body class="page-body " data-url="http://neon.dev">

    <div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

        <?php include('./includes/sidebar.php') ?>

        <div class="main-content">

            <?php include('./includes/top-navbar.php') ?>

            <hr />

            <div class="row">
                <div class="col-sm-3 col-xs-6">

                    <div class="tile-stats tile-red">
                        <div class="icon"><i class="entypo-users"></i></div>
                        <div class="num" data-start="0" data-end=<?php echo query($conn, $approved_leaves)['count']; ?> data-postfix="" data-duration="1500" data-delay="0">0</div>

                        <h3>Approved Leaves</h3>
                        <p>Leaves that being approved</p>
                    </div>

                </div>

                <div class="col-sm-3 col-xs-6">

                    <div class="tile-stats tile-green">
                        <div class="icon"><i class="entypo-chart-bar"></i></div>
                        <div class="num" data-start="0" data-end=<?php echo query($conn, $pending_leaves_query)['count']; ?> data-postfix="" data-duration="1500" data-delay="600">0</div>

                        <h3>Pending Leaves Request</h3>
                        <p>Leaves that being not approved</p>
                    </div>

                </div>

                <div class="clear visible-xs"></div>

            </div>
            <br />
            <br />
        </div>
    </div>

    <?php include('./includes/footer.php') ?>