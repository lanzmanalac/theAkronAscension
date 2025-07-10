<?php
// Start session if not already started
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
                if (!empty($_POST['username']) && !empty($_POST['password'])) {
                    $_SESSION['user_logged_in'] = true;
                    $_SESSION['username'] = $_POST['username'];
                    $isLoggedIn = true;
                }
                break;

            case 'logout':
                session_destroy();
                $isLoggedIn = false;
                break;

            case 'toggle_theme':
                $currentTheme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light';
                $newTheme = $currentTheme === 'light' ? 'dark' : 'light';
                setcookie('theme', $newTheme, time() + (86400 * 30), "/"); // 30 days
                $_COOKIE['theme'] = $newTheme; // Apply immediately during current request
                break;
        }
    }
}

// Determine theme (default to light)
$theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light';
?>

<!-- Header HTML -->
<header class="header">
    <div class="nav-container">
        <!-- Logo Section -->
        <div class="logo">
            <h1>The King's Legacy</h1>
            <span class="tagline">The LeBron James Museum</span>
        </div>

        <!-- Navigation Links -->
        <nav class="main-nav">
            <a href="timeline.php" class="nav-link">Timeline</a>
            <a href="exhibits.php" class="nav-link">Exhibits</a>
            <a href="milestones.php" class="nav-link">Milestones</a>
            <a href="teammate&rival.php" class="nav-link">Teammates</a>
            <a href="rivalries.php" class="nav-link">Rivalries</a>
            <?php if ($isLoggedIn): ?>
                <a href="fanwall.php" class="nav-link">Fan Wall</a>
            <?php endif; ?>
        </nav>

        <!-- Header Controls -->
        <div class="header-controls">
            <!-- Theme Toggle Button -->
            <form method="POST" class="theme-toggle-form">
                <input type="hidden" name="action" value="toggle_theme">
                <button type="submit" class="theme-toggle-btn" title="Toggle Theme">
                    <?= $theme === 'light' ? '🌙' : '☀️'; ?>
                </button>
            </form>

            <!-- Search Bar -->
            <form class="search-form" method="GET" action="">
                <input type="text" name="search" placeholder="Search museum..." class="search-input">
                <button type="submit" class="search-btn">🔍</button>
            </form>

            <!-- User Section -->
            <?php if ($isLoggedIn): ?>
                <div class="user-profile">
                    <span class="welcome-msg">Hi, <?= htmlspecialchars($_SESSION['username']); ?></span>
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

<!-- Login Modal -->
<div id="loginModal" class="login-modal">
    <div class="login-content">
        <span class="close-btn" onclick="toggleLogin()">&times;</span>
        <h2>Login to Museum</h2>
        <p class="login-subtitle">Optional — Enhanced experience for registered users</p>
        <form method="POST" class="login-form">
            <input type="hidden" name="action" value="login">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="submit-btn">Login</button>
            <p class="guest-note">You can explore the museum without logging in</p>
        </form>
    </div>
</div>

<!-- Login Modal Script -->
<script>
function toggleLogin() {
    const modal = document.getElementById('loginModal');
    modal.style.display = (modal.style.display === 'block') ? 'none' : 'block';
}

window.onclick = function(event) {
    const modal = document.getElementById('loginModal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
}
</script>
