<?php
include("../config/db.php");


// Check the client whether admin or not
function isAdmin()
{
    if (isset($_SESSION['role'])) {
        if (isset($_SESSION['role']) == 'admin') {
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


function confirmQuery($result)
{
    global $conn;
    if (!$result) {
        die("QUERY FAILED" . mysqli_error($conn));
    }
    return true;
}


// Create A New Client
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


// Create A New Table
if (isset($_POST['create_table'])) {
    // admin check yap.
    $table_name = $_POST['name'];
    $table_description = $_POST['description'];
    $table_capacity = $_POST['capacity'];

    $name = escape($table_name);
    $description = escape($table_description);
    $capacity = escape($table_capacity);

    $query = "INSERT INTO tables(name,description,capacity)";
    $query .= "VALUES('{$name}','{$description}','{$capacity}')";
    $create_table_query = mysqli_query($conn, $query);
    if ($create_table_query) {
        header("Location: tables.php?addSuccess");
    }
}
