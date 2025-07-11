<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LeBron James Virtual Museum</title>
    <link rel="stylesheet" href="home.css">
    
</head>
<body>
    <?php
    // Simple PHP login check (optional)
    session_start();
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

    <div class="page-container <?php echo $theme; ?>-theme">
        <header class="header">
            <div class="nav-container">
                <div class="logo">
                    <h1>The King's Legacy</h1>
                    <span class="tagline">The LeBron James Museum</span>
                </div>
                
                <nav class="main-nav">
                    <a href="#features" class="nav-link"> Features</a>
                    <a href="#Search" class="nav-link"> Search</a>
                </nav>
                
                <div class="header-controls">
                    <form method="POST" class="theme-toggle-form">
                        <input type="hidden" name="action" value="toggle_theme">
                        <button type="submit" class="theme-toggle-btn">
                            <?php echo $theme === 'light' ? '🌙' : '☀️'; ?>
                        </button>
                    </form>
                    
                    <form class="search-form" method="GET">
                        <input type="text" name="search" placeholder="Search museum..." class="search-input">
                        <button type="submit" class="search-btn">🔍</button>
                    </form>
                    
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

        <section class="hero-section">
            <div class="hero-content">
                <h1 class="hero-title"> The Akron Ascension</h1>
                <p class="hero-subtitle">Explore the legendary career of The King</p>
                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-number">21</span>
                        <span class="stat-label">NBA Seasons</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">4</span>
                        <span class="stat-label">Championships</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">4</span>
                        <span class="stat-label">Finals MVPs</span>
                    </div>
                </div>
                <a href="#features" class="cta-button">Start Your Journey</a>
            </div>
        </section>

        <section id="features" class="features-section">
            <div class="container">
                <h2 class="section-title">Explore The Museum</h2>
                <div class="features-grid">
                    <div class="feature-card interactive-hotspot" data-feature="timeline">
                        <div class="feature-icon">📅</div>
                        <h3>Timeline View</h3>
                        <p>Journey through LeBron's entire professional career from 2003 to present</p>
                        <a href="timeline.php" class="feature-link">Explore Timeline</a>
                    </div>

                    <div class="feature-card interactive-hotspot" data-feature="exhibits">
                        <div class="feature-icon">🏆</div>
                        <h3>Virtual Exhibit Rooms</h3>
                        <p>Immerse yourself in interactive displays of LeBron's greatest achievements</p>

                        <a href="exhibits.php" class="feature-link">Enter Exhibits</a>
                    </div>

                    <div class="feature-card interactive-hotspot" data-feature="milestones">
                        <div class="feature-icon">🎯</div>
                        <h3>Career Milestone</h3>
                        <p>Discover the defining moments that shaped basketball history</p>

                        <a href="milestones.php" class="feature-link">View Milestones</a>
                    </div>

                    <div class="feature-card interactive-hotspot" data-feature="teammates">
                        <div class="feature-icon">🤝</div>
                        <h3>Teammates & Rivals</h3>
                        <p>Meet the legendary players who shared the court or battled with The King</p>

                        <a href="teammate&rival.php" class="feature-link">Meet Teammates & Rivals</a>
                    </div>

                    <div class="feature-card interactive-hotspot" data-feature="rivalries">
                        <div class="feature-icon">⚡</div>
                        <h3> The Journey </h3>
                        <p> Recap of how LeBron did for the different teams he played on</p>

                        <a href="journey.php" class="feature-link">Explore The Journey</a>
                    </div>

                    <div class="feature-card interactive-hotspot" data-feature="rivalries">
                        <div class="feature-icon">✍</div>
                        <h3> Fan Memory Wall </h3>
                        <p> Leave comments and personal notes for LeBron! </p>

                        <a href="fanwall.php" class="feature-link">Explore The Fan Memory Wall</a>
                    </div>

                    <div class="feature-card interactive-hotspot" data-feature="rivalries">
                        <div class="feature-icon">📝</div>
                        <h3> Statistics Tracker </h3>
                        <p> See LeBron's progress by the numbers over the years </p>

                        <a href="stats.php" class="feature-link">Explore Statistics</a>
                    </div>  

                    <div class="feature-card interactive-hotspot" data-feature="rivalries">
                        <div class="feature-icon">🤲</div>
                        <h3> Players Praise </h3>
                        <p> Quotes from other basketball players in awe of LeBron's greatness </p>

                        <a href="praise.php" class="feature-link">Explore Praise</a>
                    </div> 

                    <div class="feature-card interactive-hotspot" data-feature="rivalries">
                        <div class="feature-icon">🥇</div>
                        <h3> The Climb </h3>
                        <p> See LeBron's path for every championship he won </p>

                        <a href="climb.php" class="feature-link">Explore The Climb</a>
                    </div> 
                </div>
            </div>
        </section>

        <section id = "Search" class="search-filter-section">
            <div class="container">
                <h2 class="section-title">Find What You're Looking For</h2>
                <div class="search-filter-container">
                    <form class="advanced-search" method="GET">
                        <div class="search-row">
                            <input type="text" name="search_query" placeholder="Search for specific moments, achievements, or players..." class="main-search-input">
                            <button type="submit" class="search-button">Search Museum</button>
                        </div>
                        <div class="filter-row">
                            <select name="category" class="filter-select">
                                <option value="">All Categories</option>
                                <option value="timeline">Timeline Events</option>
                                <option value="achievements">Achievements</option>
                                <option value="teammates">Teammates</option>
                                <option value="rivalries">Rivalries</option>
                            </select>
                            <select name="year" class="filter-select">
                                <option value="">All Years</option>
                                <option value="2003-2010">2003-2010 (Cavaliers Era 1)</option>
                                <option value="2010-2014">2010-2014 (Heat Era)</option>
                                <option value="2014-2018">2014-2018 (Cavaliers Era 2)</option>
                                <option value="2018-2025">2018-2025 (Lakers Era)</option>
                            </select>
                            <select name="type" class="filter-select">
                                <option value="">All Types</option>
                                <option value="championship">Championships</option>
                                <option value="record">Records</option>
                                <option value="playoff">Playoff Moments</option>
                                <option value="regular">Regular Season</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <footer class="footer">
            <div class="container">
                <div class="footer-content">
                    <div class="footer-section">
                        <h3>LeBron James Virtual Museum</h3>
                        <p>Celebrating the legacy of The King</p>
                    </div>
                    <div class="footer-section">
                        <h4>Explore</h4>
                        <ul>
                            <li><a href="timeline.php">Timeline</a></li>
                            <li><a href="exhibits.php">Exhibits</a></li>
                            <li><a href="milestones.php">Milestones</a></li>
                        </ul>
                    </div>
                    <div class="footer-section">
                        <h4>Connect</h4>
                        <ul>
                            <li><a href="teammates.php">Teammates</a></li>
                            <li><a href="rivalries.php">Rivalries</a></li>
                        </ul>
                    </div>
                </div>
                <div class="footer-bottom">
                    <p>&copy; 2025 LeBron James Virtual Museum. All rights reserved.</p>
                </div>
            </div>
        </footer>
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

        // Interactive hotspots
        document.querySelectorAll('.interactive-hotspot').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html>
