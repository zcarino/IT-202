<?php
session_start();
if(!isset($_SESSION['user_id'])){
    echo "To see your cart, login.";
    exit();
  }
var_dump($_SESSION['cart']);
$whereIn = implode(',', $_SESSION['cart']);
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


    
</head>

<?php


function get_info(){
    require("config.php");
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting( E_ALL );
    $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
    $db = new PDO($connection_string, $dbuser, $dbpass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $whereIn = implode(',', $_SESSION['cart']);
    $query = ("SELECT * FROM products WHERE product_id IN (".$whereIn.")");
    $stmt = $db->prepare($query);
    $stmt->bindParam(":whereIn", $whereIn, PDO::PARAM_INT);
    $r = $stmt->execute();
    return $stmt->fetchAll();

}
?>

<div class="content-wrapper">
<div class="cart">
    <h1>Shopping Cart</h1>
    <form action="#" method="post">
        <table>
            <thead>
                <tr>
                    <td colspan="2">Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Total</td>
                </tr>
            </thead>
            
<?php
$rows = get_info();
?>

<?php foreach($rows as $index => $row):?>

    
            <tbody>
  <hr>
      <form  method = "post">
          <h4 class="text-inf"><?php echo $row['name'];?></h4>
          <h4 class ="text-inf">$<?php echo $row['price']; ?> </h4>
          <input type="hidden" name="name" value="<?php echo $row['name'];?>"/>
          <input type="hidden" name="price" value="<?php echo $row['price'];?>"/>
          <input type="number" name="quantity" value="1" min="1" max="<?=$row['quantity']?>" placeholder="Quantity" required>
          <input type="hidden" name="product_id" value="<?php echo$row['product_id'];?>"/>

<?php endforeach; ?>
            </tbody>
        
        <div class="subtotal">
            <span class="text">Subtotal</span>
            
        </div>
        <div class="buttons">
            <input type="submit" value="Update" name="update">
            <input type="submit" value="Place Order" name="placeorder">
        </div>
    </form>
</div>
                </div>
                </table>
