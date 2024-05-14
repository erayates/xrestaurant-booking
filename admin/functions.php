<?php
include("../config/db.php");

// Check the client whether admin or not
function isAdmin()
{
    if (isset($_SESSION['user_role'])) {
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
            return true;
        } else {
            return false;
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

    if (confirmQuery($create_client_query)) {
        header("Location: clients.php?addSuccess");
        exit();
    }
}


// Create A New Table
if (isset($_POST['create_table'])) {
    // admin check yap.
    $table_name = $_POST['name'];
    $table_description = $_POST['description'];
    $table_capacity = $_POST['capacity'];
    $table_status = $_POST['status'];

    $name = escape($table_name);
    $description = escape($table_description);
    $capacity = escape($table_capacity);
    $status = escape($table_status);

    $query = "INSERT INTO tables(name,description,capacity, status)";
    $query .= "VALUES('{$name}','{$description}','{$capacity}', '{$status}')";
    $create_table_query = mysqli_query($conn, $query);
    if (confirmQuery($create_table_query)) {
        header("Location: tables.php?addSuccess");
        exit();
    }
}


// Create A New Menu Item
if (isset($_POST['create_menu_item'])) {
    $item_name = $_POST['name'];
    $item_description = $_POST['description'];
    $item_price = $_POST['price'];
    $item_category = $_POST['category'];
    $item_image = $_FILES['image']['name'];
    $item_image_temp = $_FILES['image']['tmp_name'];

    $name = escape($item_name);
    $description = escape($item_description);
    $price = escape($item_price);
    $category = escape($item_category);

    if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        // Handle the error
        echo "File upload failed with error code: {$_FILES['image']['error']}";
    }

    $upload_directory = $_SERVER['DOCUMENT_ROOT'] . "/xrestaurant-booking/assets/images/menu/";
    move_uploaded_file($item_image_temp, $upload_directory . $item_image);

    $query = "INSERT INTO menu (name, description, price, category, image) ";
    $query .= "VALUES ('{$name}', '{$description}', '{$price}', '{$category}', '{$item_image}')";

    $create_menu_query = mysqli_query($conn, $query);

    if (confirmQuery($create_menu_query)) {
        header("Location: menu.php?addSuccess");
        exit();
    }
}

// Create A New Reservation

if (isset($_POST['create_reservation'])) {
    // admin check yap.
    $client_id = $_POST['client'];
    $table_id = $_POST['table'];
    $num_guests = $_POST['num_guests'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $status = $_POST['status'];
    $message = $_POST['message'];

    $client_id = escape($client_id);
    $table_id = escape($table_id);
    $num_guests = escape($num_guests);
    $date = escape($date);
    $time = escape($time);
    $status = escape($status);
    $message = escape($message);
    $query = "INSERT INTO reservations(client_id,table_id,num_guests,date,time,status,message)";
    $query .= "VALUES('{$client_id}','{$table_id}','{$num_guests}','{$date}','{$time}','{$status}','{$message}')";
    $create_reservation_query = mysqli_query($conn, $query);
    if (confirmQuery($create_reservation_query)) {
        // Rezervasyon durumu onaylanmış veya bekliyor durumda ise ilgili masanın durumu full olarak değişecek.
        if ($status === 'approved' || $status === 'pending') {
            $table_query = "UPDATE tables SET status = 'full' WHERE table_id = {$table_id}";
            $update_table_query = mysqli_query($conn, $table_query);
            if (confirmQuery($update_table_query)) {
                header("Location: reservations.php?addSuccess");
                exit();
            }
        } else {
            // Rezervasyon durumu reddedilmişse ilgili masanın durumu empty olarak değişecek.
            $table_query = "UPDATE tables SET status = 'empty' WHERE table_id = {$table_id}";
            $update_table_query = mysqli_query($conn, $table_query);
            if (confirmQuery($update_table_query)) {
                header("Location: reservations.php?addSuccess");
                exit();
            }
        }
    }
}
