<?php 

require_once("MainController.php");

class VideoController extends MainController {
    
    public function indexAction() {
	
        parent::init();
        $this->view->assign("title", "<b>Видео</b><br><i>Портфолио видеографа Кривко Олега</i><br>");
    }
    
    public function weddingvideoAction(){
        
        $video = new Video("video");
        $this->view->assign("list_video", $video-> getVideo(1));
        $history = new History("history_video");
        $this->view->assign("history", $history-> get(1));
        
        $this->view->assign("navigation",
                            "<a href='/video/'><font color='#ffffff'><b><i>Видео</i></b> / </font></a> 
                             <a href='/video/weddingvideo/'><font color='#ff0000'><b><i>Свадьбы</i></b> /  </font>  </a>
                             <a href='/video/lovestoryvideo/'><font color='#ffffff'><b><i>Love Story</i></b> /</font>  </a>
                             <a href='/video/childrenvideo/'><font color='#ffffff'><b><i>Детское</i></b> / </font> 
                             <a href='/video/finalsvideo/'><font color='#ffffff'><b><i>Выпускные вечера</i></b> / </font>  </a>
                             <a href='/video/othervideo/'><font color='#ffffff'><b><i>Разное</i></b> </font> </a>" );
        
    }
    
    public function lovestoryvideoAction(){
        
        $video = new Video("video");
        $this->view->assign("list_video", $video-> getVideo(2));
        $history = new History("history_video");
        $this->view->assign("history", $history-> get(2));
        $this->view->assign("navigation",
                            "<a href='/video/'><font color='#ffffff'><b><i>Видео</i></b> / </font></a> 
                             <a href='/video/weddingvideo/'><font color='#ffffff'><b><i>Свадьбы</i></b> /  </font>  </a>
                             <a href='/video/lovestoryvideo/'><font color='#ff0000'><b><i>Love Story</i></b> /</font>  </a>
                             <a href='/video/childrenvideo/'><font color='#ffffff'><b><i>Детское</i></b> / </font> 
                             <a href='/video/finalsvideo/'><font color='#ffffff'><b><i>Выпускные вечера</i></b> / </font>  </a>
                             <a href='/video/othervideo/'><font color='#ffffff'><b><i>Разное</i></b> </font> </a>" );
    }
    
    public function childrenvideoAction(){
        
        $video = new Video("video");
        $this->view->assign("list_video", $video-> getVideo(3));
        $history = new History("history_video");
        $this->view->assign("history", $history-> get(3));
        $this->view->assign("navigation",
                            "<a href='/video/'><font color='#ffffff'><b><i>Видео</i></b> / </font></a> 
                             <a href='/video/weddingvideo/'><font color='#ffffff'><b><i>Свадьбы</i></b> /  </font>  </a>
                             <a href='/video/lovestoryvideo/'><font color='#ffffff'><b><i>Love Story</i></b> /</font>  </a>
                             <a href='/video/childrenvideo/'><font color='#ff0000'><b><i>Детское</i></b> / </font> 
                             <a href='/video/finalsvideo/'><font color='#ffffff'><b><i>Выпускные вечера</i></b> / </font>  </a>
                             <a href='/video/othervideo/'><font color='#ffffff'><b><i>Разное</i></b> </font> </a>" );
    }
    
    public function finalsvideoAction(){
        
        $video = new Video("video");
        $this->view->assign("list_video", $video-> getVideo(4));
        $history = new History("history_video");
        $this->view->assign("history", $history-> get(4));
        $this->view->assign("navigation",
                            "<a href='/video/'><font color='#ffffff'><b><i>Видео</i></b> / </font></a> 
                             <a href='/video/weddingvideo'><font color='#ffffff'><b><i>Свадьбы</i></b> /  </font>  </a>
                             <a href='/video/lovestoryvideo'><font color='#ffffff'><b><i>Love Story</i></b> /</font>  </a>
                             <a href='/video/childrenvideo'><font color='#ffffff'><b><i>Детское</i></b> / </font> 
                             <a href='/video/finalsvideo'><font color='#ff0000'><b><i>Выпускные вечера</i></b> / </font>  </a>
                             <a href='/video/othervideo'><font color='#ffffff'><b><i>Разное</i></b> </font> </a>" );
    }
    
    public function othervideoAction(){
        
        $video = new Video("video");
        $this->view->assign("list_video", $video-> getVideo(5));
        $history = new History("history_video");
        $this->view->assign("history", $history-> get(5));
        $this->view->assign("navigation",
                            "<a href='/video/'><font color='#ffffff'><b><i>Видео</i></b> / </font></a> 
                             <a href='/video/weddingvideo'><font color='#ffffff'><b><i>Свадьбы</i></b> /  </font>  </a>
                             <a href='/video/lovestoryvideo'><font color='#ffffff'><b><i>Love Story</i></b> /</font>  </a>
                             <a href='/video/childrenvideo'><font color='#ffffff'><b><i>Детское</i></b> / </font> 
                             <a href='/video/finalsvideo'><font color='#ffffff'><b><i>Выпускные вечера</i></b> / </font>  </a>
                             <a href='/video/othervideo'><font color='#ff0000'><b><i>Разное</i></b> </font> </a>" );
    }
   
} 

