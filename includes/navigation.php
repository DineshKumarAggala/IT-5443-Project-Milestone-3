<?php
$current_page = get_current_page();
$nav_items = array(
    'index' => 'Home',
    'faculty' => 'Faculty',
    'resources' => 'Resources',
    'eligibility' => 'Eligibility Evaluation',
    'application' => 'Apply Now'
);
?>

<!-- Navigation Menu -->
<nav class="navigation">
    <ul class="nav-menu">
        <?php foreach ($nav_items as $page => $title): ?>
            <li>
                <a href="<?php echo $page; ?>.php" 
                   class="nav-link <?php echo ($current_page === $page) ? 'active' : ''; ?>">
                    <?php echo htmlspecialchars($title); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>