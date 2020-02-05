<html>
    <head>
        <title>My Project - Register</title>
    </head>
    <body>
        <form method = "POST">
            <input type="text" name="MyFirstInput"/>
            <input type="submit" value="Click it?"/>
            
        </form>
        
    </body>
</html>
<?php

if(!empty($_REQUEST)){
    echo "Request:<pre>" . var_export($_REQUEST, true) . "</pre>";
    
if(!empty($_GET)){
    echo "GET:<pre>" . var_export($_GET, true) . "</pre>";
}
if(!empty($_POST)){
    echo "POST:<pre>" . var_export($_POST, true) . "</pre>";
}
?>