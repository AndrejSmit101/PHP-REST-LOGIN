<?php
require_once('includes/init.php');
//This if statement is here so there wouldn't be errors about variables not being set.
if(isset($_POST['submit'])){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    //Regex method, returns true/false
    $regex = $user->Regex($email);
    if(!$regex) {
        $message = "Email format is incorrect!";
    } else {
        //Parameters for the Request method.
        $url = "https://fws-api-test-be.herokuapp.com/api/token";
        $headers = array(
            "Content-Type: application/json",
          );
        $data = $data = <<<DATA
        {
          "grant_type": "password",
          "username": "$email",
          "password": "$password",
          "client_id": "2",
          "client_secret": "8CmyVWf9dzPqbywdFuGDCcyOozvchn8I1dgdSgsk"
        }
        DATA;
        //Method for POST REQUEST, returns false/JSON decoded in array.
        $check = $request->postRequest($url, $headers, $data);
        //If statement in case that the POST method returns false
        if(!$check) {
            $message = "Wrong email or password";
        } else {
          //Puts access_token into $_SESSION and uses it in properties/index.php
          session_start();
          $_SESSION['key'] = $check['access_token'];
          header("Location: properties/");
        }

    }
  }

?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
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
      .email {
        width: 464px;
        height: 36px;
        border: 2px solid #C4C4C4;
        font-family: 'Rhodium Libre', serif;
        font-size: 18px;
      }
      .password {
        width: 464px;
        height: 36px;
        border: 2px solid #C4C4C4;
        font-family: 'Rhodium Libre', serif;
        font-size: 18px;
      }
      button {
        width: 106px;
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
      }
      .checkbox {
        width: 35px;
        height: 35px;
        position: absolute;
        left: 87%;
        top: 45%;
        opacity: 0;
      }
      .checkbox:focus {
        background-color: #C1F0E5;
      }
      a {
        position: absolute;
        top: 82%;
        left: 12%;
      }

      .switch {
        position: absolute;
        display: inline-block;
        width: 50px;
        height: 24px;
        top: 47%;
        left: 89%;
      }
      .switch input {
        opacity: 0;
        width: 0;
        height: 0;
      }

      .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
      }

      .slider:before {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
      }

      input:checked + .slider {
        background-color: #2196F3;
      }

      input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
      }

      input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
      }

      .slider.round {
        border-radius: 34px;
      }

      .slider.round:before {
        border-radius: 50%;
      }
    </style>
  </head>
  <body>
    <form class="form" method="post">
      <br><br><br>
      <input class="email" type="text" placeholder="Email" name="email" required="">
      <br><br><br>
      <input class="password" type="password" id="password" placeholder="Password" name="password" required="">
      <script type="text/javascript">
      function check() {
        var x = document.getElementById("password");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      }
      </script>
      <label class="switch">
      <input type="checkbox" class="checkbox" onclick="check()">
      <span class="slider round"></span>
      </label>
      <h4><?php echo $message; ?></h4>
      <br><br>
      <button type="Submit" name="submit">Login</button>
      <a href="reset-password/">Forgot password?</a>
    </form>
  </body>
</html>
