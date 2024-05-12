<?php
include("../config/db.php");


// Check the client whether admin or not
function isAdmin()
{
    if (isset($_SESSION['user_role'])) {
        if (isset($_SESSION['user_role']) == 'admin') {
            return true;
        }
    }
}

function escape($string)
{
    global $conn;
    return mysqli_real_escape_string($conn, trim($string));
}

function isUserExists($email)
{
    global $conn;

    $sanitized_email = escape($email);
    $query = "SELECT * FROM clients WHERE email = '{$sanitized_email}'";
    $select_query = mysqli_query($conn, $query);

    if (!$select_query) {
        die("Query failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($select_query) > 0) {
        return true;
    } else {
        return false;
    }
}


// Edit Client
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


// Create Client
if (isset($_POST['create_client'])) {
    if (isUserExists($_POST['email'])) {
        header("Location: clients.php?source=add_client&addClientFailed");
        exit();
    }

    $client_password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_BCRYPT, array('cost' => 12));
    $client_firstname = $_POST['firstName'];
    $client_lastname = $_POST['lastName'];
    $client_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $client_role = $_POST['role'];
    $client_phone = $_POST['phone'];

    $email = escape($client_email);
    $firstName = escape($client_firstname);
    $lastName = escape($client_lastname);
    $role = escape($client_role);
    $phone = escape($client_phone);

    $query = "INSERT INTO clients(password,firstName,lastName,email,role,phone)";
    $query .= "VALUES('{$client_password}','{$firstName}','{$lastName}','{$email}','{$role}','{$phone}')";
    $create_client_query = mysqli_query($conn, $query);

    if ($create_client_query) {
        header("Location: clients.php?addSuccess");
    }
}
