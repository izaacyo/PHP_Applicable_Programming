<?php

class ContactController extends Controller {


    function runBeforeAction(){
        //  $this->insideAndChildren and everywhere that extends this controller

        if($_SESSION['has_submitted_the_form'] ?? 0 == 1){

            $dbh = DatabaseConnection::getInstance();
            $dbc = $dbh->getConnection();


            $pageObj = new Page($dbc);
            $pageObj->findById(3);
            $variables['pageObj'] = $pageObj;


            $template = new Template('default');
            $template->view('page/views/staticPage', $variables);
            return false;
        }
        return true;
    }

    function defaultAction(){
        $dbh = DatabaseConnection::getInstance();
        $dbc = $dbh->getConnection();


        $pageObj = new Page($dbc);
        $pageObj->findBy('id', $this->entityId);
        $variables['pageObj'] = $pageObj;

        $template = new Template('default');
        $template->view('contact/views/contactUs', $variables);
}

   function submitContactFormAction(){
       // validate
       // store data
       // send email
       $_SESSION['has_submitted_the_form'] = 1;

       $dbh = DatabaseConnection::getInstance();
       $dbc = $dbh->getConnection();


       $pageObj = new Page($dbc);
       $pageObj->findById(5);
       $variables['pageObj'] = $pageObj;


       $template = new Template('default');
       $template->view('page/views/staticPage', $variables);

   }

}

