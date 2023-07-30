      <style>
          .line {
              display: inline-block;
          }

          .image.pull-right {
              float: right;
          }
      </style>
      <?php
        include('../connection.php');
        $pending_leaves_query1 = "select * from employee_leaves where status = 'pending'";

        function query1($conn, $sql)
        {
            $row2 = mysqli_query($conn, $sql);
            return mysqli_num_rows($row2);
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
                        $row2 = mysqli_query($conn, $pending_leaves_query1);

                        ?>
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="false">
                          <i class="entypo-bell"></i>

                          <span class="badge badge-secondary"><?php echo mysqli_num_rows($row2);  ?></span>
                      </a>
                      <?php
                        $i = 0;
                        if (mysqli_num_rows($row2) > 0) {

                        ?>

                          <ul class="dropdown-menu">
                              <li>

                                  <ul class="dropdown-menu-list scroller" tabindex="5002" style="overflow: hidden; outline: none; padding-inline:10px;">
                                      <?php
                                        while ($record1 = mysqli_fetch_assoc($row2)) { ?>
                                          <li style="display: flex; justify-content: space-between; padding-block:5px">
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
                                      <?php } ?>

                                  </ul>
                              </li>


                          </ul>
                      <?php
                        } ?>

                  </li>
              </ul>

          </div>


          <!-- Raw Links -->
          <div class="col-md-6 col-sm-4 clearfix hidden-xs">

              <ul class="list-inline links-list pull-right">

                  <li class="sep"></li>

                  <li>
                      <a href="../logout.php">
                          Log Out <i class="entypo-logout right"></i>
                      </a>
                  </li>
              </ul>

          </div>

      </div>