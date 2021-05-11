<?php

/**
 * Check if the user log or not
 */
function isLogged() {
    if(isset($_SESSION['username'])) {
        return true;
    }
    return false;
}

/**
 * Check if the user is admin or not
 */
function isAdmin() {
    if(isLogged()) {
        if(isset($_SESSION['username']) && $_SESSION['isAdmin'] == 1) {
            return true;
        }
    }
    return false;
}