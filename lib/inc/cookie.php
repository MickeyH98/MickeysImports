<?php
$cookie_name = "reserved";
$cookie_value = serialize([]); //empty array to be populated as cars are reserved

if(!isset($_COOKIE[$cookie_name])){ //if no cookie exists, create it
  setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); //cookie will persist for 1 month
};
?>
