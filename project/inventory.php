<?php
session_start();
if ($_SESSION['user_admin'] == 0){
  echo "Access Denied.";
  exit();
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Bakery Home </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <link rel="stylesheet" href="main.css">
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>



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
        <li><a href='login.php' >Login</a></li>
      <?php } ?>

        <li><a href='profile.php'>Profile</a></li>
        <li><a href='cart.php'>Cart</a></li>
      </ul>
      
      
    </nav>

    <section class="index-banner1">
    </section>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Inventory</h2>
                    </div>
                    <?php
                    error_reporting( E_ALL );
                    ini_set( 'display_errors', 1 );             
                    require("config.php");                                   
                    $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
                    $db = new PDO($connection_string, $dbuser, $dbpass);
                    $query = "SELECT * FROM products";
                    if($result = $db->query($query)){
                        if($result->rowCount() > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Price</th>";
                                        
                                        echo "<th>Delete Product</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch()){
                                    echo "<tr>";
                                        echo "<td>" . $row['product_id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['price'] . "</td>";
                              
                                        echo "<td>";
                                            
                                            echo "<a href='delete.php?id=". $row['product_id'] ."' title='Delete Record' data-toggle='tooltip'><span aria-hidden='true'>&times;</span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            unset($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
                    }
                    unset($db);
                    ?>
                </div>
            </div>        
        </div>
    </div>
    


    <div style="text-align:center;">
        <h4>Insert Products</h4>
        <form action="inventory.php" method="post">
            <p>
                <label for="firstName">Product Name:</label>
                <input type="text" name="name" id="ProductName">
            </p>
            <p>
                <label for="ProductPrice">Product Price:</label>
                <input type="text" name="price" id="ProductPrice">
            </p>
            <p>
                <label for="ProductImage">Product Image:</label>
                <input type="text" name="image" id="ProductImage">
            </p>
            <input type="submit" value="Submit">
        </form>
    </div>
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

  try{
      require("config.php");
    
      error_reporting(E_ALL);
      $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
      $db = new PDO($connection_string, $dbuser, $dbpass);
    
    
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e){
      die("ERROR: Could not connect. " . $e->getMessage());
}
 

  try{
    
      $sql = "INSERT INTO products (name, image, price) VALUES (:name, :image, :price)";
      $stmt = $db->prepare($sql);
    
    
      $stmt->bindParam(':name', $_REQUEST['name']);
    $stmt->bindParam(':price', $_REQUEST['price']);
    $stmt->bindParam(':image', $_REQUEST['image']);
    
    
      $stmt->execute();
      echo "Product inserted successfully.";
  } catch(PDOException $e){
      die("ERROR: Could not able to execute $sql. " . $e->getMessage());
  }
  unset($db);
?>
