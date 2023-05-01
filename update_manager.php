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

$id=$_GET['id'];
error_reporting(0);
 
 if(isset($_POST['submit'])){
 
 
   $f_name = $_POST['f_name'];
   $m_name = $_POST['m_name'];
   $l_name = $_POST['l_name'];
   $dob    = $_POST['dob'];
   $gender = $_POST['gender'];
   $mobile = $_POST['mobile'];
   $email  = $_POST['email'];
   $city   = $_POST['city'];
   $pin    = $_POST['pin'];
 
   if(empty($f_name) || empty($m_name) || empty($l_name) || empty($dob) || empty($gender) || empty($mobile) || empty($email) || empty($city) || empty($pin)){
 
     $error="All Feilds are Mandatory!";
 
   }elseif(strlen($pin) > 6  ){
      
     $p_error="length of Pin should be 6 charters";
 
   }elseif(!preg_match("/^[a-zA-Z\s]+$/",$f_name) || !preg_match("/^[a-zA-Z\s]+$/",$m_name) || !preg_match("/^[a-zA-Z\s]+$/",$l_name) ){

    $name_error="Enter Valid name";
 

   }elseif(!preg_match("/^[0-9]*$/",$mobile) || strlen($mobile) > 10){

    $mobile_error="Please Enter Valid Mobile Number";

   }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL) == TRUE){
        $email_error="Please Enter Valid Email Id";
   }else{
 
    $sql="UPDATE `customer_details` SET `f_name`='$f_name',`m_name`='$m_name',`l_name`='$l_name',`dob`='$dob',`gender`='$gender',`mobile`='$mobile',`email`='$email',`city`='$city',`pin`='$pin' WHERE id='$id'";

  $result=mysqli_query($conn,$sql);
    
   if($result){
     header('Location: manager.php');
   }else{
     die(mysqli_error($conn));
   }
 
   }
   
 }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/form.css">
    <title>Update Customer</title>
</head>

<body>
    <div class="form">
      <h3>Update</h3>

      <?php
      $sql="SELECT * FROM `customer_details` WHERE id=$id";

      $result=mysqli_query($conn,$sql);
  
      if(mysqli_num_rows($result) > 0){
        
          while($row=mysqli_fetch_assoc($result)){

            $id1=$row['id'];
            $f_name1=$row['f_name'];
            $m_name1=$row['m_name'];
            $l_name1=$row['l_name'];
            $dob1=$row['dob'];
            $gender1=$row['gender'];
            $mobile1=$row['mobile'];
            $email1=$row['email'];
            $city1=$row['city'];
            $pin1=$row['pin'];


      ?>
        <form method="post" autocomplete="off">
            <div>
                <div class="input">
                    <label for="name">First Name</label>
                   <div> <input type="text" name="f_name" value="<?php echo $f_name1?>"></div>

                </div>

                <div class="input">
                    <label for="name">Middle Name</label>
                    <div> <input type="text" name="m_name"  value="<?php echo $m_name1?>"></div>

                </div>

                <div class="input">
                    <label for="name">Last Name</label>
                    <div> <input type="text" name="l_name"  value="<?php echo $l_name1?>"></div>

                </div>

                <div class="input">
                    <label for="name">Date Of Birth</label>
                    <div><input type="date" name="dob"  value="<?php echo $dob1?>"></div>
                </div>

                
                <div class="input">
                    <label for="name">Mobile Number</label>
                    <div><input type="text" name="mobile"  value="<?php echo $mobile1?>"></div>

                </div>

                <div class="input">
                    <label for="name">Email Id</label>
                    <div><input type="text" name="email"  value="<?php echo $email1?>"></div>
                </div>

                <div class="input">
                    <label for="name">City</label>
                    <div><input type="text" name="city"  value="<?php echo $city1?>"></div>
                </div>

                <div class="input">
                    <label for="name">Pin</label>
                    <div><input type="text" name="pin"  value="<?php echo $pin1?>"></div>

                </div>

                <div class="gender">
                    <label for="">Gender :</label>
                    <input type="radio" name="gender" value="Male"> Male
                    <input type="radio" name="gender"  value="Female"> Female
                </div>


                <div class="bt">
                    <input type="submit" name="submit" value="Update" class="btn">
                </div>
                <span><?php echo $error ?></span>
                <span><?php echo $name_error?></span>
                <span><?php echo $p_error ?></span>
                <span><?php echo $mobile_error ?></span>
                <span><?php echo $email_error ?></span>
                <span><?php echo $duplicate_error ?></span>

            </div>
        </form>
        <?php
          }
        }
        ?>

    </div>

</body>

</html>