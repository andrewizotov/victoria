<?php 
require_once("MainController.php");

class AdminController extends MainController {

    public function indexAction() {

        if(!Zend_Auth::getInstance()->hasIdentity() ) {

            return $this->_redirect( Zend_Registry::get( 'domen' )."/login/" );
        }

        if( $this-> _request-> isGet() && $this->_request->getParam("type") == "about" ) {

            $note = new Note("site");

            if( $note->checkNote( $this->_request->getParam("type") ) ) {

                $this->view->assign("data", $note);
            }

            if( $note->checkNote( "about_bred" ) ) {

                $this->view->assign("dataBred", $note);
            }

            $this->view->assign("action","about");
            $this->view->assign("title","О нас");
        }

          if( $this-> _request-> isGet() && $this->_request->getParam("type") == "main" ) {

            $note = new Note("site");

            if( $note->checkNote($this->_request->getParam("type")) ) {

                $this->view->assign("data", $note );
            }

            if( $note->checkNote( "main_bredMain" ) ) {
               
                $this->view->assign("dataMainBred", $note);
            }

            $this->view->assign("action","main");
            $this->view->assign("title","Контакты");
        }


        if( $this-> _request-> isGet() && $this->_request->getParam("type") == "note" ) {

            $note = new Note("site");

            if( $note->checkNote($this->_request->getParam("type")) ) {

                $this->view->assign("data", $note );
            }

            if( $note->checkNote( "note_bredNote" ) ) {

                $this->view->assign("dataNoteBred", $note);
            }

            $this->view->assign("action","note");
            $this->view->assign("title","Полезное");
        }


        if( $this-> _request-> isGet() && $this->_request->getParam("type") == "more" ) {

            $note = new Note("site");

            if( $note->checkNote( $this->_request->getParam("type") ) ) {

                $this->view->assign("data", $note);
            }

            if( $note->checkNote( "more_bredMore" ) ) {

                $this->view->assign("dataBredMore", $note);
            }

            $this->view->assign("action","more");
            $this->view->assign("title","Дополнительные услуги");
        }

        if( $this-> _request-> isGet() && $this->_request->getParam("type") == "price" ) {

            $note = new Note("site");

            if( $note->checkNote( $this->_request->getParam("type") ) ) {

                $this->view->assign("data", $note);
            }

            $this->view->assign("action","price");
            $this->view->assign("title","Цены");
        }


        if( $this-> _request-> isGet() && $this->_request->getParam("type") == "music" ) {

            $note = new Note("site");

            if( $note->checkNote( $this->_request->getParam("type") ) ) {

                $this->view->assign("data", $note);
            }

            $this->view->assign("action","music");
            $this->view->assign("title","Музыка Тамада");
        }




        if( $this-> _request-> isGet() && $this->_request->getParam("type") == "links" ) {

            $otz = new Otzivi("otzivi");

            if( isset( $_GET['del']) ) {
                $otz->del($_GET['del']);
            }

            $this->view->assign("data", $otz->getAdmin());
            $this->view->assign("action","links");
            $this->view->assign("title","Отзывы");
        }

        if( $this-> _request-> isGet() && $this->_request->getParam("type") == "links" && isset($_GET['allow']) && $_GET['allow'] > 0) {

            $otz = new Otzivi("otzivi");
            if(strlen(trim($_GET['allow'])) == 0) return ;
            $otz->allowComment( trim($_GET['allow']) );

            $this->view->assign("data", $otz->getAdmin());
            $this->view->assign("action","links");
            $this->view->assign("title","Отзывы");
        }

        if( $this-> _request-> isGet() && $this->_request->getParam("type") == "uslugi" ) {

            $note = new Note("site");

             if( $note->checkNote( "uslugi_bredWork" ) ) {

                $this->view->assign("dataBredWork", $note);
            }

            if( $note->checkNote($this->_request->getParam("type")) ) {

                $this->view->assign("data", $note );
            }

            $this->view->assign("action","uslugi");
            $this->view->assign("title","Услуги");
        }

        if( $this-> _request-> isGet() && $this->_request->getParam("type") == "contacts" ) {

            $note = new Note("site");

            if( $note->checkNote($this->_request->getParam("type")) ) {

                $this->view->assign("data", $note );
            }

            $this->view->assign("action","contacts");
            $this->view->assign("title","Контакты");
        }

       

        if( $this-> _request-> isGet() && $this->_request->getParam("type") == "photo" ) {

            $this->_redirect(Zend_Registry::get( 'domen' )."/admin/photo/");
        }


        if( $this-> _request-> isGet() && $this->_request->getParam("type") == "video" ) {

            $this->_redirect(Zend_Registry::get( 'domen' )."/admin/video/");
        }

        if( $this-> _request-> isGet() && $this->_request->getParam("type") == "uslugi" ) {
            $this->view->assign("action","uslugi");
            $this->view->assign("title","Услуги");
        }

        if( $this-> _request-> isGet() && count($this->_request->getParams())) {

            $this->_redirect(Zend_Registry::get( 'domen' )."/admin/photo/");
        }

    }

