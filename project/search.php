<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Bakery Home </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="main.css">



  </head>
  <body>
    <nav>
      <div class="Name">
        <h4><a href="https://web.njit.edu/~zjc6/IT-202/project/home.php">Bakery</h4>
      </div>
      <ul class="nav-links">
      <?php if(isset($_SESSION['user_id'])){?>
        <li><a href='logout.php' >Logout</a></li>
      <?php }else{ ?>
        <li><a href='login.php'>Login</a></li>
      <?php } ?>

        <li><a href='profile.php'>Profile</a></li>
        <li><a href='cart.php'>Cart</a></li>
      </ul>
      
      
    </nav>
    <div class="content-wrapper">

    <section class="index-banner">
    </section>

    
</head>
<body>
    
    
    

  <div class="dropdown show">
    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Sort By
    </a>

    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
      <a class="dropdown-item" href="search.php?sort=asc">Lowest Price</a>
      <a class="dropdown-item" href="search.php?sort=desc">Highest Price</a>
    </div>
  </div>

  <form method = "post" action="home.php" >
      <input type="text" name="name" id="name" >
      <button type="submit"  name="name">Search</button>
  </form> 
  <hr>
<?php

function get_items(){
      ini_set('display_errors', 1);
      ini_set('display_startup_errors', 1);
      error_reporting(E_ALL);
      require("config.php");
      $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
      $db = new PDO($connection_string, $dbuser, $dbpass);
      $query = "SELECT product_id, name, image, price from products";
      if (isset($_POST['sub']))
      {
        if(!empty($_POST['name'])){

        
          $name = $_POST['name'];
          $query .= " WHERE name LIKE :name";  
          $stmt = $db->prepare($query);
          $stmt->bindvalue(':name', '%' . $name . '%', PDO::PARAM_STR);
          $name = $_POST['name'];
          $r = $stmt->execute();
          return $stmt->fetchAll();
          
        }
      }

        elseif ($_GET['sort'] == 'asc')
        {
            $query .= " ORDER BY price ASC";
        }
        elseif ($_GET['sort'] == 'desc')
        {
            $query .= " ORDER BY price DESC";
        }
      



      $stmt = $db->prepare($query);
      $r = $stmt->execute();
      return $stmt->fetchAll();
    }
?>


<?php
$rows = get_items();
?>

<?php foreach($rows as $index => $row):?>

    
    
    <hr>  
      <form method="post" action="home.php?action=add&id=<?php  $row['product_id'];?>">
      
        <div class="products">
          <img src="<?php echo $row['image']; ?> " class="img-responsive" height="350" width="500" />
          <h4 class="text-inf"><?php echo $row['name'];?></h4>
          <h4 class ="text-inf">$<?php echo $row['price']; ?> </h4>
          <input type="hidden" name="name" value="<?php echo $row['name'];?>"/>
          <input type="hidden" name="price" value="<?php echo $row['price'];?>"/>
          <input type="number" name="quantity" value="1" min="1" max="<?=$row['quantity']?>" placeholder="Quantity" required>
          <input type="hidden" name="product_id" value="<?php echo$row['product_id'];?>"/>
          <input type="submit" name="add_to_cart" class="btn btn-secondary"
            value="Add to Cart"/>

<?php endforeach; ?>
        </div>
      </form>
    
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </div>
   </body>
</html>
