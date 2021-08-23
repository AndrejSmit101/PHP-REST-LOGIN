<?php
require_once('../includes/init.php');
session_start();
//This checks if the $_SESSION['key'] true. If it isn't that means that the page is being accessed manually, and not from the login form.
if(!$_SESSION['key']) {
  header("Location: ../../");
}
//This is used in properties/index.php
$token = $_SESSION['key'];

$url = "https://fws-api-test-be.herokuapp.com/api/properties?orderby=title&order=asc&items-per-page=10";
$headers = array(
  "Accept: application/json",
  "Content-Type: application/json",
  "Authorization: Bearer $token"
);
//GET REQUEST method
$check = $request->getRequest($url, $headers);
//In case that GET method returns false, that means that the access token isn't valid. In the first 3 minutes this error won't come up.
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
      //This shows the first title in the $check array.
      echo $check['properties']['data']['0']['title'];
    ?>
  </body>
</html>
