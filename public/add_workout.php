<?php

require_once "../app/view/layout/auth.php";
require_once "../app/view/includes/db.php";

$date = $_GET['date'] ?? date('Y-m-d');

$types = $conn->query(
    "
    SELECT *
    FROM workout_types
    WHERE user_id = " . $_SESSION['user_id']
);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Workout</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/calendar.css">
</head>

<body>

    <?php include "../app/view/layout/navbar.php"; ?>
    <div class="workout-page">

        <div class="workout-card">

            <h1>Add Workout</h1>

            <form action="save_workout.php" method="POST">

                <label class="form-label">Workout Name</label>

                <input
                    type="text"
                    name="workout_name"
                    required>

                <br><br>
                <label>Workout Type</label>

                <select name="workout_type_id">
                    <option value="">-- Select Existing --</option>

                    <?php while ($type = $types->fetch_assoc()): ?>
                        <option value="<?= $type['id'] ?>">
                            <?= htmlspecialchars($type['name']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <br><br>
                <label>OR Create New Workout Type?</label>
                <div class="new-type-row">

                    <input
                        type="text"
                        name="new_type_name"
                        placeholder="New type name">

                    <input
                        type="color"
                        class="color-picker"
                        name="new_type_color"
                        value="#2196f3">

                </div>

                <br><br>

                <label>Distance (km)</label>

                <input
                    type="number"
                    step="0.01"
                    name="distance">

                <br><br>

                <label>Duration (minutes)</label>

                <input
                    type="number"
                    name="duration_minutes">

                <br><br>

                <label>Date</label>

                <input
                    type="date"
                    name="workout_date"
                    value="<?= $date ?>">

                <br><br>

                <label>Notes</label>

                <textarea name="notes"></textarea>

                <br><br>

                <button type="submit">

                    Save Workout

                </button>

            </form>
        </div>
    </div>

</body>

</html>