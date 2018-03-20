
function Result( _id, _data) {
   
  this.id = _id;
  this.data = _data;
}


function jsSaveInfo( _domen, _req,  _form , _progress  ){

 if( _progress ){
  var area = document.getElementById( _progress );
  area.innerHTML = "<img src='" + _domen + "/img/loader.gif'>"
 }
 
 YAHOO.util.Connect.setForm( _form );
 
 var cObj = YAHOO.util.Connect.asyncRequest("POST", _domen + '/json_proxy.php?req=' + _req, callback = {
		
 success: function ( oResponse ) {
 
    var answer = YAHOO.lang.JSON.parse( oResponse.responseText );
    alert( answer.mess );
    if( _progress ) area.innerHTML = "";
 },
 
 failure: function (o) {
   alert("failure!");
 }});
}

function jsGetData( _domen, _req,  _idRow ){
   
 var cObj = YAHOO.util.Connect.syncRequest("GET", _domen + '/json_proxy.php?req=' +_req +'&id=' + _idRow , callback = {
		
 success: function (oResponse) {

  var answer = YAHOO.lang.JSON.parse( oResponse.responseText );
     
   if( Number( answer.status )  == -1 ) {
      
       alert('Ошибка');
       return false;
   }
   
   if( Number( answer.status )  == -2 ) {
      
       alert('Не определено');
       return false;
   }
   
   if( Number( answer.status )  == -3 ) {
      
       alert('Нет результата');
       return false;
   }
   
   res  = new Result( answer.id, answer.data );
   
   return res;
 },
     
 failure: function (o) {
    alert("failure!");
 }});
}