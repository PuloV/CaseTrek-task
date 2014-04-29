<?php
session_start();
require_once 'require.php';
require_once 'log.php';

$f = new Feature();

/* Да пробвам да изтривам всички записи и да вкарвам тези от гет-а вместо тях */
if (array_key_exists("feature", $_POST)) {
  $f->delete_all();
  $shuffle_feature =$_POST['feature'];
  foreach ($shuffle_feature as $key => $value) {
    $new_feature = new Feature(array("id" => $value['id'] , "name" => $value['value']));
    $new_feature->save();
  }

  $f->fix_ids();
}

$features = $f->all();
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Admin View</title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<style>
#sortable { list-style-type: none; margin: 0; padding: 0; width: 30%; }
#sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
#sortable li span { position: absolute; margin-left: -1.3em; }
#sortable li div { float: right }
#sortable li input {position:relative}
a {width: 30%; vertical-align: left; float: right;}
input  { border-radius: 5px; border-width: 2px; border-color: black;}
.submit { border-radius: 5px; border-width: 2px; border-color: black; width: 100px; background-color: #0011FF; color: #FFFFFF}
</style>
<script>
$(function() {
	var start;
	var end;
$( "#sortable" ).sortable();

});
var add = 0;
function add_feature(){
  add --;
  new_li = "<li class='ui-state-default' id = '"+ add + "'>"
  new_li += "<span class='ui-icon ui-icon-arrowthick-2-n-s'></span>"
  new_li +='<input id = "id" name= "feature['+ add + '][id]" type="hidden" value="'+ add + '">'
  new_li +="<input id = 'feature["+ add + "][value]' name= 'feature["+ add + "][value]' type='text' value=''>"
  new_li +='<div class="ui-icon ui-icon-closethick" onclick="remove_feature('+ add + ')"></div></li>'
  $("#sortable").append(new_li)
};
function remove_feature(id){
  $("li#"+id).remove();
}
</script>
</head>
<body>
<?php
  if(array_key_exists("logged", $_SESSION) && $_SESSION['logged']) {
?>
<a href="admin.php?log=out">Logout</a>
<form action="admin.php" method="POST">
<ul id="sortable">
<?php
$li ='<li class="ui-state-default" id = "%d">
        <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
        <input id = "id" name= "feature[%d][id]" type="hidden" value="%d">
        <input id = "feature[%d][value]" name= "feature[%d][value]" type="text" value="%s">
        <div class="ui-icon ui-icon-closethick" onclick="remove_feature(%d)"></div>
      </li>';
foreach ($features as $key => $value) {
  printf($li,$key,$value->id,$value->id,$value->id,$value->id,$value->name,$key);
}
?>
</ul>
<input class="submit" type="submit" value="Save">
<input type="button" value="Add feature" onclick="add_feature()">
</form>
<?php }
  else Admin::print_login();
?>
</body>
</html>