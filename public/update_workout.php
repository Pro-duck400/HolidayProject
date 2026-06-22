<?php

require_once __DIR__ . "/../app/view/layout/auth.php";
require_once __DIR__ . "/../app/view/includes/db.php";

$userId = $_SESSION['user_id'];

$stmt = $conn->prepare("
    UPDATE workouts
    SET
        workout_type_id = ?,
        workout_name = ?,
        distance = ?,
        duration_minutes = ?,
        workout_date = ?,
        notes = ?
    WHERE id = ? AND user_id = ?
");

$stmt->bind_param(
    "isdisisi",
    $_POST['workout_type_id'],
    $_POST['workout_name'],
    $_POST['distance'],
    $_POST['duration_minutes'],
    $_POST['workout_date'],
    $_POST['notes'],
    $_POST['id'],
    $userId
);

$stmt->execute();

header("Location: calendar.php");
exit();