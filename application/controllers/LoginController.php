<?php 

require_once("MainController.php");

class LoginController extends MainController {
    
    public function indexAction() {
         
        if( Zend_Auth::getInstance()->hasIdentity() ){
        
         return $this->_redirect( Zend_Registry::get( 'domen' )."/admin/" );
        } 
    }

} 

