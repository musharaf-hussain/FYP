<?php include('./includes/header.php');
include('../connection.php'); ?>
<?php
$record = [];


if (isset($_POST['update'])) {
    $casual_leaves = $_POST['casual_leaves'];
    $componsatory_leaves = $_POST['componsatory_leaves'];
    $medical_leaves = $_POST['medical_leaves'];
    $sql = "SELECT * FROM leaves WHERE id IS NOT NULL";
    $row = mysqli_query($conn, $sql);
    if (mysqli_num_rows($row) > 0) {
        $result = mysqli_fetch_assoc($row);
        $id = $result['id'];
        $sql = "UPDATE leaves SET casual_leaves = '$casual_leaves', componsatory_leaves = '$componsatory_leaves', medical_leaves = '$medical_leaves' WHERE id = $id";
    } else {
        $sql = "INSERT INTO leaves (casual_leaves, componsatory_leaves, medical_leaves) VALUES ('$casual_leaves', '$componsatory_leaves', '$medical_leaves')";
    }

    if (mysqli_query($conn, $sql)) {
        $_SESSION['flash_message'] = true;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

    $sql = "SELECT * FROM leaves WHERE id IS NOT NULL";
    $row = mysqli_query($conn, $sql);
    if (mysqli_num_rows($row) > 0) {
        $record = mysqli_fetch_assoc($row);
    }
?>

<body class="page-body  page-fade" data-url="http://neon.dev">

    <div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
        <?php include('./includes/sidebar.php') ?>

        <div class="main-content">
            <?php include('./includes/top-navbar.php') ?>
            <hr />
            <div class="row">
                <form action="leaves.php" method="post">
                    <div class="panel-body">
                        <?php
                        if (isset($_SESSION['flash_message'])) {
                        ?>
                            <div class="alert alert-success">Updated record successfully</div>
                        <?php
                            unset($_SESSION['flash_message']);
                        }
                        ?>

                        <div class="col-sm-3 col-xs-12 col-lg-12">
                            <h3>Leaves</h3>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-1" class=" control-label">Casual Leave</label>

                                        <div class="">
                                            <input type="number" name="casual_leaves" value=<?php echo count($record) > 0 ? $record['casual_leaves'] : 0 ?> class="form-control" id="field-1" placeholder="Placeholder">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-1" class=" control-label">Compensatory Leave</label>

                                        <div class="">
                                            <input type="number" name="componsatory_leaves" value=<?php echo count($record) > 0 ? $record['componsatory_leaves'] : 0 ?> class="form-control" id="field-1" placeholder="Placeholder">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-1" class=" control-label">Medical Leave</label>

                                        <div class="">
                                            <input type="number" name="medical_leaves" value=<?php echo count($record) > 0 ? $record['medical_leaves'] : 0 ?> class="form-control" id="field-1" placeholder="Placeholder">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <input type="submit" name="update" class="btn btn-gold" id="field-1" value="update">
                            </div>
                        </div>

                    </div>
                </form>

            </div>

            <br />


            <br />


            <script type="text/javascript">
                // Code used to add Todo Tasks
                jQuery(document).ready(function($) {
                    var $todo_tasks = $("#todo_tasks");

                    $todo_tasks.find('input[type="text"]').on('keydown', function(ev) {
                        if (ev.keyCode == 13) {
                            ev.preventDefault();

                            if ($.trim($(this).val()).length) {
                                var $todo_entry = $('<li><div class="checkbox checkbox-replace color-white"><input type="checkbox" /><label>' + $(this).val() + '</label></div></li>');
                                $(this).val('');

                                $todo_entry.appendTo($todo_tasks.find('.todo-list'));
                                $todo_entry.hide().slideDown('fast');
                                replaceCheckboxes();
                            }
                        }
                    });
                });
            </script>

        </div>

    </div>
    <?php include('./includes/footer.php');

    ?>