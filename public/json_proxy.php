<?php
session_start();
header("Cache-Control: no-cache");
header("Pragma: no-cache");
header('Content-type: text/html');
require_once("include/base_function.php");
require_once("include/phpmailer/class.phpmailer.php");


function getListFinDir(){
    
     $res =  Select("DISTINCT( ur.id_user_ur )","role r INNER JOIN users_role ur ON ur.id_role_ur = r.id_role", "WHERE r.makr_role = 1");
     $listUserID = array();
     
     foreach( $res as $k=>$v ){
        
       $res = Select("id_user, name_user,surName_user,otch_user","users WHERE id_user = {$v['id_user_ur']}");
      
       $idUser = $v['id_user_ur'];
       $user = array();
       $user['name'] = $res[0]['name_user'];
       $user['surname'] = $res[0]['surName_user'];
       $user['otch'] = $res[0]['otch_user'];
       $listUserID[$idUser] = $user;
     }
      return $listUserID;
}

$results = -1; 
$startIndex = 0; 
$sort = null; 
$dir = 'asc'; 
$sort_dir = SORT_ASC;
$req =  $_GET['req'];

if(strlen($_GET['results']) > 0) {
    $results = $_GET['results'];
}

if(strlen($_GET['startIndex']) > 0) {
    $startIndex = $_GET['startIndex'];
}

returnData($results, $startIndex, $sort, $dir, $sort_dir,$req);

function returnData($results, $startIndex, $sort, $dir, $sort_dir, $req) {
    
    $allRecords = initArray($req,$dir);
    if(is_null($startIndex) || !is_numeric($startIndex) || ($startIndex < 0)) {
        $startIndex = 0;
    }else {
        $startIndex += 0;
    }

    if(is_null($results) || !is_numeric($results) || ($results < 1) || ($results >= count($allRecords))) {

        $results = count($allRecords);
    }else {
        $results += 0;
    }


    $data = array();
    $lastIndex = $startIndex+$results;
    if($lastIndex > count($allRecords)) {
        $lastIndex = count($allRecords); 
    }
    for($i=$startIndex; $i<($lastIndex); $i++) {
        $data[] = $allRecords[$i];
    }

    // Create return value
    $returnValue = array(
        'recordsReturned'=>count($data),
        'totalRecords'=>count($allRecords),
        'startIndex'=>$startIndex,
        'sort'=>$sort,
        'dir'=>$dir,
        'pageSize'=>$results,
        'records'=>$data
    );
    require_once('JSON.php');
    $json = new Services_JSON();
    echo ($json->encode($returnValue)); 
}

