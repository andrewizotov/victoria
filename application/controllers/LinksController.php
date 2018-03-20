<?php 

require_once("MainController.php");

class LinksController extends MainController {
    
    public function indexAction() {
        
        $this->view->assign("title", "Отзывы<br><br>");
        $note = new Note("site");
        $otz = new Otzivi("otzivi");

	$this->view->assign("data", $otz-> get() );
    }
    
    public function addAction(){
        
        $otz = new Otzivi("otzivi");
        if($otz -> add( $_POST ) == false){
          $this->_redirect("/error_script");
        }
        $this->_redirect("/links");
    }
} 

