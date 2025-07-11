<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check login status
$isLoggedIn = isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true;

// Handle theme toggle, login, logout
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'login':
            if (!empty($_POST['username']) && !empty($_POST['password'])) {
                $_SESSION['user_logged_in'] = true;
                $_SESSION['username'] = htmlspecialchars($_POST['username']);
                $isLoggedIn = true;
            }
            break;
        case 'logout':
            session_destroy();
            session_start();
            $isLoggedIn = false;
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        case 'toggle_theme':
            $currentTheme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light';
            $newTheme = $currentTheme === 'light' ? 'dark' : 'light';
            setcookie('theme', $newTheme, time() + (86400 * 30), "/");
            $_COOKIE['theme'] = $newTheme;
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
    }
}

// Determine theme
$theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light';

// Username display
$username = $isLoggedIn ? htmlspecialchars($_SESSION['username']) : 'Guest';

// Database connection
try {
    $pdo = new PDO('mysql:host=localhost;dbname=theakronascension;charset=utf8mb4', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Get championship runs
$stmt = $pdo->query("SELECT * FROM championshippaths ORDER BY year ASC");
$championships = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Image per year
function getChampionshipImage($year) {
    $images = [
        '2012' => 'images/2012_championship.jpg',
        '2013' => 'images/2013_championship.jpg',
        '2016' => 'images/2016_championship.jpg',
        '2020' => 'images/2020_championship.jpeg',
    ];
    return $images[$year] ?? 'images/default_championship.jpg';
}

// Color styling per team/year
function getTeamStyling($year, $teamColor) {
    $styles = [
        '2012' => ['bg' => 'linear-gradient(135deg, #98002E, #F9A01B)', 'text' => '#FFFFFF'],
        '2013' => ['bg' => 'linear-gradient(135deg, #98002E, #F9A01B)', 'text' => '#FFFFFF'], 
        '2016' => ['bg' => 'linear-gradient(135deg, #FDBB30, #041E42)', 'text' => '#FFFFFF'],
        '2020' => ['bg' => 'linear-gradient(135deg, #FDB927, #552583)', 'text' => '#FFFFFF'],
    ];
    return $styles[$year] ?? ['bg' => $teamColor, 'text' => '#FFFFFF'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>The Climb - LeBron’s Championships</title>
  <link rel="stylesheet" href="home.css" />
  <link rel="stylesheet" href="climb.css" />
</head>
<body class="<?= $theme; ?>-theme">
  <div class="page-container <?= $theme; ?>-theme">
    <!-- Header -->
    <header class="header <?= $theme; ?>-theme">
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
                <?php if ($isLoggedIn): ?>
                    <a href="fanwall.php" class="nav-link">Fan Wall</a>
                <?php endif; ?>
            </nav>

            <div class="header-controls">
                <form method="POST" class="theme-toggle-form">
                    <input type="hidden" name="action" value="toggle_theme">
                    <button type="submit" class="theme-toggle-btn" title="Toggle Theme">
                        <?= $theme === 'light' ? '🌙' : '☀️'; ?>
                    </button>
                </form>

                <?php if ($isLoggedIn): ?>
                    <div class="user-profile">
                        <span class="welcome-msg">Hi, <?= $username; ?></span>
                        <form method="POST" class="logout-form">
                            <input type="hidden" name="action" value="logout">
                            <button type="submit" class="logout-btn">Logout</button>
                        </form>
                    </div>
                <?php else: ?>
                    <button class="login-btn" onclick="toggleLogin()">Login</button>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <main class="climb-main">
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

                </div> <!-- .championship-content -->
            </div>
        <?php endforeach; ?>
        </div>

        <div class="climb-summary">
            <h2>The Legacy</h2>
            <p>Four championships with three different franchises. Four Finals MVP awards. The only player in NBA history to lead all players in all five major statistical categories in a single Finals series (2016). From the heartbreak of early losses to the ultimate triumph of bringing Cleveland its first championship in 52 years, LeBron's climb to greatness is unmatched in modern basketball.</p>
        </div>
    </main>
  </div>

  <script>
    function toggleLogin() {
        const modal = document.getElementById('loginModal');
        modal.style.display = modal.style.display === 'block' ? 'none' : 'block';
    }

    window.onclick = function(event) {
        const modal = document.getElementById('loginModal');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    }
  </script>
</body>
</html>
