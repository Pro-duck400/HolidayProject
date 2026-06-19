<?php

require_once __DIR__ . "/../app/view/layout/auth.php";

?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>

    <link rel="stylesheet" href="assets/css/index.css">
</head>

<body>

<?php include __DIR__ . "/../app/view/layout/navbar.php"; ?>

<h1>
    Welcome,
    <?= htmlspecialchars($_SESSION['display_name']) ?>!
</h1>

</body>

</html>