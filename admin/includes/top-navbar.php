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

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="false">
                                <i class="entypo-bell"></i>
                                <span class="badge badge-secondary">10</span>
                            </a>

                            <ul class="dropdown-menu">
                                <li>

                                    <ul class="dropdown-menu-list scroller" tabindex="5002" style="overflow: hidden; outline: none;">
                                        <li>
                                            <a href="#">
                                                <span class="image pull-right">
                                                    <button class="btn btn-sm btn-success">Accept</button>
                                                    <button class="btn btn-sm btn-danger">Reject</button>
                                                </span>

                                                <span class="line">
                                                    Hayden Cartwright
                                                    - a week ago
                                                </span>

                                                <span class="line desc small">
                                                    Whose her enjoy chief new young. Felicity if ye required likewise so doubtful.
                                                </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <span class="image pull-right">
                                                    <button class="btn btn-sm btn-success">Accept</button>
                                                    <button class="btn btn-sm btn-danger">Reject</button>
                                                </span>

                                                <span class="line">
                                                    Hayden Cartwright
                                                    - a week ago
                                                </span>

                                                <span class="line desc small">
                                                    Whose her enjoy chief new young. Felicity if ye required likewise so doubtful.
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>


                            </ul>

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