<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Отправка картинки';
$this->params['breadcrumbs'][] = $this->title;
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        Это страница для выгрузки картинки.
    </p>
	<br>
    <button class="myButton" onclick="addField()">Добавить еще 1 файл</button><p></p>
	<form action="file-upload.php" method="post" enctype="multipart/form-data">
		<label>Имя</label>
		<input name="username" type="text" onblur="checkUsername(this.value)" onkeypress="clearError('nameerror')" oninput="clearError('nameerror')" /><br>
		<label id="nameerror"></label><br>
		<label>Электронная почта</label>
		<input name="email" type="text" onblur="validateEmail(this.value)" onkeypress="clearError('emailerror')"/><br>
		
		<label id="emailerror"></label><br>
		Выберите файл:<br />
		<div id="multifile">
		<!--onsubmit, oninput[html5], onchange -->
		<input name="userfile[]" type="file" /><br />
		<input name="userfile[]" type="file" /><br />
		</div>
		<div id="multifileend">
		</div>
		<input type="submit" value="Send files" />
	</form>
	<br>

<script>

function clearError(str) {
	//console.log(str);
	document.getElementById(str).innerHTML="";
    return;
 }
function checkUsername(str) {
	//console.log(str);
	if (str.length==0) {
		document.getElementById('nameerror').innerHTML="заполните имя";
    return;
  }
}
function validateEmail(str) {

  if (str.length==0) {
	document.getElementById('emailerror').innerHTML="заполните e-mail";
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
	  result = this.responseText;
      console.log(result);
      if (result!==str) {
		console.log("smth went wrong");  
		document.getElementById('emailerror').innerHTML=result;
	    //return;
	  } else {
	    document.getElementById('emailerror').innerHTML="";
	  }
    }
  }
  //xmlhttp.open("GET","validateemail.php?email="+str,true);
  console.log(str);
  var params = "email="+str;
  xmlhttp.open("POST","validateemail.php",true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send(params);
}
</script>

  <script>
function addField() {
    var node = document.createElement("input");
    node.name = "userfile[]";
    node.type = "file";
    //var t = document.createTextNode("Click me");
    //node.appendChild(t);
    document.getElementById("multifile").appendChild(node);
}
</script>
    <code><?= __FILE__ ?></code>
</div>
