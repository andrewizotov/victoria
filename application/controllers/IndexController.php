<?php


class IndexController extends Zend_Controller_Action
{
    public function indexAction()
    {
        parent::init();
        $this->view->assign("title", "Главная");
        $note = new Note("site");
        $this->view->assign("data", $note);
        $this->view->assign("data_bred", $note);
        $this->getResponse()->setHeader('Cookie', 'name=andrew');
    }
} 

