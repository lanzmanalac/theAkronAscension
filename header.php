<?php
$isLoggedIn = isset($isLoggedIn) ? $isLoggedIn : false;
$username = isset($username) ? htmlspecialchars($username) : 'Guest'; // Ensure username is escaped
$theme = isset($theme) ? $theme : 'light';
?>

<header class="header <?php echo $theme; ?>-theme">
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

            <form class="search-form" method="GET" action="">
                <input type="text" name="search" placeholder="Search museum..." class="search-input">
                <button type="submit" class="search-btn">🔍</button>
            </form>

            <?php if ($isLoggedIn): ?>
                <div class="user-profile">
                    <span class="welcome-msg">Hi, <?= $username; ?></span> <form method="POST" class="logout-form">
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

<?php if (!$isLoggedIn): ?>
<div id="loginModal" class="login-modal">
    <div class="login-content">
        <span class="close-btn" onclick="toggleLogin()">&times;</span>
        <h2>Login to Museum</h2>
        <p class="login-subtitle">Optional — Enhanced experience for registered users</p>
        <form method="POST" class="login-form" action="home.php"> <input type="hidden" name="action" value="login">
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
<?php endif; ?>

<script>
function toggleLogin() {
    const modal = document.getElementById('loginModal');
    modal.style.display = (modal.style.display === 'block') ? 'none' : 'block';
}

window.onclick = function(event) {
    const modal = document.getElementById('loginModal');
    // Ensure modal exists before trying to access its style
    if (modal && event.target === modal) {
        modal.style.display = 'none';
    }
}
</script>