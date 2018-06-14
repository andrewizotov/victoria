<?php

class VideoController extends Zend_Controller_Action
{
    protected $navigation = array();
    protected $types;
    /**
     * @var Zend_Translate
     */
    protected $translate;

    public function init()
    {
        /* @var $bootStrap Bootstrap */
        $bootStrap = $this->getInvokeArg('bootstrap');
        /* @var $translate Zend_Translate */
        $this->translate = $bootStrap->getResource('translate');

        $this->types = array(
            'wedding' => 1,
            'lovestory' => 2,
            'children' => 3,
            'finals' => 4,
            'other' => 5
        );


    }

    public function preDispatch()
    {

        /* @var $bootStr Bootstrap */
        $bootStr = $this->getFrontController()->getParam('bootstrap');
        $baseUrl = $bootStr->getBaseUrlFromSettings();

        foreach ($this->types as $key => $val) {
            $this->navigation[$key] = array(
                'link' => $baseUrl . '/' . $this->getRequest()->getControllerName() . '/' . $key,
                'translation' =>$this->translate->getAdapter()->_($key)
            );
        }

        if (
            $this->getRequest()->getActionName() !== 'show' &&
            $this->getRequest()->getActionName() !== 'all'
        ) {
            $this->_forward('show', null, null, array('type' => $this->getRequest()->getActionName()));
        }
    }

    public function allAction()
    {
        //$this->view->assign("title", "<b>Фото</b><br><i>Портфолио фотографа Кривко Татьяны</i><br>");
    }

    public function showAction()
    {
        $config = array(
            'adapter'   => 'Zend_Http_Client_Adapter_Curl',
            'curloptions' => array(
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 30
            ),
        );


        $client = new Zend_Http_Client(null, $config);



        $photo = new Application_Model_Video('video');
        $this->view->assign("vimeoClient", $client);
        $this->view->assign("list_video", $photo->getVideo($this->getRequest()->getUserParam('type')));
        $this->view->assign("navigation", $this->navigation);
    }
}


