<?php
session_start();
include("function.php");
echo "<pre>" . var_export($_SESSION, true) . "</pre>;

echo "User is logged in: " . is_logged_in();
echo "<br>";
echo "User is admin: " . is_admin();
?>