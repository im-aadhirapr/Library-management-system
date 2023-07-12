<?php
include("data_class.php");

$BookId = $_POST['BookId'];
$BookName = $_POST['BookName'];
$UserName = $_POST['UserName']

$var = new data(); 
;
$var->setconnection();
$var->bookissue($BookId, $BookName, $UserName );
?>
