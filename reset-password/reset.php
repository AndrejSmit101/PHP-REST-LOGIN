<?php
require_once('../includes/init.php');

//Taking value from the URL and putting it into these variables.
$token = $_GET['token'];
$email = $_GET['email'];
//Converting @ character into %40 so I can use it in the URL
$emailconvert = str_replace("@", "%40", $email);
//Parameters for the request method.
$url = "https://fws-api-test-be.herokuapp.com/api/reset-password/$token?email=$emailconvert";
$headers = array(
    'Accept: application/json',
    'Content-Type: application/json',
  );
//GET REQUEST method, returns false/JSON Decoded in array.
$check = $request->getRequest($url, $headers);
//In case the return is false, that means the token is not valid.
if(!$check) {
    die("Token is invalid!");
}
//Puts values into variables only if the form is submitted.
if(isset($_POST['submit'])){
    //Checking if the strings are identical, and if they are it will put one of them into a variable.
    if($_POST['password'] === $_POST['password2']) {
        $password = $_POST['password'];
        //Second parameters for the second request method. I am using two requests in this file, one for the token check and second for the reset password.
        $url = "https://fws-api-test-be.herokuapp.com/api/reset-password";
        $headers = array(
            "Content-Type: application/json",
          );
        $data = <<<DATA
        {
          "email": "$email",
          "password": "$password",
          "token": "$token"
        }
        DATA;
        //POST REQUEST method for password reset. Returns false/JSON Decoded in array.
        $reset = $request->postRequest($url, $headers, $data);
        //In case where method returns false.
        if(!$reset) {
            die("There was an error");
        } else {
            //If the password was reset successfully, it will redirect us to the login page.
            header("Location: ../");
        }
    } else {
        //If the strings are not identical, it will show a message.
        $message = "Entered passwords are not the same!";
    }

}
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Reset Password</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rhodium+Libre&display=swap" rel="stylesheet">
    <style>
      body {
        background-color: #C4C4C4;
        text-align: center;
      }
      .form {
        display: inline-block;
        border-radius: 25px;
  		  background-color: #FFFFFF;
		    padding: 30px;
		    margin: 0;
 		    position: absolute;
 		    top: 50%;
		    left: 33%;
 		    -ms-transform: translateY(-50%);
 		    transform: translateY(-50%);
        width: 550px;
        height: 282px;

      }
      .password {
        width: 464px;
        height: 36px;
        border: 2px solid #C4C4C4;
        font-family: 'Rhodium Libre', serif;
        font-size: 18px;
      }
      button {
        width: 160px;
        height: 32px;
        position: absolute;
        top: 85%;
        left: 70%;
        border-radius: 50px;
        background-color: #C1F0E5;
        border: 0px;
        font-family: 'Rhodium Libre', serif;
        font-size: 18px;
      }
      h4 {
        color: red;
        font-family: 'Rhodium Libre', serif;
      }
      h1 {
        font-family: 'Rhodium Libre', serif;
      }
    </style>
  </head>
  <body>
    <form class="form" method="post">
      <h1>Reset your password</h1>
      <input class="password" type="password" id="password" placeholder="New Password" name="password" required="">
      <br><br><br>
      <input class="password" type="password" id="password" placeholder="New Password Again" name="password2" required="">
      <h4><?php echo $message; ?></h4>
      <br><br>
      <button type="Submit" name="submit">Reset Password</button>
    </form>
  </body>
</html>
