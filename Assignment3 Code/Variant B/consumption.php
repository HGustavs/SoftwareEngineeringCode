<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<style>

/* Style The Dropdown Button */
.dropbtn {
  font-family:arial narrow;
  margin-top:4px;
  background-color: #AF4C50;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position:absolute;
  left:0px;
  right:0px;
  top:0px;
  height:60px;
  background:#035;
  display: inline-block;
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
  left:80px;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
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
    <span style="color:white;margin:8px;" class="logotyp">Elsidan</span>
    <button class="dropbtn">Settings</button>
    <button class="dropbtn">Period</button>
    <div class="dropdown-content">
      <a href="#">Daily</a>
      <a href="#">Monthly</a>
    </div>
  </div> 

<h1>Electricity Usage</h1>

<p>Daily Electricity Usage Diagram:</p>

<div class="grid-container">
  <div class="item4">
  <?php  
      $months=["Januari","Februari","Mars","April","Maj","Juni","Juli","Augusti","September","Oktober","November","December"];

      echo "<a href='consumption.php?year=".$_GET['year']."&month=".($_GET['month']-1)."'>";
      echo "&#5130;";
      echo $months[($_GET['month']-2)%12];
      echo "</a>";
  ?>
  </div>
  <div class="item3" id="myChart" style="width:100%; height:500px;"></div>
  <div class="item5">
  <?php  
      echo "<a href='consumption.php?year=".$_GET['year']."&month=".($_GET['month']+1)."'>";
      echo $months[($_GET['month'])%12];
      echo "</a>";  ?>
  &#5125;
  </div>
  <div class="item6">Footer</div>
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

              echo ",[".$row['cmonth'].",".($priceavg*100).",".$consumptiontotal."]";
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
      $months=["Januari","Februari","Mars","April","Maj","Juni","Juli","Augusti","September","Oktober","November","December"];
      echo $months[$_GET['month']-1]." ".$_GET['year'];     
  ?>',
  hAxis: {title: 'Date'},
  vAxis: {title: 'kWh'},
  legend: 'kWh'
};
// Draw
var chart = new google.visualization.LineChart(document.getElementById('myChart'));
chart.draw(data, options);
}
</script>

</body>
</html>