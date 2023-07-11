<?php include("mylibrary_db.php");

class data extends db {

    private $BookId;
    private $BookName;
    private $CreatedOn;

    function __construct() {
        echo "</br></br>";
    }


    function addbook($BookId, $BookName, $CreatedOn) {
        $this->$BookId=$BookId;
        $this->BookName=$BookName;
        $this->CreatedOn=$CreatedOn;

       $sql="INSERT INTO books (BookId, BookName, CreatedOn)VALUES('','$BookName', '$CreatedOn')";

        if($this->connection->exec($sql)) {
            header("Location:home.php?msg=done");
        }
        else {
            header("Location:home.php?msg=fail");
        }
    }

    function getbook() {
        $sql="SELECT * FROM books ";
        $data=$this->connection->query($sql);
        return $data;
    }
}