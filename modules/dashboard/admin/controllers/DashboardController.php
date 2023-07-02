<?php

class  DashboardController extends Controller {

    // check privileges
    function runBeforeAction(){

        if($_SESSION['is_admin'] ?? false == true){
            return true;
        }

        $action = $_GET['action'] ?? $_POST['action'] ?? 'default';

        if($action != 'login' ){
            header('Location: /public/admin/index.php?module=dashboard&action=login');

        } else {
            return true;
        }
    }

    function defaultAction(){

        echo "Welcome to admin page";

    }

    function loginAction(){

        if($_POST['postAction'] ?? 0 == 1){


            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $validation = new Validation();
/*
            if(!$validation->validatePassword($password)){
                $_SESSION['validationRules']['error'] = "Password must be between 3 and 20 char"
                . "and must contain one special char";
            }

            if(!$validation->validateUsername($username)){
                $_SESSION['validationRules']['error'] = "Username is not valid email";
            }*/

            if(!$validation
                    ->addRule(new ValidateMinimum(3))
                    ->addRule(new ValidateMaximum(20))
                    ->addRule(new ValidateSpecialCharacter())
                ->validate($password)
            ){
                $_SESSION['validationRules']['error'] = "Password must be between 3 and 20 char"
                    . "and must contain one special char";

            }

            if(!$validation
                ->addRule(new ValidateMinimum(3))
                ->addRule(new ValidateEmail())
                ->validate($username)
            ){
                $_SESSION['validationRules']['error'] = "Email incorrect";

            }

            // first if the above are empty messages check next one too
            if(($_SESSION['validationRules']['error'] ?? '') == ''){

            $auth = new Auth();
            if($auth->checkLogin($username, $password)){
                // all is good
                $_SESSION['is_admin'] = 1;
                header('Location: /public/admin/index.php');
                exit();
            }
                $_SESSION['validationRules']['error'] = "Username or password is incorrect";

            }

        }

         include VIEW_PATH . '/admin/login.html';
         unset($_SESSION['validationRules']['error']);

    }
}