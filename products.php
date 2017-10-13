<?php require "lib/inc/dbconnect.php";

function spaceReplacer($string, $replaceWith){
  $string = str_replace(' ', $replaceWith, $string); //replace white spaces with specified variable
  return $string;
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="lib/css/normalize.css">
    <link rel="stylesheet" href="lib/css/styles.css">
    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    <link href="https://fonts.googleapis.com/css?family=Alex+Brush" rel="stylesheet">
    <title>Mickey's Imports Products</title>
  </head>
  <body>
    <div class="products-pageWrapper">

      <!--Header-->
      <?php require "lib/inc/header.php" ?>

      <div class="productsHeader">
        <h2>Inventory</h2>
      </div>

      <div class="filterResultsLabel">
        <h3 id="filterResultsLabelH3">Show Filters</h3>
      </div>
      <div class="filterProductsWrapper">
        <form method="post" action="products.php">
          <div class="filterMakeWrapperWrapper">
            <p class="filterMakeLabel filterLabel">Make</p>
            <div class="filterMakeWrapper">
              <?php
              try {
                $sql = $db->prepare(
                  "SELECT Make FROM Products GROUP BY Make"
                );
                $sql->execute();
                $result = $sql->fetchAll();

              } catch (PDOException $e) {
                echo $e->getMessage();
              }
              foreach($result as $car){
                $spacelessMake = spaceReplacer($car['Make'], '');
              ?>
              <div class="filterMake filter">
                <input class="boxFilter" type="checkbox" name="make[]" id="<?= $spacelessMake ?>Checkbox" value="<?= $car['Make'] ?>">
                <label for="<?= $spacelessMake ?>Checkbox"><?= $car["Make"] ?></label>
              </div>
              <?php
              } //close foreach loop
              ?>
            </div>
          </div>
          <div class="filterModelWrapperWrapper">
            <p class="filterModelLabel filterLabel">Model</p>
            <div class="filterModelWrapper">
              <?php
              try {
                $sql = $db->prepare(
                  "SELECT Model
                  FROM Products"
                );
                $sql->execute();
                $result = $sql->fetchAll();

              } catch (PDOException $e) {
                echo $e->getMessage();
              }

              foreach($result as $car){
                $spacelessModel = spaceReplacer($car['Model'], '');
              ?>
              <div class="filterModel filter">
                <input class="boxFilter" type="checkbox" name="model[]" id="<?= $spacelessModel ?>Checkbox" value="<?= $car['Model'] ?>">
                <label for="<?= $spacelessModel ?>Checkbox"><?= $car["Model"] ?></label>
              </div>
              <?php
              }
              ?>
            </div>
          </div>
          <div class="filterYearWrapperWrapper">
            <p class="filterYearLabel filterLabel">Year</p>
            <div class="filterYearWrapper">
              <?php
              try {
                $sql = $db->prepare(
                  "SELECT Year
                  FROM Products
                  GROUP BY Year"
                );
                $sql->execute();
                $result = $sql->fetchAll();

              } catch (PDOException $e) {
                echo $e->getMessage();
              }
              foreach($result as $car){
              ?>
              <div class="filterYear filter">
                <input class="boxFilter" type="checkbox" name="year[]" id="<?= $car['Year'] ?>Checkbox" value="<?= $car['Year'] ?>">
                <label for="<?= $car["Year"] ?>Checkbox"><?= $car["Year"] ?></label>
              </div>
              <?php
              } //close foreach loop
              ?>
            </div>
          </div>
          <div class="filterPriceWrapperWrapper">
            <p class="filterPriceLabel filterLabel">Price</p>
            <div class="filterPriceWrapper">
              <div class="filterPrice filter">
                <input class="boxFilter" type="radio" name="price" id="price1" value="0 AND 25000">
                <label for="price1">$0 - $25k</label>
              </div>
              <div class="filterPrice filter">
                <input class="boxFilter" type="radio" name="price" id="price2" value="25000 AND 50000">
                <label for="price2">$25k - $50k</label>
              </div>
              <div class="filterPrice filter">
                <input class="boxFilter" type="radio" name="price" id="price3" value="50000 AND 75000">
                <label for="price3">$50k - $75k</label>
              </div>
              <div class="filterPrice filter">
                <input class="boxFilter" type="radio" name="price" id="price4" value="75000 AND 100000">
                <label for="price4">$75k - $100k</label>
              </div>
              <div class="filterPrice filter">
                <input class="boxFilter" type="radio" name="price" id="price5" value="100000 AND 200000">
                <label for="price5">$100k - $200k</label>
              </div>
              <div class="filterPrice filter">
                <input class="boxFilter" type="radio" name="price" id="price6" value="200000 AND 300000">
                <label for="price6">$200k - $300k</label>
              </div>
              <div class="filterPrice filter">
                <input class="boxFilter" type="radio" name="price" id="price7" value="300000 AND 400000">
                <label for="price7">$300k - $400k</label>
              </div>
              <div class="filterPrice filter">
                <input class="boxFilter" type="radio" name="price" id="price8" value="400000 AND 500000">
                <label for="price8">$400k - $500k</label>
              </div>
              <div class="filterPrice filter">
                <input class="boxFilter" type="radio" name="price" id="price9" value="500000 AND 99999999">
                <label for="price9">$500k +</label>
              </div>
            </div>
          </div>

          <input type="submit" value="Filter" name="submit" class="filterLabel filterButton">
        </form>
      </div>

      <!--Generate Products based on filter results-->
      <?php
      $where = "";
      echo " Make: ";
      echo $_POST["make"];
      echo " Model: ";
      echo $_POST["model"];
      echo " Year: ";
      echo $_POST["year"];
      echo " Price: ";
      echo $_POST["price"];

      if( isset($_POST["submit"]) &&
      (sizeof($_POST["make"]) > 0 || sizeof($_POST["model"]) > 0 || sizeof($_POST["year"]) > 0 || isset($_POST["price"])) ){

        $make = $_POST["make"];
        $model = $_POST["model"];
        $year = $_POST["year"];
        $price = $_POST["price"];

        $where = "WHERE ";

        if(sizeof($make) > 0){
          $where .= "`Make` IN (";
          foreach ($make as $name){ $where .= "'" . $name . "'" . ", "; }
          $where = rtrim($where, ', ');
          $where .= ")";
        }

        if(sizeof($make) > 0 && sizeof($model) > 0){
          $where .= " AND ";
        }

        if(sizeof($model) > 0){
          $where .= "`Model` IN (";
          foreach ($model as $name){ $where .= "'" . $name . "'" . ", "; }
          $where = rtrim($where, ', ');
          $where .= ")";
        }

        if((sizeof($make) > 0 || sizeof($model) > 0) && sizeof($year) > 0){
          $where .= " AND ";
        }

        if(sizeof($year) > 0){
          $where .= "`Year` IN (";
          foreach ($year as $name){ $where .= "'" . $name . "'" . ", "; }
          $where = rtrim($where, ', ');
          $where .= ")";
        }

        if((sizeof($make) > 0 || sizeof($model) > 0 || sizeof($year) > 0) && isset($price)){
          $where .= " AND ";
        }

        if(isset($price)){
          $where .= "`Price` BETWEEN ";
          $where .= $price;
        }

        $where .= ";";

      //SEARCH BAR FILTER
      }else if ( isset($_POST["submitSearch"]) && isset($_POST["searchInput"]) ){
        $searchInput = trim($_POST["searchInput"]);
        $where = "WHERE LOWER(`Make`) LIKE LOWER('%" . $searchInput . "%') OR LOWER(`Model`) LIKE LOWER('%" . $searchInput . "%');";
      }
      ?>

      <div class="productsListWrapper">

        <!--Generate Products-->
        <?php
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

        if(empty($result)){
          echo "No results match.";
        }
        foreach($result as $car){
          $replacedModel = spaceReplacer($car['Model'], '%20'); //replace spaces with %20 for url
        ?>
        <a href="productdetail.php/?model=<?= $replacedModel ?>">
          <div class="flip-container">
  	        <div class="flipper">
  		        <div class="front">
                <img src="<?= $car['ImgFront'] ?>" alt="Car Front">
  		        </div>
  		        <div class="back">
                <img src="<?= $car['ImgBack'] ?>" alt="Car Back">
  	          </div>
  	        </div>
          </div>
        </a>
        <?php
      } //close foreach loop
        ?>
      </div>

    </div>

    <!--Footer-->
    <?php require "lib/inc/footer.php" ?>

  </body>
</html>
