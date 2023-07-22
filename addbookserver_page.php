<?php
include("data_class.php");

$BookName=$_POST['BookName'];
$AvailableCopies=$_POST['AvailableCopies'];

$obj=new data();
$obj->setconnection();
$obj->addbook($BookName, $AvailableCopies);
?>