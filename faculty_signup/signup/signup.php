<?php
session_start();
require('../../authentication/connection.php');
$email = $_GET['email'];
$token = $_GET['token'];
$currentDate = date("Y-m-d H:i:s");

$check_token = "SELECT * FROM register_token WHERE email = '$email' AND token = '$token' ";
$result = $conn->query($check_token);

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8"/>
      <meta name="viewport" content="width=device-width, intial-scale=1.0" />
      <meta http-equiv="X-UA-Compatible" content="ie-edge" />
      <link rel="stylesheet" href="signup.css" />
      <script src="signup.js"></script>
      <title>hello</title>
   </head>
<?php 

if($result->num_rows === 1){
    $row = $result->fetch_assoc();
    if($row['expirydate'] >= $currentDate ){

      $username = substr($email, 0, 10);
      $_SESSION['user']=$username;
      $_SESSION['email']=$email;
?>
   <body>
      <div class="container" id="container">
      <form name="signup" action = "save.php" onsubmit="return validateForm()" method = "POST" class="f1">
         <br>
         <h1>Register Form</h1>
         <br>
         <input type="text" name="name" id="name"  placeholder="Full name" />
         <p style="color:red;" id="name-error" hidden></p>
         <input type="text" name="user" id="user" placeholder="Faculty ID"/>
         <p style="color:red;" id="user-error" hidden></p>
         <input type="text" name="email" id="email" value="<?php echo $email; ?>" disabled />
         <input type="password" name="pass" id="pass" placeholder="Password"/>
         <span style="color:red;" id="password-error" hidden></span>
         <input type="password" name="repass" id="repass" placeholder="Confirm password" />
         <span style="color:red;" id="confirm-error" hidden></span>             
         <p style="color:red;" id="test" hidden></p>
         <input
            class="button"
            type="submit"
            id="button"
            name="commit"
            value="Submit"
            tabindex="3"
            class="lastInput"
            style="margin:12px;border-radius:0.5rem"
            /> 
      </form>
      <br>
   </body>
</html>
<?php    

    }  
}else echo "Link Expired";

?>
