<?php
require_once 'require.php';
$f = new Feature();
$features = $f->all();
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>User View</title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.raty.min.js"></script>
<style>
  li {width: 20% ; height: 30px;}
  div { float: right; }
}
</style>
</head>
<body>
<span>You have <span id="left"></span> stars left !</span>
<ul>
<?php
$li ='<li id = "%d">
        <div id="star%d"></div>
        <span>%s</span>
      </li>';
foreach ($features as $key => $value) {
  printf($li,$key,$value->id,$value->name);
}
?>
</ul>
</form>
</body>
<script type="text/javascript">
<?php
  printf("var Max=%d;",sizeof($features)*3);
  ?>
  $("#left").text(Max);
  var stats = {}
  <?php
 $js = '$("#star%d").raty({
    scoreName: "feature[%d]" ,
    numberMax: 2,
    onClick: function(score) {
      id = %d ;
      current_stat = stats[id] || 0;
     /* temp =parseInt(score);
      if (score < current_stat) {
         temp = parseInt(current_stat);
      }*/
      if(parseInt(Max) - parseInt(score) + parseInt(current_stat) < 0){
        alert("Wrong Vote");
        $("#star"+id).raty.click(0);

      }
      else {
        Max = parseInt(Max) - parseInt(score) + parseInt(current_stat);
        stats[id] = score;
        $("#left").text(Max);
      }

    }
});
';
foreach ($features as $key => $value) {
  printf($js,$value->id,$value->id,$value->id);
}

?>
</script>
</html>