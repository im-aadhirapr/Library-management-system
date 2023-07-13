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
        $DueOn = date('Y-m-d', strtotime('+7 days'));

        $sql = "INSERT INTO issue (BookId, BookName, Username, IssuedOn, DueOn) VALUES ('$BookId', '$BookName', '$UserName', '$IssuedOn', '$DueOn')";

        if ($this->connection->exec($sql)) {
        echo "Book issued successfully.";
        } else {
        echo "Error issuing book.";
        }
    }

    function getbook() {
        $sql="SELECT * FROM books ";
        $data=$this->connection->query($sql);
        return $data;
    }


    function bookreturn ($BookId, $UserName ) {
        $this->$BookId=$BookId;
        $this->UserName=$UserName;

        $sql = "UPDATE issue SET returnedOn = now() WHERE BookId = '$BookId' AND UserName = '$UserName'";

        if ($this->connection->exec($sql)) {
        echo "Book returned successfully.";
        } else {
        echo "Error returning book.";
        }
    }
    
}
// If the button is clicked, call the issueBook() function
//if (isset($_POST['bookissue'])) {
 //   bookissue();
//}

// If the button is clicked, call the returnBook() function
//if (isset($_POST['returnBook'])) {
//    returnBook();
//}

// Close the database connection
//mysqli_close($conn);
