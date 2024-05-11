<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header container">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">XRESTO Admin</a>
    </div>

    <ul class="nav navbar-right top-nav">
        <li><a href="../index.php" style="font-weight: bold;">Home Site</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
            <ul class="dropdown-menu message-dropdown">
                <li class="message-preview">
                    <a href="#">
                        <div class="media">
                            <span class="pull-left">
                                <img class="media-object" src="http://placehold.it/50x50" alt="">
                            </span>
                            <div class="media-body">
                                <h5 class="media-heading">
                                    <strong><?php echo $_SESSION['user_firstname'] . "" . $_SESSION['user_lastname'] ?></strong>
                                </h5>
                                <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                <p>Lorem ipsum dolor sit amet, consectetur...</p>
                            </div>
                        </div>
                    </a>
                </li>

                <li class="message-footer">
                    <a href="#">Read All New Messages</a>
                </li>
            </ul>
        </li>

        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php if (isset($_SESSION['user_username'])) echo $_SESSION['user_firstname'] . " " . $_SESSION['user_lastname'] ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                </li>

                <li class="divider"></li>
                <li>
                    <a href="../logout.php?logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>

    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
            </li>

            <li>
                <a href="clients.php"><i class="fa-solid fa-user"></i> Clients</a>
            </li>
            <li>
                <a href="clients.php"> <i class="fa-solid fa-menorah"></i> Menu</a>
            </li>

            <li>
                <a href="#" data-toggle="collapse" data-target="#reservations_dropdown"><i class="fa-solid fa-registered"></i> Reservations <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="reservations_dropdown" class="collapse">
                    <li>
                        <a href="reservations.php"><i class="fa-solid fa-eye"></i> View All Reservations</a>
                    </li>
                    <li>
                        <a href="reservations.php?source=add_reservation"><i class="fa-solid fa-plus"></i> Add Reservation</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#tables_dropdown"><i class="fa-solid fa-chair"></i> Tables <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="tables_dropdown" class="collapse">
                    <li>
                        <a href="tables.php"><i class="fa-solid fa-eye"></i> View All Tables</a>
                    </li>
                    <li>
                        <a href="tables.php?source=add_table"><i class="fa-solid fa-plus"></i> Add Table</a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="messages.php"><i class="fa-solid fa-message"></i></i> Messages</a>
            </li>

        </ul>
    </div>
</nav>