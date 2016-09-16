<?php
$error = array();

if(empty($_POST['street']))
    $error['street']="Street Address required";

if(empty($_POST['street']))
    $error['city']="City required";

if(empty($_POST['street']))
    $error['state']="State required";

if(empty($_POST['street']))
    $error['degree']="Degree required";
else{
    $street=$_POST['street'];
$city=$_POST['city'];
$state=$_POST['state'];
$degree=$_POST['degree'];
    $streetAddress=str_replace(" ", "+", $street); 
      $cityName= str_replace(" ", "+", $city); 
      $streetCity= $streetAddress . "," . $cityName . ",";
      $url="https://maps.googleapis.com/maps/api/geocode/xml?address=".$streetCity.$state."&key=AIzaSyDG9vThc9HZeaxYU7Hwar04oqM601NSKh4";

       $file = simplexml_load_file($url);
       $latitude=$file->xpath('//location/lat');
       $longitude=$file->xpath('//location/lng');
       $lat=$latitude[0];
       $lng=$longitude[0];

    $forecastURL="https://api.forecast.io/forecast/e1f8b243c29fab1ac5bc6dbfe863a6ca/$lat,$lng?units=us&exclude=flags";

    $json_string =file_get_contents($forecastURL);
    
echo json_encode(array("jsonData" => $json_string, 
      "latitude" => $lat,
    "longitude" => $lng ));
     
 
}

?>