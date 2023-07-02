<?php

class Validation {

    private $rules;
    /*
        public function validatePassword($password){

            // minimum number of char
            if(strlen($password)<3){
                return false;
            }

            // maximum number of char
            if(strlen($password)>20){
                return false;
            }

            // one special char

            if(!preg_match("/[^a-zA-Z0-9]+/", $password)){
                return false;
            }

        $validationMinimum = new ValidateMinimum(3);
        if(!$validationMinimum->validateRule($password)){
            return false;
        }

        $validationMaximum = new ValidateMaximum(20);
        if(!$validationMaximum->validateRule($password)){
            return false;
        }

        $validationSpecialCharacter = new ValidateSpecialCharacter();
        if(!$validationSpecialCharacter->validateRule($password)){
            return false;
        }
        return true;
    }

    public function validateUsername($username){


        // minimum number of char

        if(strlen($username)<3){
            return false;
        }

        // maximum number of char
        if(strlen($username)>20){
            return false;
        }

        // one special char

        if(!filter_var($username, FILTER_VALIDATE_EMAIL)){
            return false;
        }

        return true;
    } */

    public function addRule($rule){
        $this->rules[] = $rule;
        return $this;
    }

    public function validate($value){
        foreach($this->rules as $rule){
            $ruleValidation = $rule->validateRule($value);
            if(!$ruleValidation){
                return false;
            }
        }

        return true;

    }
}