


<?php
session_start();
require('includes/pdocon.php');
//Include functions
include('includes/functions.php');     
//check to see if user if logged in else redirect to index page

?>
<?php 
                /************** Fetching data from database using id ******************/
               if(isset($_GET['admin_id'])){
                   $admin_id = $_GET['admin_id'];

               }
               
                //require database class files
                

                //instatiating our database objects
               $db = new Pdocon;
               $db->query("SELECT * FROM register WHERE id=:id");

                //Create a query to display customer inf // You must bind the id coming in from the url
                $db->bindvalue(':id',$admin_id,PDO::PARAM_INT);
                $row=$db->fetchSingle();
            

if(isset($_POST['submit_update'])){
    $raw_firstname = cleandata($_POST['firstname']);
    $raw_lastname = cleandata($_POST['lastname']); 
    $raw_email = cleandata($_POST['email']); 
    $raw_password = cleandata($_POST['password']); 
    $raw_phone = cleandata($_POST['phonenumber']); 


    //$raw_image= cleandata($_POST['image']);  
    
    $c_name = sanitize($raw_firstname);
    $c_lastname = sanitize($raw_lastname);
    $c_email= valemail($raw_email);
    $c_password=sanitize($raw_password);
    $c_phone=sanitize($raw_phone);
    $hashed_pass = hashpassword($c_password);


    //Hash password using our md5 function
      
    //move images to permanent location
    
    
            $db->query("UPDATE register SET firstname=:first,lastname=:last,email=:email,password=:pass,phone_number=:phone");
            $db->bindvalue(':first',$c_name,PDO::PARAM_STR);
            $db->bindvalue(':last', $c_lastname,PDO::PARAM_STR);
            $db->bindvalue(':email',$c_email,PDO::PARAM_STR);
            $db->bindvalue(':pass',$hashed_pass,PDO::PARAM_STR);
            $db->bindvalue(':phone',$c_phone,PDO::PARAM_STR);
            $run=$db->execute();
            
            if($run){
                redirect('my_admin.php');
           keepmsg('<div class="alert alert-success text-center">
            <strong>Sucess!</strong> Update succesfull.
            </div>');
            }
             
            else{
           redirect('my_admin.php');  
            keepmsg(' <div class="alert alert-danger text-center">
            <strong>Sorry!</strong> Update not succesfull, please try again.
            </div>');
            
            }    
    

}


?>

<!DOCTYPE html>
<html>
<head>
  <title> </title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>



               


      
<form class="text-center border border-light p-5" action="<?php $_SERVER["PHP_SELF"]; ?>"  method="post">
  <!--i added col sm 12 i added row andd href login,incase it doesnt work 
    remove all of them and leave just p class for sign up-->

    

               
  <div class="row">
  <div class="col-sm-12">
    <p class="h4 mb-4">update</p>
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
            <input type="text" class="form-control" placeholder="Last name" name="lastname" required value>
        </div>
    </div>

    <!-- E-mail -->
    <input type="email" class="form-control mb-4" placeholder="E-mail" name="email" required value>

    <!-- Password -->
    <input type="password" class="form-control" placeholder="Password" name="password" required>
    <small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
        At least 8 characters and 1 digit
    </small>

    <!-- Phone number -->
    <input type="text" class="form-control" placeholder="Phone number" name="phonenumber" required>
    <small id="defaultRegisterFormPhoneHelpBlock" class="form-text text-muted mb-4">
        Optional - for two step authentication
    </small>

    <!-- Newsletter -->
    

    <!-- Sign up button -->
    <button class="btn btn-info my-4 btn-block" type="submit" name="submit_update">update</button>
    <a href="my_admin.php" class="btn btn-primary">cancel</a>


    
    <hr>

    <!-- Terms of service -->
    <p>By clicking
        <em>update</em> you agree to our
        <a href="" target="_blank">terms of service</a>
      

</form>




</body>
</html>