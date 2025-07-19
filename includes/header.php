<?php
if (!function_exists('get_current_page')) {
    require_once 'includes/functions.php';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'Center for Applied Computing'; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <?php if (isset($additional_css)): ?>
        <?php foreach ($additional_css as $css): ?>
            <link rel="stylesheet" href="<?php echo htmlspecialchars($css); ?>">
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body>
    <div class="container">
        <!-- Header Section -->
        <header class="header">
            <div class="logo-section">
                <a href="http://ccse.kennesaw.edu/it" target="_blank">
                    <img src="img/ksu_horizontal.svg" alt="Kennesaw State University" class="logo">
                </a>
            </div>
            <h1 class="site-title">Center for Applied Computing</h1>
            
            <?php include 'includes/navigation.php'; ?>
        </header>