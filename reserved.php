<?php
require "lib/inc/dbconnect.php";

if(isset($_REQUEST['delete'])){ //if delete button clicked

  $cookie_value = unserialize($_COOKIE["reserved"]); //grab cookie value

  //remove clicked item
  foreach(array_keys($cookie_value, $_REQUEST['model']) as $key) { //array keys to create indexes
    unset($cookie_value[$key]); //remove specified index
  }

  //set cookie
  setcookie("reserved", serialize($cookie_value), time() + (86400 * 30), "/");
  //page must be refreshed to access new cookie data
  header("Refresh: 0, url=http://mhernandez.road2hire.ninja/MickeysImports/reserved.php"); //refresh page to view changes

}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="http://mhernandez.road2hire.ninja/MickeysImports/lib/css/normalize.css">
  <link rel="stylesheet" href="http://mhernandez.road2hire.ninja/MickeysImports/lib/css/styles.css">
  <link href="https://fonts.googleapis.com/css?family=Alex+Brush" rel="stylesheet">
  <title>Mickey's Imports Reserved</title>
</head>
<body>
  <div class="reserved-pageWrapper">

    <!--Header-->
    <?php require "lib/inc/header.php"; ?>

    <h2 class="reservedVehiclesHeader">Reserved Vehicles</h2>

    <div class="reservedVehiclesWrapper">

    <!--GENERATE RESERVED VEHICLES BASED OFF OF COOKIE-->
    <?php
    if(isset($_COOKIE["reserved"])){
      $where = "WHERE `Model` IN (";
      foreach (unserialize($_COOKIE["reserved"]) as $name){ $where .= "'" . $name . "'" . ", "; }
      $where = rtrim($where, ', ');
      $where .= ");";
    } else {
      $where = "";
    }

      try {
        $sql = $db->prepare(
          "SELECT Make, Model, Year, Description, Price, ImgFront, ImgBack
          FROM Products $where"
        );
        $sql->execute();
        $result = $sql->fetchAll();

      } catch (PDOException $e) {
        echo "No Vehicles have been reserved.";
      }
      if(isset($result)){
        foreach($result as $car){
        ?>

        <a href="productdetail.php/?model=<?= $car['Model'] ?>">
          <div class="reservedVehicle">
            <img class="reservedVehicleImage" src='<?= $car["ImgFront"] ?>' alt="Car Front">
            <div class="reservedVehicleDetails">
              <h3><?= $car["Year"] ?> <?= $car["Make"] ?> <?= $car["Model"] ?></h3>
              <p>$<?= number_format($car["Price"]) ?></p> <!-- number format adds commas -->
            </div>
          </div>
        </a>
        <form action="reserved.php/?model=<?= $car["Model"] ?>&delete=true" method="post">
          <button class="reserveDeleteButton">Remove</button>
        </form>
        <?php
        } //close foreach loop
      } //close if statement
    ?>
    </div>

    <a href="http://mhernandez.road2hire.ninja/MickeysImports/products.php"><div id="reserveMoreButton">Reserve More</div></a>

  </div>

  <!--Footer-->
  <?php require "lib/inc/footer.php" ?>

</body>
</html>

<!--
Our final PHP project will be an e-Commerce site. You may choose what to “sell”, but the following requirements must be met:

• The products must be mainstream and professional.
• You must be able to categorize the products into a minimum of 4 categories
• Each product will have a photo, name, description, and price.

*The website must have the following pages:*
• Home page: have a featured products area that will show products marked as featured in the database. There should also be a banner image slideshow. The rest of the home page content is up to you.
• Products Page: This page should be a visual list of all the products on your site. Each product should show an image, the price and a quick description. The user should be able to click on the product and go to a product detail page. The user should also be able to choose to only display products from a particular category.
• Product Detail Page: Must show a minimum of one image of the product. Multiple images are encouraged. Price & description must be shown. User should be able to access a form that lets them select the number they wish to purchase. If the product requires other selections (like size or color), they should be able to do that, too.
  The form should have an add to cart button and when it is clicked, use Javascript to notify the user that they have added the item to the cart – even though we won’t have an actual cart.
• Search: this page should allow the user to type in a search term and it should return a list of products. The search term should search the category, the name and the description. The search page should also let you filter by price.
• Contact: Standard contact form but instead of sending an email, the contact form should save to a contact table. When the form is submitted, hide the form and show a list of all of the comments in the database with the most recent comment at the top.
• The header, navigation and footer should be include files

*Visual requirements:*
• Colors, logo, fonts and icons are entirely up to you. Just try to make things neat and organized.
• The site should use media queries to do 2 different layouts. One for less than 800 pixels and one for greater than 800 pixels. Set a max width so the site doesn’t look bad as the screen size widens.

*JavaScript:*
• Implement a form validation for the contact form and the product purchase form
• Implement a jQuery slider for the home page.
• Implement a notification of adding an item to the cart

*Assessment:* The project will be assessed on the following criteria:
• HTML sematic structure. Validate your HTML!
• CSS validation & usage. Use of media query
• JavaScript: working scripts
• PHP: include files, code for displaying products. Strongly prefer Object-oriented PHP.
• MySQL: correct search and display queries

*Deadline:* Friday, October 13 at noon.
-->
