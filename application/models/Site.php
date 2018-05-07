<?php

class Application_Model_Site extends Zend_Db_Table
{
    public function __construct($_table)
    {
        parent::__construct($_table);
    }

    public function save($_post)
    {

        $this->Insert("insert into {$this->mTable} (note,type_note) values('{$_post['tDesc']}','{$_post['hAction']}')");
    }

    public function checkNote($_action)
    {
        $res = $this->Select("select * from {$this->mTable} where type_note='$_action'");
        if (count($res[0]['id']) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getNote($_type)
    {
        $file = '';
        $select = $this->select()->where('type_note = ?', $_type);
        /* @var $row Zend_Db_Table_Row */
        $row = $this->fetchRow($select);
        if (file_exists($row['note'])) {
            $file = file_get_contents($row['note']);
        }

        return $file;
    }

    public function updateNote($_post, $_action)
    {
        $f = fopen('site/' . $_action, 'w');
        $_post['tDesc'] = str_replace("\\", "", $_post['tDesc']);
        fwrite($f, $_post['tDesc']);
        fclose($f);
        @chmod('site/' . $_action, 0777);
        $this->Update("update site set note='" . 'site/' . $_action . "' where type_note = '$_action'");

    }
}
