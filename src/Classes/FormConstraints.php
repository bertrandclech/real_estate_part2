<?php

/**
 * Class Form Constraints
 * 
 * @author Guillaume RGD <devweb@guillaumerigourd.fr>
 * [Created : 04.03.2022]
 * [Update  : 06.03.2022]
 */
abstract class FormConstraints
{

    public array $errors = [];
    public array $valide = [];

    /** 
     * Verify if isset "value" and not empty 
     */
    public function verify(mixed $value): ?string
    {
        return (!isset($value) && empty($value) && $value !== " " ? $value = null : htmlspecialchars($value));
    }

    /** 
     * Length "min" & "max" 
     */
    public static function length(mixed $value, int $min, int $max): ?string
    {
        if ($value) {
            if (strlen($value) < $min || strlen($value) > $max) {
                $value = null;
            }
        }
        return $value !== null ? htmlspecialchars($value) : $value;
    }

    /** 
     * Only "String"
     */
    public static function string(mixed $value): ?string
    {
        return !is_string($value) ? $value = null : htmlspecialchars($value);
    }

    /** 
     * Only "Integer"
     */
    public static function int(mixed $value): ?int
    {
        if ($value) {
            if (!preg_match("/^[1-9][0-9]*$/", $value)) {
                $value = null;
            }
        }
        return $value !== null ? (int) htmlspecialchars($value) : null;
    }

    /**
     * Code postale
     */
    public static function postalCode(mixed $value): ?string
    {
        if ($value) {
            if (!preg_match("~^[0-9]{5}$~", $value)) {
                $value = null;
            }
        }
        return $value !== null ? htmlspecialchars($value) : null;
    }


    /**
     * Verify password
     */
    static public function passCheck(mixed $value1, mixed $value2)
    {
        if ($value1 === $value2) {
            return true;
        } else {
            return null;
        }
    }

    /**
     * Hash Password
     */
    static public function passHash(mixed $value): string
    {
        $optionsHash = ['cost' => 12];
        return password_hash($value, PASSWORD_BCRYPT, $optionsHash);
    }


    /**
     * Email
     */
    static public function email($value): ?string
    {
        if ($value) {
            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $value = null;
            }
        }
        return $value !== null ? htmlspecialchars($value) : null;
    }
}
