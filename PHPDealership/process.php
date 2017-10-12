<?php
require "./lib/inc/dbconnect.php";

  if(!empty($_POST["name"])){ //if form is submitted
    try {
      $sql = $db->prepare( //insert comment into db
        "INSERT INTO Comments (Name, Email, Comment)
        VALUES (:name, :email, :comment)"
      );
      $result = $sql->execute(
        ["name" => $_POST["name"],
        "email" => $_POST["email"],
        "comment" => $_POST["comment"]]
      );
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  //this code block outside of conditional so the comments are always shown
  try {
    $sql = $db->prepare( //get comments
      "SELECT Name, Email, Comment
      FROM Comments");
    $sql->execute();
    $result = $sql->fetchAll();
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  //encode comments and echo them to contact page
  echo json_encode($result); exit;


?>
