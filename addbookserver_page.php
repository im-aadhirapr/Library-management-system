<?php
include("data_class.php");

$BookName=$_POST['BookName'];

$obj=new data();
$obj->setconnection();
$obj->addbook($BookName);
?>