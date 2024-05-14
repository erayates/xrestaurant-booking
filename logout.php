<?php
ob_start();
session_start();

if (isset($_GET['logout'])) {
    session_destroy();
    session_unset();
    header("Location: index.php?logoutSuccess");
}
