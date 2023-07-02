<?php


class Auth {
    function checkLogin($username, $password){

        $dbh = DatabaseConnection::getInstance();
        $dbc = $dbh->getConnection();

        $userObj = new User($dbc);
        $userObj->findBy('username', $username);

        if(property_exists($userObj,'id')){
    // for the manual hash if($userObj->password === md5($password . ENCRYPTION_SALT . $userObj->password_hash)){
             if(password_verify($password, $userObj->password)){
                    return true;
            }
        }
    }

    function changeUserPassword($userObj, $newPassword){
        //random string
       //  $tmp = date('YmdHis') . 'secret_string12312';
        //manual hash
       // $hash = md5($tmp);
       // $hashedPassword  = md5($newPassword . ENCRYPTION_SALT . $hash);
        //  $userObj->password = $hashedPassword;
        //   $userObj->password_hash = $hash;


       $userObj->password = password_hash($newPassword, PASSWORD_DEFAULT);;
        return $userObj;
    }
}