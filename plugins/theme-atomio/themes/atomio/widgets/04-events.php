<?php
defined('MYAAC') or die('Direct access not allowed!');

// Server start time SS
$serverStartTime = strtotime("2024-02-02 6:00:00");

// Config timer
$baseTimers = [
    ['name' => 'Clock 1', 'time' => 4 * 3600], // 4 godziny
    ['name' => 'Clock 2', 'time' => 3 * 3600], // 3 godziny
    ['name' => 'Clock 3', 'time' => 2 * 3600], // 2 godziny
    ['name' => 'Clock 4', 'time' => 1 * 3600], // 1 godzina
];

$timers = [];
$previousEndTime = $serverStartTime;

foreach ($baseTimers as $index => $timer) {
    $startTime = $previousEndTime + 600; // Dodajemy 10 minut przerwy
    $timers[] = [
        'name' => $timer['name'],
        'time' => $timer['time'],
        'start' => $startTime
    ];
    $previousEndTime = $startTime + $timer['time'];
}

// Aktualny czas serwera
$currentServerTime = time();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Countdown</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; padding: 20px; }
        .well { padding: 20px; border-radius: 5px; }
        .header { font-size: 20px; margin-bottom: 10px; font-weight: bold; }
        .table-100 { width: 100%; border-collapse: collapse; }
        .table-100 td { padding: 10px; }
    </style>
</head>
<body>

<div class="well">
    <div class="header">Events</div>
    <div class="body">
        <table class="table-100">
            <?php foreach ($timers as $index => $timer): ?>
                <tr>
                    <td><?= htmlspecialchars($timer['name']) ?></td>
                    <td><i class="fa fa-clock"></i> <span id="timer-<?= $index ?>"></span></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let timers = <?= json_encode($timers) ?>;
        let serverCurrentTime = <?= $currentServerTime ?>; // Aktualny czas serwera w sekundach

        function updateTimer(index, startTime, duration) {
            let now = Math.floor(Date.now() / 1000); // Pobranie aktualnego czasu użytkownika w sekundach
            let elapsedTime = now - startTime;

            let remainingTime = duration - (elapsedTime % duration);

            if (remainingTime < 0) {
                remainingTime = duration;
            }

            let hours = Math.floor(remainingTime / 3600);
            let minutes = Math.floor((remainingTime % 3600) / 60);
            let seconds = remainingTime % 60;

            document.getElementById("timer-" + index).textContent =
                `${hours}h ${minutes}m ${seconds}s`;
        }

        timers.forEach((timer, index) => {
            updateTimer(index, timer.start, timer.time);
            setInterval(() => updateTimer(index, timer.start, timer.time), 1000);
        });
    });
</script>

</body>
</html>
