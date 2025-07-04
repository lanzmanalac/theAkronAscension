<?php
// Connect to MySQL database using PDO
try {
    $pdo = new PDO('mysql:host=localhost;dbname=LJ_Tmln;charset=utf8mb4', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Show errors
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Get all events from the lebron_timeline table, sorted by year
$stmt = $pdo->query("SELECT * FROM lebron_timeline ORDER BY year ASC");
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Function to get the image filename based on the year
function getImage($year) {
    $images = [
        '2003' => 'images/2003.jpg',
        '2010' => 'images/2010.jpg',
        '2012' => 'images/2012.jpg',
        '2016' => 'images/2016.jpg',
        '2018' => 'images/2018.jpg',
        '2020' => 'images/2020.jpg',
        // You can add more images for new years here
    ];
    // If year not found, return default image
    return $images[$year] ?? 'images/default.jpg';
}

// Function to set border and text color per event based on year/team
function getBorderColor($year) {
    $colors = [
        '2003' => '#6F263D', // Cavs (wine)
        '2010' => '#98002E', // Heat (red)
        '2012' => '#98002E', // Heat (red)
        '2016' => '#FDBB30', // Cavs (gold)
        '2018' => '#552583', // Lakers (purple)
        '2020' => '#FDB927', // Lakers (gold)
        // Add more color codes for new years if needed
    ];
    return $colors[$year] ?? '#f39c12'; // fallback color if not listed
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>LeBron James Timeline</title>
  <style>
    /* General page reset */
    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 40px 20px;

      /* Background gradient showing transition through teams */
      background: linear-gradient(to right,
                  #6F263D 0%,     /* Cavs */
                  #FDBB30 20%,    /* Cavs Gold */
                  #98002E 40%,    /* Heat */
                  #000000 55%,    /* Heat Black */
                  #552583 75%,    /* Lakers */
                  #FDB927 100%    /* Lakers Gold */
      );
      background-attachment: fixed;
      background-repeat: no-repeat;
      background-size: cover;
      color: #fff;
    }

    /* Page title */
    h2.timeline-title {
      text-align: center;
      font-size: 2.2rem;
      color: #fff;
      margin-bottom: 30px;
      text-shadow: 1px 1px 3px rgba(0,0,0,0.5); /* shadow for readability */
    }

    /* Timeline container holding all event cards horizontally */
    .timeline-container {
      display: flex;
      overflow-x: auto; /* allow horizontal scroll */
      gap: 20px;
      padding: 20px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      scroll-snap-type: x mandatory; /* better scroll snapping */
    }

    /* Each event block/card */
    .timeline-event {
      flex: 0 0 280px;
      background: #ffffff;
      color: #333;
      padding: 20px;
      border-radius: 16px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.07);
      scroll-snap-align: start;
      transition: transform 0.3s ease; /* animation on hover */
    }

    /* Slight raise effect on hover */
    .timeline-event:hover {
      transform: translateY(-5px);
    }

    /* Event title (year + event) */
    .timeline-event h3 {
      margin: 0 0 10px;
      font-size: 18px;
      transition: color 0.3s ease;
    }

    /* Event description */
    .timeline-event p {
      font-size: 14px;
      line-height: 1.6;
    }

    /* Scrollbar styling (horizontal) */
    .timeline-container::-webkit-scrollbar {
      height: 10px;
    }
    .timeline-container::-webkit-scrollbar-thumb {
      background-color: #bbb;
      border-radius: 5px;
    }
    .timeline-container::-webkit-scrollbar-track {
      background: #eee;
    }

    /* Responsive adjustments for small screens */
    @media (max-width: 600px) {
      .timeline-container {
        gap: 15px;
      }
      .timeline-event {
        flex: 0 0 90%; /* cards take more space on mobile */
      }
    }

    /* Event image styling */
    .event-img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 12px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>

  <!-- Main title -->
  <h2 class="timeline-title">LeBron James NBA Career Timeline</h2>

  <!-- Container for all events -->
  <div class="timeline-container">
    <?php foreach($events as $event): ?>
      <!-- Each timeline card -->
      <div class="timeline-event" style="border-left: 6px solid <?= getBorderColor($event['year']) ?>;">
        <!-- Event image based on year -->
        <img src="<?= getImage($event['year']) ?>" alt="LeBron <?= htmlspecialchars($event['year']) ?>" class="event-img">
        
        <!-- Title with dynamic color based on team -->
        <h3 style="color: <?= getBorderColor($event['year']) ?>;">
          <?= htmlspecialchars($event['year']) ?> — <?= htmlspecialchars($event['title']) ?>
        </h3>

        <!-- Description text -->
        <p><?= nl2br(htmlspecialchars($event['description'])) ?></p>
      </div>
    <?php endforeach; ?>
  </div>

</body>
</html>
