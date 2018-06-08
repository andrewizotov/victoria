<?php

class Application_Model_Reviews extends Zend_Db_Table {

    public function __construct($table = null)
    {
        parent::__construct('otzivi');
    }


    public function getPublicReviews()
    {
        /* @var $rows Zend_Db_Table_Rowset_Abstract */
        $rows = $this->fetchAll('allow = 1', 'id DESC');
        return $rows->toArray();
    }

}