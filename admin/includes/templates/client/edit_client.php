<?php
if (isset($_POST['edit_client'])) {
    if (isUserExists($_POST['email'])) {
        header("Location: clients.php?source=edit_client&uid={$client_id}&editClientFailed");
    }

    $client_password = password_hash($_POST['password'], PASSWORD_BCRYPT, array('cost' => 12));
    $client_firstname = $_POST['firstName'];
    $client_lastname = $_POST['lastName'];
    $client_phone = $_POST['phone'];
    $client_email = $_POST['email'];
    $client_role = $_POST['role'];

    $firstName = escape($client_firstname);
    $lastName = escape($client_lastname);
    $email = escape($client_email);
    $phone = escape($client_phone);
    $role = escape($client_role);

    $query = "UPDATE clients SET ";
    $query .= "password = '{$client_password}', ";
    $query .= "firstName = '{$firstName}', ";
    $query .= "lastName = '{$lastName}', ";
    $query .= "email = '{$email}', ";
    $query .= "phone = '{$phone}', ";
    $query .= "role = '{$role}' ";
    $query .= "WHERE client_id = {$_GET['uid']}";

    $update_client = mysqli_query($conn, $query);
    if (confirmQuery($update_client)) {
        header("Location: clients.php?updateSuccess");
    }
}
?>

<?php
if (isset($_GET['uid'])) {
    $query = "SELECT * FROM clients WHERE client_id = {$_GET['uid']}";
    $get_client = mysqli_query($conn, $query);
    confirmQuery($get_client);
    while ($row = mysqli_fetch_assoc($get_client)) {
        $client_id = htmlspecialchars($row['client_id']);
        $firstName = htmlspecialchars($row['firstName']);
        $lastName = htmlspecialchars($row['lastName']);
        $email = htmlspecialchars($row['email']);
        $phone = htmlspecialchars($row['phone']);
        $role = htmlspecialchars($row['role']);

?>
        <?php
        if (isset($_GET['editClientField'])) {
            echo "<span class='text-danger mb-4'>Email already in used.</span>";
        }
        ?>

        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="firstName">Firstname:</label>
                <input type="text" class="form-control" name="firstName" id="firstName" value=<?php echo $firstName ?>>
            </div>

            <div class="form-group">
                <label for="lastName">Lastname:</label>
                <input type="text" class="form-control" name="lastName" id="lastName" value=<?php echo $lastName ?>>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" id="password" value="">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" id="email" value=<?php echo $email ?>>
            </div>


            <div class="form-group">
                <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="phone" id="phone" pattern="[0][0-9]{10}" placeholder="05XXXXXXXXX" value=<?php echo $phone ?> required>
            </div>


            <div class="form-group ">
                <label for="role">Role:</label>
                <select name="role" id="role">
                    <option value="admin">Admin</option>
                    <option value="client">Client</option>
                </select>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="edit_client" value="Edit Client">
            </div>

        </form>

<?php }
}
?>