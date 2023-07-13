<?php include("mylibrary_db.php");

class data extends db
{

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

        $IssuedOn = date('Y-m-d');
        $DueOn = date('Y-m-d', strtotime('+7 days'));

        $sql1 = "SELECT * FROM books WHERE BookId = '$BookId'";
        $data = $this->connection->query($sql1);

        $sql2 = "SELECT * FROM issue WHERE BookId = '$BookId' AND ReturnedOn IS NULL";
        $statement = $this->connection->query($sql2);

        $number = 0;
        while ($row = $statement->fetch()) {
            $number++;
        }

        

        $count = 0;
        while ($row = $data->fetch()) {
            $count++;
        }

        if ($count== 0){
            echo 'Wrong BookId';
        } else if ($number > 0) {
            echo 'Book taken';
        } else {
              $sql = "INSERT INTO issue (BookId, Username, IssuedOn, DueOn) VALUES ('$BookId', '$UserName', '$IssuedOn', '$DueOn')";

            if ($this->connection->exec($sql)) {
                echo "Book issued successfully.";
            } else {
                echo "Error issuing book.";
            }
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
    
        $sql = "UPDATE issue SET ReturnedOn = now() WHERE BookId = '$BookId' AND UserName = '$UserName'";

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
