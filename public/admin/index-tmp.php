<?php

session_start();

//rootpath has to be public/index.php
define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR );
define('VIEW_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR);
define('MODULES_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR);

define('ENCRYPTION_SALT', 'asdgnaisjbdgiabosnoasas12412as');




require_once ROOT_PATH . 'src/DatabaseConnection.php';
require_once ROOT_PATH . 'src/Entity.php';
require_once ROOT_PATH . 'src/Auth.php';
require_once MODULES_PATH . 'user/models/User.php';



DatabaseConnection::connect('PhpTrack-db', 'darwin_cms', 'root', 'root');


$dbh = DatabaseConnection::getInstance();
$dbc = $dbh->getConnection();
$userObj = new User($dbc);

$userObj->findBy('username', 'admin');

$authObj = new Auth();
$userObj = $authObj->changeUserPassword($userObj, 'TopSecret');

var_dump($userObj);

