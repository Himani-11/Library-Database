<?php
  include "connection.php";
  include "navbar.php";
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve Request</title>
    <style>
     .srch{
      padding-left:900px;
    }
    .form-control{
        width: 300px;
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
  padding: 16px;
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
    height:600px;
    background-color:black;
    opacity:0.8;
    color:white;
}
.Approve{
    margin-left:400px;
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
<div class="container"><br>
    <h3 style="text-align:center;">Approve Request</h3><br><br>
    <form action="" class="Approve" method="post">
        <input class="form-control" type="text" name="approve" placeholder="Yes or no" required=""><br>
        <input class="form-control" type="text" name="issue_date" placeholder="Issue Date (yyyy-mm-dd)" required=""><br>
        <input class="form-control" type="text" name="return_date" placeholder="Return Date (yyyy-mm-dd)" required=""><br>
        <button class="btn btn-default" type="submit" name="submit">Approve</button>
    </form>
</div>
</div>
<?php
if(isset($_POST['submit'])){
    mysqli_query($db,"UPDATE `issue_book` SET `approve`='$_POST[approve]',`issue_date`='$_POST[issue_date]',`return_date`='$_POST[return_date]' WHERE usn='$_SESSION[usn]' and book_id='$_SESSION[book_id]';");
    mysqli_query($db,"UPDATE `book` SET quantity=quantity-1 WHERE book_id='$_SESSION[book_id]';");
    $res=mysqli_query($db,"SELECT quantity from `book` WHERE book_id='$_SESSION[book_id]'");
    while($row=mysqli_fetch_assoc($res)){
        if($row['quantity']==0){
            mysqli_query($db,"UPDATE `book` SET status='not-available' WHERE book_id='$_SESSION[book_id]';");
        }
    }
 ?>
 <script>
    alert("Updated successfully.");
    window.location="request.php"
 </script>
 <?php
}
?>
</body>
</html>