function initArray($_req,$dir) {
    
$arr = array();

if( $_req == "load_office" ){

  $listFinDir = getListFinDir();
   
  if( isset($_REQUEST['search']) ) $wh = "where o.name_office LIKE '{$_REQUEST['search']}%'";
    
  $r = Select("o.id_office,o.name_office,o.id_findir_office,u.id_user,u.name_user,u.surName_user,u.otch_user",
              "office o LEFT JOIN users u ON u.id_user = o.id_findir_office",
              " $wh ORDER BY o.id_office DESC");
  
  for($i = 0;  $i < count($r); $i++){
    
        $del = "<img style='cursor:pointer'  src='/img/trash.gif' border=0 onClick='jsDelOffice({$r[$i]['id_office']})'>";
        
        
        $status = "<select id='s_{$r[$i]['id_office']}' onChange='jsChangeStatus(this, {$r[$i]['id_office']})'>
                      <option value='0' ".(($r[$i]['status_office'] > 0)?"selected":"").">неактивно</option>
                      <option value='1' ".(($r[$i]['status_office'] > 0)?"selected":"").">активно</option>
                   </select>";
        
        $findir = "<select id='s_f{$r[$i]['id_office']}' onChange='jsChangeFinDir(this, {$r[$i]['id_office']})'>
                   <option value=o>выбрать...</option>";
                   
        foreach( $listFinDir as $key=>$val ){
           if($key == $r[$i]['id_findir_office'])  $sel = "selected" ; else $sel = "";
           $findir .= "<option value='$key' $sel >{$val['surname']} {$val['name']} {$val['otch']}</option>";  
        } 
                   
        $findir.= "</select>";           
        
        $temp = array('id'=>$r[$i]['id_office'], 
                      'name'=>"<div  style='cursor:pointer' onClick='showEditPanel({$r[$i]['id_office']},\"{$r[$i]['name_office']}\")'>".$r[$i]['name_office'],
                      'findir'=> $findir,
                      'status'=>"<center>".$status."</center>", 
                      'del' => "<center>".$del."</center>");
        $arr[] = $temp;
        
  }     

}

if( $_req == "change_findir_office" ){
  
   $id = $_REQUEST['id'];
   $val = $_REQUEST['val'];
    
    if ( Update("update office set id_findir_office = $val where id_office = $id") > 0)
     print("{\"mess\":\"Фин.Дир изменён\"}");
    else
     print("{\"mess\":\"Фин.Дир не изменён\"}");
    exit();  
     
}

if( $_req == "change_status_office" ){
    
    $id = $_REQUEST['id'];
    $val = $_REQUEST['val'];
    
    if ( Update("update office set status_office = $val where id_office = $id") > 0)
     print("{\"mess\":\"Статус изменён\"}");
    else
     print("{\"mess\":\"Статус не изменён\"}");
    exit();
} 
 
if( $_req == "edit_office" ){
    
    $id = $_REQUEST['hIdElement'];
    $val = $_REQUEST['tEditField'];
    
    if ( Update("update office set name_office = '$val' where id_office = $id") > 0)
     print("{\"mess\":\"Отредактировано\"}");
    else
     print("{\"mess\":\"Error\"}");
    exit();
}  
 
if( $_req == "add_office" ){
	  
  $name = trim(urldecode($_REQUEST['tNameOffice']));
  
  $idFinDir = $_REQUEST['sFinDir'];
  
  $status = $_REQUEST['sStatusOffice'];
  
  $resCheck = Select("*","office","where name_office = '$name'");
  
  if( count( $resCheck ) > 0){
    
    print("{\"mess\":\"Недобавлено, уже есть такое '$name'\"}");
    exit();
  }
  
  if ( Insert("office","name_office,id_findir_office,status_office","'$name',$idFinDir,$status") > 0 )
    print("{\"mess\":\"предприятие добавлено\"}");
  else
    print("{\"mess\":\"Error\"}");
  exit();
}
 
if($_req == "delete_office") {
    
  $id = $_REQUEST['id'];
  if( Delete("Delete from office where id_office = $id" ) > 0 ){
     print("{\"mess\":\"Удалено\"}");
  }else{
    print("{\"mess\":\"Error\"}");
  }
  exit();
}

// Role ----------------------------------------------------------------------------------------------
if($_req == "load_role"){
  
  if( isset($_REQUEST['search']) ) $wh = "where name_role LIKE '{$_REQUEST['search']}%'";
    
  $r = Select("*","role"," $wh ORDER BY id_role DESC");
    
  for($i = 0;  $i < count($r); $i++){
    
        $del = "<img style='cursor:pointer'  src='/img/trash.gif' border=0 onClick='jsDelRole({$r[$i]['id_role']})'>";
        
        
        $status = "<select id='s_{$r[$i]['id_role']}' onChange='jsChangeStatus(this, {$r[$i]['id_role']})'>
                      <option value='0' ".(($r[$i]['status_role'] > 0)?"selected":"").">неактивно</option>
                      <option value='1' ".(($r[$i]['status_role'] > 0)?"selected":"").">активно</option>
                   </select>";
        
        
        
        
        $temp = array('id'=>$r[$i]['id_role'], 
                      'name'=>"<div style='cursor:pointer' onClick='showEditPanel( {$r[$i]['id_role']}, \"{$r[$i]['name_role']}\", \"{$r[$i]['desc_role']}\" )'>".$r[$i]['name_role']."</div>",
                      'desc'=>$r[$i]['desc_role'],
                      'status'=>"<center>".$status."</center>",
                      /*read_role 	create_role 	edit_role 	brak_role 	makr_role 	mark2_role 	close_role 	comment_role*/
                      'mode'=>
                      "<div style='cursor:pointer' onClick='jsEditMode({$r[$i]['id_role']},{$r[$i]['read_role']},{$r[$i]['create_role']},{$r[$i]['edit_role']},{$r[$i]['brak_role']},{$r[$i]['makr_role']},{$r[$i]['mark2_role']},{$r[$i]['close_role']},{$r[$i]['comment_role']})' align='center'><font color='#FF0000'><b>режим</b></font></div>",
                      'del' => "<center>".$del."</center>");
        $arr[] = $temp;
        
  }     

}

if( $_req == "change_status_role" ){
    
    $id = $_REQUEST['id'];
    $val = $_REQUEST['val'];
    
    if ( Update("update role set status_role = $val where id_role = $id") > 0)
     print("{\"mess\":\"Статус изменён\"}");
    else
     print("{\"mess\":\"Статус не изменён\"}");
    exit();
}

if( $_req == "edit_role" ){
    
    $id = $_REQUEST['hIdElement'];
    $val = $_REQUEST['tEditField'];
    $desc = $_REQUEST['tDescElement'];
    
    if ( Update("update role set name_role = '$val', desc_role='$desc' where id_role = $id") > 0)
     print("{\"mess\":\"Отредактировано\"}");
    else
     print("{\"mess\":\"Error\"}");
    exit();
}

if( $_req == "add_role" ){
	  
  $name = trim( urldecode($_REQUEST['tNameRole']) );
  $status = $_REQUEST['sStatusRole'];
  $desc = trim( urldecode($_REQUEST['tDescRole']) );
  $resCheck = Select("*","role","where name_role = '$name'");
  
  $sql = "Update role set ";
  
  foreach($_REQUEST['rules'] as $key=>$val){
    
    $sql .= $val."=1,";
  }
  
  $sql = trim($sql, ",");

  if( count( $resCheck ) > 0){
    
    print("{\"mess\":\"Недобавлено, уже есть такое '$name'\"}");
    exit();
  }
  
  $lastID = Insert("role","name_role,status_role,desc_role","'$name',$status,'$desc'");
  
  if ( $lastID > 0){
    
    $sql .= " where id_role = $lastID"; 
    Update($sql);
    $sql = "";
    print("{\"mess\":\"роль добавлена\"}");
  }
  else
    print("{\"mess\":\"Error\"}");
  exit();
}
 
if($_req == "delete_role") {
    
  $id = $_REQUEST['id'];
  if(Delete("Delete from role where id_role = $id") > 0){
     print("{\"mess\":\"Удалено\"}");
  }else{
    print("{\"mess\":\"Error\"}");
  }
  exit();
}
//--------Position--------------------------------------------------------


if($_req == "load_position"){
  
  if( isset($_REQUEST['search']) ) $wh = "where name_position LIKE '{$_REQUEST['search']}%'";
    
  $r = Select("*","position"," $wh ORDER BY id_position DESC");
    
  for($i = 0;  $i < count($r); $i++){
    
        $del = "<img style='cursor:pointer'  src='/img/trash.gif' border=0 onClick='jsDelPosition({$r[$i]['id_position']})'>";
        
        
        $status = "<select id='s_{$r[$i]['id_position']}' onChange='jsChangeStatus(this, {$r[$i]['id_position']})'>
                      <option value='0' ".(($r[$i]['status_position'] > 0)?"selected":"").">неактивно</option>
                      <option value='1' ".(($r[$i]['status_position'] > 0)?"selected":"").">активно</option>
                   </select>";
        
        $temp = array('id'=>$r[$i]['id_position'], 
                      'name'=>"<div  style='cursor:pointer' onClick='showEditPanel({$r[$i]['id_position']},\"{$r[$i]['name_position']}\")'>".$r[$i]['name_position'],
                      'status'=>"<center>".$status."</center>", 
                      'del' => "<center>".$del."</center>");
        $arr[] = $temp;
        
  }     

}

if( $_req == "change_status_position" ){
    
    $id = $_REQUEST['id'];
    $val = $_REQUEST['val'];
    
    if ( Update("update position set status_position = $val where id_position = $id") > 0)
     print("{\"mess\":\"Статус изменён\"}");
    else
     print("{\"mess\":\"Статус не изменён\"}");
    exit();
} 
 
if( $_req == "edit_position" ){
    
    $id = $_REQUEST['hIdElement'];
    $val = $_REQUEST['tEditField'];
    
    if ( Update("update position set name_position = '$val' where id_position = $id") > 0)
     print("{\"mess\":\"Отредактировано\"}");
    else
     print("{\"mess\":\"Error\"}");
    exit();
}  
 
if( $_req == "add_position" ){
	  
  $name = trim(urldecode($_REQUEST['tNamePosition']));
  $status = $_REQUEST['sStatusPosition'];
  
  $resCheck = Select("*","position","where name_position = '$name'");
  
  if( count( $resCheck ) > 0){
    
    print("{\"mess\":\"Недобавлено, уже есть такое '$name'\"}");
    exit();
  }
  
  if (Insert("position","name_position,status_position","'$name',$status") > 0)
    print("{\"mess\":\"Должность добавлена\"}");
  else
    print("{\"mess\":\"Error\"}");
  exit();
}
 
if($_req == "delete_position") {
    
  $id = $_REQUEST['id'];
  if(Delete("Delete from position where id_position = $id") > 0){
     print("{\"mess\":\"Удалено\"}");
  }else{
    print("{\"mess\":\"Error\"}");
  }
  exit();
}
//------------USERS----------------------------------------------------------------


if($_req == "load_user"){
  
  if( isset($_REQUEST['search']) ) $wh = "where surName_user LIKE '{$_REQUEST['search']}%'";
    
  $r = Select("*","users"," $wh ORDER BY id_user DESC");
    
  for($i = 0;  $i < count($r); $i++){
    
        $del = "<img style='cursor:pointer'  src='/img/trash.gif' border=0 onClick='jsDelUser({$r[$i]['id_user']})'>";
        
        
        $status = "<select id='s_{$r[$i]['id_user']}' onChange='jsChangeStatus(this, {$r[$i]['id_user']})'>
                      <option value='0' ".(($r[$i]['status_user'] > 0)?"selected":"").">неактивно</option>
                      <option value='1' ".(($r[$i]['status_user'] > 0)?"selected":"").">активно</option>
                   </select>";
        
        $temp = array('id'=>$r[$i]['id_user'],
                      'surName'=>"<a href='/user/?id={$r[$i]['id_user']}'>".$r[$i]['surName_user']."</a>", 
                      'name'=>$r[$i]['name_user'],
                      'otch'=>$r[$i]['otch_user'],
                      'mail'=>$r[$i]['mail_user'],
                      'phone'=>$r[$i]['phone_user'],
                      'status'=>"<center>".$status."</center>", 
                      'del' => "<center>".$del."</center>");
        $arr[] = $temp;
        
  }     

}

if( $_req == "change_status_user" ){
    
    $id = $_REQUEST['id'];
    $val = $_REQUEST['val'];
    
    if ( Update("update user set status_user = $val where id_user = $id") > 0)
     print("{\"mess\":\"Статус изменён\"}");
    else
     print("{\"mess\":\"Статус не изменён\"}");
    exit();
} 
 
if( $_req == "edit_user" ){
    
    $id = $_REQUEST['hIdElement'];
    $val = $_REQUEST['tEditField'];
    
    if ( Update("update user set name_user = '$val' where id_user = $id") > 0)
     print("{\"mess\":\"Отредактировано\"}");
    else
     print("{\"mess\":\"Error\"}");
    exit();
}  
 
if($_req == "delete_user") {
    
  $id = $_REQUEST['id'];
  if(Delete("Delete from users where id_user = $id") > 0){
     
     Delete("Delete from users_position where id_user_up = $id");
     Delete("Delete from users_office where id_user_uo = $id");
     
     print("{\"mess\":\"Удалено\"}");
  }else{
    print("{\"mess\":\"Error\"}");
  }
  exit();
}
//----------------------------------------------------------------
function genPass(){
    
    $pass = generate_password(6);
     
     $res = Select("pass_user","users","where pass_user = '$pass'");
     
     if( count($res) > 0 ){
         return false;   
     }
    return $pass; 
}

if($_req == "generate_pass"){
    
 $pass = false;
     
 while( !( $pass = genPass() )  ){
   
   
 }
 
 if( $pass ){ 
  print("{\"pass\":\"$pass\"}");
 }else{
  print("{\"pass\":\"0\"}");  
 }
  
 exit();
}
//-------------------------------------------------
function sendMail($_content, $_adress, $_them){
    
   $eMail2 = new PHPMailer();
   
   /*if(preg_match("/^[0-9A-Za-z]+@uftex\.com$/i", $_adress)){
      $eMail2->IsSMTP();
      $eMail2->Host = "ASPMX3.GOOGLEMAIL.COM";
   }*/
   
   $eMail2->IsHTML = false;
   $eMail2->CharSet='utf-8';
   $eMail2->From = "request@system.com";
   $eMail2->FromName = "Administrator";
   $EMAIL_TEST_MODE = 0;
   $eMail2->Subject    = $_them;
   $eMail2->AddAddress($_adress);
   $eMail2->IsHTML(true);
   $eMail2->Body = $_content;
   $r = $eMail2->Send();
   return $r;
}

if($_req == "send_pass"){
    
   $pass = trim( $_REQUEST['pass'] );
   $mail = $_REQUEST['mail'];
   $idUser = $_REQUEST['idUser'];
   
   if( strlen($pass) > 0 && strlen($mail) > 0){
    
     if( sendMail("Пароль: $pass", $mail, "Admin") == 1){
       
       Update("update users set pass_user  = '$pass' where id_user = $idUser");
        
       print("{\"mess\":\"Письмо отослано\"}");
     }
     exit();  
   }else{
     print("{\"mess\":\"Error\"}");
     exit();  
   }
   exit();
}
//-------------------------------------------------

if($_req == "edit_access"){
 
  $id = $_REQUEST['hModeIdRole'];
  
  $listMode = $_REQUEST['mode'];
  
  $listModeDB = array( "read_role","create_role","edit_role","brak_role","makr_role","mark2_role","close_role","comment_role");
  
  if( count($listMode)  == 0) {
      
    for($i = 0; $i < count($listModeDB); $i++)
      Update("update role set {$listModeDB[$i]}=0 where id_role = $id");
      print("{\"mess\":\"сохранено\"}");
      exit();
  }
  
  for($i = 0; $i < count($listModeDB); $i++){
    
    if( in_array( $listModeDB[$i], $listMode) ){
        
        Update("update role set {$listModeDB[$i]}=1 where id_role = $id");
    }else{
        Update("update role set {$listModeDB[$i]}=0 where id_role = $id");
    }
  }
  print("{\"mess\":\"сохранено\"}");
  exit();
}
////////////////////////////////////////////////////

if( $_req == "save_user_position" ){
    
    $userID = $_REQUEST['userID'];
    
    if( $userID == "" || $userID == 0 ){
        
       print("{\"mess\":\"нет ID пользователя\"}");
       exit(); 
    }
    
    
    $listUserPosition = $_REQUEST['cUserPos'];
    
    Delete("delete from users_position where id_user_up = $userID");
    
    if( count( $listUserPosition ) > 0){
        
        foreach( $listUserPosition as $key => $val ){
            
           DatabaseConnection::get()-> Insert( "users_position", "id_user_up,id_position_up", "$userID, $val" );
        }
    }
    
    print("{\"mess\":\"сохранено\"}");
    exit();
}


if( $_req == "save_user_office" ){
    
    $userID = $_REQUEST['userID'];
    
    if( $userID == "" || $userID == 0 ){
        
       print("{\"mess\":\"нет ID пользователя\"}");
       exit(); 
    }
    
    
    $listUserPosition = $_REQUEST['cUserOffice'];
    
    Delete("delete from users_office where id_user_uo = $userID");
    
    if( count( $listUserPosition ) > 0){
        
        foreach( $listUserPosition as $key => $val ){
            
           DatabaseConnection::get()-> Insert( "users_office", "id_user_uo, id_office_uo", "$userID, $val" );
        }
    }
    
    print("{\"mess\":\"сохранено\"}");
    exit();
}

if( $_req == "save_user_role" ){
    
    $userID = $_REQUEST['userID'];
    
    if( $userID == "" || $userID == 0 ){
        
       print("{\"mess\":\"нет ID пользователя\"}");
       exit(); 
    }
    
    $listUserRole = $_REQUEST['cUserRole'];
    
    Delete("delete from users_role where id_user_ur = $userID");
    
    if( count( $listUserRole ) > 0){
        
        foreach( $listUserRole as $key => $val ){
            
           DatabaseConnection::get()-> Insert( "users_role", "id_user_ur, id_role_ur", "$userID, $val" );
        }
    }
    
    print("{\"mess\":\"сохранено\"}");
    exit();
}


if( $_req == "load_my_req" ){
 
 /*
    id_request, id_user_request, id_office_request, provider_request, contract_request, destination_request, amount_request, price_request, sum_request, type_cost_request, code_budget_request, specialist1_request, specialist2_request, specialist3_request, findir_request, ts
     {key:"id"},
	          {key:"office"},
	          {key:"provider"},
                  {key:"contract"},
                  {key:"delivery"},
                  {key:"amount"},
                  {key:"price"},
                  {key:"sum"},
                  {key:"price"},
                  {key:"typeCost"},
                  {key:"codeBudget"},
                  {key:"spec1"},
                  {key:"spec2"},
                  {key:"spec3"},
                  {key:"findir"},
                  {key:"date"},
                  {key:"del"}
 */
    
 
 
   $r = Select("r.id_request,
                r.id_user_request,
                r.id_office_request,
                r.provider_request,
                r.contract_request,
                r.destination_request,
                r.amount_request,
                r.price_request,
                r.sum_request,
                r.type_cost_request,
                r.code_budget_request,
                r.specialist1_request,
                r.specialist2_request,
                r.specialist3_request,
                r.mark_cpec1,
                r.mark_cpec2,
                r.mark_cpec3,
                r.findir_request, r.mark_findir,r.pay_request, r.ts", "request r", "ORDER BY r.ts DESC");
 
 for($i = 0; $i < count($r); $i++){
    
    $ts = date("d-m-Y H:i", $r[$i]['ts']);
    
    $spec1 = Select("surName_user,name_user,otch_user,mail_user,phone_user","users","where id_user = {$r[$i]['specialist1_request']}");
    $spec2 = Select("surName_user,name_user,otch_user,mail_user,phone_user","users","where id_user = {$r[$i]['specialist2_request']}");
    $spec3 = Select("surName_user,name_user,otch_user,mail_user,phone_user","users","where id_user = {$r[$i]['specialist3_request']}");
    $finDir = Select("surName_user,name_user,otch_user,mail_user,phone_user","users","where id_user = {$r[$i]['findir_request']}");
    $creator = Select("surName_user,name_user,otch_user,mail_user,phone_user","users","where id_user = {$r[$i]['id_user_request']}");
    
    
    $office = Select("name_office,id_office","office","where id_office = {$r[$i]['id_office_request']}");
    
    if( $r[$i]['type_cost_request'] == 1 ) $typeCost = "инвест.";
     else if($r[$i]['type_cost_request'] == 2) $typeCost = "операц.";
      else $typeCost = "нет.";
    
     if( $r[$i]['mark_findir'] == 0){
    
      $actionFinDir = "<br><font color=#FF0000><b>в работе</b></font>";
      
    }else if( $r[$i]['mark_findir'] == 1 ){
      $actionFinDir = "<br><font color=#228B22><b>Подписано</b></font>";
    }else if( $r[$i]['mark_findir'] == 2 ){
      $actionFinDir = "<br><font color=#FF0000><b>Забраковано</b></font>";
    }
    
    $temp = array('id'=> $r[$i]['id_request'],
                  'office'=> $office[0]['name_office'], 
                  'creator'=> $creator[0]['surName_user'], 
                  'provider'=> $r[$i]['provider_request'],
                  'contract'=> $r[$i]['contract_request'],
                  'destination'=> $r[$i]['destination_request'],
                  'amount'=> $r[$i]['amount_request'],
                  'price'=> $r[$i]['price_request'],
                  'sum'=> $r[$i]['sum_request'],
                  'price'=> $r[$i]['id_request'],
                  'typeCost'=> $typeCost,
                  'codeBudget'=> $r[$i]['code_budget_request'],
                  'spec1'=> $spec1[0]['surName_user']."<br>".(($r[$i]['mark_cpec1'] == 1)?"<font color=#228B22>Подписано</font>":"<font color=#FF0000>в работе</font>"),
                  'spec2'=> $spec2[0]['surName_user']."<br>".(($r[$i]['mark_cpec2'] == 1)?"<font color=#228B22>Подписано</font>":"<font color=#FF0000>в работе</font>"),
                  'spec3'=> $spec3[0]['surName_user']."<br>".(($r[$i]['mark_cpec3'] == 1)?"<font color=#228B22>Подписано</font>":"<font color=#FF0000>в работе</font>"),
                  'findir'=> $finDir[0]['surName_user'].$actionFinDir,
                  'close'=>"",
                  'date'=> $ts
                  );
    $arr[] = $temp;
 }
}

return $arr;
}

?>
