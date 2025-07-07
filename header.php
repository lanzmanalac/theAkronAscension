<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn = isset($_SESSION['user_logged_in']) ? $_SESSION['user_logged_in'] : false;

// Handle login form submission
if (isset($_POST['action']) && $_POST['action'] == 'login') {
    // Simple authentication (in real app, use proper validation)
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $_SESSION['user_logged_in'] = true;
        $_SESSION['username'] = $_POST['username'];
        $isLoggedIn = true;
    }
}

// Handle logout
if (isset($_POST['action']) && $_POST['action'] == 'logout') {
    session_destroy();
    $isLoggedIn = false;
}

// Handle theme toggle
$theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light';
if (isset($_POST['action']) && $_POST['action'] == 'toggle_theme') {
    $theme = $theme === 'light' ? 'dark' : 'light';
    setcookie('theme', $theme, time() + (86400 * 30), "/"); // 30 days
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LeBron James Virtual Museum</title>
    <link rel="stylesheet" href="home.css">
    
</head>
<body>
<!-- Header Section -->
<header class="header">
    <div class="nav-container">
        <div class="logo">
            <h1>The King's Legacy</h1>
            <span class="tagline">The LeBron James Museum</span>
        </div>
        
        <nav class="main-nav">
            <a href="#timeline" class="nav-link"> Timeline</a>
            <a href="#exhibits" class="nav-link"> Exhibits</a>
            <a href="#milestones" class="nav-link"> Milestones</a>
            <a href="#teammates" class="nav-link"> Teammates</a>
            <a href="#rivalries" class="nav-link"> Rivalries</a>
        </nav>
        
        <div class="header-controls">
            <!-- Theme Toggle -->
            <form method="POST" class="theme-toggle-form">
                <input type="hidden" name="action" value="toggle_theme">
                <button type="submit" class="theme-toggle-btn">
                    <?php echo $theme === 'light' ? '🌙' : '☀️'; ?>
                </button>
            </form>
            
            <!-- Search Form -->
            <form class="search-form" method="GET">
                <input type="text" name="search" placeholder="Search museum..." class="search-input">
                <button type="submit" class="search-btn">🔍</button>
            </form>
            
            <!-- Login/Profile Section -->
            <?php if ($isLoggedIn): ?>
                <div class="user-profile">
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
        <p class="login-subtitle">Optional - Enhanced experience for registered users</p>
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

<script>
// Simple JavaScript for login modal toggle
function toggleLogin() {
    const modal = document.getElementById('loginModal');
    modal.style.display = modal.style.display === 'block' ? 'none' : 'block';
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('loginModal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
}
</script>

</body>
</html>