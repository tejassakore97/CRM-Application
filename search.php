<?php

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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>Search</title>
</head>
<header>
    <h1>Search</h1>
    <nav>
        <ul>
            <li><input type="submit" value="Go back!" class="log1" onclick="history.back()"></li>
            <li><button class="log" type="submit"><a href="index.php">Log Out</a></button></li>
        </ul>
    </nav>
</header>

<body>



    <div class="tab">
        <table class="table">
            <thead>
                <tr>
                    <th>sr.no</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Date Of Birth</th>
                    <th>Gender</th>
                    <th>Mobile Number</th>
                    <th>Email Id</th>
                    <th>City</th>
                    <th>Pin Code</th>
                </tr>
            </thead>
            <tbody>

                <?php

        $search=$_GET['search'];
        $sql="SELECT * FROM `customer_details` WHERE CONCAT(`id`, `f_name`, `m_name`, `l_name`, `dob`, `gender`, `mobile`, `email`, `city`, `pin`) LIKE '%$search%'";

        $result=mysqli_query($conn,$sql);

        $query=mysqli_num_rows($result);

        if($query > 0){
          $i=1;
            while($row=mysqli_fetch_assoc($result)){
                $id=$row['id'];
                $f_name=$row['f_name'];
                $m_name=$row['m_name'];
                $l_name=$row['l_name'];
                $dob=$row['dob'];
                $gender=$row['gender'];
                $mobile=$row['mobile'];
                $email=$row['email'];
                $city=$row['city'];
                $pin=$row['pin'];
              
              
               echo '<tr>
               <th>'.$i.'</th>
               <td>'.$f_name.'</td>
               <td>'.$m_name.'</td>
               <td>'.$l_name.'</td>
               <td>'.$dob.'</td>
               <td>'.$gender.'</td>
               <td>'.$mobile.'</td>
               <td>'.$email.'</td>
               <td>'.$city.'</td>
               <td>'.$pin.'</td>
             </tr>';
             $i++;
    
            }
            // echo "<span>Record Found!</span>";
             
        }else{
            // $e="Record Not Found!! ";
        }
              
    ?>

            </tbody>
        </table>

    </div>


</body>


</html>