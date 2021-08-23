<?php

class User
{
  //Regex metoda, nista vise nista manje.
  public function Regex($string)
  {
      $email = $string;
      $check = filter_var($email, FILTER_VALIDATE_EMAIL);
      return $check;
  }
}
//Ovde pravim objekat, da ne moram u svakom fajlu to raditi. Accessible je preko init.php fajla. Njega ne moram komentarisati :)
$user = new User();
