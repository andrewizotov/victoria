<?php 

require_once("MainController.php");

class AboutController extends MainController {
    
    public function indexAction() {
	
        parent::init();
        $this->view->assign("title", "О нас");
        $note = new Note("site");
	$this->view->assign("data", $note);
        $this->view->assign("data_bred", $note);
    }
} 

