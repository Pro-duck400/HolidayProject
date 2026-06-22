<?php

require_once __DIR__ . "/../app/view/layout/auth.php";
require_once __DIR__ . "/../app/view/includes/db.php";

$userId = $_SESSION['user_id'];

$id = $_POST['id'] ?? null;

if (!$id) {
    die("Workout ID missing.");
}

$stmt = $conn->prepare("
    DELETE FROM workouts
    WHERE id = ?
    AND user_id = ?
");

$stmt->bind_param(
    "ii",
    $id,
    $userId
);

$stmt->execute();

header("Location: calendar.php");
exit();