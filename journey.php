<?php
// Connect to MySQL database using PDO
try {
    $pdo = new PDO('mysql:host=localhost;dbname=theakronascension;charset=utf8mb4', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Get all team journey data, sorted by order sequence
$stmt = $pdo->query("SELECT * FROM team_journey ORDER BY order_sequence ASC");
$teams = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Function to get team styling based on team colors
function getTeamStyling($teamColors) {
    $colorArray = explode(', ', $teamColors);
    $primary = $colorArray[0] ?? '#000000';
    $secondary = $colorArray[1] ?? '#FFFFFF';
    
    return [
        'bg' => "linear-gradient(135deg, $primary, $secondary)",
        'text' => '#FFFFFF',
        'accent' => $secondary
    ];
}

// Function to format years for display
function formatYearsDisplay($yearsSpan, $seasonsPlayed) {
    return "$yearsSpan ($seasonsPlayed seasons)";
}

// Ensure theme has a default fallback
$theme = isset($theme) ? $theme : 'light';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>The Journey - LeBron's Team Legacy</title>
    <link rel="stylesheet" href="home.css" />
    <link rel="stylesheet" href="timeline.css" />
    <link rel="stylesheet" href="journey.css" />
</head>
<body class="<?php echo $theme; ?>-theme">

    <?php include 'header.php'; ?>

    <div class="page-container <?php echo $theme; ?>-theme">
        
        <div class="journey-hero">
            <h1 class="journey-title">THE JOURNEY</h1>
            <p class="journey-subtitle">LeBron James' Legacy Across Franchises</p>
            <div class="journey-stats">
                <div class="stat-item">
                    <span class="stat-number">3</span>
                    <span class="stat-label">Franchises</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">22+</span>
                    <span class="stat-label">Seasons</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">4</span>
                    <span class="stat-label">Championships</span>
                </div>
            </div>
        </div>

        <div class="teams-container">
            <?php foreach($teams as $index => $team): 
                $styling = getTeamStyling($team['team_colors']);
                $isCurrentTeam = $team['years_span'] === '2018-Present';
            ?>
                <div class="team-card <?= $isCurrentTeam ? 'current-team' : '' ?>" 
                     data-team="<?= htmlspecialchars($team['team_name']) ?>"
                     style="background: <?= $styling['bg'] ?>; color: <?= $styling['text'] ?>;">

                    <div class="team-header">
                        <div class="team-logo-section">
                            <?php if ($team['team_logo']): ?>
                                <img src="<?= htmlspecialchars($team['team_logo']) ?>" 
                                     alt="<?= htmlspecialchars($team['team_name']) ?> Logo" 
                                     class="team-logo"
                                     onerror="this.style.display='none'" />
                            <?php else: ?>
                                <div class="team-logo team-logo-placeholder">
                                    <?= strtoupper(substr($team['team_name'], 0, 1)) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="team-info">
                            <h2 class="team-name">
                                <?= htmlspecialchars($team['team_name']) ?>
                                <?php if ($team['stint_number'] > 1): ?>
                                    <span class="stint-badge">Stint <?= $team['stint_number'] ?></span>
                                <?php endif; ?>
                            </h2>
                            <div class="years-span"><?= formatYearsDisplay($team['years_span'], $team['seasons_played']) ?></div>
                        </div>
                        <?php if ($isCurrentTeam): ?>
                            <div class="current-badge">Current Team</div>
                        <?php endif; ?>
                    </div>

                    <div class="team-achievements">
                        <div class="achievement-stat">
                            <span class="achievement-number"><?= $team['championships_won'] ?></span>
                            <span class="achievement-label">Championships</span>
                        </div>
                        <div class="achievement-stat">
                            <span class="achievement-number"><?= $team['finals_appearances'] ?></span>
                            <span class="achievement-label">Finals</span>
                        </div>
                    </div>

                    <div class="team-content">
                        <div class="content-section">
                            <h3>Regular Season Performance</h3>
                            <p><?= nl2br(htmlspecialchars($team['regular_season_stats'])) ?></p>
                        </div>

                        <div class="content-section">
                            <h3>Playoff Achievements</h3>
                            <p><?= nl2br(htmlspecialchars($team['playoff_achievements'])) ?></p>
                        </div>

                        <div class="content-section">
                            <h3>Memorable Moments</h3>
                            <p><?= nl2br(htmlspecialchars($team['memorable_moments'])) ?></p>
                        </div>

                        <div class="content-section">
                            <h3>Team Impact</h3>
                            <p><?= nl2br(htmlspecialchars($team['team_impact'])) ?></p>
                        </div>

                        <div class="content-section">
                            <h3>Legacy</h3>
                            <p><?= nl2br(htmlspecialchars($team['legacy_with_team'])) ?></p>
                        </div>

                        <div class="content-section teammates-section">
                            <h3>Key Teammates</h3>
                            <div class="teammates-list">
                                <?php 
                                $teammates = explode(', ', $team['key_teammates']);
                                foreach($teammates as $teammate): 
                                ?>
                                    <span class="teammate-badge"><?= htmlspecialchars(trim($teammate)) ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="journey-summary">
            <h2>The Ultimate Journey</h2>
            <p>
                From the chosen rookie in Cleveland to the veteran leader in Los Angeles, LeBron's journey spans over two decades and three franchises. 
                Each stop on his path has added unique chapters to his legendary story - the promise of youth in Cleveland, the championship breakthrough in Miami, 
                the homecoming hero narrative back in Cleveland, and the continuing excellence in Los Angeles. 
                No player in NBA history has maintained such a high level of play across so many seasons and different team contexts.
            </p>
            <div class="journey-legacy-stats">
                <div class="legacy-stat">
                    <h4>Career Totals</h4>
                    <p>40,000+ Points • 10,000+ Rebounds • 10,000+ Assists</p>
                </div>
                <div class="legacy-stat">
                    <h4>Unique Achievement</h4>
                    <p>Only player to win Finals MVP with 3 different franchises</p>
                </div>
                <div class="legacy-stat">
                    <h4>Longevity</h4>
                    <p>22+ seasons of elite basketball across multiple eras</p>
                </div>
            </div>
        </div>

    </div>

    <script>
        // Login modal toggle from header.php
        function toggleLogin() {
            const modal = document.getElementById('loginModal');
            modal.style.display = modal.style.display === 'block' ? 'none' : 'block';
        }

        // Close login modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('loginModal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        }

        // Add scroll animations for team cards
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.addEventListener('DOMContentLoaded', () => {
            // Animate team cards on scroll
            const cards = document.querySelectorAll('.team-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(50px)';
                card.style.transition = `all 0.6s ease-out ${index * 0.2}s`;
                observer.observe(card);
            });

            // Add hover effects to teammate badges
            const teammates = document.querySelectorAll('.teammate-badge');
            teammates.forEach(badge => {
                badge.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.05)';
                });
                
                badge.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                });
            });
        });
    </script>

</body>
</html>