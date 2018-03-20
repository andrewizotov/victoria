<?php require_once("main_model.php");

class Make extends MainModel{

  public function __construct( $_table  ){
        
        parent::__construct( $_table );
  }
  
  public function run(){
    
     $res = $this-> Select("select * from {$this->mTable}");
     
     foreach($res as $val){
        
       $this-> make_thumbnail($val['link'], 200, 100, 200);
     }
  }
  
  

};