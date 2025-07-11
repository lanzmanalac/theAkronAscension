<?php
// Start session
session_start();

// Check if user is logged in - redirect if not
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header('Location: home.php');
    exit();
}

$isLoggedIn = true;
$username = $_SESSION['username'];

// Database configuration
$host = 'localhost';
$dbname = 'theakronascension';
$db_username = 'root';
$db_password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $db_username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'logout':
                session_destroy();
                header('Location: home.php');
                exit();
                break;

            case 'toggle_theme':
                $currentTheme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light';
                $newTheme = $currentTheme === 'light' ? 'dark' : 'light';
                setcookie('theme', $newTheme, time() + (86400 * 30), "/");
                $_COOKIE['theme'] = $newTheme;
                break;

            case 'post_praise':
                if (!empty($_POST['praise'])) {
                    try {
                        $stmt = $pdo->prepare("INSERT INTO lbjpraise (quotedBy, quoteText, context) VALUES (?, ?, ?)");
                        $stmt->execute([
                            $username,
                            trim($_POST['praise']),
                            'User Submission'
                        ]);
                        
                        // Redirect to prevent resubmission
                        header('Location: praise.php');
                        exit();
                    } catch(Exception $e) {
                        $error = "Error posting praise: " . $e->getMessage();
                    }
                }
                break;
        }
    }
}

// Get all praise quotes from database
try {
    $stmt = $pdo->query("SELECT * FROM lbjpraise ORDER BY id DESC");
    $praiseQuotes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(Exception $e) {
    $praiseQuotes = [];
    $error = "Error loading quotes: " . $e->getMessage();
}

// Determine theme
$theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Praise Wall - LeBron James Museum</title>
    <link rel="stylesheet" href="NEEDED FOR ALL CSS FILES.css">
    <link rel="stylesheet" href="praise.css">
</head>
<body>
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
                    <a href="timeline.php" class="nav-link">Timeline</a>
                    <a href="exhibits.php" class="nav-link">Exhibits</a>
                    <a href="fanwall.php" class="nav-link">Fan Wall</a>
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
                             <span class="welcome-msg">Hi, <?= htmlspecialchars($username); ?></span>
                             <form method="POST" class="logout-form">
                                 <input type="hidden" name="action" value="logout">
                                 <button type="submit" class="logout-btn">Logout</button>
                             </form>
                         </div>
                     <?php endif; ?>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="praise-main">
            <div class="praise-container">
                <div class="praise-header">
                    <h1 class="page-title">👑 Praise Wall</h1>
                    <p class="page-subtitle">Discover what NBA players, media, and sports personalities are saying about The King!</p>
                 </div>

                <?php if (isset($error)): ?>
                    <div class="error-message">
                        <?= htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <!-- Praise Quotes Wall -->
                <section class="messages-section">
                    <h2>What People Are Saying About The King</h2>
                    <div class="messages-container">
                        <?php if (empty($praiseQuotes)): ?>
                            <div class="no-messages">
                                <div class="no-messages-icon">👑</div>
                                <h3>No quotes available yet!</h3>
                                <p>We're currently building our collection of praise quotes from NBA players, media, and sports personalities about LeBron James.</p>
                             </div>
                            </div>
                        <?php else: ?>
                            <?php foreach ($praiseQuotes as $quote): ?>
                                <div class="message-card">
                                    <div class="source-badge">
                                        <span class="source-icon"><?= getSourceIcon($quote['context']); ?></span>
                                        <span class="source-text"><?= htmlspecialchars($quote['context'] ?: 'Unknown'); ?></span>
                                    </div>
                                    <div class="message-content">
                                        <p>"<?= nl2br(htmlspecialchars($quote['quoteText'])); ?>"</p>
                                    </div>
                                    <div class="message-footer">
                                        <div class="message-author">
                                            <span class="author-icon">👤</span>
                                            <span class="author-name"><?= htmlspecialchars($quote['quotedBy']); ?></span>
                                        </div>
                                        <?php if ($quote['dateSaid']): ?>
                                            <div class="message-date">
                                                <span class="date-icon">�</span>
                                                <span class="date-text"><?= date('M j, Y', strtotime($quote['dateSaid'])); ?></span>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($quote['sourceURL']): ?>
                                            <div class="message-source">
                                                <span class="source-icon">�</span>
                                                <a href="<?= htmlspecialchars($quote['sourceURL']); ?>" target="_blank" class="source-link">Source</a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </section>

                <!-- Statistics Section -->
                <section class="stats-section">
                    <div class="stats-container">
                        <h3>Praise Wall Statistics</h3>
                        <div class="stats-grid">
                            <div class="stat-card">
                                <div class="stat-number"><?= count($praiseQuotes); ?></div>
                                <div class="stat-label">Total Quotes</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-number"><?= count(array_unique(array_column($praiseQuotes, 'context'))); ?></div>
                                <div class="stat-label">Sources</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-number"><?= count(array_filter($praiseQuotes, function($q) { return !empty($q['sourceURL']); })); ?></div>
                                <div class="stat-label">With Source Links</div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Inspiration Quote -->
                <section class="inspiration-section">
                    <div class="quote-container">
                        <blockquote class="lebron-quote">
                            "I like criticism. It makes you strong."
                        </blockquote>
                        <cite class="quote-author">- LeBron James</cite>
                    </div>
                </section>
            </div>
        </main>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-content">
                <p>&copy; 2025 LeBron James Virtual Museum. Honoring greatness.</p>
                <div class="footer-links">
                    <a href="home.php">Home</a>
                    <a href="timeline.php">Timeline</a>
                    <a href="exhibits.php">Exhibits</a>
                    <a href="fanwall.php">Fan Wall</a>
                </div>
            </div>
        </footer>
    </div>

    <style>
        .message-source {
            display: inline-block;
            margin-left: 10px;
        }
        .source-link {
            color: #007cba;
            text-decoration: none;
            font-size: 0.9em;
        }
        .source-link:hover {
            text-decoration: underline;
        }
    </style>

    <script>
        // Add animation to message cards
        document.addEventListener('DOMContentLoaded', function() {
            const messageCards = document.querySelectorAll('.message-card');
            messageCards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</body>
</html>

<?php
// Helper function to get source icons
function getSourceIcon($context) {
    if (!$context) return '✨';
    $icons = [
        'News' => '�',
        'Podcast' => '🎙️',
        'Social Media' => '�',
        'Interview' => '🎤',
        'NBA Player' => '�',
        'User Submission' => '👤',
        'Online Forum' => '💬'
    ];
    
    foreach ($icons as $key => $icon) {
        if (stripos($context, $key) !== false) {
            return $icon;
        }
    }
    
    return '✨'; // Default icon
}
?>