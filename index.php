<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/index.css">
    <title>Login</title>
</head>
<body>
    <div class="login">
     <div>
        <h1>Login</h1>
       <form action="" method="post" autocomplete="off">
        <div class="user">
            <input type="text" name="name" placeholder="Username">
        </div>
        <div class="user">
            <input type="password" name="password" placeholder="Password">
        </div>
        <div class="user">
            <button type="submit" name="btnlogin">Login</button>
        </div>
       <div class="invalid"> <?php if(isset($_GET['error'])){ echo $_GET['error']; }?> </div>
       </form>
     </div>
    </div>
    
</body>
</html>

<?php
session_start();

$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "login";
// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST["btnlogin"]))
{
    $username=$_POST["name"];
    $password=$_POST["password"];

    $query= "SELECT * FROM `user_login` WHERE username='$username' AND Pass='$password'";

    $result=mysqli_query($conn,$query);

    $count=mysqli_num_rows($result);

    if($count>0){
      
      while($row = mysqli_fetch_assoc($result))
      { 

        if($row["role"] == "Admin"){
            // $_SESSION["LoginUser"]=$row["username"];
            $_SESSION["role"]=$row["role"];
            // $_SESSION["status"] = "access";
            header('Location: admin.php');

        }elseif($row["role"] == "Manager"){
            // $_SESSION["LoginUser"]=$row["username"];
            $_SESSION["role"]=$row["role"];
            // $_SESSION["status"] = "access";
            header('Location: manager.php');
        }elseif($row["role"] == "Employe"){
            // $_SESSION["LoginUser"]=$row["username"];
            $_SESSION["role"]=$row["role"];
            // $_SESSION["status"] = "access";
            header('Location: employe.php');
        }else{
            echo "";
        }

      }

    }
    else{
      header('Location: index.php?error=Invalid Credentials!!');
    }   
    
}

?>