<?php 

require_once("MainController.php");

class MusicController extends MainController {
    
    public function indexAction() {
	
        parent::init();
        $this->view->assign("title", "Музыка Тамада");
        $note = new Note("site");
	$this->view->assign("data", $note);
    }
} 

