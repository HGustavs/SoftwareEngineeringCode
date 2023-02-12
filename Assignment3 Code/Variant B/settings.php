<!DOCTYPE html>
<html>
<head>
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

<?php
  session_start();
  if(isset($_POST['year'])){
      $_SESSION['chart']=$_POST['chart'];
      $_SESSION['year']=$_POST['year'];
      $_SESSION['month']=$_POST['month'];
  }
?>

<div class="dropdown">
    <img src="Icon.svg" style="width:52px;">
    <a href="settings.php"><button class="dropbtn">Settings</button></a>
    <button class="dropbtn">Period</button>
    <div class="dropdown-content">
      <a href="consumption.php?<?php echo "year=".$_SESSION['year']."&month=".$_SESSION['month']; ?>">Daily</a>
      <a href="consumption.php?monthly=true<?php echo "&year=".$_SESSION['year']; ?>">Monthly</a>
    </div>
    <a href="login.php"><button class="dropbtn">Login</button></a>
    <a href="logout.php"><button class="dropbtn">Logout</button></a>        
</div> 

  <form method="POST" action="settings.php" >
      <div>Bar Chart: <input type="radio" name="chart" value="bar"></div>
      <div>Line Chart: <input type="radio" name="chart" checked value="line"></div>
      <div>Month: <select name='month'><option value='1'>Januari</option><option value='2'>Februari</option><option value='3'>Mars</option><option value='4'>April</option><option value='5'>Maj</option><option value='6'>Juni</option><option value='7'>Juli</option><option value='8'>Augusi</option><option value='9'>September</option><option value='10'>Oktober</option><option value='11'>November</option><option value='12'>December</option></select></div>
      <div>Year: <select name='year'><option>2021</option><option>2022</option><option>2023</option></select>
      <div><input type="submit" value="Save"></div>
  </form>

</div>

</body>
</html>