    public function exitAction() {

        if( Zend_Auth::getInstance()->hasIdentity() ) {

            Zend_Auth::getInstance()-> clearIdentity();
            return $this->_redirect( Zend_Registry::get( 'domen' ) );
        }else
            return $this->_redirect( Zend_Registry::get( 'domen' )."/login/" );
    }

    public function authAction() {

        if( Zend_Auth::getInstance()->hasIdentity() ) {

            return $this->_redirect( Zend_Registry::get( 'domen' )."/admin/" );
        }

        if ( $this-> _request-> isPost() && $this-> _request-> getPost('sSubmit')) {

            $login  = $this-> _request-> getPost('tLogin');
            $pass  = $this-> _request-> getPost('tPass');


            $authAdapter = $this->_getAuthAdapter( $login,  $pass );

            $auth = Zend_Auth::getInstance();
            $result =  $auth-> authenticate( $authAdapter );

            if ( !$result->isValid() ) {

                return $this->_redirect( Zend_Registry::get( 'domen' )."/login/" );
            }else {

                $currentUser = $authAdapter-> getResultRowObject(  array('login', 'pass') );
                Zend_Auth::getInstance()-> getStorage()-> write( $currentUser );
                return $this->_redirect( Zend_Registry::get( 'domen' )."/admin/" );
            }
        }else return $this->_redirect( Zend_Registry::get( 'domen' )."/login/" );
    }

    public function videoAction() {

        if( !Zend_Auth::getInstance()->hasIdentity() ) {

            return $this->_redirect( Zend_Registry::get( 'domen' ) );
        }

        $video = new Video("video");

        if( $this-> _request-> isGet() && $this->_request->getParam("del") > 0 ) {

            $video-> delVideo( $this->_request->getParam("del") );
        }


        $this->view->assign("listWed_video", $video->getVideo(1) ) ;
        $this->view->assign("listOther_video", $video->getVideo(5) ) ;
        $this->view->assign("listCh_video", $video->getVideo(3) ) ;
        $this->view->assign("listFinal_video", $video->getVideo(4) ) ;
        $this->view->assign("listStory_video", $video->getVideo(2) ) ;

        $history = new History("history_video");

        $this->view->assign("history_wedd", $history-> get(1) ) ;
        $this->view->assign("history_love", $history-> get(2) ) ;
        $this->view->assign("history_ch", $history-> get(3) ) ;
        $this->view->assign("history_finals", $history-> get(4) ) ;
        $this->view->assign("history_other", $history-> get(5) ) ;
    }

    public function savewedvideoAction() {

        $video = new Video("video");

        $video-> add( $_POST, 1 );


        return $this->_redirect( Zend_Registry::get( 'domen' )."/admin/video/");
    }

