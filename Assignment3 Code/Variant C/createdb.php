<?php

$log_db = new PDO('sqlite:./electric.db');

// Create tables customer consumption and price

$sql = "CREATE TABLE IF NOT EXISTS customer(id INTEGER PRIMARY KEY, email TEXT, name VARCHAR(64), address VARCHAR(64),postcode VARCHAR(32), passw VARCHAR(16));";
$log_db->exec($sql);

$sql = "INSERT INTO customer(id,email,name,address,postcode,passw) VALUES('1','elise@hotmail.com','Elise Van Sant','177 91 Cypress Drive','Hialeah FL 33002-1144','hello');";
$log_db->exec($sql);

$sql = "INSERT INTO customer(id,email,name,address,postcode,passw) VALUES('2','kevin@hotmail.com','Kevin Saunders','371 7th Ave','New York, NY 10001','yello');";
$log_db->exec($sql);

$sql = "INSERT INTO customer(id,email,name,address,postcode,passw) VALUES('3','mk123@hotmail.com','Mike Kimmel','60 Washington Square S','New York, NY 10012','bello');";
$log_db->exec($sql);

// Insert into consumption

$sql = "CREATE TABLE IF NOT EXISTS consumption(id INTEGER PRIMARY KEY, custid INTEGER, cyear INTEGER, cmonth INTEGER, consumption TEXT );";
$log_db->exec($sql);

// Elise is only user to have any consumption registered
$sql = "INSERT INTO consumption(id,custid,cyear,cmonth,consumption) VALUES('3','1','2022','10','1.2,1.5,1.1,1.4,1.7,1.8,1.6,1.2,1.5,2.2,1.9,1.8,1.6,1.7,1.1,1.1,1.3,1.4,1.7,1.9,1.4,1.6,1.3,1.1,1.3,1.6,1.5,1.7,1.9,2.4');";
$log_db->exec($sql);
$sql = "INSERT INTO consumption(id,custid,cyear,cmonth,consumption) VALUES('4','1','2022','11','2.5,2.8,2.4,2.7,2.9,2.8,2.9,2.4,2.7,2.8,2.9,2.8,2.6,2.7,2.1,2.1,2.3,2.4,2.7,2.9,3.0,2.6,2.3,2.1,2.3,2.4,2.5,2.7,2.9,3.1');";
$log_db->exec($sql);
$sql = "INSERT INTO consumption(id,custid,cyear,cmonth,consumption) VALUES('5','1','2022','12','3.5,3.8,3.6,3.9,3.1,3.3,3.0,2.7,2.9,3.7,3.4,3.5,3.1,3.7,3.1,2.9,4.3,4.1,4.2,3.7,3.6,3.4,3.5,4.1,3.8,3.6,3.8,3.6,3.6,3.5');";
$log_db->exec($sql);

$sql = "CREATE TABLE IF NOT EXISTS price(id INTEGER PRIMARY KEY, cyear INTEGER, cmonth INTEGER, price TEXT );";
$log_db->exec($sql);

$sql = "INSERT INTO price(id,cyear,cmonth,price) VALUES('3','2022','10','0.94,1.21,1.21,1.23,1.27,1.30,1.34,1.32,1.37,1.25,1.32,1.33,1.33,1.38,1.48,1.36,1.40,1.34,1.42,1.68,1.53,1.44,1.20,1.15,1.17,1.07,1.09,1.05,1.12,1.15');";
$log_db->exec($sql);
$sql = "INSERT INTO price(id,cyear,cmonth,price) VALUES('4','2022','11','1.11,1.51,1.41,1.33,1.37,1.40,1.37,1.22,1.24,1.15,1.28,1.33,1.43,1.45,2.48,1.66,1.70,1.74,1.82,1.68,1.53,1.44,1.20,1.25,1.27,1.37,1.29,1.05,1.12,1.25');";
$log_db->exec($sql);
$sql = "INSERT INTO price(id,cyear,cmonth,price) VALUES('5','2022','12','1.41,1.61,1.51,1.55,1.24,1.55,1.27,1.42,1.35,1.27,1.58,1.77,1.83,1.95,2.18,2.23,1.95,1.85,1.45,1.18,1.23,1.12,0.99,0.75,1.15,0.77,0.67,1.05,1.12,1.25');";
$log_db->exec($sql);

?>