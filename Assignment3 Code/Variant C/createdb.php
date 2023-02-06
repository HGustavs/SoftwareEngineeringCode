<?php

$log_db = new PDO('sqlite:./dealer.db');

$sql = "CREATE TABLE IF NOT EXISTS customer(id INTEGER PRIMARY KEY, email TEXT, name VARCHAR(64), address VARCHAR(64),postcode VARCHAR(32), passw VARCHAR(16));";
$log_db->exec($sql);

$sql = "INSERT INTO customer(id,email,name,address,postcode,passw) VALUES('1','elise@hotmail.com','Elise Van Sant','177 91 Cypress Drive','Hialeah FL 33002-1144','hello');";
$log_db->exec($sql);

$sql = "INSERT INTO customer(id,email,name,address,postcode,passw) VALUES('2','kevin@hotmail.com','Kevin Saunders','371 7th Ave','New York, NY 10001','yello');";
$log_db->exec($sql);

$sql = "INSERT INTO customer(id,email,name,address,postcode,passw) VALUES('3','mk123@hotmail.com','Mike Kimmel','60 Washington Square S','New York, NY 10012','bello');";
$log_db->exec($sql);

// Create tables customers and dealerships

$sql = "CREATE TABLE IF NOT EXISTS dealership(id INTEGER PRIMARY KEY, name VARCHAR(64), place VARCHAR(64),country VARCHAR(64), brand VARCHAR(64), category VARCHAR(64), longitude real, latitude real);";
$log_db->exec($sql);

$sql = "INSERT INTO dealership(id,name,place,country,brand,longitude,latitude) VALUES(1,'Frankfurt Mittwoch PKW','Frankfurt','Germany','MW',50.110556, 8.682222);";
$log_db->exec($sql);
$sql = "INSERT INTO dealership(id,name,place,country,brand,longitude,latitude) VALUES(2,'Mannheim Mittwoch PKW','Mannheim','Germany','MW',49.487778, 8.466111);";
$log_db->exec($sql);
$sql = "INSERT INTO dealership(id,name,place,country,brand,longitude,latitude) VALUES(3,'Elverum PKW Mittwoch','Elverum','Norway','MW',60.881389, 11.563889);";
$log_db->exec($sql);
$sql = "INSERT INTO dealership(id,name,place,country,brand,longitude,latitude) VALUES(4,'Pervasive Motorcraft Varnamo','Varnamo','Sweden','Pervive',57.181667, 14.058611);";
$log_db->exec($sql);
$sql = "INSERT INTO dealership(id,name,place,country,brand,longitude,latitude) VALUES(5,'Pervasive Motorcraft Gdansk','Gdansk','Poland','Pervive',54.381667, 18.6375);";
$log_db->exec($sql);

$sql = "CREATE TABLE IF NOT EXISTS newsitem(id INTEGER PRIMARY KEY, current TIMESTAMP,contents TEXT);";
$log_db->exec($sql);

$sql = "INSERT INTO newsitem(current,contents) VALUES(DATE(),'Latest News New model Released by MW');";
$log_db->exec($sql);

$sql = "INSERT INTO newsitem(current,contents) VALUES(DATE(),'Other News New model Released by MW');";
$log_db->exec($sql);

?>