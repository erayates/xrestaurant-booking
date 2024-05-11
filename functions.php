<?php
include("./config/db.php");

// Escape string
function escape($string)
{
    global $conn;
    return mysqli_real_escape_string($conn, trim($string));
}

// Is User Exits Functions
// Is User Exits Function
function isUserExists($email)
{
    global $conn;
    // Add single quotes around the email value in the SQL query
    $query = "SELECT * FROM clients WHERE email = '{$email}'";
    $select_query = mysqli_query($conn, $query);

    // Check if the query executed successfully
    if (!$select_query) {
        die("Query failed: " . mysqli_error($conn));
    }

    // Check if a user with the given email exists
    if (mysqli_num_rows($select_query) > 0) {
        return true;
    } else {
        return false;
    }
}





// Login Logic

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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $email = escape($email);
            $password = escape($password);

            $query = "SELECT * FROM clients WHERE email = '{$email}'";
            $result = mysqli_query($conn, $query);

            // Check if the query was successful
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                if ($row) {
                    if (password_verify($password, $row['password'])) {
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['role'] = $row['role'];
                        header("Location: index.php?loginSuccess");
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
                // Handle query failure
                header("Location: sign-in.php?loginFailed");
                exit();
            }
        }
    }
}




// Redirect
