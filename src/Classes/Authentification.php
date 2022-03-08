<?php

/**
 * Class Authentification
 */

class Authentification extends Utilis
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

    /**
     * Verify if Authentifcation
     *
     * @return boolean
     */
    public static function isAuth() : bool
    {
        if (isset($_SESSION['auth'])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Verify is Admin
     */
    public static function isAdmin()
    {
        if($_SESSION['auth']['role'] === 1){
            return true;
        }else{
            return false;
        }
    }
}
