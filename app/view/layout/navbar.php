<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$currentPage = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar">
    <div class="logo">
        <img src="assets/images/FitnessImage.png" alt="Logo" />
        <span class="logo-text">Fitness<br>Tracker</span>
    </div>

    <ul class="nav-links">

        <?php if (isset($_SESSION['user_id'])): ?>

            <li>
                <a href="dashboard.php"
                    class="<?= $currentPage === 'dashboard.php' ? 'active' : '' ?>">
                    Dashboard
                </a>
            </li>

            <li>
                <a href="calendar.php"
                    class="<?= $currentPage === 'calendar.php' ? 'active' : '' ?>">
                    Calendar
                </a>
            </li>

            <li>
                <a href="logout.php">
                    Logout
                </a>
            </li>

        <?php else: ?>

            <li>
                <a href="index.php"
                    class="<?= $currentPage === 'index.php' ? 'active' : '' ?>">
                    Login
                </a>
            </li>

            <li>
                <a href="register.php"
                    class="<?= $currentPage === 'register.php' ? 'active' : '' ?>">
                    Sign Up
                </a>
            </li>

        <?php endif; ?>

    </ul>
</nav>