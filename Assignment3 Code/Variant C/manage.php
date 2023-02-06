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

<?php

  session_start();
	$log_db = new PDO('sqlite:./dealer.db');  

  if(isset($_POST['newsItem'])){
      print_r($_POST);
      $str = "INSERT INTO newsitem(current,contents) VALUES(DATE(),:item);";
    	$query = $log_db->prepare($str);
      $query->bindParam(':item', $_POST['newsItem']);
      $query->execute();
  }

  if(isset($_SESSION['email'])){
    	$str="SELECT * FROM newsitem;";
    	$query = $log_db->prepare($str);
      $query->execute();
    	$rows = $query->fetchAll(PDO::FETCH_ASSOC);

      echo "<table>";
      echo "<tr style='color:white;background:black;'><th>Date</th><th>Contents</th></tr>";
      foreach($rows as $row){
          echo "<tr style='vertical-align:top;'>";
          echo "<td>".$row['current']."</td>";
          echo "<td>".$row['contents']."</td>";          
          echo "</tr>";
      }
      echo "</table>";

      echo "<form method='POST' action='manage.php' >";
      echo "<div style='margin-top:50px;'>Login:</div><div><textarea name='newsItem'>Enter New News Item Here</textarea></div>";
      echo "<div><input type='submit' value='Save News Item'></div>";
      echo "</form>";
  }else{
      if(isset($_POST['email'])){
        	$str="SELECT * FROM customer WHERE customer.email=:email;";
        	$query = $log_db->prepare($str);
          $query->bindParam(':email', $_POST['email']);
          $query->execute();
        	$rows = $query->fetchAll(PDO::FETCH_ASSOC);  

          foreach($rows as $row){
              $_SESSION['email']=$_POST['email'];
              $_SESSION['passw']=$_POST['passw'];
          }
      }else{
          echo "<form method='POST' action='manage.php' >";
          echo "<div>Login: <input type='text' name='email' placeholder='email'></div>";
          echo "<div>Password: <input type='password' name='passw' placeholder='passw'></div>";
          echo "<div><input type='submit' value='submit'></div>";
          echo "</form>";
      }
  }

?>

  <li class="item4" style='margin-top:50px;'>
      <a class="active" href="logout.php">Log Out</a>
   </li>

</body>

</html>