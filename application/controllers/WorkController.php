<?php 

require_once("MainController.php");

class WorkController extends MainController {
    
    public function indexAction() {
	
        parent::init();
        $this->view->assign("title", "Услуги");
        $note = new Note("site");
	$this->view->assign("data", $note);
    }
} 

