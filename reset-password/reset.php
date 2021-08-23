<?php
require_once('../includes/init.php');

//Uzimam value iz URL u ove varijable.
$token = $_GET['token'];
$email = $_GET['email'];
//Convertujem @ karakter u %40, jer URL u ovom slucaju ne prihvata @ karakter, saznao sam na tezi nacin.
$emailconvert = str_replace("@", "%40", $email);
//Postavljam parametre za metodu.
$url = "https://fws-api-test-be.herokuapp.com/api/reset-password/$token?email=$emailconvert";
$headers = array(
    'Accept: application/json',
    'Content-Type: application/json',
  );
//GET REQUEST metoda, vraca false/JSON Decode u array.
$check = $request->getRequest($url, $headers);
//U slucaju da vrati false to znaci da token nije validan.
if(!$check) {
    die("Token is invalid!");
}
//Ako je submit postavljen, samo onda stavlja value u varijable.
if(isset($_POST['submit'])){
    //Gleda da li su uneseni stringovi isti, i ako jesu onda ce uzeti jedan od njih i staviti u varijablu.
    if($_POST['password'] === $_POST['password2']) {
        $password = $_POST['password'];
        //Drugi parametri za drugi request, u ovom fajlu pozivam dva requesta, jedan check token a drugi reset password.
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
        //POST REQUEST metoda za reset password. Vraca false/JSON Decode u array.
        $reset = $request->postRequest($url, $headers, $data);
        //U slucaju da metoda vrati false.
        if(!$reset) {
            die("There was an error");
        } else {
            //Ako je uspesno resetovana lozinka, vratice nas na login stranicu da se ulogujemo.
            header("Location: ../");
        }
    } else {
        //U slucaju da uneseni stringovi nisu isti.
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
