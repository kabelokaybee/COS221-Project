<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brands</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" 
    integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/brand.css"/>
    <link rel="stylesheet" href="css/homepage.css"/>
    <style>
      /* #brand-section {
      background-color: #520101f6;
      padding: 50px;
      background-image: url("img/homepage.jpg");
      background-repeat:no-repeat;
      background-size: cover;
  } */
  </style>
  <script src ="js/Region.js" defer></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<?php 
        // if(isset($_COOKIE['theme'])&& $_COOKIE['theme'] == 'light' && isset($_COOKIE['api_key'])){
        //   echo "<body class='light-theme' onload='BrandsLoad();applyTheme(\"".$_COOKIE['theme']."\")'>";

        // }else{
        //     echo "<body onload='BrandsLoad()'>";
        // }
        echo "<body onload='BrandsLoad()'>";
       ?>
    <!--Navbar-->
    <?php include('./globals/header.php')?>

    <!--Brands-->
    <div class = "Models-Layout">
      <div class="Intro">
            <img id="landing-image" src="img/Winery.jpg" alt="picture of wines">
        </div>
        <div class="filter-box">
               <select id="filter-select-sort"  class="filter-select">
                 <option value="" disabled selected>Sort</option>
                 <option value="ASC" id="SortByModel">Sort By Region (A-Z)</option>
                 <option value="DESC" id="SortByBrand">Sort By Region (Z-A)</option>
               </select>  
        </div>
        <div>
          <button id="Refine" class="refine" onclick="sort()">Refine</button><br>
        </div>
      </div>
    <div class="loading">
      <div class="loading-container"></div>
    </div>    
    <section id="brand-section">
     <div class="brand-wrapper">
      
    </div>
   </section>
   <footer>
      <?php include("./globals/footer.php")?>
   </footer>
</body>
</html>