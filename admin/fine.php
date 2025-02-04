<?php
  include "connection.php";
  include "navbar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fine calculation</title>
  <style>
    .srch{
      padding-left:850px;
    }
    body {
  font-family: "Lato", sans-serif;
  transition: background-color .5s;
}

.sidenav {
  height: 100%;
  margin-top:70px;
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
.img-circle{
  margin-left:20px;
}
  </style>
</head>
<body>
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <div style="color:white; margin-left:60px; font-size:20px;">
                            <img src="" alt="">
                            <?php
                             if(isset($_SESSION['login_user'])){
                            echo  "<img class='img-circle profile_img' height=120 width=120 src='images/".$_SESSION['pic']."'>";
                            echo "<br><br>";
                        echo "Welcome ".$_SESSION['login_user'];
                             }
                        ?>
                        </div>
  
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
      <!-- ----------------search bar-------------- -->
      <div class="container">
      <div class="srch">
        <form class="navbar-form" method="post" name="form1">
                <input class="form-control" type="text" name="search" placeholder="search student usn..." required=''>
                <button style="background-color:#6db6b9e6;" type="submit" name="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
            
        </form>
      </div>
     <h2>List of Students</h2>
     <?php
       if(isset($_POST['submit']))
       {
             $q=mysqli_query($db,"SELECT * FROM `fine` where usn like '%$_POST[search]%' ");
             if(mysqli_num_rows($q)==0){
                echo "Sorry! No student found with this usn. Try searching again.";
             }
             else{
              echo "<table class='table table-bordered table-hover'>";
              echo "<tr style='background-color:#6db6b9e6;'>";
              // Table header
              echo "<th>"; echo "USN";  echo "</th>";
              echo "<th>"; echo "status";  echo "</th>";
              echo "<th>"; echo "book_id";  echo "</th>";
              echo "<th>"; echo "returned_date";  echo "</th>";
              echo "<th>"; echo "Day";  echo "</th>";
              echo "<th>"; echo "Fine in Rs.";  echo "</th>";
               echo "</tr>";
         
               while($row=mysqli_fetch_assoc($q))
                 {
                   echo "<tr>";
                   echo "<td>"; echo $row['usn']; echo "</td>";
                   echo "<td>"; echo $row['status']; echo "</td>"; 
                   echo "<td>"; echo $row['book_id']; echo "</td>";
                   echo "<td>"; echo $row['returned_date']; echo "</td>"; 
                   echo "<td>"; echo $row['day']; echo "</td>";
                   echo "<td>"; echo $row['fine']; echo "</td>";
                   echo "</tr>";
                 }
                 echo "</table>";
             }
       }
      /*If button is not pressed*/ 
       else{
        $res=mysqli_query($db," SELECT * FROM `fine` ;");
        echo "<table class='table table-bordered table-hover'>";
        echo "<tr style='background-color:#6db6b9e6;'>";
        // Table header
        echo "<th>"; echo "USN";  echo "</th>";
        echo "<th>"; echo "status";  echo "</th>";
        echo "<th>"; echo "book_id";  echo "</th>";
        echo "<th>"; echo "returned_date";  echo "</th>";
        echo "<th>"; echo "Day";  echo "</th>";
        echo "<th>"; echo "Fine in Rs.";  echo "</th>";
         echo "</tr>";
   
         while($row=mysqli_fetch_assoc($res))
           {
             echo "<tr>";
                 echo "<td>"; echo $row['usn']; echo "</td>";
                 echo "<td>"; echo $row['status']; echo "</td>"; 
                 echo "<td>"; echo $row['book_id']; echo "</td>"; 
                 echo "<td>"; echo $row['returned_date']; echo "</td>"; 
                 echo "<td>"; echo $row['day']; echo "</td>";
                 echo "<td>"; echo $row['fine']; echo "</td>";
             echo "</tr>";
           }
           echo "</table>";
       }

     ?>
     </div>
</body>
</html>
