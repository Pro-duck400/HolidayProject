<?php

require_once __DIR__ . "/../app/view/layout/auth.php";

$id = $_GET["id"] ?? "";

?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Workout</title>
</head>

<body>

<?php include __DIR__ . "/../app/view/layout/navbar.php"; ?>

<h1>Edit Workout</h1>

<p>Workout ID: <?= htmlspecialchars($id) ?></p>

</body>

</html>