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
            include("data_class.php");
            $msg="";

            if(!empty($_REQUEST['msg'])){
            $msg=$_REQUEST['msg'];
            }

            if($msg=="done"){
            echo "<div class='alert alert-success' role='alert'></div>";
            }
            elseif($msg=="fail"){
            echo "<div class='alert alert-danger' role='alert'>Fail</div>";
            }

        ?>

        <button onclick="openpart('addbook')" >ADD BOOK</button>
        <button onclick="openpart('bookreport')" >BOOK REPORT</button>
        <button onclick="openpart('bookissue')" >ISSUE BOOK</button>
        <button onclick="openpart('bookreturn')" >RETURN BOOK</button>
        <button onclick="openpart('issuereturn')" >ISSUE RETURN TABLE</button>

        <div id="addbook" class="innerright portion" style="<?php  if(!empty($_REQUEST['viewid'])){ echo "display:none";} else {echo ""; }?>">
        <h2>ADD NEW BOOK</h2>
        <form action="addbookserver_page.php" method="post" enctype="multipart/form-data">
            <br>
            <table>
                <tr>
                <th>Book Name</th>
                <td><input  type="text" name="BookName" placeholder="Book Name"></td>
                </tr>
                <tr>
                <th>Created On</th>
                <td><input type="date" name="CreatedOn" placeholder="Date"></td>
                </tr>
            </table>
        <button type="submit">SUBMIT</button>
        </form>
        </div>

        <div class="rightinnerdiv">   
            <div id="bookreport" class="innerright portion" style="display:none">
            <h2>ALL BOOKS</h2>
            <?php
            $u=new data;
            $u->setconnection();
            $u->getbook();
            $recordset=$u->getbook();

            $table="<table style='border-collapse: ;width: 100%; border: 1px solid #000;'>
            <tr><th>Book Id</th><th>Book Name</th><th>Created On</th></tr>";
            foreach($recordset as $row){
                $table.="<tr>";
                $table.="<td>$row[0]</td>";
                $table.="<td>$row[1]</td>";
                $table.="<td>$row[2]</td>";
                $table.="</tr>";
            }
            $table.="</table>";

            echo $table;
            ?>
            </div>
            </div>
        </div>
        </div>

        <div class="rightinnerdiv"> 
        <div id="bookissue" class="innerright portion" style="<?php  if(!empty($_REQUEST['viewid'])){ echo "display:none";} else {echo ""; }?>">
        <h2>BOOK ISSUE</h2>
        <form action="issue_book.php" method="post" enctype="multipart/form-data">
            <br>
            <table>
                <tr>
                <th>Book Id</th>
                <td><input type="text" name="BookId" placeholder="BookID"></td>
                </tr>
                <tr>
                <th>User Name</th>
                <td><input  type="text" name="UserName" placeholder="User Name"></td>
                </tr>
            </table>
            <button type="submit">ISSUE</button>
        </form>
        </div> 
        </div>

        <div class="rightinnerdiv"> 
        <div id="bookreturn" class="innerright portion" style="<?php  if(!empty($_REQUEST['viewid'])){ echo "display:none";} else {echo ""; }?>">
        <h2>BOOK RETURN</h2>
        <form action="return_book.php" method="post" enctype="multipart/form-data">
            <br>
            <table>
                <tr>
                <th>Book Id</th>
                <td><input type="text" name="BookId" placeholder="BookID"></td>
                </tr>
                <tr>
                <th>User Name</th>
                <td><input  type="text" name="UserName" placeholder="User Name"></td>
                </tr>
            </table>
            <button type="submit">RETURN</button>
        </form>
        </div> 
        </div>

        <div class="rightinnerdiv">   
            <div id="issuereturn" class="innerright portion" style="display:none">
            <h2>ISSUE RETURN</h2>
            <?php
            $u=new data;
            $u->setconnection();
            $u->IsRE();
            $recordset=$u->IsRe();

            $table="<table style='border-collapse: ;width: 100%; border: 1px solid #000;'>
            <tr><th>Book Id</th><th>Book Name</th><th>User Name</th><th>Issued On</th>
            <th>Due On</th><th>Returned On</th></tr>";
            foreach($recordset as $row){
                $table.="<tr>";
                $table.="<td>$row[0]</td>";
                $table.="<td>$row[1]</td>";
                $table.="<td>$row[2]</td>";
                $table.="<td>$row[3]</td>";
                $table.="<td>$row[4]</td>";
                $table.="<td>$row[5]</td>";
                $table.="</tr>";
            }
            $table.="</table>";

            echo $table;
            ?>
            </div>
            </div>
        </div>
        </div>

    </body>
</html>