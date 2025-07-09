<?php
// Connect to MySQL database using PDO
try {
    $pdo = new PDO('mysql:host=localhost;dbname=theakronascension;charset=utf8mb4', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Show errors
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Get all events from the lbjtimeline table, sorted by year
$stmt = $pdo->query("SELECT * FROM lbjtimeline ORDER BY year ASC");
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Function to get the image filename based on the year
function getImage($year) {
    $images = [
        '2003' => 'images/2003.jpg',
        '2010' => 'images/2010.jpg',
        '2012' => 'images/2012.jpg',
        '2013' => 'images/2013.jpg',
        '2016' => 'images/2016.jpg',
        '2018' => 'images/2018.jpg',
        '2020' => 'images/2020.jpg',
    ];
    return $images[$year] ?? 'images/default.jpg';
}

// Function to set border and text color per event based on year/team
function getBorderColor($year) {
    $colors = [
        '2003' => '#6F263D', // Cavs
        '2010' => '#98002E', // Heat
        '2012' => '#98002E', // Heat
        '2013' => '#98002E', // Heat
        '2016' => '#FDBB30', // Cavs (gold)
        '2018' => '#552583', // Lakers (purple)
        '2020' => '#FDB927', // Lakers (gold)
    ];
    return $colors[$year] ?? '#f39c12'; // fallback
}

// Ensure theme has a default fallback
$theme = isset($theme) ? $theme : 'light';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>LeBron James Timeline</title>
  <link rel="stylesheet" href="home.css" />
  <link rel="stylesheet" href="timeline.css" />
</head>
<body class="<?php echo $theme; ?>-theme">

  <?php include 'header.php'; ?>

  <div class="page-container <?php echo $theme; ?>-theme">

    <h1 class="timeline-title">LeBron James NBA Career Timeline</h1>

    <div class="timeline-container">
      <?php foreach($events as $event): ?>
        <div class="timeline-event <?= $event['year']  ? 'featured' : '' ?>" 
             data-year="<?= htmlspecialchars($event['year']) ?>" 
             style="border-left: 6px solid <?= getBorderColor($event['year']) ?>;">

          <img src="<?= getImage($event['year']) ?>" 
               alt="LeBron <?= htmlspecialchars($event['year']) ?> - <?= htmlspecialchars($event['title']) ?>" 
               class="event-img" />

          <h3 style="color: <?= getBorderColor($event['year']) ?>;">
            <?= htmlspecialchars($event['year']) ?> — <?= htmlspecialchars($event['title']) ?>
          </h3>

          <p><?= nl2br(htmlspecialchars($event['description'])) ?></p>
        </div>
      <?php endforeach; ?>
    </div>

  </div>

  <script>
    // Login modal toggle from header.php
    function toggleLogin() {
        const modal = document.getElementById('loginModal');
        modal.style.display = modal.style.display === 'block' ? 'none' : 'block';
    }

    // Close login modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('loginModal');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    }
  </script>

</body>
</html>
