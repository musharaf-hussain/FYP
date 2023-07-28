<?php include('./includes/header.php'); ?>
<?php include('./connection.php'); ?>
<?php
$id = $_SESSION['auth']['id'];
function query($conn, $sql)
{
    $row1 = mysqli_query($conn, $sql);
    $record1 = mysqli_fetch_assoc($row1);
    return $record1;
}
$sql_sick_leave = "SELECT SUM(leave_count) AS sick_leave_count FROM employee_leaves WHERE leave_type = 'sick' AND user_id='$id' AND status='Approved'";
$sql_casual_leave = "SELECT SUM(leave_count) AS casual_leave_count FROM employee_leaves WHERE leave_type = 'casual' AND user_id='$id' AND status='Approved'";
$sql_compensatory_leave = "SELECT SUM(leave_count) AS compensatory_leave_count FROM employee_leaves WHERE leave_type = 'compensatory' AND user_id='$id' AND status='Approved'";
$s_record = query($conn, $sql_sick_leave);
$c_record = query($conn, $sql_casual_leave);
$com_record = query($conn, $sql_compensatory_leave);

/**  */
$sql_l = "SELECT * FROM leaves WHERE id IS NOT NULL";
$leaveRecord = query($conn, $sql_l);



include('./connection.php');
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
                    if ($id) {
                        $sql = "SELECT * FROM users JOIN employee_leaves ON users.id = employee_leaves.user_id where users.id = '$id'";
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
                                            <th>Remaining Casual Leaves</th>
                                            <th>Remaining Sick Leaves</th>
                                            <th>Remaining Componensatory Leaves</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $leaveRecord['medical_leaves'] - $s_record['sick_leave_count'] ?? 0 ;  ?></td>
                                            <td><?php echo $leaveRecord['casual_leaves'] - $c_record['casual_leave_count'] ?? 0;  ?></td>
                                            <td><?php echo $leaveRecord['componsatory_leaves'] - $com_record['compensatory_leave_count'] ?? 0;  ?></td>
                                        </tr>
                                    </tbody>

                                    <table class="table table-bordered responsive">

                                        <thead>
                                            <tr>
                                                <th width="15%">#</th>
                                                <th>Start Date & Time</th>
                                                <th>End Date & Time</th>
                                                <th>Leave Type</th>
                                                <th width="33%">Status</th>
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
                                                        <td><?php echo $record['leave_type']; ?></td>
                                                        <td>
                                                            <?php if ($record['status'] == 'Approved') {
                                                            ?>
                                                                <div class="label label-success">Approved </div>

                                                            <?php
                                                            } else if ($record['status'] == 'Rejected') {
                                                            ?>
                                                                <div class="label label-secondary">Rejected</div>

                                                            <?php
                                                            } else if ($record['status'] == 'pending') {
                                                            ?>
                                                                <div class="label label-secondary">Pending</div>

                                                            <?php } ?>

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


        <div id="chat" class="fixed" data-current-user="Art Ramadani" data-order-by-status="1" data-max-chat-history="25">

            <div class="chat-inner">


                <h2 class="chat-header">
                    <a href="#" class="chat-close"><i class="entypo-cancel"></i></a>

                    <i class="entypo-users"></i>
                    Chat
                    <span class="badge badge-success is-hidden">0</span>
                </h2>


                <div class="chat-group" id="group-1">
                    <strong>Favorites</strong>

                    <a href="#" id="sample-user-123" data-conversation-history="#sample_history"><span class="user-status is-online"></span> <em>Catherine J. Watkins</em></a>
                    <a href="#"><span class="user-status is-online"></span> <em>Nicholas R. Walker</em></a>
                    <a href="#"><span class="user-status is-busy"></span> <em>Susan J. Best</em></a>
                    <a href="#"><span class="user-status is-offline"></span> <em>Brandon S. Young</em></a>
                    <a href="#"><span class="user-status is-idle"></span> <em>Fernando G. Olson</em></a>
                </div>


                <div class="chat-group" id="group-2">
                    <strong>Work</strong>

                    <a href="#"><span class="user-status is-offline"></span> <em>Robert J. Garcia</em></a>
                    <a href="#" data-conversation-history="#sample_history_2"><span class="user-status is-offline"></span> <em>Daniel A. Pena</em></a>
                    <a href="#"><span class="user-status is-busy"></span> <em>Rodrigo E. Lozano</em></a>
                </div>


                <div class="chat-group" id="group-3">
                    <strong>Social</strong>

                    <a href="#"><span class="user-status is-busy"></span> <em>Velma G. Pearson</em></a>
                    <a href="#"><span class="user-status is-offline"></span> <em>Margaret R. Dedmon</em></a>
                    <a href="#"><span class="user-status is-online"></span> <em>Kathleen M. Canales</em></a>
                    <a href="#"><span class="user-status is-offline"></span> <em>Tracy J. Rodriguez</em></a>
                </div>

            </div>

            <!-- conversation template -->
            <div class="chat-conversation">

                <div class="conversation-header">
                    <a href="#" class="conversation-close"><i class="entypo-cancel"></i></a>

                    <span class="user-status"></span>
                    <span class="display-name"></span>
                    <small></small>
                </div>

                <ul class="conversation-body">
                </ul>

                <div class="chat-textarea">
                    <textarea class="form-control autogrow" placeholder="Type your message"></textarea>
                </div>

            </div>

        </div>


        <!-- Chat Histories -->
        <ul class="chat-history" id="sample_history">
            <li>
                <span class="user">Art Ramadani</span>
                <p>Are you here?</p>
                <span class="time">09:00</span>
            </li>

            <li class="opponent">
                <span class="user">Catherine J. Watkins</span>
                <p>This message is pre-queued.</p>
                <span class="time">09:25</span>
            </li>

            <li class="opponent">
                <span class="user">Catherine J. Watkins</span>
                <p>Whohoo!</p>
                <span class="time">09:26</span>
            </li>

            <li class="opponent unread">
                <span class="user">Catherine J. Watkins</span>
                <p>Do you like it?</p>
                <span class="time">09:27</span>
            </li>
        </ul>




        <!-- Chat Histories -->
        <ul class="chat-history" id="sample_history_2">
            <li class="opponent unread">
                <span class="user">Daniel A. Pena</span>
                <p>I am going out.</p>
                <span class="time">08:21</span>
            </li>

            <li class="opponent unread">
                <span class="user">Daniel A. Pena</span>
                <p>Call me when you see this message.</p>
                <span class="time">08:27</span>
            </li>
        </ul>


    </div>

    <!-- Sample Modal (Default skin) -->
    <div class="modal fade" id="sample-modal-dialog-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Widget Options - Default Modal</h4>
                </div>

                <div class="modal-body">
                    <p>Now residence dashwoods she excellent you. Shade being under his bed her. Much read on as draw. Blessing for ignorant exercise any yourself unpacked. Pleasant horrible but confined day end marriage. Eagerness furniture set preserved far recommend. Did even but nor are most gave hope. Secure active living depend son repair day ladies now.</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Sample Modal (Skin inverted) -->
    <div class="modal invert fade" id="sample-modal-dialog-2">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Widget Options - Inverted Skin Modal</h4>
                </div>

                <div class="modal-body">
                    <p>Now residence dashwoods she excellent you. Shade being under his bed her. Much read on as draw. Blessing for ignorant exercise any yourself unpacked. Pleasant horrible but confined day end marriage. Eagerness furniture set preserved far recommend. Did even but nor are most gave hope. Secure active living depend son repair day ladies now.</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Sample Modal (Skin gray) -->
    <div class="modal gray fade" id="sample-modal-dialog-3">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Widget Options - Gray Skin Modal</h4>
                </div>

                <div class="modal-body">
                    <p>Now residence dashwoods she excellent you. Shade being under his bed her. Much read on as draw. Blessing for ignorant exercise any yourself unpacked. Pleasant horrible but confined day end marriage. Eagerness furniture set preserved far recommend. Did even but nor are most gave hope. Secure active living depend son repair day ladies now.</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>




    <!-- Imported styles on this page -->
    <link rel="stylesheet" href="assets/js/jvectormap/jquery-jvectormap-1.2.2.css">
    <link rel="stylesheet" href="assets/js/rickshaw/rickshaw.min.css">

    <!-- Bottom scripts (common) -->
    <script src="assets/js/gsap/TweenMax.min.js"></script>
    <script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/joinable.js"></script>
    <script src="assets/js/resizeable.js"></script>
    <script src="assets/js/neon-api.js"></script>
    <script src="assets/js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>


    <!-- Imported scripts on this page -->
    <script src="assets/js/jvectormap/jquery-jvectormap-europe-merc-en.js"></script>
    <script src="assets/js/jquery.sparkline.min.js"></script>
    <script src="assets/js/rickshaw/vendor/d3.v3.js"></script>
    <script src="assets/js/rickshaw/rickshaw.min.js"></script>
    <script src="assets/js/raphael-min.js"></script>
    <script src="assets/js/morris.min.js"></script>
    <script src="assets/js/toastr.js"></script>
    <script src="assets/js/neon-chat.js"></script>


    <!-- JavaScripts initializations and stuff -->
    <script src="assets/js/neon-custom.js"></script>


    <!-- Demo Settings -->
    <script src="assets/js/neon-demo.js"></script>

</body>

</html>