<?php
session_start();
?>
<?php include "includes/navbar.php"; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/index.css">
</head>

<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Login</h2>
            <form method="POST" action="index.php">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>

</html>