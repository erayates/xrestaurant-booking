<?php

// Check the client whether admin or not
function isAdmin()
{
    if (isset($_SESSION['user_role'])) {
        if (isset($_SESSION['user_role']) == 'admin') {
            return true;
        }
    }
}
