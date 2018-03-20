<?php 

require_once("MainController.php");

class MoreController extends MainController {
    
    public function indexAction() {
	
        parent::init();
        $this->view->assign("title", "Дополнительные услуги");
        $note = new Note("site");
	$this->view->assign("data", $note);
    }
} 

