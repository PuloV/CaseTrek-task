<?php
require_once 'require.php';

$f = new Feature();
$features = $f->all();
if (array_key_exists("feature", $_POST)) {
  $shuffle_feature =$_POST['feature'];
  foreach ($shuffle_feature as $key => $value) {
    $poped_feature = array_shift($features);
    if($poped_feature){
      $poped_feature->name = $value;
      $poped_feature->save();
    }
    else {
      $new_feature = new Feature(array("id" => 0 , "name" => $value));
      $new_feature->save();
    }
  }
  foreach ($features as $key => $value) {
    $value->delete();
  }
}

$f = new Feature();
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
</style>
<script>
$(function() {
	var start;
	var end;
$( "#sortable" ).sortable();

});
function add_feature(){
  new_li = "<li class='ui-state-default' id = '%d'>"
  new_li += "<span class='ui-icon ui-icon-arrowthick-2-n-s'></span>"
  new_li +="<input id = 'feature[0]' name= 'feature[0]' type='text' value=''></li>"
  $("#sortable").append(new_li)
};
function remove_feature(id){
  $("li#"+id).remove();
}
</script>
</head>
<body>
<form action="admin.php" method="POST">
<ul id="sortable">
<?php
$li ='<li class="ui-state-default" id = "%d">
        <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
        <input id = "feature[%d]" name= "feature[%d]" type="text" value="%s">
        <div class="ui-icon ui-icon-closethick" onclick="remove_feature(%d)"></div>
      </li>';
foreach ($features as $key => $value) {
  printf($li,$key,$value->id,$value->id,$value->name,$key);
}
?>
</ul>
<input type="submit" value="Save">
<input type="button" value="Add feature" onclick="add_feature()">
</form>
</body>
</html>