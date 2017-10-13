<?php
// <!-- ON CLICK ADD MODEL TO RESERVED ARRAY -->
if(isset($_REQUEST['reserve'])){ //if reserve button clicked

  $cookie_value = []; //set to empty array if no cookie

  if(isset($_COOKIE["reserved"])){
    $cookie_value = unserialize($_COOKIE["reserved"]); //if cookie exists grab value
  };

  array_push($cookie_value, $_REQUEST['model']); //push model into array
  setcookie("reserved", serialize($cookie_value), time() + (86400 * 30), "/"); //cookie will persist for 1 month

  //show popup when an item is reserved
  echo "<div class='reservedPopUp'>
          <p class='reservedPopUpMessage'>Successfully Reserved " . $_REQUEST['model'] . "</p>
          <a href='http://mhernandez.road2hire.ninja/MickeysImports/products.php'><button id='reservedPopUpContinueButton'>Continue Browsing</button></a>
          <a href='http://mhernandez.road2hire.ninja/MickeysImports/reserved.php'><button id='reservedPopUpViewButton'>View Reserved</button></a>
        </div>";
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://mhernandez.road2hire.ninja/MickeysImports/lib/css/normalize.css">
    <link rel="stylesheet" href="http://mhernandez.road2hire.ninja/MickeysImports/lib/css/styles.css">
    <link href="https://fonts.googleapis.com/css?family=Alex+Brush" rel="stylesheet">
    <title>Mickey's Imports Product Detail</title>
  </head>
  <body>
    <script src="https://code.jquery.com/jquery-3.2.1.js"
    integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
    crossorigin="anonymous"></script>
    <div class="productDetail-pageWrapper">
      <!--Header-->
      <?php
      require "lib/inc/header.php";
      require "lib/inc/dbconnect.php";

      $where = "WHERE `Model` = '" . $_GET["model"] . "';";

      try {
        $sql = $db->prepare(
          "SELECT Make, Model, Year, Description, Price, ImgFront, ImgBack
          FROM Products $where"
        );
        $sql->execute();
        $result = $sql->fetchAll();

      } catch (PDOException $e) {
        echo $e->getMessage();
      }
      ?>
      <h2 class="carDetailHeader"><?= $result[0]["Year"] ?> <?= $result[0]["Make"] ?> <?= $result[0]["Model"] ?></h2>

      <img class="carImage" src='<?= $result[0]["ImgFront"] ?>' alt="Car Front">

      <div class="carDetailWrapper">
        <p class="carDetailDescription"><?= $result[0]["Description"] ?></p>
        <p class="carDetailPrice">$<?= number_format($result[0]["Price"]) ?></p>

        <img class="carImage" src='<?= $result[0]["ImgBack"] ?>' alt="Car Back">

        <form action="productdetail.php/?model=<?= $result[0]['Model'] ?>&reserve=true" method="post">
          <input id="reserveButton" type="submit" value="Reserve Me">
        </form>
      </div>
    </div>

    <a class="returnToInventoryLinkA" href="http://mhernandez.road2hire.ninja/MickeysImports/products.php"><div class="returnToInventoryLink">Back to Inventory</div></a>

    <!--Footer-->
    <?php require "lib/inc/footer.php" ?>
  </body>
</html>

<!-- $_SESSION['reserved'] -->
<!-- $result[0]["Model"] -->
