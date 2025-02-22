<?php
$page = "Home";
define('allowed', true);
include 'header.php';
?>

<main class="home-container">
    <div class="welcome-section">
        <h1>Welcome to <span class="accent">Nexus Hub</span></h1>
        <p>The best unblocked games website.</p>
        
        <div class="feature-cards">
            <a href="games.php" class="feature-card games">
                <div class="card-content">
                    <i class="fas fa-gamepad"></i>
                    <h2>Games</h2>
                    <p>200+ Unblocked Games</p>
                </div>
            </a>
            
            <a href="ai.php" class="feature-card ai">
                <div class="card-content">
                    <i class="fas fa-robot"></i>
                    <h2>AI Chat</h2>
                    <p>Multiple AI Models to choose from</p>
                </div>
            </a>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script src="js/particles-config.js?v=<?php echo time(); ?>"></script>
</body>
</html>