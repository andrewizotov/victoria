<?php

class Application_Model_History extends Zend_Db_Table
{

    protected $types;

    public function __construct($_table)
    {

        $this->types = array('weddingvideo'=>1,'lovestoryvideo'=>2, 'childrenvideo'=>3, 'finalsvideo'=>4, 'othervideo'=>5);

        parent::__construct($_table);
    }

    public function save($_post, $_type)
    {

        $res = $this->get($_type);
        if (count($res) > 0) {
            $content = str_replace("'", "\'", $_post['tHistory']);
            $this->Update("update history_video set history = '$content' where id = {$res[0]['id']}");
        } else {

            //$ts = time();
            //$this->Insert("insert into history_video (history,type) values('{$_post['tHistory']}', $_type)");
        }
    }

    public function get($_type)
    {
        /* @var $select Zend_Db_Table_Select */
        $select = $this->select()->where('type = ?', $this->types[$_type]);
        return $this->fetchAll($select);

    }
}