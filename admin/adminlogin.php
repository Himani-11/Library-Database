<?php
  include "connection.php";
  include "navbar.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Managemet System</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
   
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
    section{
        margin-top: -20px;
    }
</style>
</head>
<body>
    <!-- <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                 <h1 class="navbar-brand active" style="margin-top: 0px;">LIBRARY MANAGEMENT SYSTEM</h1>
            </div>
               <ul class="nav navbar-nav">
                  <li><a href="index.php">HOME</a></li>
                  <li><a href="book.php">BOOKS</a></li>
                  <li><a href="feedback.php">FEEDBACK</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="studentlogin.php"><span class="glyphicon glyphicon-log-in"> LOGIN</span></a></li>
                  <li><a href="studentlogin.php"><span class="glyphicon glyphicon-log-out"> LOGOUT</span></a></li>
                  <li><a href="registration.php"><span class="glyphicon glyphicon-user"> SIGNUP</span></a></li>
               </ul>
        </div>
    </nav> -->
    

    <section>
        <div class="log_img">
            <br><br>
            <div>
                <br><br><br><br><br>
                    <div class="box1">
                        <h1 style="text-align: center; font-size:35px; font-family:Lucida Console;">
                            Library Management System
                        </h1><br>
                        <h1 style="text-align: center; font-size: 25px;">User Login Form</h1>
                        <form name="login" action="" method="post">
                            <div class="login">
                            <input type="text" class="form-control" name="username" placeholder="Username" required=""><br>
                            <input type="password" class="form-control" name="password" placeholder="Password" required=""><br>
                            <input class="btn btn-default" type="submit" value="Login" name="submit" style="color: black; width: 70px; height: 30px;"></div> 
                        </form>
                        <br>
                        <p style="color: white; padding-left:5px;">
                            <br>
                           <a style="color:white; text-decoration:none;" href="update_password.php">Forgot Password?</a>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                            New to this website?<a style="color: white;" href="registration.php" style="text-decoration: none;">Sign Up</a>
                        </p>
                    </div>
                </div>
           </div>  
    </section>
   <?php 
       if(isset($_POST['submit'])){
        $count=0;
           $res=mysqli_query($db,"SELECT * FROM `admin` WHERE username='$_POST[username]' && password='$_POST[password]';");
           $row=mysqli_fetch_assoc($res);
        $count=mysqli_num_rows($res);
        if($count==0){
          ?>
          <!-- <script type="text/javascript">
            alert("The name and username doesnot match.");
          </script> -->
          <br><br><br><br><br>
          <div class="alert alert-warning-danger" style="width:700px; margin-left:400px; background-color:#de1313; color:white;">
              <strong>The username and password doesnot match.</strong>
          </div>
          <?php  
        }
        else{
            // If username and password matches
            $_SESSION['login_user']=$_POST['username'];
            $_SESSION['pic']=$row['pic'];
            ?>
            <script type="text/javascript">
                window.location="index.php";
            </script>
            <?php
        }
       }
   ?>
<!-- </div> -->

</body>
</html>