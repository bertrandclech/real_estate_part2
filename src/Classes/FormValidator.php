<?php

require_once 'FormConstraints.php';

/**
 * Class Form Validator
 * 
 * A basic example
 * 
 * 2. Validate Form
 * $formValidator = 
 * new FormValidator(
 *      $formBuilder, 
 *          [
 *              'firstName' => FormConstraints::controllLength(@$formBuilder->method['firstName'], 2, 5),
 *              'age' => FormConstraints::controllInt(@$formBuilder->method['age'])
 *          ]);
 * 
 *  if($formValidator->isSubmit()){
 *      if($formValidator->isValide()){
 *           // More logic here ...
 * 
 *  }else{
 *      // Return errors
 *      $errors = $formValidator->errors;
 *  }
 * }
 * 
 * @author Guillaume RGD <devweb@guillaumerigourd.fr>
 * [Created : 04.03.2022]
 * [Update  : 06.03.2022]
 */
class FormValidator extends FormConstraints
{
    public function __construct(FormBuilder $formBuilder, array $constraints)
    {
        $this->constraints = $constraints;

        if (isset($formBuilder->method)) {
            /* METHOD */
            foreach ($formBuilder->method as $key => $data) {
                # Verify datas after submit
                if (!$this->verify($data)) {
                    $this->errors[] = "champ <b>#{$key}</b> est requis.";
                }
            }

            /* CONSTRAINTS */
            foreach ($this->constraints as $key => $constraint) {
                if (is_null($constraint)) {
                    $this->errors[] = "La donnée <b>#{$key}</b>, ne correspond pas aux critères.</b>";
                }
            }
        }
    }

    public function isValide()
    {
        return $this->errors ? false : true;
    }

    public function isSubmit()
    {
        return ($_POST) ?? false;
    }
}
