<!DOCTYPE html>
<html>
<head>
  <title>Dealership Locator</title>
<style>

body{
    background:#444;
    color:#fff;
    font-family:verdana;
}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  color:#000;
  background-color: #689;
  background-color: #10CC8D;
}

li {
  float: left;
}

li a {
  display: block;
  color: #000;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover:not(.active) {
  background-color: #222;
  color:#fff;
}

.active {
  background-color: #04AA6D;
  color:#fff;
}

.item3 {
    text-decoration: underline;
}

</style>  

</head>

<body>

<ul>
  <li><img style="width:40px;margin-left:4px;margin-top:4px;" src="Icon.svg"></li>
  <li><a class="item2" href="news.php">News</a></li>
  <li><a class="item3" href="showdealership.php">Locator</a></li>
  <li class="item4" style="float:right">
      <a class="active" href="manage.php">Manage</a>
    </li>
</ul>

<h3>Dealership Network News</h3>

<?php

	$log_db = new PDO('sqlite:./dealer.db');  

	$str="SELECT * FROM newsitem;";
	$query = $log_db->prepare($str);
  $query->execute();
	$rows = $query->fetchAll(PDO::FETCH_ASSOC);

  foreach($rows as $row){
      echo "<div style='width:400px;color:black;margin:8px;padding:20px;box-shadow:2px 2px 2px RGBA(0,0,0,0.3);background:#def;'>";
      echo "<div style='font-weight:bold;'>".$row['current']."</div>";
      echo "<div>".$row['contents']."</div>";
      echo "</div>";          
  }

?>

</body>

</html>