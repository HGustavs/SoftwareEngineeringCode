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
            <li><a class="dropdown-item" href="rebate.php">Rebate Voucher</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid mt-3">
  <h3>Shipments</h3>
  <p>Show Shipments</p>

  <div class="rebate">

<?php

  session_start();
  $email=$_SESSION['email'];

	$log_db = new PDO('sqlite:./tracking.db');
	$str="SELECT customer.name,customer.id,count(*) as cnt FROM customer join shipment ON customer.id=shipment.custid WHERE customer.email=:email GROUP BY customer.id;";
	$query = $log_db->prepare($str);
  $query->bindParam(':email', $email);
  $query->execute();
	$rows = $query->fetchAll(PDO::FETCH_ASSOC);

  echo "Customer: ".$rows[0]['name']." Rebate Code: C".$rows[0]['id']."REB".($rows[0]['cnt']*5)."%";

?>

</div>

</body>
</html>


