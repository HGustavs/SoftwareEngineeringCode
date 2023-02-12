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

    .item1 { grid-area: pbox; font-family:Verdana; font-size:40px;width:100px;}
    .item2 { grid-area: stamp; font-family:Verdana; font-size:12px; }    
    .item3 { grid-area: main;}
    .item6 { grid-area: footer; font-family:Verdana; font-size:32px;height:84px;}
    .item7 { grid-area: label;}
    .item8 { grid-area: tracking;}
    .item9 { grid-area: empty;}   

    .label {margin-left:20px;text-align:left; font-size: 14px; line-height: 15px; font-weight:bold}

    .grid-container {
      width:800px;
      display: grid;
      grid-template-areas:
        'pbox main main stamp'
        'footer footer footer footer'
        'label label label label'
        'tracking tracking tracking tracking'
        'empty empty empty empty'
        ;
      grid-template-columns: 100px 1fr 1fr 100px;
      gap: 1px;
      background-color: #000;
      padding: 2px;
      font-size:15px;
      box-shadow:2px 2px 5px RGBA(0,0,0,0.3);
    }

    .grid-container > div {
      background-color: rgba(255, 255, 255, 1.0);
      text-align: center;
      padding: 20px 0;
      font-family:Arial Narrow;
      height:125px;
    }

    .stamp {
        width:80px;
        height:80px;
        margin:8px;
        padding:8px;
        text-align: center;
        border:1px solid black;
        margin: auto;
    }
</style>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="Icon.svg" style="width:30px;"></a>
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
  <h3>Return Label</h3>
  <p>Print Labdel and affix securely to package</p>

  <div class="grid-container">
      <div class="item1"><div class="stamp">P</div></div>
      <div class="item2">
        <div class="stamp">NO POSTAGE NEEDED</div>
      </div>
      <div class="item3"><div class="label"><p>POSTAGE AND FEES PAID</p><p>2LB PRIORITY MAIL RATE</p><p>ZONE 1 NO ADDITIONAL SURCHARGE</p></div></div>
      <div class="item6" style="height:84px;">PRIORITY MAIL 1-DAY&#174;</div>
      <div class="item7" style="height:auto;padding-right:20px;">
          <div class="label">
          <p>Shipped To:</p>
          <ul>
            <li>Sharp Dressed Dork Inc</li>
            <li>154 21 Half Moose Lane</li>
            <li>Elk Grove MI 10001-6100</li>
          </ul>
          <hr>
          <p>Shipped From:</p>
          <ul>

<?php
  $trackno=$_GET['trackno'];

	$log_db = new PDO('sqlite:./tracking.db');
	$str="SELECT * FROM shipment,customer WHERE customer.id=shipment.custid AND trackno=:trackno;";
	$query = $log_db->prepare($str);
  $query->bindParam(':trackno', $trackno);
  $query->execute();
	$rows = $query->fetchAll(PDO::FETCH_ASSOC);
  
  echo "      <li>".$rows[0]['name']."</li>";
  echo "      <li>".$rows[0]['address']."</li>";
  echo "      <li>".$rows[0]['postcode']."</li>";
  echo "    </ul>";
  echo "  </div>";          
  echo "</div>";

  echo "<div class='item8' style='height:auto;margin-top:4px;margin-bottom:4px;'>";
  echo "  <div style='font-family:courier;font-size:22px;'>CSNY TRACKING #</div>";
  echo "  <div style='font-family:\"Libre Barcode 39\";font-size: 46px;'>".$rows[0]['trackno']."</div>";        
?>

  </div>  
  <div class="item9" style="height:100px;">
  </div>

</div>

</body>
</html>


