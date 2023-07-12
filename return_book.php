<?php include("data_class.php");

$BookId = $_POST['BookId'];

$sql = "UPDATE issue SET return_date = CURRENT_DATE WHERE id = '$BookId'";
$result = mysqli_query($conn, $sql);

if ($result) {
  echo "Book returned successfully.";
} else {
  echo "Error returning book.";
}

?>