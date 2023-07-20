<?php include("db_connector.php");
    class db_manager extends db_connector
    {
        function __construct()
        {
            echo "</br></br>";
        }

        function add_book($book_name)
        {
            $created_on = date('Y-m-d');

            $sql = "INSERT INTO books
            (
                BookId
                , BookName
                , CreatedOn
            )
            VALUES
            (
                ''
                , '$book_name'
                , '$created_on'
            )";

            if ($this->connection->exec($sql)) {
                echo 'Added book successfully';
            } else {
                echo 'Failed to add book';
            }
        }

        function book_issue($book_id, $username)
        {
            $issued_on = date('Y-m-d');
            $due_on = date('Y-m-d', strtotime('+7 days'));

            $book_by_id_query = "SELECT * FROM books WHERE BookId = '$book_id'";
            $book_by_id = $this->connection->query($book_by_id_query);

            $book_already_issued_query = "SELECT *
            FROM issue
            WHERE BookId = '$book_id'
                AND ReturnedOn IS NULL";

            $book_already_issued = $this->connection->query($book_already_issued_query);

            $book_already_issued_count = 0;
            while ($book_already_issued->fetch()) {
                $book_already_issued_count++;
            }

            if ($book_already_issued_count > 0) {
                echo 'Book Already Issued!';
                return;
            }

            $book_by_id_count = 0;
            while ($book_by_id->fetch()) {
                $book_by_id_count++;
            }

            if ($book_by_id_count == 0) {
                echo 'Wrong BookId!';
                return;
            }

            $insert_book_command = "INSERT INTO issue
            (
                BookId
                , Username
                , IssuedOn
                , DueOn
            )
            VALUES
            (
                '$book_id'
                , '$username'
                , '$issued_on'
                , '$due_on'
            )";

            if ($this->connection->exec($insert_book_command)) {
                echo "Book issued successfully.";
            } else {
                echo "Error issuing book!";
            }
        }

        function get_all_books()
        {
            $get_all_books_query = "SELECT * FROM books";
            $all_books = $this->connection->query($get_all_books_query);
            return $all_books;
        }

        function set_return_book($book_id)
        {
            $set_return_book_query = "UPDATE issue
            SET ReturnedOn = now()
            WHERE BookId = '$book_id'";

            if ($this->connection->exec($set_return_book_query)) {
                echo "Book returned successfully.";
            } else {
                echo "Error returning book!";
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
            THEN DATEDIFF(CURRENT_DATE(), iss.DueOn)
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
            THEN DATEDIFF(CURRENT_DATE(), iss.DueOn)
            ELSE 0
            END) FinePaid
            FROM issue iss inner join books b on iss.BookId=b.BookId";
            $data = $this->connection->query($sql);
            return $data->fetchAll();
        }
    }
?>
