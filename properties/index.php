<?php
require_once('../includes/init.php');
session_start();
//Proverava da li je $_SESSION['key'] true, ako nije to znaci da se stranica pristupa manuelno tj. ne kroz login formu.
if(!$_SESSION['key']) {
  header("Location: ../../");
}
//Ovo mogu iskoristiti u header, kod authorization.
$token = $_SESSION['key'];

$url = "https://fws-api-test-be.herokuapp.com/api/properties?orderby=title&order=asc&items-per-page=10";
$headers = array(
  "Accept: application/json",
  "Content-Type: application/json",
  "Authorization: Bearer $token"
);
//GET REQUEST metoda
$check = $request->getRequest($url, $headers);
//U slucaju da GET metoda vrati false, to znaci da access token nije dobar. Prvih 3 minuta nece izaci ovaj error.
if(!$check) {
    die("Invalid Token, can't retrieve properties!");
}


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Properties</title>
  </head>
  <body>
    <?php
      //Prikazuje prvi Title u array. Objasnio sam zasto nije odradjeno sve.
      echo $check['properties']['data']['0']['title'];
    ?>
  </body>
</html>
