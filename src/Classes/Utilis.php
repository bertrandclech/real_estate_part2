<?php

/**
 * Class Utilitairs
 */
class Utilis
{
    /**
     * Redirection
     */
    public static function redirect(string $path)
    {
        header('Content-Type: text/html; charset=utf-8');
        header("Location: {$path}");
        exit();
    }

    /**
     * Flash message session
     */
    public static function flash(string $sessionName, array $message) : void
    {
        $_SESSION[$sessionName] = $message;
    }
}
