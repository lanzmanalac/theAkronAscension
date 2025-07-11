<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Check login status
$isLoggedIn = isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true;

// Handle form actions (login, logout, theme toggle)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'login':
                // In a real application, you'd validate credentials against a database here.
                if (!empty($_POST['username']) && !empty($_POST['password'])) {
                    // For demonstration: assume successful login
                    $_SESSION['user_logged_in'] = true;
                    $_SESSION['username'] = htmlspecialchars($_POST['username']); // Sanitize username
                    $isLoggedIn = true;
                }
                break;

            case 'logout':
                session_destroy();
                // Optionally regenerate session ID to prevent session fixation after destroy
                session_start(); // Start new session after destroying old one
                $isLoggedIn = false;
                // Redirect to home or current page to reflect logout status and clear POST data
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
                break;

            case 'toggle_theme':
                $currentTheme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light';
                $newTheme = ($currentTheme === 'light') ? 'dark' : 'light';
                // Set cookie for 30 days
                setcookie('theme', $newTheme, time() + (86400 * 30), "/");
                // Update $_COOKIE superglobal immediately for current request
                $_COOKIE['theme'] = $newTheme;
                // Redirect to self to prevent form resubmission on refresh
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
                break;
        }
    }
}

// Determine theme (default to light, or use cookie value)
$theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light';

// Check login status AFTER potential logout
// This handles cases where user logs out from a different page and lands here.
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
}

// Ensure username is set if logged in
$username = $isLoggedIn ? htmlspecialchars($_SESSION['username']) : 'Guest'; // Default for display


// --- Database Connection (No change needed) ---
try {
    $pdo = new PDO('mysql:host=localhost;dbname=theakronascension;charset=utf8mb4', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Show errors
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Get all events from the lbjtimeline table, sorted by year (No change needed)
$stmt = $pdo->query("SELECT * FROM lbjtimeline ORDER BY year ASC");
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Function to get the image filename based on the year (No change needed)
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

// Function to set border and text color per event based on year/team (No change needed)
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
  <div class="page-container <?php echo $theme; ?>-theme">
        <!-- Header -->
        <header class="header">
            <div class="nav-container">
                <div class="logo">
                    <h1>The King's Legacy</h1>
                    <span class="tagline">The LeBron James Museum</span>
                </div>

                <nav class="main-nav">
                    <a href="home.php" class="nav-link">Back to Home</a>
                    <a href="exhibits.php" class="nav-link">Exhibits</a>
                    <a href="milestones.php" class="nav-link">Milestones</a>
                    <a href="teammate&rival.php" class="nav-link">Teammates</a>
                    <a href="rivalries.php" class="nav-link">Rivalries</a>
                    <a href="fanwall.php" class="nav-link">Fan Wall</a>
                </nav>

                <div class="header-controls">
                    <form method="POST" class="theme-toggle-form">
                        <input type="hidden" name="action" value="toggle_theme">
                        <button type="submit" class="theme-toggle-btn" title="Toggle Theme">
                            <?= $theme === 'light' ? '🌙' : '☀️'; ?>
                        </button>
                    </form>

                    <div class="user-profile">
                        <span class="welcome-msg">Hi, <?= htmlspecialchars($username); ?></span>
                        <form method="POST" class="logout-form">
                            <input type="hidden" name="action" value="logout">
                            <button type="submit" class="logout-btn">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

    <h1 class="timeline-title">LeBron James NBA Career Timeline</h1>

    <div class="timeline-container">
      <?php foreach($events as $event): ?>
        <div class="timeline-event <?= $event['year'] ? 'featured' : '' ?>"
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

  <?php // No specific footer provided, assuming it's also included or part of the main layout. ?>
  <?php // If you have a footer.php, include it here. ?>

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