<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teammates & Rivals - LeBron James Virtual Museum</title>
    <link rel="stylesheet" href="teammates-rivals.css">
    <link rel="stylesheet" href="home.css">


</head>
<body>
    <?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "theakronascension";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    // Fetch teammates data
    $teammatesQuery = "SELECT * FROM lbjteammates";
    $teammatesStmt = $conn->prepare($teammatesQuery);
    $teammatesStmt->execute();
    $teammates = $teammatesStmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch rivals data
    $rivalsQuery = "SELECT * FROM lbjrivals";
    $rivalsStmt = $conn->prepare($rivalsQuery);
    $rivalsStmt->execute();
    $rivals = $rivalsStmt->fetchAll(PDO::FETCH_ASSOC);

    // Handle search and filter
    $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
    $filterType = isset($_GET['filter']) ? $_GET['filter'] : 'all';
    $filterTeam = isset($_GET['team']) ? $_GET['team'] : '';
    $filterYears = isset($_GET['years']) ? $_GET['years'] : '';

    ?>

    <div class="page-container <?php echo isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light'; ?>-theme">
        
        <?php include 'header.php'; ?>

        <!-- Hero Section -->
        <section class="hero-section teammates-rivals-hero">
            <div class="hero-content">
                <h1 class="hero-title">Teammates & Rivals</h1>
                <p class="hero-subtitle">The legends who shared the court with The King and those who battled against him</p>
                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-number"><?php echo count($teammates); ?></span>
                        <span class="stat-label">Notable Teammates</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number"><?php echo count($rivals); ?></span>
                        <span class="stat-label">Epic Rivals</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">21</span>
                        <span class="stat-label">Years of Battles</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Teammates Section -->
        <section class="teammates-section">
            <div class="container">
                <h2 class="section-title">🤝 Legendary Teammates</h2>
                <p class="section-description">The elite players who joined forces with LeBron to chase championships</p>
                
                <div class="players-grid">
                    <?php foreach ($teammates as $teammate): ?>
                        <?php
                        // Apply filters
                        if ($filterType === 'rivals') continue;
                        if ($filterTeam && strpos($teammate['teamName'], $filterTeam) === false) continue;
                        if ($searchQuery && stripos($teammate['name'], $searchQuery) === false) continue;
                        
                        // Parse years for filtering
                        $playerYears = $teammate['yearsPlayedWith'];
                        if ($filterYears) {
                            $filterRange = explode('-', $filterYears);
                            $playerYearRange = explode('-', $playerYears);
                            if (count($playerYearRange) >= 2) {
                                $playerStart = intval($playerYearRange[0]);
                                $playerEnd = intval($playerYearRange[1]);
                                $filterStart = intval($filterRange[0]);
                                $filterEnd = intval($filterRange[1]);
                                
                                if ($playerEnd < $filterStart || $playerStart > $filterEnd) continue;
                            }
                        }
                        ?>
                        
                        <div class="player-card teammate-card" onclick="openPlayerModal('teammate', <?php echo $teammate['id']; ?>)">
                            <div class="player-image">
                                <img src="<?php echo htmlspecialchars($teammate['imageURL']); ?>" alt="<?php echo htmlspecialchars($teammate['name']); ?>">
                                <div class="player-overlay">
                                    <div class="player-position"><?php echo htmlspecialchars($teammate['position']); ?></div>
                                </div>
                            </div>
                            <div class="player-info">
                                <h3 class="player-name"><?php echo htmlspecialchars($teammate['name']); ?></h3>
                                <p class="player-team"><?php echo htmlspecialchars($teammate['teamName']); ?></p>
                                <p class="player-years"><?php echo htmlspecialchars($teammate['yearsPlayedWith']); ?></p>
                                <div class="player-preview">
                                    <p><?php echo htmlspecialchars(substr($teammate['notableMoments'], 0, 100)) . '...'; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Rivals Section -->
        <section class="rivals-section">
            <div class="container">
                <h2 class="section-title">⚔️ Epic Rivals</h2>
                <p class="section-description">The formidable opponents who pushed LeBron to greatness</p>
                
                <div class="players-grid">
                    <?php foreach ($rivals as $rival): ?>
                        <?php
                        // Apply filters
                        if ($filterType === 'teammates') continue;
                        if ($filterTeam && strpos($rival['teamName'], $filterTeam) === false) continue;
                        if ($searchQuery && stripos($rival['name'], $searchQuery) === false) continue;
                        
                        // Parse years for filtering
                        /*$playerYears = $rival['yearsPlayedWith'];
                            if ($filterYears) {
                                $filterRange = explode('-', $filterYears);
                                $playerYearRange = explode('-', $playerYears);
                                if (count($playerYearRange) >= 2) {
                                    $playerStart = intval($playerYearRange[0]);
                                    $playerEnd = intval($playerYearRange[1]);
                                    $filterStart = intval($filterRange[0]);
                                    $filterEnd = intval($filterRange[1]);
                                    
                                    if ($playerEnd < $filterStart || $playerStart > $filterEnd) continue;
                                }
                            }
                        */
                        ?>
                        
                        <div class="player-card rival-card" onclick="openPlayerModal('rival', <?php echo $rival['id']; ?>)">
                            <div class="player-image">
                                <img src="<?php echo htmlspecialchars($rival['imageURL']); ?>" alt="<?php echo htmlspecialchars($rival['name']); ?>">
                                
                            </div>
                            <div class="player-info">
                                <h3 class="player-name"><?php echo htmlspecialchars($rival['name']); ?></h3>
                                <p class="player-team"><?php echo htmlspecialchars($rival['teamName']); ?></p>
                                
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Player Modal -->
        <div id="playerModal" class="player-modal">
            <div class="modal-content">
                <span class="close-btn" onclick="closePlayerModal()">&times;</span>
                <div id="modalContent">
                    <!-- Dynamic content will be loaded here -->
                </div>
            </div>
        </div>

        <!-- Footer -->
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
                            <li><a href="home.php">Home</a></li>
                            <li><a href="journey.php">The Journey</a></li>
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
        // Player modal functionality
        function openPlayerModal(type, playerId) {
            const modal = document.getElementById('playerModal');
            const modalContent = document.getElementById('modalContent');
            
            // Show loading state
            modalContent.innerHTML = '<div class="loading">Loading player details...</div>';
            modal.style.display = 'block';
            
            // Fetch player details via AJAX
            fetch(`get_player_details.php?type=${type}&id=${playerId}`)
                .then(response => response.text())
                .then(html => {
                    modalContent.innerHTML = html;
                })
                .catch(error => {
                    modalContent.innerHTML = '<div class="error">Error loading player details.</div>';
                });
        }

        function closePlayerModal() {
            document.getElementById('playerModal').style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('playerModal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        }

        // Interactive card animations
        document.querySelectorAll('.player-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
    </script>
</body>
</html>