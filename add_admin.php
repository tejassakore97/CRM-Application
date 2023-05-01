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
 
     $sql="INSERT INTO `customer_details`(`id`, `f_name`, `m_name`, `l_name`, `dob`, `gender`, `mobile`, `email`, `city`, `pin`) VALUES ('','$f_name','$m_name','$l_name','$dob','$gender','$mobile','$email','$city','$pin')";
 
   $result=mysqli_query($conn,$sql);
 
   if($result){
     header('Location: admin.php');
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
    <title>Add Customer</title>
</head>

<body>
    <div class="form">
      <h3>Registration</h3>
        <form method="post" autocomplete="off">
            <div>
                <div class="input">
                    <label for="name">First Name<span class="star">*</span></label>
                   <div> <input type="text" name="f_name" placeholder="Enter Your First Name"></div>

                </div>

                <div class="input">
                    <label for="name">Middle Name<span class="star">*</span></label>
                    <div> <input type="text" name="m_name" placeholder="Enter Your Middle Name"></div>

                </div>

                <div class="input">
                    <label for="name">Last Name<span class="star">*</span></label>
                    <div> <input type="text" name="l_name" placeholder="Enter Your Last Name"></div>

                </div>

                <div class="input">
                    <label for="name">Date Of Birth<span class="star">*</span></label>
                    <div><input type="date" name="dob" placeholder="DOB"></div>
                </div>

                
                <div class="input">
                    <label for="name">Mobile Number<span class="star">*</span></label>
                    <div><input type="text" name="mobile" placeholder="Enter Mobile Number"></div>

                </div>

                <div class="input">
                    <label for="name">Email Id<span class="star">*</span></label>
                    <div><input type="text" name="email" placeholder="Enter Email Id"></div>
                </div>

                <div class="input">
                    <label for="name">City<span class="star">*</span></label>
                    <div><input type="text" name="city" placeholder="Enter Your City"></div>
                </div>

                <div class="input">
                    <label for="name">Pin<span class="star">*</span></label>
                    <div><input type="text" name="pin" placeholder="Enter Pin"></div>

                </div>

                <div class="gender">
                    <label for="">Gender<span class="star">*</span> :</label>
                    <input type="radio" name="gender" value="Male"> Male
                    <input type="radio" name="gender" value="Female"> Female
                </div>


                <div class="bt">
                    <input type="submit" name="submit" value="Register" class="btn">
                </div>
                <span><?php echo $error ?></span>
                <span><?php echo $name_error?></span>
                <span><?php echo $p_error ?></span>
                <span><?php echo $mobile_error ?></span>
                <span><?php echo $email_error ?></span>
                <span><?php echo $duplicate_error ?></span>

            </div>
        </form>

    </div>

</body>

</html>