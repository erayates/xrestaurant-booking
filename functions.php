<?php

session_start();
include("./config/db.php");

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







// Register Logic
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['register'])) {
        if (!empty($_POST["firstName"]) && !empty($_POST["lastName"]) && !empty($_POST["email"]) && !empty($_POST["phone"]) && !empty($_POST["password"])) {
            $firstName = $_POST["firstName"];
            $lastName = $_POST["lastName"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $password = $_POST["password"];

            $firstName = escape($firstName);
            $lastName = escape($lastName);
            $email = escape($email);
            $phone = escape($phone);
            $password = escape($password);

            echo $firstName, $lastName, $email, $phone, $password;

            if (isUserExists($email)) {
                header("Location: sign-up.php?userExists");
                exit();
            } else {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                $query = "INSERT INTO clients (firstName, lastName, email, phone, password, role) VALUES ('$firstName', '$lastName', '$email', '$phone', '$hashedPassword', 'client')";

                $reg_user = mysqli_query($conn, $query);

                if (!$reg_user) {
                    die("QUERY FAILED" . mysqli_error($conn));
                }

                header("Location: sign-up.php?success");
                exit();
            }
        }
    }
}

// Login Logic
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $email = escape($email);
            $password = escape($password);

            $query = "SELECT * FROM clients WHERE email = '{$email}'";
            $result = mysqli_query($conn, $query);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                if ($row) {
                    if (password_verify($password, $row['password'])) {
                        $_SESSION['user_id'] = $row["client_id"];
                        $_SESSION['user_firstname'] = $row['firstName'];
                        $_SESSION['user_lastname'] = $row['lastName'];
                        $_SESSION['user_phone'] = $row['phone'];
                        $_SESSION['user_email'] = $row['email'];
                        $_SESSION['user_role'] = $row['role'];


                        session_regenerate_id(true);
                        header("Location: index.php?loginSuccess");
                        session_write_close();
                        exit();
                    } else {
                        header("Location: sign-in.php?loginFailed");
                        exit();
                    }
                } else {
                    header("Location: sign-in.php?loginFailed");
                    exit();
                }
            } else {
                header("Location: sign-in.php?loginFailed");
                exit();
            }
        }
    }
}




// Create A Reservation
if (isset($_POST['reservation'])) {
    $client_id = $_SESSION['user_id'];
    $table_id = $_POST['table'];
    $reservation_date = $_POST['reservation_date'];
    $reservation_time = $_POST['reservation_time'];
    $num_guests = $_POST['num_guests'];
    $message = $_POST['message'];
    $status = "pending";


    $client_id = escape($client_id);
    $table_id = escape($table_id);
    $reservation_date = escape($reservation_date);
    $reservation_time = escape($reservation_time);
    $num_guests = escape($num_guests);
    $message = escape($message);

    $query = "INSERT INTO reservations (client_id, table_id, num_guests, date, time, status, message) VALUES ('$client_id', '$table_id', '$num_guests', '$reservation_date', '$reservation_time', '$status', '$message')";
    $reg_reservation = mysqli_query($conn, $query);
    if (confirmQuery($reg_reservation)) {
        $table_query = "UPDATE tables SET status = 'full' WHERE table_id = {$table_id}";
        $updated_query = mysqli_query($conn, $table_query);
        if (confirmQuery($updated_query)) {
            header("Location: reservation.php?reservationSuccess");
            exit();
        }
    }
}
