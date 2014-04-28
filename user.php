<?php
require_once 'require.php';
$f = new Feature();
$features = $f->all();
$user = $_POST["email"];
$feature_votes = array();

if (array_key_exists("feature", $_POST) && trim($user)!="" ) {
  $feature_votes =$_POST['feature'];
  $user = $_POST["email"];
  foreach ($feature_votes as $key => $value) {
    $vote = new Vote(array("user" => $_POST['email'] ,
                           "feature" => $key,
                           "vote_score" => $value));
    $vote->save();
  }
}

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
  .wrong {border-color: red; border-radius: 5px;}
  .wrongmsg {color: red;}
  .correctmsg {color: green;}
  input { border-radius: 5px; border-width: 2px; border-color: black;}
}
</style>
</head>
<body>
<span>You have <span id="left"></span> stars left !</span>
<form action="user.php" method="POST">
<label for="email"> Your Email : </label><input id ="email" type="text" name="email" value="<?php if($user) print($user); ?>">
<span id="errorMSG"></span>
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
<input id="submit" type="submit" value="Save">
</form>
</body>
<script type="text/javascript">
$("input#email").change(function(){
  email = $(this).val();
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  console.log(re.test(email));
  if(re.test(email) === false){
    $(this).attr("class" , "wrong");
    $("#errorMSG").text("Wrong or missing email !")
    $("#errorMSG").attr("class","wrongmsg");
    $("#submit").attr("disabled", "disabled");
  }
  else {
    $("#errorMSG").text("OK !");
    $("#errorMSG").attr("class","correctmsg");
    $("#submit").removeAttr("disabled");
  }

});
<?php
  printf("var Max=%d;",sizeof($features)*3 - array_sum($feature_votes));
  ?>
  $("#left").text(Max);
  var stats = {}
  <?php
 $js = '$("#star%d").raty({
    scoreName: "feature[%d]" ,
    numberMax: 2,
    start: %d,
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
  if(array_key_exists($value->id,$feature_votes))
    $vote = $feature_votes[$value->id];
  else
    $vote = 0;
  printf($js,$value->id,$value->id,$vote,$value->id);
  printf('stats[%d]=%d ;',$value->id ,$vote );
}

?>
</script>
</html>