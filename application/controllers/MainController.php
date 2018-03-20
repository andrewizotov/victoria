<?php
require_once 'Zend/Controller/Action.php';
require_once '../application/models/note.php';
require_once '../application/models/photo.php';
require_once '../application/models/otzivi.php';
require_once '../application/models/video.php';
require_once '../application/models/hostory.php';
require_once '../application/models/feedback.php';
require_once '../application/models/make.php';

//require_once( "include/phpmailer/class.phpmailer.php" );

class MainController extends Zend_Controller_Action
{

    public function init()
    {
        $this->view->assign("domen", Zend_Registry::get('domen'));
    }
}

;