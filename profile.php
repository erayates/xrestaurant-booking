<?php
include 'includes/templates/header.php';
?>

<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: sign-in.php");
    exit();
}
?>

<?php
if (isset($_POST['update_password'])) {
    $user_id = $_SESSION['user_id'];

    $old_password = $_POST['password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_new_password'];

    $old_password = escape($old_password);
    $new_password = escape($new_password);
    $confirm_password = escape($confirm_password);

    $query = "SELECT password FROM clients WHERE client_id = {$user_id}";
    $get_user = mysqli_query($conn, $query);

    confirmQuery($get_user);

    $user_password = "";
    if ($row = mysqli_fetch_assoc($get_user)) {
        $user_password = $row['password'];
    }

    if (password_verify($old_password, $user_password)) {
        if ($new_password === $confirm_password) {
            $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
            $query = "UPDATE clients SET password = '{$hashed_new_password}' WHERE client_id = {$user_id}";
            $update_user = mysqli_query($conn, $query);
            if ($update_user) {
                header("Location: profile.php?updateSuccess");
            } else {
                header("Location: profile.php?updateFailed");
            }
        } else {
            header("Location: profile.php?passwordNotMatch");
        }
    } else {
        header("Location: profile.php?wrongPassword");
    }
    exit();
}
?>



