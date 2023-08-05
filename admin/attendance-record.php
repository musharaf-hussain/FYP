<?php include('./includes/header.php'); ?>
<?php include('../env.php');
$start = isset($_GET['start']) && $_GET['start'] != '' ? $_GET['start'] : null;
$end = isset($_GET['end']) && $_GET['end'] != ''  ? $_GET['end']  : null;
?>

<?php
$id = null;
if (isset($_GET['id']) && $_GET['id'] !== '') {
    $id = $_GET['id'];
} else {
    echo '<h1>Page Not found</h1>';
    die();
}
function getHours($user_id, $conn)
{
    $currentYear = date('Y');
    $currentMonth = date('m');

    // Form the start and end dates of the current month
    $startOfMonth = $currentYear . '-' . $currentMonth . '-01 00:00:00';
    $endOfMonth = $currentYear . '-' . $currentMonth . '-31 23:59:59';
    $sql = "Select * from attendences where user_id ='$user_id' AND created_at >= '$startOfMonth' AND created_at <= '$endOfMonth'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($query);
    $totalHours = 0;

    if ($row > 0) {
        while ($record = mysqli_fetch_assoc($query)) {
            if ($record['check_in'] && $record['check_out']) {
                $startDateTime = new DateTime($record['check_in']);
                $endDateTime = new DateTime($record['check_out']);

                // Calculate the interval between the two date-times
                $interval = $startDateTime->diff($endDateTime);

                // Extract the total hours from the interval
                $totalHours = $totalHours + ($interval->days * 24 + $interval->h);
            }
        }

        return $totalHours;
    }
    return 0;
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
                        if ($start && $end) {

                            $start = $start . ' 00:00:00';
                            $end = $end . ' 23:59:00';
                            $sql = "SELECT * FROM users JOIN attendences ON users.id = attendences.user_id where users.id = '$id' AND created_at >= '$start' AND created_at <= '$end' ";
                        } else {
                            $sql = "SELECT * FROM users JOIN attendences ON users.id = attendences.user_id where users.id = '$id'";
                        }
                        // $sql = "SELECT * FROM users JOIN attendences ON users.id = attendences.user_id where users.id = '$id'";
                        $user = query($conn, $sql);
                    }
                    ?>
                    <div class="col-sm-3 col-xs-12 col-lg-12">
                        <?php
                        if ($id && $user) {
                        ?>
                            <h3><?php echo $user['email']; ?> leave records</h3>
                        <?php } ?>

                        <div>
                            <h4>Employee's Current Month Working Hours : <strong><?php echo getHours($id, $conn); ?></strong></h4>
                        </div>
                        <br>

                        <div class="row">
                            <div class="form-group " style="margin-bottom:10px;">
                                <label class=" control-label">Selected Date Range</label>
                                <div class="">
                                    <input type="text" class="form-control daterange" value="<?php echo $end ? $start . ',' . $end : '' ?>" data-format="YYYY-MM-DD" data-separator=" , " />
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">

                                <table class="table table-bordered responsive">

                                    <thead>
                                        <tr>
                                            <th width="15%">#</th>
                                            <th>Check-in Time</th>
                                            <th>Check-out Time</th>

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
                                                    <td><?php echo $record['check_in']; ?></td>
                                                    <td><?php echo $record['check_out']; ?></td>

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

    <script>
        $('.daterange').change(function() {
            let dateRangeStr = $(this).val()
            var [start, end] = dateRangeStr.split(" , ");
            let url = '<?php echo $adminBaseUrl; ?>/attendance-record.php?id=<?php echo $id ?>';
            url = url + '&start=' + start + '&end=' + end
            window.location.href = url
        })
    </script>

    <?php include('includes/footer.php'); ?>