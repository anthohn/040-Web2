<?php
/**
 * Auteur : Anthony Höhn, Younes Sayeh
 * Date : 26.04.2021
 * Description : Utils function
 */

/**
 * Check if the user log or not
 */
function isLogged()
{
    if(isset($_SESSION['username']))
    {
        return true;
    }
    return false;
}

/**
 * Check if the user is log and admin or not
 */
function isAdmin()
{
    if(isLogged())
    {
        if(isset($_SESSION['username']) && $_SESSION['useIsAdmin'] == 1)
        {
            return true;
        }
    }
    return false;
}