<?php
if (isset($_POST['update_profile'])) {
    $user_id = $_SESSION['user_id'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $user_phone = $_POST['user_phone'];

    $user_firstname = escape($user_firstname);
    $user_lastname = escape($user_lastname);
    $user_email = escape($user_email);
    $user_phone = escape($user_phone);

    if (checkOtherclients($user_email, $user_id)) {
        header("Location: profile.php?userExists");
        exit();
    }

    $query = "UPDATE clients SET firstName = '{$user_firstname}', lastName = '{$user_lastname}', email = '{$user_email}', phone = '{$user_phone}' WHERE client_id = {$user_id}";
    $update_user = mysqli_query($conn, $query);
    if (confirmQuery($update_user)) {
        header("Location: profile.php?updateProfileSuccess");
    }
}
?>

<section class="page-hero">
    <div class="d-flex container flex-column justify-content-center align-items-center">
        <h2 class="h1 font-weight-bold">Profile</h2>
    </div>
</section>

<?php
if (isset($_GET['updateSuccess'])) {
    echo "
    <div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
    <strong>SUCCESS!</strong> You have updated your profile!
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
}
?>

<section id="profile" class="section--space row container mx-auto">
    <div class="col-12 col-lg-6">
        <div class="row">
            <div class="col-12">
                <h1 class="page-header">
                    Profile
                </h1>
                <div class="bg-warning rounded" style="height: 6px;"></div>
                <div class="mt-3">
                    <?php
                    $get_user_query = "SELECT * FROM clients WHERE client_id = '" . $_SESSION['user_id'] . "'";
                    $select_user_query = mysqli_query($conn, $get_user_query);
                    if ($select_user_query) {
                        while ($row = mysqli_fetch_assoc($select_user_query)) {
                            $password = htmlspecialchars($row['password']);
                            $firstname = htmlspecialchars($row['firstName']);
                            $lastname = htmlspecialchars($row['lastName']);
                            $email = htmlspecialchars($row['email']);
                            $role = htmlspecialchars($row['role']);
                            $phone = htmlspecialchars($row['phone']);
                        }
                    }
                    ?>
                    <p><strong><i class="fa-solid fa-square"></i> Firstname: </strong> <?php echo $firstname ?></p>
                    <p><strong><i class="fa-solid fa-square"></i> Lastname: </strong> <?php echo $lastname ?></p>
                    <p><strong><i class="fa-solid fa-square"></i> Email: </strong> <?php echo $email ?></p>
                    <p><strong><i class="fa-solid fa-square"></i> Phone: </strong> <?php echo $phone ?></p>
                    <p><strong><i class="fa-solid fa-square"></i> Role: </strong> <?php echo $role ?></p>
                </div>
            </div>

            <div class="col-12 mt-5">
                <h1 class="page-header">
                    Change Password
                </h1>
                <div class="bg-warning rounded " style="height: 6px;"></div>

                <div class="mt-2">
                    <p class="text-danger">
                        <?php
                        if (isset($_GET['wrongPassword'])) {
                            echo "Please enter your current password correctly.";
                        } else if (isset($_GET['passwordNotMatch'])) {
                            echo "New password and confirm password do not match.";
                        }
                        ?>
                    </p>

                </div>
                <form method="POST" action="" class="mt-3">
                    <div class="form-group">
                        <label for="password">Current Password:</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password">New Password:</label>
                        <input type="password" class="form-control" name="new_password" id="new_password" required>
                    </div>

                    <div class="form-group">
                        <label for="confirm_new_password">Confirm New Password:</label>
                        <input type="password" class="form-control" name="confirm_new_password" id="confirm_new_password" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="update_password" value="Update Password">
                    </div>
                </form>
                </form>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-6 mt-5 mt-md-0">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Update Profile
                </h1>
            </div>

        </div>

        <div class="bg-warning rounded" style="height: 6px;"></div>

        <?php
        if (isset($_GET['userExists'])) {
            echo "
    <div class='alert alert-danger alert-dismissible fade show text-center mt-2' role='alert'>
    <strong>Email already used in.</strong>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
        }
        ?>



        <form method="POST" action="" enctype="multipart/form-data" class="mt-3">
            <div class="form-group">
                <label for="user_firstname">Firstname:</label>
                <input type="text" class="form-control" name="user_firstname" id="user_firstname" value=<?php echo $firstname ?>>
            </div>
            <div class="form-group">
                <label for="user_lastname">Lastname:</label>
                <input type="text" class="form-control" name="user_lastname" id="user_lastname" value=<?php echo $lastname ?>>

            </div>
            <div class="form-group">
                <label for="user_phone">Phone:</label>
                <input type="text" class="form-control" name="user_phone" id="user_phone" value=<?php echo $phone ?>>
            </div>


            <div class="form-group">
                <label for="user_email">Email:</label>
                <input type="email" class="form-control" name="user_email" id="user_email" value=<?php echo $email ?>>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="update_profile" value="Update Profile">
            </div>

        </form>

    </div>
    <div class="col-xs-12 mt-5" style="overflow-x: auto;">
        <h1 class="page-header">
            Your Reservations
        </h1>
        <div class="bg-warning rounded" style="height: 6px;"></div>
        <div>
            <table class="table table-striped mt-3" style="overflow-x: auto;">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Table ID</th>
                        <th scope="col"># of Guests</th>
                        <th scope="col">Message</th>
                        <th scope="col">Status</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $query = "SELECT * FROM reservations WHERE client_id = '" . $_SESSION['user_id'] . "'";
                    $get_all_reservations = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($get_all_reservations)) {
                        $table_id = htmlspecialchars($row['table_id']);
                        $reservation_id = htmlspecialchars($row['reservation_id']);
                        $num_guests =  htmlspecialchars($row['num_guests']);
                        $message = htmlspecialchars($row['message']);
                        $status = htmlspecialchars($row['status']);
                        $date = htmlspecialchars($row['date']);
                        $time = htmlspecialchars($row['time']);
                    ?>
                        <tr>
                            <th scope="row"><?php echo $reservation_id ?></th>
                            <td><?php echo $table_id ?></td>
                            <td><?php echo $num_guests ?></td>
                            <td><?php echo $message ?></td>
                            <td class="text-white"><?php if ($status === "pending") { ?>
                                    <span class='badge' style="background-color: blue;">Pending</span>
                                <?php } elseif ($status === "approved") { ?>
                                    <span class='badge' style="background-color: green;">Approved</span>
                                <?php } elseif ($status === "denied") { ?>
                                    <span class='badge' style="background-color: red;">Denied</span>
                                <?php }
                                ?>
                            </td>
                            <td><?php echo $date ?></td>
                            <td><?php echo $time ?></td>

                        <?php }
                        ?>

                </tbody>
            </table>
        </div>
    </div>
    </div>
</section>

<?php include 'includes/templates/footer.php' ?>