<header>
    <nav class="navbar navbar-expand-lg py-4 navbar-dark" id="ftco-navbar" style="background-color: #1c2331;">
        <div class="container">
            <a id="navbar-brand" href="index.php">XResto</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars">
                </span>
            </button>

            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item actives"><a href="index.php" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="about-us.php" class="nav-link">About Us</a></li>
                    <li class="nav-item"><a href="menu.php" class="nav-link">Menu</a></li>
                    <li class="nav-item"><a href="contact-us.php" class="nav-link">Contact Us</a></li>
                    <li class="nav-item" id="cta"><a href="reservation.php" class="nav-link">Book a table</a></li>

                    <div class="d-flex md-d-block mt-2 mt-md-0">
                        <li class="nav-item ml-md-2">
                            <?php
                            if (isset($_SESSION['user_role'])) {
                                if ($_SESSION['user_role'] == 'admin') {
                                    echo "<a href='admin/index.php' class='btn btn-primary rounded-0'>Dashboard
                                    </a>";
                                }
                            }
                            ?>
                        </li>

                        <li class="nav-item ml-2">
                            <?php
                            if (isset($_SESSION['user_id'])) {
                                echo "<a href='profile.php' class='btn btn-primary rounded-0'><i class='fa-solid fa-user'></i>
                                    </a>";
                            }
                            ?>
                        </li>

                        <li class="nav-item ml-2">
                            <?php
                            if (isset($_SESSION['user_id'])) {
                                echo "<a href='logout.php?logout' class='btn btn-danger rounded-0'><i class='bi bi-box-arrow-in-left'></i>
                                </i>
                                    </a>";
                            } else {
                                echo "<a href='sign-in.php' class='btn btn-primary rounded-0'><i class='bi bi-box-arrow-in-right'></i>
                                    </a>";
                            }
                            ?>
                        </li>
                    </div>


                </ul>
            </div>
        </div>
    </nav>

</header>