<?php
$page = "Display";
define('allowed', true);
include 'header.php';

if (!isset($_GET['game']) || !isset($_GET['title'])) {
    header('Location: games.php');
    exit;
}

$gameUrl = urldecode($_GET['game']);
$gameTitle = urldecode($_GET['title']);
?>

<main class="game-display">
    <div class="game-container">
        <h1><?php echo htmlspecialchars($gameTitle); ?></h1>
        <div class="game-frame-container">
            <iframe src="<?php echo htmlspecialchars($gameUrl); ?>" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="game-controls">
            <button onclick="toggleFullscreen()" class="control-btn">
                <i class="fas fa-expand"></i> Fullscreen
            </button>
            <button onclick="window.location.href='games.php'" class="control-btn">
                <i class="fas fa-arrow-left"></i> Back to Games
            </button>
        </div>
    </div>
</main>

<script>
function toggleFullscreen() {
    const iframe = document.querySelector('iframe');
    if (iframe.requestFullscreen) {
        iframe.requestFullscreen();
    } else if (iframe.webkitRequestFullscreen) {
        iframe.webkitRequestFullscreen();
    } else if (iframe.msRequestFullscreen) {
        iframe.msRequestFullscreen();
    }
}
</script>

<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script src="js/particles-config.js?v=<?php echo time(); ?>"></script>
</body>
</html> 