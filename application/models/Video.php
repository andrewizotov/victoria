<?php


class Application_Model_Video extends Zend_Db_Table
{

    protected $types;

    public function __construct($_table)
    {
        $this->types = array('wedding' => 1, 'lovestory' => 2, 'children' => 3, 'finals' => 4, 'other' => 5);

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