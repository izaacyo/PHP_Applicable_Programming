<?php

session_start();

//rootpath has to be public/index.php
define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR );
define('VIEW_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR);
define('MODULES_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR);

define('ENCRYPTION_SALT', 'asdgnaisjbdgiabosnoasas12412as');



require_once ROOT_PATH . 'src/Controller.php';
require_once ROOT_PATH . 'src/Template.php';
require_once ROOT_PATH . 'src/DatabaseConnection.php';
require_once ROOT_PATH . 'src/Entity.php';
require_once ROOT_PATH . 'src/Router.php';
require_once ROOT_PATH . 'src/Auth.php';
require_once ROOT_PATH . 'src/Validation.php';
require_once ROOT_PATH . 'src/validationRules/ValidateMaximum.php';
require_once ROOT_PATH . 'src/validationRules/ValidateMinimum.php';
require_once ROOT_PATH . 'src/validationRules/ValidateSpecialCharacter.php';
require_once ROOT_PATH . 'src/validationRules/ValidateEmail.php';
require_once MODULES_PATH . 'page/models/Page.php';
require_once MODULES_PATH . 'user/models/User.php';



DatabaseConnection::connect('PhpTrack-db', 'darwin_cms', 'root', 'root');


if(isset($_GET["module"])){
    $section = $_GET['module'] ;
} else if(isset($_POST["module"])) {
    $section = $_POST['module'] ;
}
else {
    $section = 'home';
}

$module = $_GET['module'] ?? $_POST['module'] ?? 'dashboard';
$action = $_GET['action'] ?? $_POST['action'] ?? 'default';



   if($module == 'dashboard'){
    include MODULES_PATH . 'dashboard/admin/controllers/DashboardController.php';

       $DashboardController = new DashboardController();
       $DashboardController->runAction($action);

}
