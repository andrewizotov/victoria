<?php



require_once("main_model.php");

class Note extends MainModel{
    
    public function __construct( $_table  ){
        
        parent::__construct( $_table );
    }
    
    public function save( $_post ){
         
        $this->Insert("insert into {$this->mTable} (note,type_note) values('{$_post['tDesc']}','{$_post['hAction']}')");
    }
    
    public function checkNote($_action){
        
        $res = $this->Select("select * from {$this->mTable} where type_note='$_action'");
        if( count($res[0]['id']) > 0 ) { return true; }
        else{  return false; }
    }
    
    
    
    public function getNote($_type){
         $res = $this->Select("select * from {$this->mTable} where type_note='$_type'");
         if(file_exists($res[0]['note'])){
             $res[0]['note'] = file_get_contents($res[0]['note']);
         }
         return $res;
    }
    
    public function updateNote($_post, $_action){
        $f = fopen('site/'.$_action, 'w');
        $_post['tDesc'] = str_replace("\\", "", $_post['tDesc']);
        fwrite($f, $_post['tDesc']);
        fclose($f);
        @chmod('site/'.$_action, 0777); 
        $this->Update("update site set note='".'site/'.$_action."' where type_note = '$_action'");
        
    }
}
