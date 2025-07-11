<?php
/**
 * Script to add praise quotes to the database from external sources
 * This can be used to feed quotes from news articles, podcasts, interviews, etc.
 */

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

/**
 * Add a quote to the database
 * 
 * @param string $quote_text The actual quote text
 * @param string $quoted_by Name of the person who said it (NBA player, journalist, etc.)
 * @param string $context Context/source type (News, Podcast, Social Media, NBA Player, Interview, Online Forum)
 * @param string $source_url Optional URL to the original source
 * @param string $date_said Optional date when the quote was originally made (YYYY-MM-DD format)
 * @return bool Success status
 */
function addQuote($quote_text, $quoted_by, $context, $source_url = null, $date_said = null) {
    global $pdo;
    
    try {
        $stmt = $pdo->prepare("
            INSERT INTO lbjpraise (quotedBy, quoteText, context, dateSaid, sourceURL) 
            VALUES (?, ?, ?, ?, ?)
        ");
        
        $stmt->execute([
            $quoted_by,
            $quote_text,
            $context,
            $date_said,
            $source_url
        ]);
        
        echo "✅ Successfully added quote by {$quoted_by} from {$context}\n";
        return true;
        
    } catch(Exception $e) {
        echo "❌ Error adding quote: " . $e->getMessage() . "\n";
        return false;
    }
}

// Command line usage
if (php_sapi_name() === 'cli') {
    echo "=== LeBron James Praise Quote Adder ===\n\n";
    
    if ($argc < 4) {
        echo "Usage: php add_quote.php \"quote text\" \"quoted by\" \"context\" [source_url] [date_said]\n";
        echo "\nContext types: News, Podcast, Social Media, NBA Player, Interview, Online Forum\n";
        echo "Example: php add_quote.php \"LeBron is amazing\" \"Michael Jordan\" \"Interview\" \"https://example.com\" \"2024-01-01\"\n";
        exit(1);
    }
    
    $quote_text = $argv[1];
    $quoted_by = $argv[2];
    $context = $argv[3];
    $source_url = isset($argv[4]) ? $argv[4] : null;
    $date_said = isset($argv[5]) ? $argv[5] : null;
    
    addQuote($quote_text, $quoted_by, $context, $source_url, $date_said);
    
} else {
    // Web interface for adding quotes
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['add_quote'])) {
            $success = addQuote(
                $_POST['quote_text'],
                $_POST['quoted_by'],
                $_POST['context'],
                $_POST['source_url'] ?: null,
                $_POST['date_said'] ?: null
            );
            
            if ($success) {
                $message = "Quote successfully added!";
                $message_type = "success";
            } else {
                $message = "Error adding quote.";
                $message_type = "error";
            }
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Praise Quote - LeBron James Museum</title>
        <style>
            body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
            .form-group { margin-bottom: 15px; }
            label { display: block; margin-bottom: 5px; font-weight: bold; }
            input, textarea, select { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
            textarea { height: 100px; resize: vertical; }
            button { background: #007cba; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
            button:hover { background: #005a87; }
            .message { padding: 10px; margin: 10px 0; border-radius: 4px; }
            .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
            .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
            .back-link { display: inline-block; margin-bottom: 20px; color: #007cba; text-decoration: none; }
            .back-link:hover { text-decoration: underline; }
        </style>
    </head>
    <body>
        <a href="praise.php" class="back-link">&larr; Back to Praise Wall</a>
        
        <h1>Add Praise Quote</h1>
        <p>Use this form to add quotes from external sources like news articles, podcasts, interviews, or social media.</p>
        
        <?php if (isset($message)): ?>
            <div class="message <?= $message_type; ?>">
                <?= htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label for="quote_text">Quote Text *</label>
                <textarea id="quote_text" name="quote_text" required placeholder="Enter the praise quote here..."></textarea>
            </div>
            
            <div class="form-group">
                <label for="quoted_by">Quoted By *</label>
                <input type="text" id="quoted_by" name="quoted_by" required placeholder="e.g., Stephen Curry, Michael Jordan, etc.">
            </div>
            
            <div class="form-group">
                <label for="context">Context/Source Type *</label>
                <select id="context" name="context" required>
                    <option value="">Select source type...</option>
                    <option value="News">News Article</option>
                    <option value="Podcast">Podcast</option>
                    <option value="Interview">TV/Radio Interview</option>
                    <option value="Social Media">Social Media Post</option>
                    <option value="NBA Player">NBA Player Statement</option>
                    <option value="Online Forum">Online Forum/Discussion</option>
                    <option value="Press Conference">Press Conference</option>
                    <option value="Documentary">Documentary</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="source_url">Source URL (Optional)</label>
                <input type="url" id="source_url" name="source_url" placeholder="https://example.com/article">
            </div>
            
            <div class="form-group">
                <label for="date_said">Date Said (Optional)</label>
                <input type="date" id="date_said" name="date_said">
            </div>
            
            <button type="submit" name="add_quote">Add Quote</button>
        </form>
        
        <hr style="margin: 30px 0;">
        
        <h2>Recent Quotes</h2>
        <?php
        try {
            $stmt = $pdo->query("SELECT * FROM lbjpraise ORDER BY id DESC LIMIT 10");
            $recent_quotes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if ($recent_quotes): ?>
                <div style="max-height: 400px; overflow-y: auto; border: 1px solid #ddd; padding: 15px;">
                    <?php foreach ($recent_quotes as $quote): ?>
                        <div style="border-bottom: 1px solid #eee; padding: 10px 0;">
                            <strong><?= htmlspecialchars($quote['quotedBy']); ?></strong>
                            <span style="color: #666; font-size: 0.9em;">(<?= htmlspecialchars($quote['context'] ?: 'Unknown'); ?>)</span>
                            <?php if ($quote['sourceURL']): ?>
                                <a href="<?= htmlspecialchars($quote['sourceURL']); ?>" target="_blank" style="color: #007cba; font-size: 0.8em; margin-left: 5px;">🔗 Source</a>
                            <?php endif; ?>
                            <p style="margin: 5px 0;">"<?= htmlspecialchars($quote['quoteText']); ?>"</p>
                            <?php if ($quote['dateSaid']): ?>
                                <small style="color: #888;"><?= date('M j, Y', strtotime($quote['dateSaid'])); ?></small>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>No quotes added yet.</p>
            <?php endif;
        } catch(Exception $e) {
            echo "<p>Error loading recent quotes: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
        ?>
    </body>
    </html>
    <?php
}
?>