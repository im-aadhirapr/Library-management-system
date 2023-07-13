<?php include("data_class.php");

$BookId = $_POST['BookId'];
$UserName = $_POST['UserName'];

$obj = new data();
$obj->setconnection();
$obj->bookreturn($BookId, $UserName);
?>
