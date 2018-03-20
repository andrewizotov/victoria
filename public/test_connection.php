<?php

set_include_path( '../'. PATH_SEPARATOR. get_include_path());

require 'Zend/Loader/Autoloader.php';

Zend_Loader_Autoloader::getInstance();


$mysql = new Zend_Db_Adapter_Pdo_Mysql(
    array('dbname'=>'victoria','username'=>'root','password'=>'root','charset'=>'utf8','host'=>'127.0.0.1')
);

$connection  = $mysql->getConnection();

if($mysql->isConnected()){
    echo "Connected\n";
} else {
    echo 'No Connected';
    exit();
}

$select  = $mysql->select();

$select->from('photo')->forUpdate();