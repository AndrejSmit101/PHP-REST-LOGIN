<?php
require_once('../includes/init.php');
//Ovaj statement je tu da ne bi bilo errora da nisu setovane varijable.
if(isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    //Parametri za metodu.
    $url = "https://fws-api-test-be.herokuapp.com/api/request-reset-password?email=$email";
    $headers = array(
        'Accept: application/json',
        'Content-Type: application/json',
      );
    //Metoda za GET REQUEST, vraca false/JSON Decode u array.
    $check = $request->getRequest($url, $headers);
    //Ako metoda iznad vrati false. Error handling je kustomizovan za Vas, ne za klijenta.
    if(!$check) {
        die("There was an error with the API, HTTP CODE WAS NOT 200");
    } else {
        header("Location: sent.html");
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
        height: 182px;

      }
      .email {
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
        top: 80%;
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
      <h1>Enter your Email address</h1>
      <input class="email" type="text" placeholder="Email" name="email" required="">
      <h4><?php echo $message; ?></h4>
      <br><br>
      <button type="Submit" name="submit">Reset Password</button>
    </form>
  </body>
</html>