    public function savelovevideoAction() {

        $video = new Video("video");

        $video-> add( $_POST, 2 );


        return $this->_redirect( Zend_Registry::get( 'domen' )."/admin/video/");
    }

    public function savechildvideoAction() {


        $video = new Video("video");

        $video-> add( $_POST, 3 );

        return $this->_redirect( Zend_Registry::get( 'domen' )."/admin/video/");
    }

    public function savefinalsvideoAction() {

        $video = new Video("video");

        $video-> add( $_POST, 4 );

        return $this->_redirect( Zend_Registry::get( 'domen' )."/admin/video/");
    }

    public function saveothervideoAction() {

        $video = new Video("video");

        $video-> add( $_POST, 5 );

        return $this->_redirect( Zend_Registry::get( 'domen' )."/admin/video/");
    }



    public function photoAction() {

        if( !Zend_Auth::getInstance()->hasIdentity() ) {

            return $this->_redirect( Zend_Registry::get( 'domen' ) );
        }

        $ph = new Photo("photo");

        if( $this-> _request-> isGet() && $this->_request->getParam("del") > 0 ) {

            $ph-> delPhoto( $this->_request->getParam("del") );
        }


        $this->view->assign("listWed", $ph->getPhotoWed() ) ;
        $this->view->assign("listOther", $ph->getPhotoOther() ) ;
        $this->view->assign("listCh", $ph->getPhotoCh() ) ;
        $this->view->assign("listFinal", $ph->getPhotoFinals() ) ;
        $this->view->assign("listStory", $ph->getPhotoStory() ) ;

    }

    public function savewedAction() {

        if( !Zend_Auth::getInstance()->hasIdentity() ) {

            return $this->_redirect( Zend_Registry::get( 'domen' ) );
        }

        $ph = new Photo( "photo" );

        $ph->saveWed( $this->_request-> getPost() );

        return $this->_redirect( Zend_Registry::get( 'domen' )."/admin/photo/" );
    }

    public function savefinalAction() {

        if( !Zend_Auth::getInstance()->hasIdentity() ) {

            return $this->_redirect( Zend_Registry::get( 'domen' ) );
        }

        $ph = new Photo("photo");
        $ph->saveFinals( $this->_request->getPost() );

        return $this->_redirect( Zend_Registry::get( 'domen' )."/admin/photo/" );
    }

    public function saveotherAction() {

        if( !Zend_Auth::getInstance()->hasIdentity() ) {

            return $this->_redirect( Zend_Registry::get( 'domen' ) );
        }

        $ph = new Photo("photo");

        if( $ph->saveOther( $_POST ) ) {

            $mess = "good";

        }else { $mess = "no_good"; }


        return $this->_redirect( Zend_Registry::get( 'domen' )."/admin/photo/?mess=".$mess );

    }


    public function savestoryAction() {

        if( !Zend_Auth::getInstance()->hasIdentity() ) {

            return $this->_redirect( Zend_Registry::get( 'domen' ) );
        }

        $ph = new Photo("photo");
        $ph->saveStory( $this->_request->getPost() );

        return $this->_redirect( Zend_Registry::get( 'domen' )."/admin/photo/" );

    }

    public function savechAction() {

        if( !Zend_Auth::getInstance()->hasIdentity() ) {

            return $this->_redirect( Zend_Registry::get( 'domen' ) );
        }

        $ph = new Photo("photo");
        $ph->saveCh( $this->_request->getPost() );

        return $this->_redirect( Zend_Registry::get( 'domen' )."/admin/photo/" );

    }

    public function saveAction() {

        if ( $this-> _request-> isPost() && $this-> _request-> getPost('sDesc')  ) {

            $note = new Note("site");

            if( !$note->checkNote($this-> _request-> getPost('hAction')) ) {
                $note-> save($this-> _request-> getPost(),  $this-> _request-> getPost('hAction') );
            }else $note-> updateNote( $this-> _request-> getPost(),  $this-> _request-> getPost('hAction') );


        }


        $this->_redirect( Zend_Registry::get( 'domen' )."/admin/?type=".$this-> _request-> getPost('hAction'));
    }

