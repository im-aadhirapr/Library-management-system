<?php include("mylibrary_db.php");

class data extends db {

    private $BookId;
    private $BookName;
    
    private $CreatedOn;
    private $UserName;
    private $IssuedOn;
    private $ReturnedOn;
    private $DueOn;

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

    function bookissue($BookId, $BookName, $UserName ){
        $this->$BookId=$BookId;
        $this->BookName=$BookName;
        $this->UserName=$UserName;

        $IssuedOn = date('Y-m-d');

        $sql = "INSERT INTO issue (BookId, BookName, Username, IssuedOn, DueOn) VALUES ('$BookId', '$BookName', '$UserName', '$IssuedOn', DATE_ADD('$IssuedOn', INTERVAL 7 DAY))";
        if($this->connection->exec($sql)) {
            header("Location:home.php?msg=done");
        }
        else {
            header("Location:home.php?msg=fail");
        }
        // $result = mysqli_query($conn, $sql);
        
        //if ($result) {
        //echo "Book issued successfully.";
        //} else {
        //echo "Error issuing book.";
        //}
    }

    function getbook() {
        $sql="SELECT * FROM books ";
        $data=$this->connection->query($sql);
        return $data;
    }
}