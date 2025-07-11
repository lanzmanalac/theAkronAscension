<?php
// Connect to MySQL database using PDO
try {
    $pdo = new PDO('mysql:host=localhost;dbname=theakronascension;charset=utf8mb4', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Show errors
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Get all championship paths from the championshippaths table, sorted by year
$stmt = $pdo->query("SELECT * FROM championshippaths ORDER BY year ASC");
$championships = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Function to get the image filename based on the year
function getChampionshipImage($year) {
    $images = [
        '2012' => 'images/2012_championship.jpg',
        '2013' => 'images/2013_championship.jpg',
        '2016' => 'images/2016_championship.jpg',
        '2020' => 'images/2020_championship.jpeg',
    ];
    return $images[$year] ?? 'images/default_championship.jpg';
}

// Function to get team colors and styling
function getTeamStyling($year, $teamColor) {
    $styles = [
        '2012' => ['bg' => 'linear-gradient(135deg, #98002E, #F9A01B)', 'text' => '#FFFFFF'],
        '2013' => ['bg' => 'linear-gradient(135deg, #98002E, #F9A01B)', 'text' => '#FFFFFF'], 
        '2016' => ['bg' => 'linear-gradient(135deg, #FDBB30, #041E42)', 'text' => '#FFFFFF'],
        '2020' => ['bg' => 'linear-gradient(135deg, #FDB927, #552583)', 'text' => '#FFFFFF'],
    ];
    return $styles[$year] ?? ['bg' => '#f39c12', 'text' => '#FFFFFF'];
}

// Ensure theme has a default fallback
$theme = isset($theme) ? $theme : 'light';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>The Climb - LeBron's Championship Paths</title>
  <link rel="stylesheet" href="home.css" />
  <link rel="stylesheet" href="timeline.css" />
  <link rel="stylesheet" href="climb.css" />
</head>
<body class="<?php echo $theme; ?>-theme">

  <?php include 'header.php'; ?>

  <div class="page-container <?php echo $theme; ?>-theme">

    <h1 class="climb-title">THE CLIMB</h1>
    <p class="climb-subtitle">LeBron James' Journey to 4 Championships</p>

    <div class="championships-container">
      <?php foreach($championships as $championship): 
        $styling = getTeamStyling($championship['year'], $championship['team_color']);
      ?>
        <div class="championship-card" 
             data-year="<?= htmlspecialchars($championship['year']) ?>"
             style="background: <?= $styling['bg'] ?>; color: <?= $styling['text'] ?>;">

          <div class="championship-header">
            <div class="year-badge"><?= htmlspecialchars($championship['year']) ?></div>
            <div class="team-name"><?= htmlspecialchars($championship['team']) ?></div>
          </div>

          <img src="<?= getChampionshipImage($championship['year']) ?>" 
               alt="LeBron <?= htmlspecialchars($championship['year']) ?> Championship" 
               class="championship-img" />

          <div class="championship-content">
            <h2 class="championship-title"><?= htmlspecialchars($championship['championship_title']) ?></h2>
            
            <div class="finals-matchup">
              <span class="vs-text">VS</span>
              <span class="opponent"><?= htmlspecialchars($championship['finals_opponent']) ?></span>
              <span class="series-result"><?= htmlspecialchars($championship['series_result']) ?></span>
            </div>

            <div class="path-summary">
              <h3>The Path</h3>
              <p><?= nl2br(htmlspecialchars($championship['path_summary'])) ?></p>
            </div>

            <div class="key-moments">
              <h3>Key Moments</h3>
              <p><?= nl2br(htmlspecialchars($championship['key_moments'])) ?></p>
            </div>

            <div class="lebron-stats">
              <h3>LeBron's Performance</h3>
              <p><?= nl2br(htmlspecialchars($championship['lebron_stats'])) ?></p>
            </div>

            <?php if($championship['finals_mvp']): ?>
            <div class="finals-mvp-badge">
              <span>🏆 FINALS MVP</span>
            </div>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="climb-summary">
      <h2>The Legacy</h2>
      <p>Four championships with three different franchises. Four Finals MVP awards. The only player in NBA history to lead all players in all five major statistical categories in a single Finals series (2016). From the heartbreak of early losses to the ultimate triumph of bringing Cleveland its first championship in 52 years, LeBron's climb to greatness is unmatched in modern basketball.</p>
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

    // Add scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    document.addEventListener('DOMContentLoaded', () => {
        const cards = document.querySelectorAll('.championship-card');
        cards.forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(50px)';
            card.style.transition = 'all 0.6s ease-out';
            observer.observe(card);
        });
    });
  </script>

</body>
</html>