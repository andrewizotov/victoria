<?php
  require_once("main_model.php");
  
  class History extends MainModel{
    
    public function __construct( $_table  ){
        
        parent::__construct( $_table );
    }
  
    public function save($_post, $_type){
      
       $res = $this->get($_type);
       if(count($res) > 0){
         $content = str_replace("'","\'",$_post['tHistory']);
         $this->Update("update history_video set history = '$content' where id = {$res[0]['id']}");
       } else {
      
         //$ts = time();
         //$this->Insert("insert into history_video (history,type) values('{$_post['tHistory']}', $_type)");
       }
    }
    
    public function get( $_type ){
      
      return $this->Select("select * from history_video where type = $_type");
      
    }
  }
?>