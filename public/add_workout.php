<?php

require_once __DIR__ . "/../app/view/layout/auth.php";

$date = $_GET["date"] ?? "";

?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Workout</title>
</head>

<body>

<?php include __DIR__ . "/../app/view/layout/navbar.php"; ?>

<h1>Add Workout</h1>

<p>Selected Date: <?= htmlspecialchars($date) ?></p>

</body>

</html>