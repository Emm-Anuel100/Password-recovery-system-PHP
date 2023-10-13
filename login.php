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
  
<section class="section-page"> 
    <div class="form-section">
      <h2>Login To Your Account</h2><br>
      <form action="#" method="POST" id="sign-in" onsubmit='return validate()'>
         <fieldset>
            <input type="email" name="email" id="email" required="" placeholder="Email...">
         </fieldset>
         <fieldset class="password1">
            <input type="password" name="password" id="password1" required="" placeholder="Password...">
            <h5 class="show1">SHOW</h5>
         </fieldset>
         <br/>
         <a href="forgot.php" class="forgot">Forgot password?</a>
         <fieldset>
            <button type="submit" id="submit_btn">sign up</button>
         </fieldset>
      </form>
    </div>
   </section>

  <noscript>Pls enable JavaScript to run this page</noscript>
  <script src="./scripts/password.js"></script>
</body>
</html>