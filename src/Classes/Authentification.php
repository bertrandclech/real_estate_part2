<?php

/**
 * Class Authentification
 */

class Authentification
{
    /**
     * Verify session or start session
     */
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function isAuth() : bool
    {
        if (isset($_SESSION['auth'])) {
            return true;
        } else {
            return false;
        }
    }
}
