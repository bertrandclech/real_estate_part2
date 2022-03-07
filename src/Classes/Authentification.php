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
            session_status();
        }
    }
}
