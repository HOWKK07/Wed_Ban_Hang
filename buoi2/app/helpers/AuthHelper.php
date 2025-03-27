<?php
class AuthHelper
{
    public static function isAdmin()
    {
        return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
    }

    public static function isUser()
    {
        return isset($_SESSION['role']) && $_SESSION['role'] === 'user';
    }
}
?>