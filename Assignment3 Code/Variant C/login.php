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

  <h3>Login Page</h3>
  
  <form method="POST" action="login.php" >
      <div>Login: <input type="text" name="email" placeholder="email"></div>
      <div>Password: <input type="text" name="passw" placeholder="passw"></div>
      <div><input type="submit" value="submit"></div>
  </form>
  <form method="POST" action="login.php" >
      <div><input type="submit" value="logout"></div>
  </form>

<?php

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
  }

?>

</div>

</body>
</html>


