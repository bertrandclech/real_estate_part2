<?php
/**
 * Autoload for index files
 */

// Verify session PHP
if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}

// Autoload
spl_autoload_register(function ($className) {
    require_once 'src' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . $className . '.php';
});
