<?php 

require_once("MainController.php");

class ContactsController extends MainController {
    
    public function indexAction() {
        
        $this->view->assign("title", "Контакты");
        $note = new Note("site");
        $this->view->assign("data", $note);
        
        if(isset($_GET['status']) && $_GET['status'] == "done")
         $this->view->assign("status", "Спасибо ваше сообщение доставлено");
    }
    
    public function messageAction(){
        
       if( $this->_request->isPost() ){
        
         $feedBack = new FeedBack();
         $feedBack->send($this->_request->getPost());
       } 
        $this->_redirect("/contacts/?status=done");
    }
} 

