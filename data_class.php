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
            echo 'Added book successfully';
        } else {
            echo 'Failed to add book';
        }
    }

    function bookissue($BookId, $UserName)
    {

        $Fine = 0;
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

        if ($count == 0) {
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


    function bookreturn($BookId)
    {

        $sql = "UPDATE issue SET ReturnedOn = now() WHERE BookId = '$BookId'";

        if ($this->connection->exec($sql)) {
            echo "Book returned successfully.";
        } else {
            echo "Error returning book.";
        }
    }

    function IsRe()
    {
        $sql = "SELECT iss.BookId
        ,b.BookName
        ,iss.UserName
        ,iss.IssuedOn
        ,iss.DueOn
        ,iss.Returnedon
        , (CASE
        WHEN iss.ReturnedOn IS NULL
            AND iss.DueOn < CURRENT_DATE()
        THEN 2 * DATEDIFF(CURRENT_DATE(), iss.DueOn)
        WHEN iss.ReturnedOn IS NOT NULL
        THEN 0
        WHEN iss.ReturnedOn IS NULL
            AND iss.DueOn >= CURRENT_DATE()
        THEN 0
        ELSE 0
        END) Fine
        , (CASE 
        WHEN iss.ReturnedOn IS NOT NULL
            AND iss.DueOn < CURRENT_DATE()
        THEN 2 * DATEDIFF(CURRENT_DATE(), iss.DueOn)
        ELSE 0
        END) FinePaid
        FROM issue iss inner join books b on iss.BookId=b.BookId";
        $data = $this->connection->query($sql);
        return $data->fetchAll();
    }
}