<html>
<head>
    <title>Home</title>
    <link href="style.css" rel="stylesheet">
    <script>
        function openpart(portion) {
            var i;
            var x = document.getElementsByClassName("portion");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            document.getElementById(portion).style.display = "block";
        }
    </script>
</head>

<body>
    <?php
        include("./DatabaseAccess/db_manager.php");
    ?>

    <button onclick="openpart('bookreport')">ALL BOOK</button>
    <button onclick="openpart('addbook')">ADD BOOK</button>
    <button onclick="openpart('bookissue')">ISSUE BOOK</button>
    <button onclick="openpart('bookreturn')">RETURN BOOK</button>
    <button onclick="openpart('issuereturn')">ISSUE RETURN</button>

    <div id="addbook" class="portion" style="display:none">
        <h2>ADD BOOK</h2>
        <form action="./DatabaseAccess/addbookserver_page.php" method="post" enctype="multipart/form-data">
            <br>
            <table>
                <tr>
                    <th>Book Name</th>
                    <td><input type="text" name="BookName" placeholder="Book Name"></td>
                </tr>
            </table>
            <button type="submit">SUBMIT</button>
        </form>
    </div>

    <div id="bookreport" class="portion" style="display:block">
        <h2>ALL BOOK</h2>
        <?php
        $u = new data;
        $u->setconnection();
        $u->getbook();
        $recordset = $u->getbook();

        $table = "<table style='border-collapse: ;width: 100%; border: 1px solid #000;'>
            <tr><th>Book Id</th><th>Book Name</th><th>Created On</th></tr>";
        foreach ($recordset as $row) {
            $table .= "<tr>";
            $table .= "<td>$row[0]</td>";
            $table .= "<td>$row[1]</td>";
            $table .= "<td>$row[2]</td>";
            $table .= "</tr>";
        }
        $table .= "</table>";

        echo $table;
        ?>
    </div>

    <div id="bookissue" class="portion" style="display:none">
        <h2>ISSUE BOOK</h2>
        <form action="issue_book.php" method="post" enctype="multipart/form-data">
            <br>
            <table>
                <tr>
                    <th>Book Id</th>
                    <td><input type="text" name="BookId" placeholder="BookID"></td>
                </tr>
                <tr>
                    <th>User Name</th>
                    <td><input type="text" name="UserName" placeholder="User Name"></td>
                </tr>
            </table>
            <button type="submit">ISSUE</button>
        </form>
    </div>

    <div id="bookreturn" class="portion" style="display:none">
        <h2>RETURN BOOK</h2>
        <form action="return_book.php" method="post" enctype="multipart/form-data">
            <br>
            <table>
                <tr>
                    <th>Book Id</th>
                    <td><input type="text" name="BookId" placeholder="BookID"></td>
                </tr>
            </table>
            <button type="submit">RETURN</button>
        </form>
    </div>

    <div id="issuereturn" class="portion" style="display:none">
        <h2>ISSUE RETURN</h2>
        <?php
        $u = new data;
        $u->setconnection();
        $u->IsRE();
        $recordset = $u->IsRe();

        $table = "<table style='border-collapse: ;width: 100%; border: 1px solid #000;'>
            <tr><th>Book Id</th><th>Book Name</th><th>User Name</th><th>Issued On</th>
            <th>Due On</th><th>Returned On</th><th>Fine</th><th>Fine Paid</th></tr>";
        foreach ($recordset as $row) {
            $table .= "<tr>";
            $table .= "<td>$row[0]</td>";
            $table .= "<td>$row[1]</td>";
            $table .= "<td>$row[2]</td>";
            $table .= "<td>$row[3]</td>";
            $table .= "<td>$row[4]</td>";
            $table .= "<td>$row[5]</td>";
            $table .= "<td>$row[6]</td>";
            $table .= "<td>$row[7]</td>";
            $table .= "</tr>";
        }
        $table .= "</table>";

        echo $table;
        ?>
    </div>
</body>
</html>