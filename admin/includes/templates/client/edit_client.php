<?php
function confirmQuery($result)
{
    global $conn;
    if (!$result) {
        die("QUERY FAILED" . mysqli_error($conn));
    }
    return true;
}

if (isset($_GET['uid'])) {
    $query = "SELECT * FROM clients WHERE client_id = {$_GET['uid']}";
    $get_client = mysqli_query($conn, $query);
    confirmQuery($get_client);
    while ($row = mysqli_fetch_assoc($get_client)) {
        $client_id = $row['client_id'];
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
        $email = $row['email'];
        $phone = $row['phone'];
        $role = $row['role'];

?>
        <?php
        if (isset($_GET['editClientField'])) {
            echo "<span class='text-danger mb-4'>Email already in used.</span>";
        }
        ?>

        <form method="POST" action="functions.php" enctype="multipart/form-data">
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
