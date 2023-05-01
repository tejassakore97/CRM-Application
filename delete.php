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

if(isset($_GET['id'])){
    $id=$_GET['id'];

    $sql="DELETE FROM `customer_details` WHERE id=$id";

    $result=mysqli_query($conn,$sql);

    if($result){
        header('Location: admin.php');
    }else{
        die(mysqli_error($conn));
    }
}

?>

 