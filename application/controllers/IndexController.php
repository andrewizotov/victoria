<?php

class IndexController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $this->view->assign('title', 'Главная');
        $note = new Application_Model_Site('site');
        $text = $note->getNote('main');
        $this->view->assign('article', $text);
        $this->view->assign("url", $this->getFrontController()->getBaseUrl());
    }


    public function allvideoAction()
    {
        $this->view->assign("title", "<b>Видео</b><br><i>Портфолио видеографа Кривко Олега</i><br>");
        $this->view->assign("url", $this->getFrontController()->getBaseUrl());
    }

    public function photoAction()
    {
        $this->view->assign("title", "<b>Фото</b><br><i>Портфолио фотографа Кривко Татьяны</i><br>");
        $this->view->assign("url", $this->getFrontController()->getBaseUrl());
    }

    public function workAction()
    {
        $this->view->assign("title", "Услуги");
        $note = new Application_Model_Site('site');
        $text = $note->getNote('uslugi');
        $this->view->assign("article", $text);
        $this->view->assign("url", $this->getFrontController()->getBaseUrl());

    }


    public function contactsAction()
    {
        $this->view->assign("title", "Контакты");
        $note = new Application_Model_Site('site');
        $text = $note->getNote('contacts');
        $this->view->assign("article", $text);
        $this->view->assign("url", $this->getFrontController()->getBaseUrl());

    }


    public function aboutAction()
    {
        $this->view->assign("title", "О нас");
        $note = new Application_Model_Site('site');
        $text = $note->getNote('about');
        $this->view->assign("article", $text);
        $this->view->assign("url", $this->getFrontController()->getBaseUrl());
    }


    public function noteAction()
    {
        $this->view->assign("title", "Полезное");
        $note = new Application_Model_Site('site');
        $text = $note->getNote('note');
        $this->view->assign("article", $text);
        $this->view->assign("url", $this->getFrontController()->getBaseUrl());

    }


    public function reviewsAction()
    {
        $this->view->assign("title", "Отзывы");
        $reviews = new Application_Model_Reviews();
        $this->view->assign("data", $reviews->getPublicReviews());

        $this->view->assign("url", $this->getFrontController()->getBaseUrl());
    }

    public function moreAction()
    {
        $this->view->assign("title", "Дополнительные услуги");
        $note = new Application_Model_Site('site');
        $text = $note->getNote('more');
        $this->view->assign("article", $text);
        $this->view->assign("url", $this->getFrontController()->getBaseUrl());
    }

    public function weddingvideoAction()
    {

        $video = new Application_Model_Video('video');

        $this->view->assign("list_video", $video->getVideo($this->getRequest()->getActionName()));
        $history = new Application_Model_History('history_video');

        $this->view->assign("history", $history->get($this->getRequest()->getActionName()));

        $this->view->assign("navigation",
            "<a href='/index/video/'><font color='#ffffff'><b><i>Видео</i></b> / </font></a> 
                             <a href='/index/weddingvideo/'><font color='#ff0000'><b><i>Свадьбы</i></b> /  </font>  </a>
                             <a href='/index/lovestoryvideo/'><font color='#ffffff'><b><i>Love Story</i></b> /</font>  </a>
                             <a href='/index/childrenvideo/'><font color='#ffffff'><b><i>Детское</i></b> / </font> 
                             <a href='/index/finalsvideo/'><font color='#ffffff'><b><i>Выпускные вечера</i></b> / </font>  </a>
                             <a href='/index/othervideo/'><font color='#ffffff'><b><i>Разное</i></b> </font> </a>" );
        $this->view->assign("url", $this->getFrontController()->getBaseUrl());
    }


    public function childrenvideoAction()
    {

        $video = new Application_Model_Video('video');

        $this->view->assign("list_video", $video->getVideo($this->getRequest()->getActionName()));
        $history = new Application_Model_History('history_video');

        $this->view->assign("history", $history->get($this->getRequest()->getActionName()));

        $this->view->assign("navigation",
            "<a href='/index/'><font color='#ffffff'><b><i>Видео</i></b> / </font></a> 
                             <a href='/index/weddingvideo/'><font color='#ff0000'><b><i>Свадьбы</i></b> /  </font>  </a>
                             <a href='/index/lovestoryvideo/'><font color='#ffffff'><b><i>Love Story</i></b> /</font>  </a>
                             <a href='/index/childrenvideo/'><font color='#ffffff'><b><i>Детское</i></b> / </font> 
                             <a href='/index/finalsvideo/'><font color='#ffffff'><b><i>Выпускные вечера</i></b> / </font>  </a>
                             <a href='/index/othervideo/'><font color='#ffffff'><b><i>Разное</i></b> </font> </a>" );

        $this->view->assign("url", $this->getFrontController()->getBaseUrl());
    }


    public function othervideoAction()
    {

        $video = new Application_Model_Video('video');

        $this->view->assign("list_video", $video->getVideo($this->getRequest()->getActionName()));
        $history = new Application_Model_History('history_video');

        $this->view->assign("history", $history->get($this->getRequest()->getActionName()));

        $this->view->assign("navigation",
            "<a href='/index/video/'><font color='#ffffff'><b><i>Видео</i></b> / </font></a> 
                             <a href='/index/weddingvideo/'><font color='#ff0000'><b><i>Свадьбы</i></b> /  </font>  </a>
                             <a href='/index/lovestoryvideo/'><font color='#ffffff'><b><i>Love Story</i></b> /</font>  </a>
                             <a href='/index/childrenvideo/'><font color='#ffffff'><b><i>Детское</i></b> / </font> 
                             <a href='/index/finalsvideo/'><font color='#ffffff'><b><i>Выпускные вечера</i></b> / </font>  </a>
                             <a href='/index/othervideo/'><font color='#ffffff'><b><i>Разное</i></b> </font> </a>" );

        $this->view->assign("url", $this->getFrontController()->getBaseUrl());
    }


    public function finalsvideoAction()
    {

        $video = new Application_Model_Video('video');

        $this->view->assign("list_video", $video->getVideo($this->getRequest()->getActionName()));
        $history = new Application_Model_History('history_video');

        $this->view->assign("history", $history->get($this->getRequest()->getActionName()));

        $this->view->assign("navigation",
            "<a href='/video/'><font color='#ffffff'><b><i>Видео</i></b> / </font></a> 
                             <a href='/index/weddingvideo/'><font color='#ff0000'><b><i>Свадьбы</i></b> /  </font>  </a>
                             <a href='/index/lovestoryvideo/'><font color='#ffffff'><b><i>Love Story</i></b> /</font>  </a>
                             <a href='/index/childrenvideo/'><font color='#ffffff'><b><i>Детское</i></b> / </font> 
                             <a href='/index/finalsvideo/'><font color='#ffffff'><b><i>Выпускные вечера</i></b> / </font>  </a>
                             <a href='/index/othervideo/'><font color='#ffffff'><b><i>Разное</i></b> </font> </a>" );
        $this->view->assign("url", $this->getFrontController()->getBaseUrl());
    }


    public function lovestoryvideoAction()
    {

        $video = new Application_Model_Video('video');

        $this->view->assign("list_video", $video->getVideo($this->getRequest()->getActionName()));
        $history = new Application_Model_History('history_video');

        $this->view->assign("history", $history->get($this->getRequest()->getActionName()));

        $this->view->assign("navigation",
            "<a href='/video/'><font color='#ffffff'><b><i>Видео</i></b> / </font></a> 
                             <a href='/index/weddingvideo/'><font color='#ff0000'><b><i>Свадьбы</i></b> /  </font>  </a>
                             <a href='/index/lovestoryvideo/'><font color='#ffffff'><b><i>Love Story</i></b> /</font>  </a>
                             <a href='/index/childrenvideo/'><font color='#ffffff'><b><i>Детское</i></b> / </font> 
                             <a href='/index/finalsvideo/'><font color='#ffffff'><b><i>Выпускные вечера</i></b> / </font>  </a>
                             <a href='/index/othervideo/'><font color='#ffffff'><b><i>Разное</i></b> </font> </a>" );
    }

    public function lovestoryAction()
    {

        $photo = new Application_Model_Photo('photo');

        $this->view->assign("list_photo", $photo->getPhotos($this->getRequest()->getActionName()) );
        $this->view->assign("navigation",
            "<a href='/index/photo/'><font color='#ffffff'><b><i>фото</i></b> / </font></a> 
                             <a href='/index/wedding/'><font color='#ffffff'><b><i>Свадьбы</i></b> /  </font>  </a>
                             <a href='/index/lovestory/'><font color='#ff0000'><b><i>Love Story</i></b> /</font>  </a>
                             <a href='/index/children/'><font color='#ffffff'><b><i>Детское</i></b> / </font> 
                             <a href='/index/finals/'><font color='#ffffff'><b><i>Выпускные альбомы</i></b> / </font>  </a>
                             <a href='/index/other/'><font color='#ffffff'><b><i>Разное</i></b> </font> </a>" );
        $this->view->assign("url", $this->getFrontController()->getBaseUrl());
    }

    public function weddingAction()
    {


        $photo = new Application_Model_Photo('photo');
        $this->view->assign("list_photo", $photo->getPhotos($this->getRequest()->getActionName()));

        $this->view->assign("navigation",
            "<a href='/index/photo/'><font color='#ffffff'><b><i>фото</i></b> / </font></a> 
                             <a href='/index/wedding/'><font color='#ff0000'><b><i>Свадьбы</i></b> /  </font>  </a>
                             <a href='/index/lovestory/'><font color='#ffffff'><b><i>Love Story</i></b> /</font>  </a>
                             <a href='/index/children/'><font color='#ffffff'><b><i>Детское</i></b> / </font> 
                             <a href='/index/finals/'><font color='#ffffff'><b><i>Выпускные альбомы</i></b> / </font>  </a>
                             <a href='/index/other/'><font color='#ffffff'><b><i>Разное</i></b> </font> </a>" );



    }



    public function childrenAction()
    {

        $photo = new Application_Model_Photo('photo');
        $this->view->assign("list_photo", $photo->getPhotos($this->getRequest()->getActionName()));

        $this->view->assign("navigation",
            "<a href='/index/photo/'><font color='#ffffff'><b><i>фото</i></b> / </font></a> 
                             <a href='/index/wedding/'><font color='#ff0000'><b><i>Свадьбы</i></b> /  </font>  </a>
                             <a href='/index/lovestory/'><font color='#ffffff'><b><i>Love Story</i></b> /</font>  </a>
                             <a href='/index/children/'><font color='#ffffff'><b><i>Детское</i></b> / </font> 
                             <a href='/index/finals/'><font color='#ffffff'><b><i>Выпускные альбомы</i></b> / </font>  </a>
                             <a href='/index/other/'><font color='#ffffff'><b><i>Разное</i></b> </font> </a>" );

        $this->view->assign("url", $this->getFrontController()->getBaseUrl());
    }


    public function otherAction()
    {
        $photo = new Application_Model_Photo('photo');
        $this->view->assign("list_photo", $photo->getPhotos($this->getRequest()->getActionName()));

        $this->view->assign("navigation",
            "<a href='/index/photo/'><font color='#ffffff'><b><i>фото</i></b> / </font></a> 
                             <a href='/index/wedding/'><font color='#ff0000'><b><i>Свадьбы</i></b> /  </font>  </a>
                             <a href='/index/lovestory/'><font color='#ffffff'><b><i>Love Story</i></b> /</font>  </a>
                             <a href='/index/children/'><font color='#ffffff'><b><i>Детское</i></b> / </font> 
                             <a href='/index/finals/'><font color='#ffffff'><b><i>Выпускные альбомы</i></b> / </font>  </a>
                             <a href='/index/other/'><font color='#ffffff'><b><i>Разное</i></b> </font> </a>" );
        $this->view->assign("url", $this->getFrontController()->getBaseUrl());

    }

    public function finalsAction()
    {
        $photo = new Application_Model_Photo('photo');
        $this->view->assign("list_photo", $photo->getPhotos($this->getRequest()->getActionName()));

        $this->view->assign("navigation",
            "<a href='/index/photo/'><font color='#ffffff'><b><i>фото</i></b> / </font></a> 
                             <a href='/index/wedding/'><font color='#ff0000'><b><i>Свадьбы</i></b> /  </font>  </a>
                             <a href='/index/lovestory/'><font color='#ffffff'><b><i>Love Story</i></b> /</font>  </a>
                             <a href='/index/children/'><font color='#ffffff'><b><i>Детское</i></b> / </font> 
                             <a href='/index/finals/'><font color='#ffffff'><b><i>Выпускные альбомы</i></b> / </font>  </a>
                             <a href='/index/other/'><font color='#ffffff'><b><i>Разное</i></b> </font> </a>" );

        $this->view->assign("url", $this->getFrontController()->getBaseUrl());

    }

    public function resizeAction()
    {
        $width = isset($_GET['width']) ? (int) $_GET['width'] : 0;
        $height = isset($_GET['height']) ? (int) $_GET['height'] : 0;
        $max_size = isset($_GET['max_size']) ? (int) $_GET['max_size'] : 0;
        $file_name = $_GET['file'];
        header('Content-Type: image/png');
        $this->make_thumbnail($file_name, $width, $height, $max_size);
        define ('IMG_CACHE', $_SERVER['DOCUMENT_ROOT'].'/img_cashe/');
        //для корректной работы filemtime
        clearstatcache();
        //имя файла с кешем
        $cache_file_name = md5($file_name);

        $cache_mtime = 0;

        if (is_file(IMG_CACHE . $cache_file_name)) {

            $cache_mtime = filemtime(IMG_CACHE . $cache_file_name);

        }

        if ($cache_mtime < filemtime($file_name)) {
            //буферизация вывода
            ob_start();
            $result = $this->make_thumbnail($file_name, $width, $height, $max_size);
            $thumbnail = ob_get_contents();
            $thumb_size = ob_get_length();
            ob_end_clean();
            if ($result)
            {
                echo 'Ошибка: ' . $result;         exit();
            }     //кеширование миниатюры
            $fd = fopen(IMG_CACHE . $cache_file_name, "wb");
            fwrite($fd, $thumbnail);
            fclose($fd);
            $cache_mtime = filemtime(IMG_CACHE . $cache_file_name);
        } else {
            //загрузка миниатюры из кеша
            var_dump('FROM CACHE');
            $fd = fopen(IMG_CACHE . $cache_file_name, "rb");
            $thumb_size = filesize(IMG_CACHE . $cache_file_name);
            $thumbnail = fread ($fd, $thumb_size);
            fclose ($fd);
        }
        #header('Content-Type: image/png');
        //время создания миниатюры
        #header('Last-Modified: '.gmdate('D, d M Y H:i:s', $cache_mtime).' GMT');
        #header('Content-Length: '.$thumb_size); //вывод миниатюры в браузер
        echo $thumbnail;

        exit();
    }


    protected function  make_thumbnail( $file_name, $thumb_width, $thumb_height, $max_size) {

        $image_info = getimagesize( $file_name );

        switch ( $image_info['mime'] ) {

            case 'image/gif':
                if (imagetypes() & IMG_GIF) {
                    $image = imagecreatefromGIF($file_name);
                }else {

                    $err_str = 'GD не поддерживает GIF';
                }
                break;

            case 'image/jpeg':

                if (imagetypes() & IMG_JPG) {

                    $image = imagecreatefromJPEG($file_name);
                }else {

                    $err_str = 'GD не поддерживает JPEG';
                }
                break;
            case 'image/png':
                if (imagetypes() & IMG_PNG) {
                    $image = imagecreatefromPNG($file_name);
                }else {
                    $err_str = 'GD не поддерживает PNG';
                }break;
            default:
                $err_str = 'GD не поддерживает ' . $image_info['mime'];
        }

        if (isset($err_str)) {
            print $err_str;
        }

        $image_width = imagesx( $image );
        $image_height = imagesy( $image );

        //задано ограничение на высоту и ширину:

        if ($max_size) {

            if ($image_width < $image_height) {

                $thumb_height = $max_size;
                $thumb_width =   round($max_size * $image_width / $image_height);

            }else {
                $thumb_width = $max_size;
                $thumb_height = round($max_size * $image_height / $image_width);
            }
        }     //задана только ширина
        elseif ($thumb_width && !$thumb_height) {
            $thumb_height = round($thumb_width * $image_height / $image_width);
        }//задана только высота
        elseif (!$thumb_width && $thumb_height) {
            $thumb_width =  round($thumb_height * $image_width / $image_height);
        }
        //не задан ни один из размеров
        else {
            $thumb_width = $image_width;
            $thumb_height = $image_height;
        }

        $thumb = imagecreatetruecolor($thumb_width, $thumb_height);
        imagealphablending($thumb, false);
        imagesavealpha($thumb, true);

        imagecopyresampled($thumb, $image, 0, 0, 0, 0, $thumb_width, $thumb_height, $image_width, $image_height);
        imagePNG($thumb);
        //освобождаем память
        imagedestroy($image);
        imagedestroy($thumb);
    }

}



