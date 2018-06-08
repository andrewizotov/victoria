<?php

class Application_Model_Photo extends Zend_Db_Table
{

    private  $types = array();

    public function __construct($_table)
    {

        $this->types = array('wedding'=>1,'lovestory'=>2,'children'=>3, 'finals'=>4, 'other'=>5);

        parent::__construct($_table);
    }

    public function saveWed($_post)
    {

        // $this->Insert("insert into {$this->mTable} (link, comment, type_photo) values('{$_post['tLink']}','{$_post['tComment']}',1)");

        if (move_uploaded_file($_FILES['file']['tmp_name'], "img/other/{$_FILES['file']['name']}")) {

            chmod("img/other/{$_FILES['file']['name']}", 0644);
            $this->Insert("insert into {$this->mTable} (link,comment,type_photo) values('" . Zend_Registry::get('domen') . "/img/other/" . $_FILES['file']['name'] . "','{$_post['tComment']}',1)");

            return true;
        } else return false;
    }

    public function saveOther($_post)
    {

        if (move_uploaded_file($_FILES['file']['tmp_name'], "img/other/{$_FILES['file']['name']}")) {
            chmod("img/other/{$_FILES['file']['name']}", 0644);
            $this->Insert("insert into {$this->mTable} (link,comment,type_photo) values('" . Zend_Registry::get('domen') . "/img/other/" . $_FILES['file']['name'] . "','{$_post['tComment']}',5)");
            return true;
        } else return false;

        return false;
    }

    public function saveCh($_post)
    {

        if (move_uploaded_file($_FILES['file']['tmp_name'], "img/other/{$_FILES['file']['name']}")) {
            chmod("img/other/{$_FILES['file']['name']}", 0644);
            $this->Insert("insert into {$this->mTable} (link,comment, type_photo) values('" . Zend_Registry::get('domen') . "/img/other/" . $_FILES['file']['name'] . "','{$_post['tComment']}',3)");
            return true;
        } else return false;

        return false;
    }


    public function saveFinals($_post)
    {

        if (move_uploaded_file($_FILES['file']['tmp_name'], "img/other/{$_FILES['file']['name']}")) {
            chmod("img/other/{$_FILES['file']['name']}", 0644);
            $this->Insert("insert into {$this->mTable} (link, comment,type_photo) values('" . Zend_Registry::get('domen') . "/img/other/" . $_FILES['file']['name'] . "','{$_post['tComment']}',4)");
            return true;
        } else return false;

        return false;
    }

    public function saveStory($_post)
    {

        if (move_uploaded_file($_FILES['file']['tmp_name'], "img/other/{$_FILES['file']['name']}")) {
            chmod("img/other/{$_FILES['file']['name']}", 0644);
            $this->Insert("insert into {$this->mTable} (link,comment, type_photo) values('" . Zend_Registry::get('domen') . "/img/other/" . $_FILES['file']['name'] . "','{$_post['tComment']}',2)");
            return true;
        } else return false;

        return false;
    }

    public function delPhoto($_id)
    {

        $res = $this->Select("select * from {$this->mTable} where id = $_id");

        $pos = strripos($res[0]['link'], "/");

        $name = trim(substr($res[0]['link'], $pos + 1, strlen($res[0]['link']) - $pos));
        $this->Delete("delete from {$this->mTable} where id = $_id");
        unlink("img/other/" . $name);
    }


    public function getPhotos($type)
    {
        $select = $this->select()->where('type_photo = ?', (int)$this->types[$type]);
        return $this->fetchAll($select);
    }


    public function getPhotoStory()
    {

        //return $this->Select("select * from {$this->mTable} where type_photo=2");
    }

    public function getPhotoCh()
    {

        return $this->Select("select * from {$this->mTable} where type_photo=3");
    }


    public function getPhotoFinals()
    {
        return $this->Select("select * from {$this->mTable} where type_photo=4");
    }

    public function getPhotoOther()
    {
        return $this->Select("select * from {$this->mTable} where type_photo=5");
    }

    public function editCommentByPhoto($_post, $_id)
    {

        $this->Update("update photo set comment = '{$_post['tComment']}' where id = $_id");
    }
}