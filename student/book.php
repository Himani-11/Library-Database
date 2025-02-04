<?php
  include "connection.php";
  include "navbar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Books</title>
  <style>
    .srch {
      padding-left: 1200px;
    }
    body {
      font-family: "Lato", sans-serif;
      transition: background-color .5s;
    }
    .sidenav {
      height: 100%;
      margin-top: 50px;
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
      padding: 16px;
    }
    @media screen and (max-height: 450px) {
      .sidenav {padding-top: 15px;}
      .sidenav a {font-size: 18px;}
    }
    .img-circle {
      margin-left: 20px;
    }
    .h:hover {
      color: white;
      width: 300px;
      height: 50px;
      background-color: #00544c;
    }
  </style>
</head>
<body>
  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div style="color: white; margin-left: 60px; font-size: 20px;">
      <?php
      if(isset($_SESSION['login_user'])) {
        echo "<img class='img-circle profile_img' height=120 width=120 src='images/".$_SESSION['pic']."'>";
        echo "<br><br>";
        echo "Welcome ".$_SESSION['login_user'];
      }
      ?>
    </div><br><br>
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
    <!-- Search bar -->
    <div class="srch">
      <form class="navbar-form" method="post" name="form1">
        <input class="form-control" type="text" name="search" placeholder="search for books..." required=''>
        <button style="background-color:#6db6b9e6;" type="submit" name="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
      </form>
    </div>
    <!-- Request book -->
    <div class="srch">
      <form class="navbar-form" method="post" name="form2">
        <input class="form-control" type="text" name="book_id" placeholder="Enter book id" required=''>
        <button style="background-color:#6db6b9e6;" type="submit" name="submit1" class="btn btn-default">Request</button>
      </form>
    </div>
    <!-- End of request book -->
    <h2><b>LIST OF BOOKS<b></h2>
    <?php
    if(isset($_POST['submit'])) {
      $q = mysqli_query($db, "SELECT * FROM book where title like '%".$_POST['search']."%' ");
      if(mysqli_num_rows($q) == 0) {
        echo "Sorry! No book found. Try searching again.";
      } else {
        echo "<table class='table table-bordered table-hover'>";
        echo "<tr style='background-color:#6db6b9e6;'>";
        echo "<th>"; echo "book_id";  echo "</th>";
        echo "<th>"; echo "title";  echo "</th>";
        echo "<th>"; echo "authors";  echo "</th>";
        echo "<th>"; echo "edition";  echo "</th>";
        echo "<th>"; echo "status";  echo "</th>";
        echo "<th>"; echo "quantity";  echo "</th>";
        echo "<th>"; echo "department";  echo "</th>";
        echo "</tr>";
        while($row = mysqli_fetch_assoc($q)) {
          echo "<tr>";
          echo "<td>"; echo $row['book_id']; echo "</td>";
          echo "<td>"; echo $row['title']; echo "</td>";
          echo "<td>"; echo $row['authors']; echo "</td>";
          echo "<td>"; echo $row['edition']; echo "</td>";
          echo "<td>"; echo $row['status']; echo "</td>";
          echo "<td>"; echo $row['quantity']; echo "</td>";
          echo "<td>"; echo $row['department']; echo "</td>";
          echo "</tr>";
        }
        echo "</table>";
      }
    } else {
      $res = mysqli_query($db, "SELECT * FROM `book` ORDER BY `book`.`title` ASC;");
      echo "<table class='table table-bordered table-hover'>";
      echo "<tr style='background-color:#6db6b9e6;'>";
      echo "<th>"; echo "book_id";  echo "</th>";
      echo "<th>"; echo "title";  echo "</th>";
      echo "<th>"; echo "authors";  echo "</th>";
      echo "<th>"; echo "edition";  echo "</th>";
      echo "<th>"; echo "status";  echo "</th>";
      echo "<th>"; echo "quantity";  echo "</th>";
      echo "<th>"; echo "department";  echo "</th>";
      echo "</tr>";
      while($row=mysqli_fetch_assoc($res)) {
        echo "<tr>";
        echo "<td>"; echo $row['book_id']; echo "</td>";
        echo "<td>"; echo $row['title']; echo "</td>"; 
        echo "<td>"; echo $row['authors']; echo "</td>"; 
        echo "<td>"; echo $row['edition']; echo "</td>";
        echo "<td>"; echo $row['status']; echo "</td>";
        echo "<td>"; echo $row['quantity']; echo "</td>"; 
        echo "<td>"; echo $row['department']; echo "</td>";
        echo "</tr>";
      }
      echo "</table>";
    }
    if(isset($_POST['submit1'])) {
      if(isset($_SESSION['login_user'])) {
        mysqli_query($db,"INSERT INTO `issue_book` VALUES('','$_SESSION[login_user]','$_POST[book_id]','','','');");
        ?>
        <script>
          window.location="request.php"
        </script>
        <?php
      } else {
        ?>
        <script>
          alert("You must login to request a book");
        </script>
        <?php
      }
    }
    ?>
  </div>
</body>
</html>

