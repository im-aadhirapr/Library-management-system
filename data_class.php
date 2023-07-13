<?php include("mylibrary_db.php");

class data extends db
{

    private $BookId;
    private $BookName;
    private $CreatedOn;
    private $UserName;
    private $IssuedOn;
    private $ReturnedOn;
    private $DueOn;

    function __construct()
    {
        echo "</br></br>";
    }

    function addbook($BookName)
    {

        $CreatedOn = date('Y-m-d');

        $sql = "INSERT INTO books (BookId, BookName, CreatedOn)VALUES('','$BookName', '$CreatedOn')";

        if ($this->connection->exec($sql)) {
            header("Location:home.php?msg=done");
        } else {
            header("Location:home.php?msg=fail");
        }
    }

    function bookissue($BookId, $UserName)
    {
        $this->BookId = $BookId;
        $this->UserName = $UserName;

        $IssuedOn = date('Y-m-d');
        $DueOn = date('Y-m-d', strtotime('+7 days'));

        $sql = "INSERT INTO issue (BookId, Username, IssuedOn, DueOn) VALUES ('$BookId', '$UserName', '$IssuedOn', '$DueOn')";

        if ($this->connection->exec($sql)) {
            echo "Book issued successfully.";
        } else {
            echo "Error issuing book.";
        }
    }

    function getbook()
    {
        $sql = "SELECT * FROM books ";
        $data = $this->connection->query($sql);
        return $data;
    }


    function bookreturn($BookId, $UserName)
    {
        $this->BookId = $BookId;
        $this->UserName = $UserName;

        $sql = "UPDATE issue SET returnedOn = now() WHERE BookId = '$BookId' AND UserName = '$UserName'";

        if ($this->connection->exec($sql)) {
            echo "Book returned successfully.";
        } else {
            echo "Error returning book.";
        }
    }

    function IsRe()
    {
        $sql = "SELECT iss.BookId,b.BookName,iss.UserName,iss.IssuedOn,iss.DueOn,iss.Returnedon FROM issue iss inner join books b on iss.BookId=b.BookId";
        $data = $this->connection->query($sql);
        return $data->fetchAll();
    }
}
