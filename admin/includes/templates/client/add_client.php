<?php
if (isset($_POST['create_client'])) {
    $client_password = password_hash($_POST['password'], PASSWORD_BCRYPT, array('cost' => 12));
    $client_firstname = $_POST['firstName'];
    $client_lastname = $_POST['lastName'];
    $client_email = $_POST['email'];
    $client_role = $_POST['role'];
    $client_phone = $_POST['phone'];

    $query = "INSERT INTO clients(password,firstName,lastName,email,role,phone)";
    $query .= "VALUES('{$client_password}','{$client_firstname}','{$client_lastname}','{$client_email}','{$client_role}','{$client_phone}')";
    $create_client_query = mysqli_query($conn, $query);

    if ($create_client_query) {
        header("Location: clients.php?addSuccess");
    }
}
?>


<form method="POST" action="" enctype="multipart/form-data">
    <div class="form-group">
        <label for="firstName">Firstname:</label>
        <input type="text" class="form-control" name="firstName" id="firstName" required>
    </div>

    <div class="form-group">
        <label for="lastName">Lastname:</label>
        <input type="text" class="form-control" name="lastName" id="lastName" required>
    </div>

    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" name="password" id="password" required>
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" name="email" id="email" required>
    </div>


    <div class="form-group">
        <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="phone" id="phone" pattern="[0][0-9]{10}" placeholder="05XXXXXXXXX" required>
    </div>


    <div class="form-group ">
        <label for="role">Role:</label>
        <select name="role" id="role" required>
            <option value="admin">Admin</option>
            <option value="client">Client</option>
        </select>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_client" value="Create Client">
    </div>

</form>