<?php

require_once 'FormValidator.php';

/**
 * Class Form Builder
 * 
 * A basic example
 * 
 * 1. Build Form
 * $formBuilder = new Formbuilder($_POST, ['firstName', 'age']);
 * 
 * @author Guillaume RGD <devweb@guillaumerigourd.fr>
 * [Created : 04.03.2022]
 * [Update  : 06.03.2022]
 */
class FormBuilder extends FormValidator
{
    /** Method  : "$_POST" */
    public array $method;

    /** Value "name" in "form" */
    public array $required;

    /**
     * Build a Form with "$method" and value name from "form"
     */
    public function __construct(array $method, array $required)
    {
        $this->method = $method;
        $this->required = $required;

        foreach ($this->method as $key => $value) {
            if (in_array($key, $this->required)) {
                return $value;
            }
        }
    }
}
