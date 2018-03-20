<?php
  require_once("main_model.php");
  
  class Video extends MainModel{
    
    public function __construct( $_table  ){
        
        parent::__construct( $_table );
    }
  
    public function add($_post, $_type){
      $ts = time();
      $this->Insert("insert into video (title,code,type,ts) values('{$_post['tTitle']}','{$_post['tVideo']}',$_type, $ts)");
    }
    
    public function getVideo($_type){
      
      return $this->Select("select * from video where type = $_type ORDER BY ts DESC");
      
    }
    
    public function delVideo($_id){
      
       $this->Delete("delete from video where id=$_id");
      
    }
  }
?>