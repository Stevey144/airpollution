
<?php 

session_start();
//Include functions
include('admin/includes/functions.php');




//check to see if user if logged in else redirect to index page 


?>

 
<?php

//require or include your database connection file
//require database class files
require('admin/includes/pdocon.php');
    
//instatiating our database objects
$db = new Pdocon;

    //Collect and process Data on login submission
if(isset($_POST['submit_login'])){
    
    $raw_email       =   cleandata($_POST['email']);
    
    $raw_password       =   cleandata($_POST['password']);
    
    
    $c_email         =   valemail($raw_email);            
    
    $hashed_password    =   hashpassword($raw_password);
      
    
    $db->query('SELECT * FROM register WHERE email=:email AND password=:pass');
    
    $db->bindValue(':email', $c_email, PDO::PARAM_STR);
    $db->bindValue(':pass',$hashed_password, PDO::PARAM_STR);
    
    $row = $db->fetchSingle();
    
    
    if($row){
        
 
        
        $_SESSION['user_data'] = array(
        
        
        'firstname'      =>   $row['firstname'],
        'email'         =>   $row['email'],
        'id'            =>   $row['id']

        );
        
        $_SESSION['user_is_logged_in']  =  true;
        
        redirect('admin/my_admin.php');
        
        
        keepmsg('<div class="alert alert-success text-center">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Welcome </strong>'.$row['firstname'].'  You are logged in as Admin 
                </div>');
        
        
        
        
    }else{
        
         echo '<div class="alert alert-danger text-center">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Sorry!</strong> User does not exist. Register or Try Again
            </div>';

    }    
    
    
    
    
}
 

?>
  



<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
  <title>Air Pollution</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">
  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,700%7CRoboto:400,700,300">

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">
</head>
<body>
	<!-- Material form login -->
<!-- Material form login -->


   

    <!-- Form -->
    <form class="text-center border border-light p-5" style="color: #757575;" action="login.php" method="POST">
            <div class="row">
      <div class="col-sm-12">
      <p class="h4 mb-4">Sign in</p>
     </div>
     </div>
      <!-- Email -->
      <div class="md-form">
        <input type="email" id="materialLoginFormEmail" name="email"   class="form-control" placeholder="enter your email here" required="required">
        <label for="materialLoginFormEmail">E-mail</label>
      </div>

      <!-- Password -->
      <div class="md-form">
        <input type="password" id="materialLoginFormPassword" class="form-control" name="password" placeholder="enter your password here" required="required">
        <label for="materialLoginFormPassword">Password</label>
      </div>

      <div class="d-flex justify-content-around">
        <div>
          <!-- Remember me -->
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="materialLoginFormRemember">
            <label class="form-check-label" for="materialLoginFormRemember">Remember me</label>
          </div>
        </div>
        <div>
          <!-- Forgot password -->
          <a href="">Forgot password?</a>
        </div>
      </div>

      <!-- Sign in button -->
      <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" name="submit_login">Sign in</button>

      <!-- Register -->
      <p>Not a member?
        <a href="register.php" class="btn btn-primary">Register</a>
      </p>

      <!-- Social login -->
      

    </form>
    <!-- Form -->

  </div>

</div>
<!-- Material form login -->
<!-- Material form login -->
<script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/popper/popper.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/counterup/jquery.waypoints.min.js"></script>
  <script src="lib/counterup/jquery.counterup.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/lightbox/js/lightbox.min.js"></script>
  <script src="lib/typed/typed.min.js"></script>
  <!-- Contact Form JavaScript File -->
  <script src="contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="js/main.js"></script>


</body>
</html>