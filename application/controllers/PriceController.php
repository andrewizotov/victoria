<?php 

require_once("MainController.php");

class PriceController extends MainController {
    
    public function indexAction() {
	
        parent::init();
        $this->view->assign("title", "Слайд-шоу");
        $note = new Note("site");
	$this->view->assign("data", $note);
    }
} 

