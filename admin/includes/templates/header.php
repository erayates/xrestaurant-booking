<?php
ob_start();
session_start();
include 'functions.php';

isAdmin();

// if (isset($_SESSION['email'])) {
//     $username = $_SESSION['user_username'];
//     $query = "SELECT * FROM users WHERE user_username = '{$username}' ";
//     $select_user_profile_query = mysqli_query($conn, $query);
//     while ($row = mysqli_fetch_assoc($select_user_profile_query)) {
//         $user_id = $row['user_id'];
//         $user_username = $row['user_username'];
//         $user_password = $row['user_password'];
//         $user_firstname = $row['user_firstname'];
//         $user_lastname = $row['user_lastname'];
//         $user_email = $row['user_email'];
//         $user_image = $row['user_image'];
//         $user_role = $row['user_role'];
//     }
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>XRESTO | Admin Dashboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="assets/css/admin.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    
    <link href="assets/css/bootstrap-min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" href="@sweetalert2/theme-wordpress-admin/wordpress-admin.css">

</head>

<body>