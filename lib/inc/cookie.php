<?php
$cookie_name = "reserved";
$cookie_value = serialize(["Aventador", "911 Carrera"]);

if(!isset($_COOKIE[$cookie_name])){
  setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); //cookie will persist for 1 month
  print_r(unserialize($_COOKIE));
};
?>
