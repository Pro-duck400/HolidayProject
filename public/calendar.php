<?php

require_once __DIR__ . "/../app/view/layout/auth.php";
require_once "../app/view/includes/db.php";

$events = [];

$query = "

SELECT

    workouts.id,

    workouts.workout_name,

    workouts.workout_date,

    workout_types.color

FROM workouts

JOIN workout_types

ON workouts.workout_type_id =
    workout_types.id

WHERE workouts.user_id = ?

";

$stmt = $conn->prepare($query);

$stmt->bind_param(
    "i",
    $_SESSION['user_id']
);

$stmt->execute();

$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {

    $events[] = [

        "id" => $row["id"],

        "title" => $row["workout_name"],

        "start" => $row["workout_date"],

        "color" => $row["color"]

    ];
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Calendar</title>

    <link rel="stylesheet" href="assets/css/calendar.css">
    <link rel="stylesheet" href="assets/css/index.css">

    <!-- FullCalendar -->
    <link
        href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.css"
        rel="stylesheet">

    <script
        src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.js">
    </script>

</head>

<body>

    <?php include __DIR__ . "/../app/view/layout/navbar.php"; ?>

    <div id="calendar"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const calendarEl = document.getElementById('calendar');

            const calendar = new FullCalendar.Calendar(calendarEl, {

                initialView: 'dayGridMonth',

                selectable: true,

                editable: true,

                headerToolbar: {
                    left: 'prev,next today',
                    right: 'title',
                },
                events: <?= json_encode($events) ?>,

                dateClick: function(info) {

                    window.location =
                        "add_workout.php?date=" +
                        info.dateStr;
                },

                eventClick: function(info) {

                    window.location =
                        "edit_workout.php?id=" +
                        info.event.id;
                }

            });

            calendar.render();

        });
    </script>

</body>

</html>