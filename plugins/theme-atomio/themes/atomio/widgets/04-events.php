<?php
defined('MYAAC') or die('Direct access not allowed!');
// Timer configuration (easily adjustable times)
$timers = [
    ['name' => 'Clock 1', 'time' => 4 * 3600], // 4 hours
    ['name' => 'Clock 2', 'time' => 3 * 3600], // 3 hours
    ['name' => 'Clock 3', 'time' => 2 * 3600], // 2 hours
    ['name' => 'Clock 4', 'time' => 1 * 3600], // 1 hour
];
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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body { 
            font-family: Arial, sans-serif; 
            margin: 0; 
            padding: 20px;
        }

        .well { 
            padding: 20px; 
            border: none; 
            border-radius: 5px; 
        }

        .header { 
            font-size: 20px; 
            margin-bottom: 10px; 
            font-weight: bold; 
        }

        .status { 
            margin-bottom: 10px; 
            font-weight: bold; 
        }

        .table-100 { 
            width: 100%; 
            border-collapse: collapse; 
        }

        .table-100 td { 
            padding: 10px; 
        }
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

        timers.forEach((timer, index) => {
            let storageKey = "timer_" + index;
            let now = Math.floor(Date.now() / 1000);
            let startTime = localStorage.getItem(storageKey);

            if (!startTime || now - startTime >= timer.time) {
                startTime = now;
                localStorage.setItem(storageKey, startTime);
            }

            function updateTimer() {
                let currentTime = Math.floor(Date.now() / 1000);
                let elapsedTime = currentTime - startTime;
                let remainingTime = timer.time - (elapsedTime % timer.time);

                let hours = Math.floor(remainingTime / 3600);
                let minutes = Math.floor((remainingTime % 3600) / 60);
                let seconds = remainingTime % 60;

                document.getElementById("timer-" + index).textContent = 
                    `${hours}h ${minutes}m ${seconds}s`;
            }

            setInterval(updateTimer, 1000);
            updateTimer();
        });
    });
</script>

</body>
</html>
