<?php require "./lib/inc/cookie.php"; ?>

<header id="header">
  <?php
  function selected($current){
    $url =  "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
    $selectUrl = "localhost:8888/PHPDealership/" . $current . ".php";
    if ($url == $selectUrl) {
      echo "class='selected'";
    }
  }
  ?>

  <a class="h1link" href="http://localhost:8888/PHPDealership/index.php"><h1>Mickey's Imports</h1></a>

  <div id="openNavButton"></div>

  <nav id="navbar">
    <ul>
      <li class="index"><a <?php selected("index"); ?> href="http://localhost:8888/PHPDealership/index.php">Home</a></li>

      <li class="products"><a <?php selected("products"); ?> href="http://localhost:8888/PHPDealership/products.php">Inventory</a></li>

      <li class="reserved"><a <?php selected("reserved"); ?> href="http://localhost:8888/PHPDealership/reserved.php">Reserved</a></li>

      <li class="contact"><a <?php selected("contact"); ?> href="http://localhost:8888/PHPDealership/contact.php">Contact</a></li>

      <li><p class="search">Search</p>
        <div class="searchDropdown scrolled">
          <form method="post" action="products.php">
            <input class="searchField" name="searchInput" type="text" placeholder="Make or Model">
            <input id="submitSearchButton" type="submit" name="submitSearch">
          </form>
        </div>
      </li>
    </ul>
  </nav>

</header>
