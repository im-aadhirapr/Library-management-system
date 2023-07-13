<?php
include("data_class.php");

$BookId = $_POST['BookId'];
$BookName = $_POST['BookName'];
$UserName = $_POST['UserName'];

$IssuedOn = date('Y-m-d');
$DueOn = date('Y-m-d', strtotime('+7 days'));

$obj = new data();
$obj->setconnection();
$obj->bookissue($BookId, $BookName, $UserName);
?>
