<?php

require_once __DIR__ . "/../app/view/layout/auth.php";

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

                initialView: 'timeGridWeek',

                selectable: true,

                editable: true,

                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },

                events: [

                    {
                        id: 1,
                        title: '5km Run',
                        start: '2026-01-13'
                    },

                    {
                        id: 2,
                        title: 'Gym Session',
                        start: '2026-01-15'
                    }

                ],

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