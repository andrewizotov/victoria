<?php
require_once 'Zend/Controller/Action.php';

require_once 'Zend/Loader/Autoloader.php';
require_once "Zend/Loader.php";


class __Bootstrap
{

    private $_config = null;
    private $registry;

    public function run($config)
    {

        $this->setLoader();
        $this->setConfig($config);
        $this->setDbAdapter();

        $front = Zend_Controller_Front::getInstance();
        $front->setControllerDirectory('../application/controllers');
        $front->registerPlugin(new Zend_Controller_Plugin_ErrorHandler());
        $front->dispatch();
        //$this->_initZFDebug();
    }

    public function setLoader()
    {

        Zend_Loader_Autoloader::getInstance();
        Zend_Loader::loadClass("Zend_Filter_StripTags");
        $this->registry = Zend_Registry::getInstance();
        Zend_Session::start();
    }

    public function setConfig($config)
    {
        $configPath = new Zend_Config_Ini('../application/config.ini', 'project');
        $this->registry->set("domen", $configPath->project->domen);
    }


    public function setDbAdapter()
    {

        $configDB = new Zend_Config_Ini('../application/config.ini', 'database');
        $this->registry->set("configDB", $configDB);
        $db = Zend_Db::factory($configDB->db->adapter, $configDB->db->params->toArray());
        Zend_Db_Table_Abstract::setDefaultAdapter($db);
        $this->registry->set("db", $db);
        $db->query("set charset utf8");
        $db->query("set NAMES utf8");
    }

    public function setRouter()
    {
        return ;
    }
};