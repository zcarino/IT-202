<!DOCTYPE html>
<html>
  <head>
    <title>Bakery Site </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link
     rel="stylesheet"
     href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
     integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
      crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="main.css">
    

  </head>
  <body>
  

    <div class="container">
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require("config.php");
    
    $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
    
    try{
      $db = new PDO($connection_string, $dbuser, $dbpass);
      $stmt = $db->prepare("SELECT * from `products`");
      $params = array();
      $stmt->execute($params);
      $results = $stmt->fetch(PDO::FETCH_ASSOC);
      echo var_export($results, true);
    }
    catch(Exception $e){
      echo $e->getMessage();
      exit("It didn't work");
    }

    ?>
    <div class ="col-md-3">
      <form method="post" action="home.php?action=add&id=<?php  $results['id'];?>">
        <div class="products">
          <img src="<?php echo $results['image']; ?> " class="img-responsive" height="350" width="500" />
          <h4 class="text-info"><?php echo $results['name'];?></h4>
          <h4>$ <?php echo $results['price']; ?> </h4>
          <input type="text" name="quantity" class="form-control" value="1"/>
          <input type="hidden" name="name" value="<?php echo $results['name'];?>"/>
          <input type="hidden" name="price" value="<?php echo $results['price'];?>"/>
          <input type="submit" name="add_to_cart" class="btn btn-info"
            value="Add to Cart"/>

        </div>
      </form>

    </div>


      
   </body>
</html>

