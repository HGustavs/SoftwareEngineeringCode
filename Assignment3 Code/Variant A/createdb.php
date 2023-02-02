<?php

$log_db = new PDO('sqlite:./tracking.db');

// Create tables customer and shipment

$sql = "CREATE TABLE IF NOT EXISTS customer(id INTEGER PRIMARY KEY, email TEXT, name VARCHAR(64), address VARCHAR(64),postcode VARCHAR(32), passw VARCHAR(16));";
$log_db->exec($sql);

$sql = "CREATE TABLE IF NOT EXISTS shipment(id INTEGER PRIMARY KEY, custid INTEGER, trackno VARCHAR(16), description VARCHAR(18), cost INTEGER, contents TEXT, delivered INTEGER);";
$log_db->exec($sql);

$sql = "INSERT INTO customer(id,email,name,address,postcode,passw) VALUES('1','elise@hotmail.com','Elise Van Sant','177 91 Cypress Drive','Hialeah FL 33002-1144','hello');";
$log_db->exec($sql);

$sql = "INSERT INTO customer(id,email,name,address,postcode,passw) VALUES('2','kevin@hotmail.com','Kevin Saunders','371 7th Ave','New York, NY 10001','yello');";
$log_db->exec($sql);

$sql = "INSERT INTO customer(id,email,name,address,postcode,passw) VALUES('3','mk123@hotmail.com','Mike Kimmel','60 Washington Square S','New York, NY 10012','bello');";
$log_db->exec($sql);

// Elise ordered two shipments, one was delivered and the other is not yet delivered
$sql = "INSERT INTO shipment(id,custid,trackno,description,cost,contents,delivered) VALUES('1','1','156677889','Boat Anchor','445','1 Anchor\n1Chain\n1 Hook','0');";
$log_db->exec($sql);
$sql = "INSERT INTO shipment(id,custid,trackno,description,cost,contents,delivered) VALUES('2','1','145566778','Skippers Hat','67','1 Hat','1');";
$log_db->exec($sql);

// Kevin has not made any orders yet

// Mike ordered one shipment that was returned 
$sql = "INSERT INTO shipment(id,custid,trackno,description,cost,contents,delivered) VALUES('3','3','171133662','Ivermectin Bottle','112','1 Bottle\n1 Instruction','2');";
$log_db->exec($sql);


?>