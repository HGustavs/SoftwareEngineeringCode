<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sharp Dressed Label Printer</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Libre Barcode 39' rel='stylesheet'>
</head>
<style>

    li {list-style: none}

</style>
<body>

<div class="container-fluid mt-3">
  <h3>Shipments</h3>
  <p>Show Shipments</p>

  <div class="shipments">

  <form method="POST" action="login.php" >
      <div>Login: <input type="text" name="email" placeholder="email"></div>
      <div>Password: <input type="password" name="passw" placeholder="passw"></div>
      <div><input type="submit" value="submit"></div>
  </form>
  <form method="POST" action="login.php" >
      <div><input type="submit" value="logout"></div>
  </form>
<?php

  session_start();

  if(isset($_POST['email'])){
    	$log_db = new PDO('sqlite:./electric.db');
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
      unset($_SESSION['email']);
  }

?>

</div>

</body>
</html>


