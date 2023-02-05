<!DOCTYPE html> 
<html>
<head>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<title>Elsidan</title>
<style>

/* Style The Dropdown Button */
.dropbtn {
  font-family:arial narrow;
  background-color: #AF4C50;
  color: white;
  padding: 12px;
  font-size: 16px;
  border: none;
  cursor: pointer;
  height:52px;
  margin-top:4px;
  margin-left:4px;
  width:80px;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position:absolute;
  left:0px;
  right:0px;
  top:0px;
  height:60px;
  background:#035;
  display: flex;
  align-items: top;
  justify-content: left;  
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 500;
  margin:0px;
  left:140px;
  top:50px;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  text-decoration: none;
  display: block;
  margin:8px;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #fed}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
  display: block;
}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {
    background-color: #8e3e41;
}

.item3 { grid-area: main; }
.item4 { grid-area: left;}
.item5 { grid-area: right;}
.item6 { grid-area: footer; }

.grid-container {
  width:80%;
  display: grid;
  grid-template-areas:
    'left main main main right'
    'footer footer footer footer footer';
  gap: 4px;
  background-color: #AF4C50;
  padding: 10px;
}

.grid-container > div {
  background-color: rgba(255, 255, 255, 0.8);
  text-align: center;
  padding: 20px 0;
  font-size: 30px;
}

</style>
</head>
<body style="margin-top:80px;font-family:arial narrow;">

<div class="dropdown">
    <?php session_start(); ?>
    <img src="icon.svg" style="width:52px;">
    <a href="settings.php"><button class="dropbtn">Settings</button></a>
    <button class="dropbtn">Period</button>
    <div class="dropdown-content">
      <a href="consumption.php?<?php echo "year=".$_SESSION['year']."&month=".$_SESSION['month']; ?>">Daily</a>
      <a href="consumption.php?monthly=true<?php echo "&year=".$_SESSION['year']; ?>">Monthly</a>
    </div>
    <a href="login.php"><button class="dropbtn">Login</button></a>
    <a href="logout.php"><button class="dropbtn">Logout</button></a>        
</div> 

<h1>Electricity Usage</h1>

<p>Daily Electricity Usage Diagram:</p>

<div class="grid-container">
  <div class="item4">
  <?php  
      $months=["Januari","Februari","Mars","April","Maj","Juni","Juli","Augusti","September","Oktober","November","December"];

      echo "&#5130;";
      if(isset($_GET['monthly'])){
          echo "<a href='consumption.php?year=".($_GET['year']-1)."&monthly=true'>";
          echo $_GET['year']-1; 
      }else{
          echo "<a href='consumption.php?year=".$_GET['year']."&month=".($_GET['month']-1)."'>";
          echo $months[($_GET['month']-2)%12];
      }
      echo "</a>";
  ?>
  </div>
  <div class="item3" id="myChart" style="width:100%; height:500px;"></div>
  <div class="item5">
  <?php  
      if(isset($_GET['monthly'])){
          echo "<a href='consumption.php?year=".($_GET['year']+1)."&monthly=true'>";
          echo $_GET['year']+1;      
      }else{
          echo "<a href='consumption.php?year=".$_GET['year']."&month=".($_GET['month']+1)."'>";
          echo $months[($_GET['month'])%12];
      }
      echo "</a>";  ?>
  &#5125;
  </div>
  <div class="item6">
    Electricity <?php
    echo $_SESSION['chart'];
    ?>Chart
  </div>
</div>

<script>
google.charts.load('current',{packages:['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
// Set Data
var data = google.visualization.arrayToDataTable([
  ['Date','Price', 'Consumption']

  <?php
    	$log_db = new PDO('sqlite:./electric.db');
      if(isset($_GET['monthly'])){
    	    $str="SELECT * FROM consumption,price WHERE consumption.cyear=price.cyear and consumption.cmonth=price.cmonth and consumption.cyear=:year";
    	    $query = $log_db->prepare($str);
      }else{
    	    $str="SELECT * FROM consumption,price WHERE consumption.cmonth=price.cmonth and consumption.cyear=price.cyear and consumption.cyear=:year and consumption.cmonth=:month";
          $query = $log_db->prepare($str);
          $query->bindParam(':month', $_GET['month']);            
      }
      $query->bindParam(':year', $_GET['year']);  
      $query->execute();
    	$rows = $query->fetchAll(PDO::FETCH_ASSOC);  

      if(isset($_GET['monthly'])){
          $j=0;
          foreach($rows as $row){
              $consumption=explode(",",$row['consumption']);
              $price=explode(",",$row['price']);

              $consumptiontotal=0;
              foreach($consumption as $val){$consumptiontotal+=$val;};

              $priceavg=0;
              foreach($price as $val){$priceavg+=$val;}
              $priceavg=$priceavg/count($price);

              echo ",['".$months[$row['cmonth']-1]."',".($priceavg*100).",".$consumptiontotal."]";
          }      
      }else{
          foreach($rows as $row){
              $consumption=explode(",",$row['consumption']);
              $price=explode(",",$row['price']);
              for($i=0;$i<30;$i++){
                  echo ",[".($i+1).",".$price[$i].",".$consumption[$i]."]";
              }
          }
      }

  ?>
]);

// Set Options
var options = {
  title: 'Electricity Usage <?php  
      if(isset($_GET['month'])) echo $months[$_GET['month']-1]." ";
      echo $_GET['year'];     
  ?>',
  hAxis: {title: 'Date'},
  vAxis: {title: 'kWh'},
  legend: 'kWh'
};
// Draw
var chart = new google.visualization.<?php 
    if(isset($_SESSION['chart'])){
        if($_SESSION['chart']=='bar'){
            echo "Column";
        }else{
            echo "Line";
        } 
    }else{
        echo "Line";
    }
    ?>Chart(document.getElementById('myChart'));
chart.draw(data, options);
}
</script>

</body>
</html>