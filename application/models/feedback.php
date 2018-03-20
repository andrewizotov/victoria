<?php
require_once("main_model.php");

class FeedBack extends MainModel{
    
    public function __construct(  ){
        
        
    }
    
    public function send( $_post ){
         
         $this->sendMail( $_post['tMessage'],
                          "Victoria-K2010@mail.ru",
                          $_post['tFrom'] ,
                          "victoria-k.dp.ua (новое сообщение)");
         
          $this->sendMail( $_post['tMessage'],
                          "Kryvco@mail.ru",
                          $_post['tFrom'] ,
                          "victoria-k.dp.ua (новое сообщение)");
    }
}