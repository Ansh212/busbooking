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
      <link rel="stylesheet" href="reset.css" />
      <script src="reset.js"></script>
      <title>hello</title>
   </head>
   <?php 
      if($result->num_rows === 1){
          $row = $result->fetch_assoc();
          if($row['expirydate'] >= $currentDate ){
              $_SESSION['email']=$email;
      ?>
   <body>
      <div class="container" id="container">
         <form name="reset" action = "save.php"  onsubmit="return validateForm()" method = "POST" class="f1">
            <br>
            <h1>Reset Password</h1>
            <br>
            <input type="password" name="pass" id="pass" placeholder="password" style="border-top-left-radius:0.5rem;border-top-right-radius:0.5rem;"/>
            <span style="color:red;" id="password-error" hidden></span>
            <input type="password" name="repass" id="repass" placeholder="confirm password" style="border-bottom-left-radius:0.5rem;border-bottom-right-radius:0.5rem;"/>
            <span style="color:red;" id="confirm-error" hidden></span>
            <input
               class="button"
               type="submit"
               id="button"
               name="commit"
               value="Submit"
               tabindex="3"
               style="border-radius:0.5rem;margin:12px"
               /> 
         </form>
      </div>
   </body>
</html>
<?php    
   }  
   }else echo "Link Expired";
   
   ?>