    public function savebredAction() {


        if ( $this-> _request-> isPost() && $this-> _request-> getPost('sDescBred')  ) {

            $note = new Note("site");

            if( !$note->checkNote( $this-> _request-> getPost('hAction') ) ) {
                $note-> save($this-> _request-> getPost(),  $this-> _request-> getPost('hAction') );
            }else $note-> updateNote( $this-> _request-> getPost(),  $this-> _request-> getPost('hAction') );
        }
        $this->_redirect( Zend_Registry::get( 'domen' )."/admin/?type=about");
    }


    public function savebredmoreAction() {


        if ( $this-> _request-> isPost() && $this-> _request-> getPost('sDescBredMore')  ) {

            $note = new Note("site");

            if( !$note->checkNote( $this-> _request-> getPost('hAction') ) ) {
                $note-> save($this-> _request-> getPost(),  $this-> _request-> getPost('hAction') );
            }else $note-> updateNote( $this-> _request-> getPost(),  $this-> _request-> getPost('hAction') );
        }
        $this->_redirect( Zend_Registry::get( 'domen' )."/admin/?type=more");
    }


    public function savebredmainAction() {


        if ( $this-> _request-> isPost() && $this-> _request-> getPost('sDescBredMain')  ) {

            $note = new Note("site");

            if( !$note->checkNote( $this-> _request-> getPost('hAction') ) ) {
                $note-> save($this-> _request-> getPost(),  $this-> _request-> getPost('hAction') );
            }else $note-> updateNote( $this-> _request-> getPost(),  $this-> _request-> getPost('hAction') );
        }
        $this->_redirect( Zend_Registry::get( 'domen' )."/admin/?type=main");
    }


   public function savebrednoteAction() {


        if ( $this-> _request-> isPost() && $this-> _request-> getPost('sDescBredNote')  ) {

            $note = new Note("site");

            if( !$note->checkNote( $this-> _request-> getPost('hAction') ) ) {
                $note-> save($this-> _request-> getPost(),  $this-> _request-> getPost('hAction') );
            }else $note-> updateNote( $this-> _request-> getPost(),  $this-> _request-> getPost('hAction') );
        }
        $this->_redirect( Zend_Registry::get( 'domen' )."/admin/?type=note");
    }


     public function savebredworkAction() {


        if ( $this-> _request-> isPost() && $this-> _request-> getPost('sDescBredWork')  ) {

            $note = new Note("site");

            if( !$note->checkNote( $this-> _request-> getPost('hAction') ) ) {
                $note-> save($this-> _request-> getPost(),  $this-> _request-> getPost('hAction') );
            }else $note-> updateNote( $this-> _request-> getPost(),  $this-> _request-> getPost('hAction') );
        }
        $this->_redirect( Zend_Registry::get( 'domen' )."/admin/?type=uslugi");
    }


    protected function _getAuthAdapter( $userName, $userPassword ) {

        $db = Zend_Registry::get( 'db' );
        $authAdapter = new Zend_Auth_Adapter_DbTable( $db );
        $authAdapter->setTableName( 'admin' )->setIdentityColumn( 'login' )->setCredentialColumn( 'pass' );
        $authAdapter->setIdentity( $userName );
        $authAdapter->setCredential( $userPassword );

        return $authAdapter;
    }

    public function historyAction() {

        $type = $_GET['type'];

        if( $this-> _request-> isPost() ) {

            $history = new History("history_video");
            $history->save($this-> _request-> getPost(),$type );
        }

        $this->_redirect("/admin/video/");
    }


    public function commenteditAction() {

        $photo = new Photo('photo');
        $photo->editCommentByPhoto($this->_request->getPost(), $this->_request->get('ID'));
        $this->_redirect("/admin/photo/");
    }


} 

