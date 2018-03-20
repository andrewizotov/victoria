<?php

require_once("MainController.php");

class NoteController extends MainController {

    public function indexAction() {

        parent::init();
        $this->view->assign("title", "Полезное");
        $note = new Note("site");
	$this->view->assign("data", $note);
        $this->view->assign("data_bred", $note);
    }
}

