
<?php 


//Include functions
include('includes/functions.php');

?>

<?
require('includes/pdocon.php');
    
//instatiating our database objects



if(isset($_POST['submit_in'])){

    $raw_name         =   cleandata($_POST['name']);
    $raw_email        =   cleandata($_POST['email']);
    $raw_subject      =   cleandata($_POST['subject']);
    $raw_message      =   cleandata($_POST['message']);

    
    
    $c_name             =   sanitize($raw_name);
    $c_email            =   valemail($raw_email);
    $c_message          =  sanitize($raw_message);
    $c_subject          =  sanitize($raw_subject);
  $db = new Pdocon;

$db->query("SELECT * FROM contact WHERE email = :email");
    
    $db->bindvalue(':email', $c_email, PDO::PARAM_STR);
    
    $row = $db->fetchSingle();
    if($row){
        
         echo "user already exists";
    }


    else{
        
        $db->query("INSERT INTO contact(name,email,subject,message) VALUES(:name,:email, :subject,:message) ");
        
        $db->bindvalue(':name', $c_name, PDO::PARAM_STR);
        $db->bindvalue(':email', $c_email, PDO::PARAM_STR);
        $db->bindvalue(':subject', $c_subject, PDO::PARAM_STR);
        $db->bindvalue(':message', $c_message, PDO::PARAM_STR);
        
        $run = $db->execute();

       if ($run) {
        keepmsg('<div class="alert alert-success text-center">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Welcome </strong> 
                </div>');
        
        
       }
       else{
         keepmsg( '<div class="alert alert-danger text-center">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Sorry!</strong> User does not exist. Register or Try Again
            </div>');

       }
   }
}



}








 ?>