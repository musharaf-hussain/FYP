      <style>
          .line {
              display: inline-block;
          }

          .image.pull-right {
              float: right;
          }
      </style>
      <?php
        include('./connection.php');
        
        $pending_leaves_query1 = 'select * from employee_leaves where status = "Pending"';

        function query1($conn, $sql)
        {
            $row2 = mysqli_query($conn, $sql);
            return mysqli_num_rows($row2);
        }
        function getCurrentDate()
        {
            $dateTime = new DateTime();
            $currentDate = $dateTime->format('Y-m-d'); // Format: YYYY-MM-DD
            return $currentDate;
        }
        $auth = $_SESSION['auth'];
        $user_id = $auth['id'];
        $getSql = "SELECT * FROM attendences WHERE DATE(check_in)  = CURDATE() AND user_id='$user_id'";
        $d = mysqli_query($conn, $getSql);

        if(isset($_GET['attendence']) && $_GET['attendence']=='check_in'){
            echo '<script>alert("you successfully check in"); location.href = "http://localhost/projects/AMS";</script>';
            
        } else if (isset($_GET['attendence']) && $_GET['attendence']== 'check_out') {
            echo '<script>alert("you successfully check out"); location.href = "http://localhost/projects/AMS";</script>';
        }
        
        ?>
      <div class="row">

          <!-- Profile Info and Notifications -->
          <div class="col-md-6 col-sm-8 clearfix">

              <ul class="user-info pull-left pull-none-xsm">

                  <!-- Profile Info -->
                  <li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->

                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          <img src="assets/images/thumb-1@2x.png" alt="" class="img-circle" width="44" />
                          <?php echo $_SESSION['auth']['name']; ?>
                      </a>

                  </li>
                  <li class="notifications dropdown">
                      <?php
                        if (mysqli_num_rows($d) > 0) {
                        ?>
                          <a href="attendence_time.php?user_id=<?php echo $user_id ?>&type=check_out" class="btn btn-success">Check-out</a>
                      <?php
                        } else {
                        ?>
                          <a href="attendence_time.php?user_id=<?php echo $user_id ?>&type=check_in" class="btn btn-warning">Check-in</a>
                      <?php
                        }
                        ?>
                      <?php
                        $row2 = mysqli_query($conn, $pending_leaves_query1);

                        ?>
                      <?php
                        if (mysqli_num_rows($row2) > 0) {
                            while ($record1 = mysqli_fetch_assoc($row2)) {
                        ?>

                              <ul class="dropdown-menu">
                                  <li>

                                      <ul class="dropdown-menu-list scroller" tabindex="5002" style="overflow: hidden; outline: none;">
                                          <li>
                                              <a href="#">
                                                  <span class="line desc small">
                                                      An Employess Want Leave
                                                  </span>

                                                  <span class="image pull-right">
                                                      <?php $id1 = $record1['id']; ?>
                                                      <a href="leave-detail.php?id=<?php echo $id1 ?>" class="btn btn-sm btn-info">View</a>
                                                  </span>
                                              </a>
                                          </li>

                                      </ul>
                                  </li>


                              </ul>
                      <?php }
                        } ?>

                  </li>
              </ul>

          </div>


          <!-- Raw Links -->
          <div class="col-md-6 col-sm-4 clearfix hidden-xs">

              <ul class="list-inline links-list pull-right">

                  <li class="sep"></li>

                  <li>
                      <a href="./logout.php">
                          Log Out <i class="entypo-logout right"></i>
                      </a>
                  </li>
              </ul>

          </div>

      </div>