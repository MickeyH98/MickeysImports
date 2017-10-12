<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="lib/css/normalize.css">
  <link rel="stylesheet" href="lib/css/styles.css">
  <link rel="stylesheet" type="text/css" href="lib/slick/slick.css"/>
  <title>Mickey's Imports Index</title>
</head>
<body>
  <div class="pageWrapper">

    <!--Header-->
    <?php require "lib/inc/header.php"; ?>

    <div class="bannerWrapper">
    <!--Slick Banner-->
      <div class="banner">
        <!--OnClick listeners instead of <a> tags because slick html requirements are strict -->
        <img onclick="window.location='http://mhernandez.road2hire.ninja/MickeysImports/productdetail.php/?model=Aventador'"
        src="http://mhernandez.road2hire.ninja/eCommerce/img/lamborghiniaventadorfront.jpg" alt="Aventador">

        <img onclick="window.location='http://mhernandez.road2hire.ninja/MickeysImports/productdetail.php/?model=911%20Carrera'"
        src="http://mhernandez.road2hire.ninja/eCommerce/img/porsche911carrerafront.jpg" alt="911 Carrera">

        <img onclick="window.location='http://mhernandez.road2hire.ninja/MickeysImports/productdetail.php/?model=z06%20Corvette'"
        src="http://mhernandez.road2hire.ninja/eCommerce/img/chevroletz06corvettefront.jpg" alt=" Z06 Corvette">

        <img onclick="window.location='http://mhernandez.road2hire.ninja/MickeysImports/productdetail.php/?model=458%20Italia'"
        src="http://mhernandez.road2hire.ninja/eCommerce/img/ferrari458italiafront.jpg" alt="458 Italia">

        <img onclick="window.location='http://mhernandez.road2hire.ninja/MickeysImports/productdetail.php/?model=P1'"
        src="http://mhernandez.road2hire.ninja/eCommerce/img/mclarenp1front.jpg" alt="P1">
      </div>
    </div>

    <div class="featured-products">
      <h2>Featured Vehicles</h2>
      <div class="featured-products-slides">
        <img onclick="window.location='http://mhernandez.road2hire.ninja/MickeysImports/productdetail.php/?model=GT-R%20Nismo'"
        src="http://mhernandez.road2hire.ninja/eCommerce/img/nissangtrnismofront.jpg" alt="GT-R Nismo">

        <img onclick="window.location='http://mhernandez.road2hire.ninja/MickeysImports/productdetail.php/?model=R8'"
        src="http://mhernandez.road2hire.ninja/eCommerce/img/audir8front.jpg" alt="R8">

        <img onclick="window.location='http://mhernandez.road2hire.ninja/MickeysImports/productdetail.php/?model=i8'"
        src="http://mhernandez.road2hire.ninja/eCommerce/img/bmwi8front.jpg" alt="i8">

        <img onclick="window.location='http://mhernandez.road2hire.ninja/MickeysImports/productdetail.php/?model=Continental%20GT'"
        src="http://mhernandez.road2hire.ninja/eCommerce/img/bentleycontinentalgtfront.jpg" alt="Continental GT">

        <img onclick="window.location='http://mhernandez.road2hire.ninja/MickeysImports/productdetail.php/?model=Phantom'"
        src="http://mhernandez.road2hire.ninja/eCommerce/img/rollsroycephantomfront.jpg" alt="Phantom">
      </div>
      <div class="h3">
        <h3>Your future luxury vehicle is waiting for you at our Beverly Hills location</h3>
      </div>
    </div>
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
