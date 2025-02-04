<?php
 include "navbar.php";
 include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <style>
        .form-control{
            width:300px;
            height:38px;
        }
        form{
               padding-left:690px;
        }
        label{
            color:white;
        }
    </style>
</head>
<body style="background-color:black;">
     <h2 style="text-align:center;color:white;">Edit Information</h2>
     <?php
          $sql = mysqli_query($db, "SELECT * FROM `admin` WHERE username='$_SESSION[login_user]'");
          $result = mysqli_fetch_assoc($sql); // Fetch the result directly
          $first = $result['first'];
          $last = $result['last'];
          $username = $result['username'];
          $password = $result['password'];
          $email = $result['email'];
          $phone = $result['phone'];
     ?>
     <div class="profile_info" style="text-align:center;">
          <span style="color:white;">Welcome,</span>
          <h4 style="color:white;"><?php echo $_SESSION['login_user']; ?></h4>
     </div><br><br><br>
     <div class="form1">
       <form action="" method="post" enctype="multipart/form-data">
        <input class="form-control" type="file" name="file">
        <label><h4><b>First Name:</b></h4></label>
        <input class="form-control" type="text" name="first" value="<?php echo $first; ?>">
        <label><h4><b>Last Name:</b></h4></label>
        <input class="form-control" type="text" name="last" value="<?php echo $last; ?>">
        <label><h4><b>Username:</b></h4></label>
        <input class="form-control" type="text" name="username" value="<?php echo $username; ?>">
        <label><h4><b>Password:</b></h4></label>
        <input class="form-control" type="password" name="password" value="<?php echo $password; ?>">
        <label><h4><b>Email ID:</b></h4></label>
        <input class="form-control" type="email" name="email" value="<?php echo $email; ?>">
        <label><h4><b>Phone Number:</b></h4></label>
        <input class="form-control" type="tel" name="phone" value="<?php echo $phone; ?>"><br>
       <div style="padding-left:100px;"> <button class="btn btn-default" type="submit" name="submit">Save</button></div>
</form>
</div>
<?php 
    if(isset($_POST['submit'])){
        move_uploaded_file($_FILES['file']['tmp_name'],"images/".$_FILES['file']['name']);
        $first = $_POST['first'];
          $last = $_POST['last'];
          $username = $_POST['username'];
          $password = $_POST['password'];
          $email = $_POST['email'];
          $phone = $_POST['phone'];
          $pic=$_FILES['file']['name'];
          $sql1="UPDATE `admin` SET pic='$pic',first='$first', last='$last', username='$username' , password='$password' , email='$email', phone='$phone' WHERE username='".$_SESSION['login_user']."';";
          if(mysqli_query($db,$sql1)){
            ?>
               <script>
                 alert("Saved Successfully.");
                 window.location="profile.php";
               </script>
            <?php
          }
    }

?>
</body>
</html>
