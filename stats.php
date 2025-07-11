<?php
// stats.php

// 1. Start session at the very beginning
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Handle POST actions (login, logout, theme toggle) - THIS IS THE MISSING PART
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'logout':
                session_destroy();
                session_start();
                header("Location: home.php");
                exit();
                break;
            case 'toggle_theme':
                $currentTheme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light';
                $newTheme = ($currentTheme === 'light') ? 'dark' : 'light';
                setcookie('theme', $newTheme, time() + (86400 * 30), "/");
                $_COOKIE['theme'] = $newTheme;
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
                break;
        }
    }
}

// Redirect if not logged in (after processing POST actions)
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header("Location: home.php");
    exit();
}

// Retrieve username and theme after all processing
$username = $_SESSION['username'] ?? 'Guest';
$theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light';

// Database connection (keep this as is)
try {
    $pdo = new PDO("mysql:host=localhost;dbname=theakronascension", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->query("SELECT * FROM lbjstats ORDER BY id DESC");
    $stats = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $stats = [];
    error_log("Database Error in stats.php: " . $e->getMessage());
    echo "<p class='error-message'>Could not load statistics. Please try again later.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LeBron Statistics Tracker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="stats.css">
</head>
<body class="<?php echo $theme; ?>-theme">
  <div class="page-container <?php echo $theme; ?>-theme">
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
        <main>
            <section class="hero-section">
                <h2>📊 LeBron's Statistics Tracker</h2>
            </section>
            <section class="stats-grid">
                <?php if (empty($stats)): ?>
                    <p class="no-data-message">No statistics data available. Please check the database connection and 'lbjstats' table.</p>
                <?php else: ?>
                    <?php foreach ($stats as $entry): ?>
                        <div class="stat-card">
                            <h3>Season #<?= htmlspecialchars($entry['id']) ?></h3>
                            <ul>
                                <li><strong>PPG:</strong> <?= htmlspecialchars($entry['ppg']) ?></li>
                                <li><strong>RPG:</strong> <?= htmlspecialchars($entry['rpg']) ?></li>
                                <li><strong>APG:</strong> <?= htmlspecialchars($entry['apg']) ?></li>
                                <li><strong>SPG:</strong> <?= htmlspecialchars($entry['spg']) ?></li>
                                <li><strong>BPG:</strong> <?= htmlspecialchars($entry['bpg']) ?></li>
                                <li><strong>MPG:</strong> <?= htmlspecialchars($entry['mpg']) ?></li>
                                <li><strong>Games Played:</strong> <?= htmlspecialchars($entry['gamesPlayed']) ?></li>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </section>
        </main>
        <footer class="footer">
            <div class="footer-content">
                <p>&copy; 2025 LeBron James Virtual Museum. Honoring greatness.</p>
            </div>
        </footer>
    </div>
</body>
</html>