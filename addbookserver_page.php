<?php
include("data_class.php");

$BookId=$_POST['BookId'];
$BookName=$_POST['BookName'];
$CreatedOn=$_POST['CreatedOn'];

$obj=new data();
$obj->setconnection();
$obj->addbook($BookId, $BookName, $CreatedOn );
?>