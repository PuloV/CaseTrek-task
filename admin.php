<?php
require_once 'require.php';
//var_dump($_POST);
if (array_key_exists("feature", $_POST)) {
  $features =$_POST['feature'];
  foreach ($features as $key => $value) {
    $f = new Feature(array("id" => $key+1,"name" => $value));
    $f->update();
  }
 //die();
}

$f = new Feature();
$features = $f->all();
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>jQuery UI Sortable - Default functionality</title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<style>
#sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
#sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
#sortable li span { position: absolute; margin-left: -1.3em; }
</style>
<script>
$(function() {
	var start;
	var end;
$( "#sortable" ).sortable({
start: function( event, ui ) {
	start = ui.item.index();
} ,
update: function( event, ui ) {
	end =ui.item.index();

} ,
stop: function( event, ui ) {
	$("#"+ (start +1) + " input").attr("name","feature[" + end + "]");
	if(start < end) {
		for (var i = end ; i > start; i--) {
			$("#"+ (i +1) + " input").attr("name","feature[" +( i-1 )+ "]");
		};}
	else{
		for (var i = start-1 ; i >= end; i--) {
			$("#"+ (i +1) + " input").attr("name","feature[" + (i+1) + "]");
		}
	}


	alert("start : "+ start + " & end :" + end);
	//console.log($("#6 input").attr("value"));
},
});
$( "#sortable" ).disableSelection();
//console.log($("#sortable").sortable('toArray'));
});
</script>
</head>
<body>
<form action="admin.php" method="POST">
<ul id="sortable">
<?
$li ='<li class="ui-state-default" id = "%d">
        <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
        <b>%d</b><input id = "feature[%d]" name= "feature[%d]" type="text" value="%s">
      </li>';
foreach ($features as $key => $value) {
  printf($li,$value->id,$value->id,$value->id,$value->id,$value->name);
}
?>
</ul>
<input type="submit" value="Save">
<input type="button" value="Add feature" onclick="add_feature();">
</form>
</body>
</html>