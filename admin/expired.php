<?php
include "connection.php";
include "navbar.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Request</title>
    <style>
     .srch{
      padding-left:85%;
    }
    .form-control{
        width: 200px;
        height:40px;
        background-color:black;
        color:white;
    }
    body {
        background-color:cornsilk;
        font-family: "Lato", sans-serif;
        transition: background-color .5s;
    }

    .sidenav {
        height: 100%;
        margin-top:50px;
        width: 0;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: #222;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 60px;
    }

    .sidenav a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 25px;
        color: #818181;
        display: block;
        transition: 0.3s;
    }

    .sidenav a:hover {
        color: #f1f1f1;
    }

    .sidenav .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
    }

    #main {
        transition: margin-left .5s;
        padding-left: 10px;
    }

    @media screen and (max-height: 450px) {
        .sidenav {padding-top: 15px;}
        .sidenav a {font-size: 18px;}
    }
    .img-circle{
        margin-left:20px;
    }
    .h:hover{
        color:white;
        width:300px;
        height:50px;
        background-color:#00544c;
    }
    .container{
        margin-top:-65px;
        width:85%;
        height:800px;
        background-color:black;
        opacity:0.7;
        color:white;
    }
    .scroll{
        width:100%;
        height:500px;
        overflow:auto;
    }
    th,td{
        width:10%;
    }
  </style>
</head>
<body>
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div style="color:white; margin-left:60px; font-size:20px;">
            <?php
            if(isset($_SESSION['login_user'])){
                echo  "<img class='img-circle profile_img' height=120 width=120 src='images/".$_SESSION['pic']."'>";
                echo "<br><br>";
                echo "Welcome ".$_SESSION['login_user'];
            }
            ?>
        </div><br><br>
        <div class="h"><a href="add.php">Books Borrowed</a></div>
        <div class="h"><a href="request.php">Book Request</a></div>
        <div class="h"><a href="issue_info.php">Issue Information</a></div>
        <div class="h"><a href="expired.php">Expired List</a></div>
    </div>

    <div id="main">
        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>

        <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "300px";
            document.getElementById("main").style.marginLeft = "300px";
            document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("main").style.marginLeft= "0";
            document.body.style.backgroundColor = "white";
        }
        </script> 

        <div class="container">
            <?php
            if(isset($_SESSION['login_user'])){
                ?>
                <div style="float:left; padding:25px;">
                    <div class="srch"><br>
                        <form action="" method="post" name="form1">
                            <input type="text" name="usn" class="form-control" placeholder="USN" required=""><br>
                            <input type="text" name="book_id" class="form-control" placeholder="Book ID" required=""><br>
                            <button class="btn btn-default" name="submit" type="submit">Book returned</button><br>
                        </form>
                    </div>
                    <?php


if (isset($_SESSION['login_user'])) {
    if (isset($_POST['submit'])) {
        $usn = $_POST['usn'];
        $book_id = $_POST['book_id'];

        // Retrieve the record from issue_book table
        $query = "SELECT * FROM `issue_book` WHERE usn='$usn' AND book_id='$book_id'";
        $result = mysqli_query($db, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $return_date = strtotime($row['return_date']);
            $current_date = strtotime(date("Y-m-d"));
            $diff = $current_date - $return_date;
            $days_diff = floor($diff / (60*60*24)); // Calculate difference in days

            if ($days_diff > 0) {
                // Calculate the fine
                $fine = $days_diff * 1; // Assuming fine is 1 unit per day

                // Insert the fine record into the fine table
                $insert_fine_query = "INSERT INTO `fine` (`usn`, `status`, `book_id`, `returned_date`, `day`, `fine`) 
                                      VALUES ('$usn', 'not paid', '$book_id', CURDATE(), '$days_diff', '$fine')";
                mysqli_query($db, $insert_fine_query);
            }

            // Update the issue_book table to mark the book as returned
            $update_query = "UPDATE `issue_book` SET approve='RETURNED' WHERE usn='$usn' AND book_id='$book_id'";
            mysqli_query($db, $update_query);

            // Increase the quantity of the book in the book table
            $update_book_quantity_query = "UPDATE `book` SET quantity = quantity + 1 WHERE book_id='$book_id'";
            mysqli_query($db, $update_book_quantity_query);
        }
    }
}
            }
?>

                <br>
                <div class="scroll">
                    <?php
                    if(isset($_SESSION['login_user'])){
                        $ret='<p style="color:yellow; background-color:green;">RETURNED</p>';
                        $exp='<p style="color:yellow; background-color:red;">EXPIRED</p>';
                        if(isset($_POST['submit2'])){
                            $sql="SELECT student.usn,book.book_id,title,authors,book.edition,approve,issue_date,return_date FROM student INNER JOIN `issue_book` ON student.usn=issue_book.usn INNER JOIN book ON issue_book.book_id =book.book_id WHERE issue_book.approve='$ret' ORDER BY `issue_book`.`return_date` DESC";
                            $res=mysqli_query($db,$sql);
                        }
                        else if(isset($_POST['submit3'])){
                            $sql="SELECT student.usn,book.book_id,title,authors,book.edition,approve,issue_date,return_date FROM student INNER JOIN `issue_book` ON student.usn=issue_book.usn INNER JOIN book ON issue_book.book_id =book.book_id WHERE issue_book.approve='$exp' ORDER BY `issue_book`.`return_date` DESC";
                            $res=mysqli_query($db,$sql);
                        }
                        else{
                            $sql="SELECT student.usn,book.book_id,title,authors,book.edition,approve,issue_date,return_date FROM student INNER JOIN `issue_book` ON student.usn=issue_book.usn INNER JOIN book ON issue_book.book_id =book.book_id WHERE issue_book.approve!='' and issue_book.approve!='YES' ORDER BY `issue_book`.`return_date` DESC";
                            $res=mysqli_query($db,$sql);
                        }

                        echo "<table class='table table-bordered' style='width:100%'>";
                        echo "<tr style='background-color:#6db6b9e6;'>";
                        echo "<th>"; echo "USN";  echo "</th>";
                        echo "<th>"; echo "Book_id";  echo "</th>";
                        echo "<th>"; echo "Book Name";  echo "</th>";
                        echo "<th>"; echo "Author";  echo "</th>";
                        echo "<th>"; echo "Edition";  echo "</th>";
                        echo "<th>"; echo "Status";  echo "</th>";
                        echo "<th>"; echo "Issue Date";  echo "</th>";
                        echo "<th>"; echo "Return Date";  echo "</th>";
                        echo "</tr>";

                        while($row=mysqli_fetch_assoc($res)) {
                            echo "<tr>";
                            echo "<td>"; echo $row['usn']; echo "</td>";
                            echo "<td>"; echo $row['book_id']; echo "</td>"; 
                            echo "<td>"; echo $row['title']; echo "</td>";
                            echo "<td>"; echo $row['authors']; echo "</td>";
                            echo "<td>"; echo $row['edition']; echo "</td>";
                            echo "<td>"; echo $row['approve']; echo "</td>";
                            echo "<td>"; echo $row['issue_date']; echo "</td>";
                            echo "<td>"; echo $row['return_date']; echo "</td>";
                            echo "</tr>";
                        }

                        echo "</table>";
                    }
                    else {
                        ?>
                        <h3 style="text-align:center;">Login to see information</h3>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

