<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Login status
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

// Theme and username
$theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light';
$username = $isLoggedIn ? htmlspecialchars($_SESSION['username']) : 'Guest';

// DB Connection
try {
    $pdo = new PDO('mysql:host=localhost;dbname=theakronascension;charset=utf8mb4', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Get milestones
$stmt = $pdo->query("SELECT * FROM career_milestones ORDER BY date_achieved ASC");
$milestones = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Styling
function getSignificanceStyling($significanceLevel) {
    $styles = [
        'Historic' => ['bg' => 'linear-gradient(135deg, #3498db, #2980b9)', 'text' => '#FFFFFF', 'badge' => '#3498db'],
        'Major' => ['bg' => 'linear-gradient(135deg, #e74c3c, #c0392b)', 'text' => '#FFFFFF', 'badge' => '#e74c3c'],
        'Legendary' => ['bg' => 'linear-gradient(135deg, #f39c12, #e67e22)', 'text' => '#FFFFFF', 'badge' => '#f39c12'],
        'GOAT-Level' => ['bg' => 'linear-gradient(135deg, #9b59b6, #8e44ad)', 'text' => '#FFFFFF', 'badge' => '#9b59b6']
    ];
    return $styles[$significanceLevel] ?? $styles['Historic'];
}

function getCategoryIcon($category) {
    $icons = [
        'Scoring' => '🎯', 'Championships' => '🏆', 'Records' => '📊',
        'Historic Moments' => '⭐', 'Social Impact' => '🌍', 'Legacy' => '👑'
    ];
    return $icons[$category] ?? '🏀';
}

function formatMilestoneDate($date) {
    return date('F j, Y', strtotime($date));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Career Milestones - Defining Basketball History</title>
    <link rel="stylesheet" href="home.css" />
    <link rel="stylesheet" href="timeline.css" />
    <link rel="stylesheet" href="milestones.css" />
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
                <a href="climb.php" class="nav-link">Championships</a>
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

    <main class="milestones-main">
        <div class="milestones-hero">
            <h1 class="milestones-title">CAREER MILESTONES</h1>
            <p class="milestones-subtitle">Defining Moments That Shaped Basketball History</p>
            <div class="milestones-overview">
                <div class="overview-stat"><span class="overview-number"><?= count($milestones) ?></span><span class="overview-label">Historic Milestones</span></div>
                <div class="overview-stat"><span class="overview-number">22+</span><span class="overview-label">Years of Excellence</span></div>
                <div class="overview-stat"><span class="overview-number">GOAT</span><span class="overview-label">Conversation</span></div>
            </div>
        </div>

        <div class="filter-section">
            <h3>Filter by Category:</h3>
            <div class="filter-buttons">
                <button class="filter-btn active" data-category="all">All Milestones</button>
                <button class="filter-btn" data-category="Scoring">🎯 Scoring</button>
                <button class="filter-btn" data-category="Championships">🏆 Championships</button>
                <button class="filter-btn" data-category="Records">📊 Records</button>
                <button class="filter-btn" data-category="Historic Moments">⭐ Historic Moments</button>
                <button class="filter-btn" data-category="Social Impact">🌍 Social Impact</button>
                <button class="filter-btn" data-category="Legacy">👑 Legacy</button>
            </div>
        </div>

        <div class="milestones-container">
            <?php foreach($milestones as $index => $milestone): 
                $styling = getSignificanceStyling($milestone['significance_level']);
                $icon = getCategoryIcon($milestone['category']);
            ?>
            <div class="milestone-card" 
                data-category="<?= htmlspecialchars($milestone['category']) ?>" 
                data-significance="<?= htmlspecialchars($milestone['significance_level']) ?>"
                style="background: <?= $styling['bg'] ?>; color: <?= $styling['text'] ?>;">
                <div class="milestone-header">
                    <div class="milestone-meta">
                        <span class="category-icon"><?= $icon ?></span>
                        <span class="category-name"><?= htmlspecialchars($milestone['category']) ?></span>
                        <span class="significance-badge" style="background-color: <?= $styling['badge'] ?>">
                            <?= htmlspecialchars($milestone['significance_level']) ?>
                        </span>
                    </div>
                    <div class="milestone-date"><?= formatMilestoneDate($milestone['date_achieved']) ?></div>
                </div>

                <?php if ($milestone['image_url']): ?>
                <div class="milestone-image">
                    <img src="<?= htmlspecialchars($milestone['image_url']) ?>" alt="<?= htmlspecialchars($milestone['milestone_title']) ?>" class="milestone-img" />
                </div>
                <?php endif; ?>

                <div class="milestone-content">
                    <h2 class="milestone-title"><?= htmlspecialchars($milestone['milestone_title']) ?></h2>
                    <p><?= nl2br(htmlspecialchars($milestone['description'])) ?></p>

                    <?php if ($milestone['stats_details']): ?>
                        <div class="stats-section">
                            <h4>Key Statistics</h4>
                            <p><?= nl2br(htmlspecialchars($milestone['stats_details'])) ?></p>
                        </div>
                    <?php endif; ?>

                    <div class="impact-section">
                        <h4>Impact on Basketball</h4>
                        <p><?= nl2br(htmlspecialchars($milestone['impact_on_basketball'])) ?></p>
                    </div>

                    <div class="context-section">
                        <h4>Career Context</h4>
                        <p><?= nl2br(htmlspecialchars($milestone['career_context'])) ?></p>
                    </div>

                    <?php if ($milestone['quote_from_lebron']): ?>
                    <div class="quote-section">
                        <h4>LeBron's Words</h4>
                        <blockquote class="lebron-quote">"<?= htmlspecialchars($milestone['quote_from_lebron']) ?>"</blockquote>
                    </div>
                    <?php endif; ?>

                    <?php if ($milestone['media_reaction']): ?>
                    <div class="media-section">
                        <h4>Media Reaction</h4>
                        <p><?= nl2br(htmlspecialchars($milestone['media_reaction'])) ?></p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="milestones-summary">
            <h2>The Milestone Legacy</h2>
            <p>LeBron James' career is defined not just by numbers, but by moments that transcended basketball and entered cultural history...</p>
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

document.addEventListener('DOMContentLoaded', () => {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const milestoneCards = document.querySelectorAll('.milestone-card');

    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            filterButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            const category = button.dataset.category;

            milestoneCards.forEach(card => {
                if (category === 'all' || card.dataset.category === category) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});
</script>

</body>
</html>
