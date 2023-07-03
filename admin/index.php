
<?php include('./includes/header.php') ?>
<script type="text/javascript">
    function getRandomInt(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }
</script>

<body class="page-body  page-fade" data-url="http://neon.dev">

    <div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

        <?php include('./includes/sidebar.php') ?>

        <div class="main-content">

            <?php include('./includes/top-navbar.php') ?>

            <hr />

            <div class="row">
                <div class="col-sm-3 col-xs-6">

                    <div class="tile-stats tile-red">
                        <div class="icon"><i class="entypo-users"></i></div>
                        <div class="num" data-start="0" data-end="83" data-postfix="" data-duration="1500" data-delay="0">0</div>

                        <h3>Approved Leaves</h3>
                        <p>All Approved Leaves</p>
                    </div>

                </div>

                <div class="col-sm-3 col-xs-6">

                    <div class="tile-stats tile-green">
                        <div class="icon"><i class="entypo-chart-bar"></i></div>
                        <div class="num" data-start="0" data-end="135" data-postfix="" data-duration="1500" data-delay="600">0</div>

                        <h3>Pending Leave</h3>
                        <p>Pending leave</p>
                    </div>

                </div>

                <div class="clear visible-xs"></div>

            </div>
            <br />
            <br />
        </div>
    </div>

<?php include('./includes/footer.php')?>