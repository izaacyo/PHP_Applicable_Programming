<?php
 session_start();

 //rootpath has to be public/index.php
define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR );
define('VIEW_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR);
define('MODULES_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR);






require_once ROOT_PATH . 'src/Controller.php';
require_once ROOT_PATH . 'src/Template.php';
require_once ROOT_PATH . 'src/DatabaseConnection.php';
require_once ROOT_PATH . 'src/Entity.php';
require_once ROOT_PATH . 'src/Router.php';
require_once MODULES_PATH  . 'page/models/Page.php';


DatabaseConnection::connect('PhpTrack-db', 'darwin_cms', 'root', 'root');


/*if(isset($_GET["section"])){
    $section = $_GET['section'] ;
} else if(isset($_POST["section"])) {
    $section = $_POST['section'] ;
}
else {
    $section = 'home';
}

$action = $_GET['action'] ?? $_POST['action'] ?? 'default';*/

$action = $_GET['seo_name'] ??  'home';

$dbh = DatabaseConnection::getInstance();
$dbc = $dbh->getConnection();

$router = new Router($dbc);

$router -> findBy('pretty_url', $action);

$action = $router->action != '' ? $router->action : 'default';

$moduleName = ucfirst($router->module) . 'Controller';


$controllerFile = MODULES_PATH . $router->module . '/controllers/' . $moduleName . '.php';

if(file_exists($controllerFile)){

    include $controllerFile;

    $controller = new $moduleName();
    $controller->setEntityId($router->entity_id);
    $controller->runAction($action);

}



/*
 * if($router->module == 'page'){
    include ROOT_PATH . 'controller/PageController.php';

    $pageController = new PageController();
    $pageController->setEntityId($router->entity_id);
    $pageController->runAction($action);

} else if ($section == 'contact') {
    include ROOT_PATH . 'controller/ContactController.php';
    $contactController = new ContactController();
    $contactController->runAction($action);

}*/


