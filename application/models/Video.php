<?php


class Application_Model_Video extends Zend_Db_Table
{

    protected $types;

    public function __construct($_table)
    {

        $this->types = array('weddingvideo' => 1, 'lovestoryvideo' => 2, 'childrenvideo' => 3, 'finalsvideo' => 4, 'othervideo' => 5);

        parent::__construct($_table);
    }


    public function add($_post, $_type)
    {
        $ts = time();
        $this->Insert("insert into video (title,code,type,ts) values('{$_post['tTitle']}','{$_post['tVideo']}',$_type, $ts)");
    }

    public function getVideo($_type)
    {

        /* @var $select Zend_Db_Table_Select */
        $select = $this->select()->where('type = ?', $this->types[$_type])->order(array('ts DESC'));
        return $this->fetchAll($select);
    }

    public function delVideo($_id)
    {

        $this->Delete("delete from video where id=$_id");

    }
}

?>