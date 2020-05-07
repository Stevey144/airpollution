<?php 

$localhost = 'localhost';
$user = 'root';
$password ='';
$db = 'air_pollution';
$conn = mysqli_connect($localhost,$user,$password, $db);

if(isset($_POST['submit'])){
 $name=$_POST['name'];
  $email=$_POST['email'];
   $subject=$_POST['subject'];
  $message=$_POST['message'];

$sql = "INSERT INTO contact(name,email,subject,message)VALUES('$name','$email','$subject','message')";
$query=mysqli_query($conn, $sql);

if($query){
  redirect('index.php');
  echo "details have been inserted successfully"; 
}
else{
  echo "failed to connect";
}

}

 ?>