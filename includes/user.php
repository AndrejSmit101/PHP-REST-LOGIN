<?php

class User
{
  //Regex method, nothing less nothing more.
  public function Regex($string)
  {
      $email = $string;
      $check = filter_var($email, FILTER_VALIDATE_EMAIL);
      return $check;
  }
}
//This is where I create the object, so I wouldn't have to do it in the every file. It is accessible from the init.php file.
$user = new User();
