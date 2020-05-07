<?php 
 


//Include functions
include('admin/includes/functions.php');




?>

 
<?php
/************** Register new Admin ******************/


//require database class files
require('admin/includes/pdocon.php');


//instatiating our database objects
$db = new Pdocon;


//Collect and clean values from the form // Collect image and move image to upload_image folder
if (empty($_POST["submit_login"])) {
  # code...
}

if(isset($_POST['submit_login'])){

    $raw_name           =   cleandata($_POST['firstname']);
    $raw_lastname       =   cleandata($_POST['lastname']);
    $raw_email          =   cleandata($_POST['email']);
    $raw_password       =   cleandata($_POST['password']);
    $raw_phonenumber    =   cleandata($_POST['phone_number']);

    
    
    $c_name             =   sanitize($raw_name);
    $c_lastname         =   sanitize($raw_lastname);
    $c_email            =   valemail($raw_email);
    $c_password         =   sanitize($raw_password);
    $c_phonenumber      =   sanitize($raw_phonenumber);

    
    $hashed_Pass        =   hashpassword($c_password);
    
    // verify file extension
 

    $db->query("SELECT * FROM register WHERE email = :email");
    
    $db->bindvalue(':email', $c_email, PDO::PARAM_STR);
    
    $row = $db->fetchSingle();
    
    
    if($row){
        
        echo '<div class="alert alert-danger text-center">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Sorry!</strong> User already Exist. Register or Try Again
            </div>';
        
    }else{
        
        $db->query("INSERT INTO register(id,firstname, lastname, email, password, phone_number) VALUES(NULL, :firstname, :lastname, :email, :password, :phone_number) ");
        
        $db->bindvalue(':firstname', $c_name, PDO::PARAM_STR);
        $db->bindvalue(':lastname', $c_lastname, PDO::PARAM_STR);
        $db->bindvalue(':email', $c_email, PDO::PARAM_STR);
        $db->bindvalue(':password', $hashed_Pass, PDO::PARAM_STR);
        $db->bindvalue(':phone_number', $c_phonenumber, PDO::PARAM_STR);
        
        $run = $db->execute();
        
        if($run){
            
            echo '<div class="alert alert-success text-center">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Success!</strong> Admin registered successfully.  Please Login
                  </div>';
            
        }else{
            
             echo '<div class="alert alert-danger text-center">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Sorry!</strong> Admin user could not be registered. Please try again later
            </div>';
        }
        
        
    }
    
    
    
}




?>



<!DOCTYPE html>
<html>
<head>
	<title></title>
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
	<!-- Default form register -->
<form class="text-center border border-light p-5" action="register.php"  method="post">
  <!--i added col sm 12 i added row andd href login,incase it doesnt work 
    remove all of them and leave just p class for sign up-->
  <div class="row">
  <div class="col-sm-12">
    <p class="h4 mb-4">Sign up</p>
    <div  class="pull-right">
    <a href="login.php" class="btn btn-secondary" type="button">log in</a>
</div>
</div>
</div>
    <div class="form-row mb-4">
        <div class="col">
            <!-- First name -->
            <input type="text" id="defaultRegisterFormFirstName" class="form-control" placeholder="First name" name="firstname" required>
        </div>
        <div class="col">
            <!-- Last name -->
            <input type="text" id="defaultRegisterFormLastName" class="form-control" placeholder="Last name" name="lastname" required>
        </div>
    </div>

    <!-- E-mail -->
    <input type="email" id="defaultRegisterFormEmail" class="form-control mb-4" placeholder="E-mail" name="email" required>

    <!-- Password -->
    <input type="password" id="defaultRegisterFormPassword" class="form-control" placeholder="Password" aria-describedby="defaultRegisterFormPasswordHelpBlock" name="password" required>
    <small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
        At least 8 characters and 1 digit
    </small>

    <!-- Phone number -->
    <input type="text" id="defaultRegisterPhonePassword" class="form-control" placeholder="Phone number" aria-describedby="defaultRegisterFormPhoneHelpBlock"  name="phone_number" required>
    <small id="defaultRegisterFormPhoneHelpBlock" class="form-text text-muted mb-4">
        Optional - for two step authentication
    </small>

    <!-- Newsletter -->
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="defaultRegisterFormNewsletter" required>
        <label class="custom-control-label" for="defaultRegisterFormNewsletter">Subscribe to our newsletter</label>
    </div>

    <!-- Sign up button -->
    <button class="btn btn-info my-4 btn-block" type="submit" name="submit_login">Submit</button>

    
    <hr>

    <!-- Terms of service -->
    <p>By clicking
        <em>Sign up</em> you agree to our
        <a href="" target="_blank">terms of service</a>

</form>
<!-- Default form register -->
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