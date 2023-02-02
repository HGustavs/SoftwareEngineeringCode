<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
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

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="icon.svg" style="width:30px;"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Handle Shipments</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="login.php">Login</a></li>
            <li><a class="dropdown-item" href="shipments.php">Shipments</a></li>
            <li><a class="dropdown-item" href="#">Rebate Voucher</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid mt-3">
  <h3>Shipments</h3>
  <p>Show Shipments</p>

  <div class="shipments">

<?php

  session_start();
  $email=$_SESSION['email'];

	$log_db = new PDO('sqlite:./tracking.db');
	$str="SELECT * FROM shipment,customer WHERE customer.id=shipment.custid and customer.email=:email;";
	$query = $log_db->prepare($str);
  $query->bindParam(':email', $email);
  $query->execute();
	$rows = $query->fetchAll(PDO::FETCH_ASSOC);

  echo "Customer: <pre>".$rows[0]['name']."</pre>";

  echo "<table>";
  echo "<tr><th></th></tr>";
  foreach($rows as $row){
      echo "<tr>";
      echo "<td>".$row['trackno']."</td>";
      echo "<td>".$row['description']."</td>";
      echo "<td>".$row['cost']."</td>";
      echo "<td>".$row['contents']."</td>";
      echo "<td>".$row['delivered']."</td>";
      echo "</tr>";
  }
  echo "</table>";

?>

</div>

</body>
</html>


