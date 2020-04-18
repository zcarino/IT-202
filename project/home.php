<!DOCTYPE html>
<html>
  <head>
    <title>My Bakery Site </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="main.css">


  </head>
  <body>
    <nav>
      <div class="Name">
        <h4>The Bakery</h4>
      </div>
      <ul class="nav-links">
        <li><a href='#'>Sign in</a></li>
        <li><a href='#'>Contact</a></li>
        <li><a href='#'>About</a></li>
      </ul>
      
      
    </nav>
    <section class="index-banner">


    </section>

    </main>
  

    <div class="container">
<?php

function get_items(){
      ini_set('display_errors', 1);
      ini_set('display_startup_errors', 1);
      error_reporting(E_ALL);
      require("config.php");
      $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
      $db = new PDO($connection_string, $dbuser, $dbpass);
      $query = "SELECT product_id, name, image, price from products";
      $stmt = $db->prepare($query);
      $r = $stmt->execute();
      return $stmt->fetchAll();
    }
?>
<?php
$rows = get_items();
?>
<?php foreach($rows as $index => $row):?>
    
    <div class ="col-md-3">
      <form method="post" action="home.php?action=add&id=<?php  $row['product_id'];?>">
      <hr/>
        <div class="products">
          <img src="<?php echo $row['image']; ?> " class="img-responsive" height="350" width="500" />
          <h4 class="text-info"><?php echo $row['name'];?></h4>
          <h4 class ="text-info">$<?php echo $row['price']; ?> </h4>
          <input type="text" name="quantity" class="form-control" value="1"/>
          <input type="hidden" name="name" value="<?php echo $row['name'];?>"/>
          <input type="hidden" name="price" value="<?php echo $row['price'];?>"/>
          <input type="submit" name="add_to_cart" class="btn btn-info"
            value="Add to Cart"/>
<?php endforeach; ?>
        </div>
      </form>
    
    </div>


      
   </body>
</html>

