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

            $auth = new Auth();
            if($auth->checkLogin($username, $password)){

                $_SESSION['is_admin'] = 1;
                header('Location: /public/admin/index.php');
                exit();
            }


        }

         include VIEW_PATH . '/admin/login.html';

    }
}