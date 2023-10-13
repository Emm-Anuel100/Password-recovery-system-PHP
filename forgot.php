<?php
session_start();
$error = array();

// require_once("./mail.php");
require_once("./conn.php");

$mode = "enter_email";
if (isset($_GET['mode'])) {
   # code...
   $mode = $_GET['mode'];
}

# when something is posted
if (count($_POST) > 0) {
   # code...
   switch ($mode) {
      case 'enter_email':
         # code...
         $email = $_POST['email'];
         # validate email
         if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
           # $error[] = "Pls enter a valid email";
           ?>
           <script>
            alert("Pls enter a valid email");
           </script>
           <?php
         }
         elseif(!valid_email($email)){ # check if email doesn't exist
           # $error[] = "This email was not found";
           ?>
           <script>
            alert("This email was not found");
           </script>
           <?php
         }
         else{ 
         $_SESSION['forgot']['email'] = $email;
         send_email($email); # invoking send_email function
         header("Location: forgot.php?mode=enter_code");
          die;
         }
         break;

      case 'enter_code':
         # code...
         $code = $_POST['code'];
         $result = is_code_correct($code); # invoking is_code_correct function

         if ($result == "The code is correct") {
            # code...
            $_SESSION['forgot']['code'] = $code;
            header("Location: forgot.php?mode=enter_password");
            die;
         }
         else{
            $error[] = $result;
         } 
         break;

       case 'enter_password':
          # code...
          $password = $_POST['password'];
          $password2 = $_POST['password2'];
          if ($password !== $password2) {
            # $error[] = "passwords do not match";
            ?>
           <script>
            alert("passwords do not match");
           </script>
           <?php
          }else if(!isset( $_SESSION['forgot']['email']) || !isset( $_SESSION['forgot']['code'])){
            header("Location: forgot.php");
            die;
          }
          else{
            
            save_password($password);  # invoking save_password function
            if (isset($_SESSION['forgot'])) {
               # code...
               unset($_SESSION['forgot']);
            }
            header("Location: login.php");
            die;
          }
         break;
      
      default:
         # code...
         break;
   }
}


function send_email($email){

 #include_once("conn.php");
 global $conn;

   $expire = time() + (60 * 4); # code will expire in 4min.
   $code = rand(10000,99999); # generate 5 digits random numbers.
   $email = addslashes($email);

   $query = "INSERT INTO  codes (email,code,expire) VALUES ('$email','$code','$expire')";
   mysqli_query($conn,$query);

   $header = "From: emmanuelodel75@gmail.com\n";
   #Send email 
   mail($email,'Password reset',"Your password reset code is ".$code,$header); # recipient,subject,message,header
}

function save_password($password){

   #include_once("conn.php");
   global $conn;
  
     $password = password_hash($password,PASSWORD_DEFAULT);
     $email = addslashes($_SESSION['forgot']['email']);
  
     $query = "UPDATE users SET password = '$password' WHERE email = '$email' LIMIT 1";
     mysqli_query($conn,$query);
  
  }

  function valid_email($email){

   #include_once("conn.php");
   global $conn;
  
     $email = addslashes($email);
  
     $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
     $result = mysqli_query($conn,$query);
     if ($result) {
        # code...
        if (mysqli_num_rows($result) > 0) {
              return true;
           }
    }
    return false;
  }


function is_code_correct($code){
   global $conn;

   $code = addslashes($code);
   $expire = time(); # current time
   $email =  addslashes($_SESSION['forgot']['email']);

   $query = "SELECT * FROM codes WHERE code = '$code' AND email = '$email' ORDER BY id DESC LIMIT 1";
   $result = mysqli_query($conn,$query);
   if ($result) {
      # code...
      if (mysqli_num_rows($result) > 0) {
         # code...
         $row = mysqli_fetch_assoc($result);
         if($row['expire'] > $expire){
            
            return "The code is correct";
         }else{
            ?>
            <script>
             alert("Your password reset code has expired");
            </script>
            <?php
         }
      }else{
         ?>
            <script>
             alert("This code is incorrect");
            </script>
            <?php
      }
   }
  return "The code is incorrect";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Meta Tags -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Title -->
  <title>GOO | Forgot password</title>
  <!-- Style -->
  <link rel="stylesheet" href="./styles/mail.css">
</head>
<body>
   
<header class="header">
 <a href="#" class="logo"><img src="./images/logo.png" alt="logo"></a>
</header>

<?php
switch ($mode) {
   case 'enter_email':
      # code...
      ?>   
   <section class="section-page"> 
   <div class="form-section">
     <h2>Enter your email below</h2><br>
     <form action="forgot.php?mode=enter_email" method="POST" id="sign-in">
        <fieldset>
           <input type="email" name="email" id="email" required="" placeholder="Your email ..." autocomplete="off">
        </fieldset>
        <a href="login.php" class="forgot">Start Over</a>
        <fieldset>
           <button type="submit" id="submit_btn">Submit</button>
        </fieldset>
     </form>
   </div> <br>
  </section> 

    <?php
      break;

   case 'enter_code':
      # code...
      ?>   
    <section class="section-page"> 
     <div class="form-section">
     <h2>Enter password reset code</h2>
     <br/>
     <h4 class="mail_message">we just sent a 5 digit code to your email</h4>
     <br/><br/>
     <form action="forgot.php?mode=enter_code" method="POST" id="sign-in" onsubmit='return validate()'>
        <fieldset>
        <input type="text" name="code" placeholder="Enter code ..." required="" autocomplete="off">
        </fieldset>
        <a href="Forgot.php" class="forgot">Resend code</a>
        <fieldset>
           <button type="submit" id="submit_btn">Submit</button>
        </fieldset>
      </form>
     </div> <br>
    </section> 
   
       <?php
      break;

    case 'enter_password':
       # code...
       ?>   
         <section class="section-page"> 
      <div class="form-section">
      <h2>Enter your new password</h2><br>
      <form action="forgot.php?mode=enter_password" method="POST" id="sign-in" onsubmit='return validate()'>
        <fieldset>
           <input type="password" name="password" id="password1" required="" placeholder="Enter password ...">
           <h5 class="show1">SHOW</h5>
         </fieldset>
          <fieldset>
           <input type="password" name="password2" id="password2" required="" placeholder="Comfirm password ...">
           <h5 class="show2">SHOW</h5>
         </fieldset>
        <a href="Login.php" class="forgot">Login</a>
        <fieldset>
           <button type="submit" id="submit_btn">Submit</button>
        </fieldset>
       </form>
      </div>
     </section> 

        <?php
      break;
   
   default:
      # code...
      break;
}
?>


<noscript>Pls Enable JavaScript!</noscript>
<script src="./scripts/password.js"></script>
</body>
</html>