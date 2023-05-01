<?php

session_start();
 
if(isset($_SESSION["role"]))
{
    if($_SESSION["role"] != 'Admin')
    {
        header('Location: index.php');
    }

}else{
    echo "";
}

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
    <title>Admin</title>
</head>

<header>
    <h1>Admin</h1>
    <nav>
        <ul>
            <li><button type="submit" class="add"><a href="add_admin.php">Register</a></button></li>
            <li>
                <form action="search.php" method="get" autocomplete="off">
                    <input type="text" name="search" value="" placeholder="Search data"><button class="search"
                        type="submit">Search</button>
                </form>
            </li>
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
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody>

                <?php
    
    $sql="SELECT * FROM `customer_details`";

    $result=mysqli_query($conn,$sql);

    if($result){
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

           echo "<tr>
           <th>".$i."</th>
           <td>".$f_name."</td>
           <td>".$m_name."</td>
           <td>".$l_name."</td>
           <td>".$dob."</td>
           <td>".$gender."</td>
           <td>".$mobile."</td>
           <td>".$email."</td>
           <td>".$city."</td>
           <td>".$pin."</td>
           <td>
           <button type='submit' class='btn1'><a href='update_admin.php?id=$id'>Update</a></button>
           <button type='submit' class='btn2'><a href='delete.php?id=$id' onclick='return confirmation()'>Delete</a></button>  
           </td>
         </tr>";

         $i++;

        }
    } 
?>
            </tbody>
        </table>
    </div>

    <script type="text/javascript">
    function confirmation() {
        return confirm("Are you sure to delete?");

    }
    </script>


</body>

</html>