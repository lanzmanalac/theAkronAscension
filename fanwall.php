<?php
// Database connection
$host = 'localhost';
$username = 'root'; 
$password = '';
$dbname = 'theakronascension';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Start session
session_start();

// Check if user is logged in - redirect if not
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header('Location: home.php');
    exit();
}

$isLoggedIn = true;
$username = $_SESSION['username'];

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

            case 'post_message':
                if (!empty($_POST['message'])) {
                    try {
                        // For simplicity, we'll use the username as userID since we don't have proper user registration
                        // In a real app, you'd store user IDs and link properly
                        $stmt = $pdo->prepare("INSERT INTO fanwall (userID, message, postedAt) VALUES (NULL, ?, NOW())");
                        $stmt->execute([$_POST['message']]);

                        // Redirect to prevent resubmission
                        header('Location: fanwall.php');
                        exit();
                    } catch(PDOException $e) {
                        $error = "Error posting message: " . $e->getMessage();
                    }
                }
                break;
        }
    }
}

// Fetch fanwall messages
try {
    $stmt = $pdo->prepare("SELECT message, postedAt FROM fanwall ORDER BY postedAt DESC LIMIT 50");
    $stmt->execute();
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    $messages = [];
    $error = "Error loading messages: " . $e->getMessage();
}

// Determine theme
$theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fan Memory Wall - LeBron James Museum</title>
    <link rel="stylesheet" href="NEEDED FOR ALL CSS FILES.css">
    <link rel="stylesheet" href="fanwall.css">
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
                    <a href="milestones.php" class="nav-link">Milestones</a>
                    <a href="teammate&rival.php" class="nav-link">Teammates</a>
                    <a href="rivalries.php" class="nav-link">Rivalries</a>
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

        <!-- Main Content -->
        <main class="fanwall-main">
            <div class="fanwall-container">
                <div class="fanwall-header">
                    <h1 class="page-title">🏀 Fan Memory Wall</h1>
                    <p class="page-subtitle">Share your favorite LeBron James memories and read what other fans have to say!</p>
                </div>

                <?php if (isset($error)): ?>
                    <div class="error-message">
                        <?= htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <!-- Post New Message -->
                <section class="post-section">
                    <div class="post-form-container">
                        <h2>Share Your Memory</h2>
                        <form method="POST" class="post-form">
                            <input type="hidden" name="action" value="post_message">
                            <div class="form-group">
                                <label for="message">Your LeBron James memory or message:</label>
                                <textarea 
                                    id="message" 
                                    name="message" 
                                    rows="4" 
                                    placeholder="Share your favorite LeBron moment, what he means to you, or leave a message for The King..."
                                    required
                                    maxlength="1000"
                                ></textarea>
                            </div>
                            <button type="submit" class="submit-btn">
                                <span class="btn-icon">💭</span>
                                Post Memory
                            </button>
                        </form>
                    </div>
                </section>

                <!-- Messages Wall -->
                <section class="messages-section">
                    <h2>Fan Memories</h2>
                    <div class="messages-container">
                        <?php if (empty($messages)): ?>
                            <div class="no-messages">
                                <div class="no-messages-icon">🏀</div>
                                <h3>Be the first to share!</h3>
                                <p>No memories have been shared yet. Be the first to leave a message on the fan wall!</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($messages as $message): ?>
                                <div class="message-card">
                                    <div class="message-content">
                                        <p><?= nl2br(htmlspecialchars($message['message'])); ?></p>
                                    </div>
                                    <div class="message-footer">
                                        <div class="message-author">
                                            <span class="author-icon">👤</span>
                                            <span class="author-name">LeBron Fan</span>
                                        </div>
                                        <div class="message-date">
                                            <span class="date-icon">🕒</span>
                                            <span class="date-text"><?= date('M j, Y \a\t g:i A', strtotime($message['postedAt'])); ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </section>

                <!-- Inspiration Quote -->
                <section class="inspiration-section">
                    <div class="quote-container">
                        <blockquote class="lebron-quote">
                            "I'm going to use all my tools, my God-given ability, and make the best life I can with it."
                        </blockquote>
                        <cite class="quote-author">- LeBron James</cite>
                    </div>
                </section>
            </div>
        </main>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-content">
                <p>&copy; 2025 LeBron James Virtual Museum. Share the legacy.</p>
                <div class="footer-links">
                    <a href="home.php">Home</a>
                    <a href="timeline.php">Timeline</a>
                    <a href="exhibits.php">Exhibits</a>
                </div>
            </div>
        </footer>
    </div>

    <script>
        // Auto-resize textarea
        const textarea = document.getElementById('message');
        if (textarea) {
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = this.scrollHeight + 'px';
            });
        }

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