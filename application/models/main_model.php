<?php


class MainModel
{

    protected $mDB, $mTable;

    function __construct($_table = 0)
    {

        if ($_table) $this->mTable = $_table;

        $registry = Zend_Registry::getInstance();
        $this->mDB = $registry->get("db");
    }

    function Insert($_sql, $_debug = 0)
    {

        if ($_debug == 1) {
            print($_sql);
            exit();
        }

        $this->mDB->query($_sql);
        return $this->mDB->lastInsertId();
    }


    function Select($_sql)
    {
        $res = $this->mDB->query($_sql);
        return $res->fetchAll();
    }

    function Update($_sql, $_debug = 0)
    {

        if ($_debug == 1) {
            print($_sql);
            exit();
        }

        $res = $this->mDB->query($_sql);
        return true;
    }

    function Delete($_sql, $_debug = 0)
    {

        if ($_debug == 1) {
            print($_sql);
            exit();
        }

        $res = $this->mDB->query($_sql);
        return true;
    }

    public function sendMail($_content, $_adress, $_from, $_them)
    {

        $eMail2 = new PHPMailer();

        /* if( preg_match("/^[0-9A-Za-z]+@agratech\.com\.ua$/i", $_adress)  ){
            $eMail2->IsSMTP();
            $eMail2->Host = "agratech.com.ua";
         }

         if(   preg_match("/^[0-9A-Za-z]+@agrtec\.com\.ua$/i", $_adress) ) {

            $eMail2->IsSMTP();
            $eMail2->Host = "agrtec.com.ua";
         }*/

        $eMail2->IsHTML = false;
        $eMail2->CharSet = 'utf-8';
        $eMail2->From = ((strlen($_from) > 0) ? $_from : "victoria-k@dp.ua");
        $eMail2->FromName = "Пользователь с сайта";
        $EMAIL_TEST_MODE = 0;
        $eMail2->Subject = $_them;
        $eMail2->AddAddress($_adress);
        $eMail2->IsHTML(true);
        $eMail2->Body = $_content;
        $r = $eMail2->Send();
        return $r;

    }
}

