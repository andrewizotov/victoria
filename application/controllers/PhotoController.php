<?php 
require_once("MainController.php");

class PhotoController extends MainController {

    public function indexAction() {
        parent::init();
        $this->view->assign("title", "<b>Фото</b><br><i>Портфолио фотографа Кривко Татьяны</i><br>");
    }
    
    public function weddingAction(){
        
        $photo = new Photo("photo");
        $this->view->assign("list_photo", $photo-> getPhotoWed());
        
       
        $this->view->assign("navigation",
                            "<a href='/photo/'><font color='#ffffff'><b><i>фото</i></b> / </font></a> 
                             <a href='/photo/wedding/'><font color='#ff0000'><b><i>Свадьбы</i></b> /  </font>  </a>
                             <a href='/photo/lovestory/'><font color='#ffffff'><b><i>Love Story</i></b> /</font>  </a>
                             <a href='/photo/children/'><font color='#ffffff'><b><i>Детское</i></b> / </font> 
                             <a href='/photo/finals/'><font color='#ffffff'><b><i>Выпускные альбомы</i></b> / </font>  </a>
                             <a href='/photo/other/'><font color='#ffffff'><b><i>Разное</i></b> </font> </a>" );
    }
    
    public function lovestoryAction(){
        
        $photo = new Photo("photo");
        
        $this->view->assign("list_photo", $photo-> getPhotoStory() );
        $this->view->assign("navigation",
                            "<a href='/photo/'><font color='#ffffff'><b><i>фото</i></b> / </font></a> 
                             <a href='/photo/wedding/'><font color='#ffffff'><b><i>Свадьбы</i></b> /  </font>  </a>
                             <a href='/photo/lovestory/'><font color='#ff0000'><b><i>Love Story</i></b> /</font>  </a>
                             <a href='/photo/children/'><font color='#ffffff'><b><i>Детское</i></b> / </font> 
                             <a href='/photo/finals/'><font color='#ffffff'><b><i>Выпускные альбомы</i></b> / </font>  </a>
                             <a href='/photo/other/'><font color='#ffffff'><b><i>Разное</i></b> </font> </a>" );
    }
    
    public function childrenAction(){
        
        $photo = new Photo("photo");
        $this->view->assign("list_photo", $photo-> getPhotoCh());
        $this->view->assign("navigation",
                            "<a href='/photo/'><font color='#ffffff'><b><i>фото</i></b> / </font></a> 
                             <a href='/photo/wedding/'><font color='#ffffff'><b><i>Свадьбы</i></b> /  </font>  </a>
                             <a href='/photo/lovestory/'><font color='#ffffff'><b><i>Love Story</i></b> /</font>  </a>
                             <a href='/photo/children/'><font color='#ff0000'><b><i>Детское</i></b> / </font> 
                             <a href='/photo/finals/'><font color='#ffffff'><b><i>Выпускные альбомы</i></b> / </font>  </a>
                             <a href='/photo/other/'><font color='#ffffff'><b><i>Разное</i></b> </font> </a>" );
    }
    
    public function finalsAction(){
        
        $photo = new Photo("photo");
        $this->view->assign("list_photo", $photo-> getPhotoFinals());
        $this->view->assign("navigation",
                            "<a href='/photo/'><font color='#ffffff'><b><i>фото</i></b> / </font></a> 
                             <a href='/photo/wedding/'><font color='#ffffff'><b><i>Свадьбы</i></b> /  </font>  </a>
                             <a href='/photo/lovestory/'><font color='#ffffff'><b><i>Love Story</i></b> /</font>  </a>
                             <a href='/photo/children/'><font color='#ffffff'><b><i>Детское</i></b> / </font> 
                             <a href='/photo/finals/'><font color='#ff0000'><b><i>Выпускные альбомы</i></b> / </font>  </a>
                             <a href='/photo/other/'><font color='#ffffff'><b><i>Разное</i></b> </font> </a>" );
    }
    
    public function otherAction(){
        
        $photo = new Photo("photo");
        $this->view->assign("list_photo", $photo-> getPhotoOther());
        $this->view->assign("navigation",
                            "<a href='/photo/'><font color='#ffffff'><b><i>фото</i></b> / </font></a> 
                             <a href='/photo/wedding/'><font color='#ffffff'><b><i>Свадьбы</i></b> /  </font>  </a>
                             <a href='/photo/lovestory/'><font color='#ffffff'><b><i>Love Story</i></b> /</font>  </a>
                             <a href='/photo/children/'><font color='#ffffff'><b><i>Детское</i></b> / </font> 
                             <a href='/photo/finals/'><font color='#ffffff'><b><i>Выпускные альбомы</i></b> / </font>  </a>
                             <a href='/photo/other/'><font color='#ff0000'><b><i>Разное</i></b> </font> </a>" );
    }
   
} 

