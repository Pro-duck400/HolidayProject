<?php

require_once __DIR__ . "/../app/view/layout/auth.php";
require_once __DIR__ . "/../app/view/includes/db.php";

$userId = $_SESSION['user_id'];
$id = $_GET["id"] ?? null;

if (!$id) {
    die("Missing workout ID");
}

$stmt = $conn->prepare("
    SELECT *
    FROM workouts
    WHERE id = ? AND user_id = ?
");

$stmt->bind_param("ii", $id, $userId);
$stmt->execute();

$result = $stmt->get_result();
$workout = $result->fetch_assoc();

if (!$workout) {
    die("Workout not found");
}

$types = $conn->query("
    SELECT *
    FROM workout_types
    WHERE user_id = $userId
");

?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Workout</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/calendar.css">
</head>

<body>

    <?php include __DIR__ . "/../app/view/layout/navbar.php"; ?>
    <div class="workout-page">

        <div class="workout-card">
            <h1>Edit Workout</h1>

            <form method="POST" action="update_workout.php">

                <input type="hidden" name="id" value="<?= $workout['id'] ?>">

                <label class="form-label">Name</label>
                <input type="text" name="workout_name"
                    value="<?= htmlspecialchars($workout['workout_name']) ?>">

                <br><br>

                <label>Type</label>
                <select name="workout_type_id">

                    <?php while ($type = $types->fetch_assoc()): ?>

                        <option value="<?= $type['id'] ?>"
                            <?= $type['id'] == $workout['workout_type_id'] ? 'selected' : '' ?>>

                            <?= htmlspecialchars($type['name']) ?>

                        </option>

                    <?php endwhile; ?>

                </select>

                <br><br>

                <label>Distance</label>
                <input type="number" step="0.01" name="distance"
                    value="<?= $workout['distance'] ?>">

                <br><br>

                <label>Duration</label>
                <input type="number" name="duration_minutes"
                    value="<?= $workout['duration_minutes'] ?>">

                <br><br>

                <label>Date</label>
                <input type="date" name="workout_date"
                    value="<?= $workout['workout_date'] ?>">

                <br><br>

                <label>Notes</label>
                <textarea name="notes"><?= htmlspecialchars($workout['notes']) ?></textarea>

                <br><br>

                <div class="action-buttons">

                    <button type="submit" class="btn-save">
                        Save Changes
                    </button>

                    <a href="calendar.php" class="btn-cancel">
                        Cancel
                    </a>

                    <form action="delete_workout.php" method="POST" class="inline-form">

                        <input type="hidden" name="id" value="<?= $workout['id'] ?>">

                        <button
                            type="submit"
                            class="btn-delete"
                            onclick="return confirm('Delete this workout?');">

                            Delete Workout

                        </button>

                    </form>

                </div>
            </form>

        </div>
    </div>

</body>

</html>