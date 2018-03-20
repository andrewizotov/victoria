<?php
   require_once("main_model.php");
   
   class Otzivi extends MainModel{
    
    public function __construct( $_table  ){
        
        parent::__construct( $_table );
    }
    
    public function add($_post){
      $ts = time();
      
      $data = strip_tags( $_post['tOtziv'] );
      $data2 = strip_tags( $_post['tName'] );
      
      $search = array ("script", "javascript","блядь", "сука","хуй","пизда", "похуй","нахуй","жопа");
      
      $data = str_ireplace( $search,"****", $data);
      $data2 = str_ireplace($search,"****", $data2);
      
      $this->Insert("insert into otzivi (name,text, allow,ts) values('$data2','$data', 0,$ts)");
      return true;
    }
    
    public function get(){
      return $this->Select("select * from otzivi WHERE allow = 1  ORDER BY ts DESC");
    }
	
	public function getAdmin(){
      return $this->Select("select * from otzivi  ORDER BY ts DESC");
    }
    
    public function del($_id){
       $this->Delete("delete from otzivi where id=$_id");
    }
	
	public function allowComment($_id){
       $this->Delete("UPDATE otzivi SET allow = 1 where id=$_id");
    }
    
   }
?>