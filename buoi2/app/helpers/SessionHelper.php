<?php
class SessionHelper
{
    public static function isLoggedIn()
    {
        return isset($_SESSION['username']);
    }
}
?>