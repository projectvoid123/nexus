<?php
if (!defined('allowed')) {
    die('Direct access not permitted');
}

$nav_items = [
    'Home' => [
        'url' => 'index.php',
        'icon' => 'fa-home'
    ],
    'Games' => [
        'url' => 'games.php',
        'icon' => 'fa-gamepad'
    ],
    'AI' => [
        'url' => 'ai.php',
        'icon' => 'fa-robot'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page) ? "$page - Nexus Hub" : 'Nexus Hub' ?></title>
    
    <!-- Styles -->
    <link rel="stylesheet" href="css/styles.css?v=<?= time() ?>">
    <link rel="stylesheet" href="css/<?= strtolower($page) ?>.css?v=<?= time() ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'loading-screen.php'; ?>
    <div id="particles-js"></div>
    
    <header class="main-header">
        <nav class="nav-container">
            <div class="logo">
                <a href="index.php">
                    <span class="logo-text">Nexus</span>
                    <span class="logo-hub">Hub</span>
                </a>
            </div>
            
            <ul class="nav-links">
                <?php foreach($nav_items as $name => $item): ?>
                    <li>
                        <a href="<?= $item['url'] ?>" <?= ($page == $name) ? 'class="active"' : '' ?>>
                            <i class="fas <?= $item['icon'] ?>"></i>
                            <?= $name ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </header>
</body>
</html> 