<?php include('./includes/header.php') ?>
<?php include('./connection.php'); ?>

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

                    <div class="col-sm-3 col-xs-12 col-lg-12">
                        <form role="form" class="form-horizontal form-groups-bordered" method="post" action="leaves.php">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Leave Type</label>

                                <div class="col-sm-5">
                                    <select class="form-control" name="leave_type">
                                        <option value="">Select Type</option>
                                        <option value="casual">Casual</option>
                                        <option value="sick">Sick</option>
                                        <option value="compensatory">Compensatory</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label" >Date</label>

                                <div class="col-sm-5">
                                    <input type="date" name="date" class="form-control input-lg" id="field-1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Apply</label>

                                <div class="col-sm-5">
                                    <input type="submit" value="Apply Leave" class="form-control input-lg btn btn-primary" id="field-1">
                                </div>
                            </div>
                        </form>
                    </div>

                </div>


            </div>

            <br />


            <br />




        </div>


        <?php
        if (isset($_POST['apply'])) {
        }
        ?>

        <?php include('./includes/footer.php') ?>