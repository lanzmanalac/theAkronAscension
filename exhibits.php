<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LeBron James - The Trophy Room</title>
    <link rel="stylesheet" href="exhibits.css">
</head>
<body>
    <?php
    // Simple PHP login check (optional)
    session_start();
    $isLoggedIn = isset($_SESSION['user_logged_in']) ? $_SESSION['user_logged_in'] : false;
    
    // Handle login form submission
    if (isset($_POST['action']) && $_POST['action'] == 'login') {
        // Simple authentication (in real app, use proper validation)
        if (!empty($_POST['username']) && !empty($_POST['password'])) { // Added !empty checks for robustness
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
                    <a href="home.php" class="nav-link"><center> Back to Home Page</center></a>
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

    <main class="trophy-room">
        <div class="room-header">
            <h1 class="room-title">The Trophy Room</h1>
            <p class="room-description">Step into the legacy of greatness. Explore LeBron James' most prestigious awards and achievements that define his legendary career.</p>
        </div>

        <section class="trophy-section championships">
            <h2 class="section-title">NBA Championships</h2>
            <div class="trophy-grid">
                <div class="trophy-display championship-trophy">
                    <div class="trophy-case">
                        <div class="trophy-item">
                            <div class="trophy-icon">🏆</div>
                            <h3>2012 NBA Championship</h3>
                            <p class="trophy-details">Miami Heat</p>
                            <p class="trophy-year">First Championship</p>
                        </div>
                        <div class="trophy-info">
                            <p>LeBron's first NBA championship came with the Miami Heat, defeating the Oklahoma City Thunder 4-1 in the Finals.</p>
                            <div class="stats">
                                <span>Finals MVP</span>
                                <span>28.6 PPG</span>
                                <span>10.2 RPG</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="trophy-display championship-trophy">
                    <div class="trophy-case">
                        <div class="trophy-item">
                            <div class="trophy-icon">🏆</div>
                            <h3>2013 NBA Championship</h3>
                            <p class="trophy-details">Miami Heat</p>
                            <p class="trophy-year">Back-to-Back</p>
                        </div>
                        <div class="trophy-info">
                            <p>Consecutive championship with Miami Heat, defeating the San Antonio Spurs 4-3 in a thrilling 7-game series.</p>
                            <div class="stats">
                                <span>Finals MVP</span>
                                <span>25.3 PPG</span>
                                <span>10.9 RPG</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="trophy-display championship-trophy">
                    <div class="trophy-case">
                        <div class="trophy-item">
                            <div class="trophy-icon">🏆</div>
                            <h3>2016 NBA Championship</h3>
                            <p class="trophy-details">Cleveland Cavaliers</p>
                            <p class="trophy-year">Historic Comeback</p>
                        </div>
                        <div class="trophy-info">
                            <p>The Promise Fulfilled - Led Cleveland to their first championship, overcoming a 3-1 deficit against Golden State.</p>
                            <div class="stats">
                                <span>Finals MVP</span>
                                <span>29.7 PPG</span>
                                <span>11.3 RPG</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="trophy-display championship-trophy">
                    <div class="trophy-case">
                        <div class="trophy-item">
                            <div class="trophy-icon">🏆</div>
                            <h3>2020 NBA Championship</h3>
                            <p class="trophy-details">Los Angeles Lakers</p>
                            <p class="trophy-year">Bubble Championship</p>
                        </div>
                        <div class="trophy-info">
                            <p>Fourth championship with the Lakers in the NBA Bubble, defeating the Miami Heat 4-2 in the Finals.</p>
                            <div class="stats">
                                <span>Finals MVP</span>
                                <span>29.8 PPG</span>
                                <span>11.8 RPG</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="trophy-section mvp-awards">
            <h2 class="section-title">MVP Awards</h2>
            <div class="trophy-grid">
                <div class="trophy-display mvp-trophy">
                    <div class="trophy-case">
                        <div class="trophy-item">
                            <div class="trophy-icon">👑</div>
                            <h3>2009 NBA MVP</h3>
                            <p class="trophy-details">Cleveland Cavaliers</p>
                            <p class="trophy-year">First MVP</p>
                        </div>
                        <div class="trophy-info">
                            <p>First NBA MVP award at age 24, leading the Cavaliers to the best record in the league.</p>
                            <div class="stats">
                                <span>28.4 PPG</span>
                                <span>7.6 RPG</span>
                                <span>7.2 APG</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="trophy-display mvp-trophy">
                    <div class="trophy-case">
                        <div class="trophy-item">
                            <div class="trophy-icon">👑</div>
                            <h3>2010 NBA MVP</h3>
                            <p class="trophy-details">Cleveland Cavaliers</p>
                            <p class="trophy-year">Back-to-Back MVP</p>
                        </div>
                        <div class="trophy-info">
                            <p>Consecutive MVP award, becoming the youngest player to win back-to-back MVP awards.</p>
                            <div class="stats">
                                <span>29.7 PPG</span>
                                <span>7.3 RPG</span>
                                <span>8.6 APG</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="trophy-display mvp-trophy">
                    <div class="trophy-case">
                        <div class="trophy-item">
                            <div class="trophy-icon">👑</div>
                            <h3>2012 NBA MVP</h3>
                            <p class="trophy-details">Miami Heat</p>
                            <p class="trophy-year">Championship Season</p>
                        </div>
                        <div class="trophy-info">
                            <p>Third MVP award during his championship season with Miami Heat.</p>
                            <div class="stats">
                                <span>27.1 PPG</span>
                                <span>7.9 RPG</span>
                                <span>6.2 APG</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="trophy-display mvp-trophy">
                    <div class="trophy-case">
                        <div class="trophy-item">
                            <div class="trophy-icon">👑</div>
                            <h3>2013 NBA MVP</h3>
                            <p class="trophy-details">Miami Heat</p>
                            <p class="trophy-year">Fourth MVP</p>
                        </div>
                        <div class="trophy-info">
                            <p>Fourth MVP award, joining elite company of players with 4+ MVP awards.</p>
                            <div class="stats">
                                <span>26.8 PPG</span>
                                <span>8.0 RPG</span>
                                <span>7.3 APG</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="trophy-section special-awards">
            <h2 class="section-title">Special Achievements</h2>
            <div class="trophy-grid">
                <div class="trophy-display special-trophy">
                    <div class="trophy-case">
                        <div class="trophy-item">
                            <div class="trophy-icon">🥇</div>
                            <h3>Olympic Gold Medals</h3>
                            <p class="trophy-details">Team USA</p>
                            <p class="trophy-year">2008, 2012</p>
                        </div>
                        <div class="trophy-info">
                            <p>Two Olympic gold medals representing Team USA in Beijing 2008 and London 2012.</p>
                            <div class="stats">
                                <span>Beijing 2008</span>
                                <span>London 2012</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="trophy-display special-trophy">
                    <div class="trophy-case">
                        <div class="trophy-item">
                            <div class="trophy-icon">⭐</div>
                            <h3>All-Time Scoring Record</h3>
                            <p class="trophy-details">38,387+ Points</p>
                            <p class="trophy-year">2023</p>
                        </div>
                        <div class="trophy-info">
                            <p>Broke Kareem Abdul-Jabbar's all-time scoring record that stood for 39 years.</p>
                            <div class="stats">
                                <span>38,387+ Points</span>
                                <span>February 7, 2023</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="trophy-display special-trophy">
                    <div class="trophy-case">
                        <div class="trophy-item">
                            <div class="trophy-icon">🏀</div>
                            <h3>NBA All-Star Selections</h3>
                            <p class="trophy-details">19× All-Star</p>
                            <p class="trophy-year">2005-2023</p>
                        </div>
                        <div class="trophy-info">
                            <p>Selected to 19 NBA All-Star Games, demonstrating consistent excellence throughout his career.</p>
                            <div class="stats">
                                <span>19× All-Star</span>
                                <span>3× All-Star MVP</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="trophy-display special-trophy">
                    <div class="trophy-case">
                        <div class="trophy-item">
                            <div class="trophy-icon">🏅</div>
                            <h3>Rookie of the Year</h3>
                            <p class="trophy-details">2003-04 Season</p>
                            <p class="trophy-year">First Award</p>
                        </div>
                        <div class="trophy-info">
                            <p>NBA Rookie of the Year award in his debut season, averaging 20.9 PPG, 5.5 RPG, and 5.9 APG.</p>
                            <div class="stats">
                                <span>20.9 PPG</span>
                                <span>5.5 RPG</span>
                                <span>5.9 APG</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="legacy-section">
            <div class="legacy-quote">
                <blockquote>
                    "I'm going to use all my tools, my God-given ability, and make the best life I can with it."
                </blockquote>
                <cite>- LeBron James</cite>
            </div>
        </section>
    </main>

    <footer class="museum-footer">
        <div class="footer-content">
            <p>&copy; 2024 LeBron James Virtual Museum. Experience the legacy of greatness.</p>
            <div class="footer-links">
                <a href="#about">About</a>
                <a href="#contact">Contact</a>
                <a href="#privacy">Privacy</a>
            </div>
        </div>
    </footer>
</body>
</html>