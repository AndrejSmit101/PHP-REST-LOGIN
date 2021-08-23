<?php

class Request
{
  //Post request method, 100% recyclable.
  public function postRequest($param, $param2, $param3)
  {
      $url = $param;

      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

      $headers = $param2;
      curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

      $data = $param3;
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

      $resp = curl_exec($curl);
      $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
      $decode = json_decode($resp, true);
      if($httpcode == 400 || $httpcode == 500 || $httpcode == 401 || $httpcode == 301) {
          return false;
      } else {
          return $decode;
      }
  }
  //Get request method, also 100% recycable.
  public function getRequest($param, $param2)
  {
      $url = $param;
      $curl = curl_init($url);
      $headers = $param2;
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($curl, CURLOPT_HEADER, 0);
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_TIMEOUT, 30);

      $response = curl_exec($curl);
      $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
      $decode = json_decode($response, true);

      if($httpcode == 400 || $httpcode == 500 || $httpcode == 401 || $httpcode == 301) {
          return false;
      } else {
          return $decode;
      }
  }
}
//This is where I create the object, so I wouldn't have to do it in the every file. It is accessible from the init.php file.
$request = new Request();
