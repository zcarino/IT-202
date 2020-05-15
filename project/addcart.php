<?php
session_start();

if (empty($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}
array_push($_SESSION['cart'], $_GET['product_id']);
?>
<p>
Product was successfully added to cart.
    <a href="cart.php">View cart</a>
</p>