<?php include("data_class.php");

$BookId = $_POST['BookId'];

$obj = new data();
$obj->setconnection();
$obj->bookreturn($BookId);
?>
