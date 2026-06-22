<?php

require_once "../app/view/layout/auth.php";
require_once "../app/view/includes/db.php";

$userId = $_SESSION['user_id'];

$conn->begin_transaction();

/*
-----------------------------------
1. Determine workout type
-----------------------------------
*/

$workoutTypeId = $_POST['workout_type_id'] ?? null;
$newTypeName = $_POST['new_type_name'] ?? null;
$newTypeColor = $_POST['new_type_color'] ?? '#2196f3';

/*
-----------------------------------
2. If user created a new type
-----------------------------------
*/

if (!empty($newTypeName)) {

    $stmt = $conn->prepare("
        INSERT INTO workout_types (user_id, name, color)
        VALUES (?, ?, ?)
    ");

    $stmt->bind_param(
        "iss",
        $userId,
        $newTypeName,
        $newTypeColor
    );

    $stmt->execute();

    $workoutTypeId = $conn->insert_id;
}

/*
-----------------------------------
3. Validate
-----------------------------------
*/

if (empty($workoutTypeId)) {
    die("Please select or create a workout type.");
}

/*
-----------------------------------
4. Insert workout
-----------------------------------
*/

$stmt = $conn->prepare("

INSERT INTO workouts (
    user_id,
    workout_type_id,
    workout_name,
    distance,
    duration_minutes,
    workout_date,
    notes
)
VALUES (?, ?, ?, ?, ?, ?, ?)

");

$stmt->bind_param(
    "iisdiss",
    $userId,
    $workoutTypeId,
    $_POST['workout_name'],
    $_POST['distance'],
    $_POST['duration_minutes'],
    $_POST['workout_date'],
    $_POST['notes']
);

$stmt->execute();

/*
-----------------------------------
5. Commit + redirect
-----------------------------------
*/

$conn->commit();

header("Location: calendar.php");
exit();