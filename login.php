<?php 
    include("config.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Log In</title>
</head>

<body>
    <div class="login-container">
        <header>
            <h3>Log In</h3>
            <h6>Welcome My Website</h6>
        </header>
        <form class="login-form" action="config.php" method="post">
            <label>Username/Email</label>
            <br>
            <input type="text" name="username" autocomplete="on">
            <br>
            <label>Password</label>
            <br>
            <input type="password" name="password">
            <br>
            <input type="submit" value="Login" class="btn">
        </form>
    </div>
    
</body>

</html>