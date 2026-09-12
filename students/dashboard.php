<?php
session_start();

if(!isset($_SESSION['student_email']))
{
    header("Location: login.php");
    exit();
}

$student_email = $_SESSION['student_email'];
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Student Dashboard | CampusHub</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>

* {
    font-family: 'Inter', sans-serif;
}

body {
    margin: 0;
    background: #f5f7fb;
    color: #172033;
}

/* Navbar */

.navbar {
    background: #ffffff;
    padding: 14px 0;
    border-bottom: 1px solid #eef0f5;
    box-shadow: 0 2px 12px rgba(16, 24, 40, 0.04);
}

.navbar-brand {
    color: #101a45 !important;
    font-size: 22px;
    font-weight: 800;
    letter-spacing: -0.5px;
    text-decoration: none;
}

.navbar-brand span {
    color: #7c6cff;
}

.nav-user {
    display: flex;
    align-items: center;
    gap: 14px;
}

.user-email {
    color: #667085;
    font-size: 13px;
    font-weight: 500;
}

.logout-btn {
    color: #635bff;
    background: #f5f4ff;
    border: 1px solid #e4e1ff;
    padding: 8px 15px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    transition: .25s ease;
}

.logout-btn:hover {
    background: #635bff;
    color: white;
    border-color: #635bff;
    transform: translateY(-1px);
}

/* Main */

.dashboard {
    padding: 45px 20px 60px;
    animation: dashboardFade .55s ease both;
}

@keyframes dashboardFade {
    from {
        opacity: 0;
        transform: translateY(12px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Welcome */

.welcome-card {
    background:
        radial-gradient(circle at 85% 15%, rgba(124,108,255,.24), transparent 28%),
        radial-gradient(circle at 15% 100%, rgba(99,91,255,.14), transparent 30%),
        linear-gradient(135deg, #101a45 0%, #292261 100%);
    border-radius: 24px;
    padding: 48px 45px;
    color: white;
    position: relative;
    overflow: hidden;
    margin-bottom: 38px;
    box-shadow: 0 20px 50px rgba(31, 27, 91, .16);
}

.welcome-card::before {
    content: "";
    position: absolute;
    width: 300px;
    height: 300px;
    border-radius: 50%;
    background: rgba(124,108,255,0.14);
    right: -100px;
    top: -150px;
}

.welcome-card::after {
    content: "";
    position: absolute;
    width: 260px;
    height: 260px;
    border-radius: 50%;
    background: rgba(124,108,255,.10);
    left: 48%;
    bottom: -180px;
}

.welcome-card::marker {
    display: none;
}

.welcome-content {
    position: relative;
    z-index: 2;
}

.welcome-label {
    color: #a9a1ff;
    text-transform: uppercase;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 1px;
    margin-bottom: 12px;
}

.welcome-card h1 {
    font-size: 36px;
    font-weight: 800;
    letter-spacing: -1.3px;
    margin-bottom: 12px;
    line-height: 1.15;
}

.welcome-card p {
    color: rgba(255,255,255,.72);
    font-size: 14px;
    line-height: 1.7;
    margin: 0;
    max-width: 680px;
}

/* Section */

.section-title {
    font-size: 20px;
    font-weight: 800;
    letter-spacing: -.4px;
    margin-bottom: 8px;
    color: #101828;
}

.section-subtitle {
    color: #667085;
    font-size: 13px;
    margin-top: 0;
    margin-bottom: 22px;
}

/* Action Cards */

.action-card {
    background: white;
    border: 1px solid #e7eaf0;
    border-radius: 18px;
    padding: 28px;
    height: 100%;
    transition: .3s ease;
    text-decoration: none;
    display: block;
    color: inherit;
    position: relative;
    overflow: hidden;
}

.action-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 40px rgba(16,24,40,.10);
    border-color: #dedbff;
    color: inherit;
}

.action-icon {
    width: 54px;
    height: 54px;
    border-radius: 14px;
    background: linear-gradient(135deg, #eeedff, #f5f3ff);
    color: #635bff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 23px;
    margin-bottom: 20px;
    transition: .3s ease;
}

.action-card:hover .action-icon {
    transform: scale(1.08) rotate(-3deg);
}

.action-card h3 {
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 8px;
}

.action-card p {
    color: #667085;
    font-size: 13px;
    line-height: 1.6;
    margin-bottom: 18px;
}

.action-link {
    color: #635bff;
    font-size: 13px;
    font-weight: 700;
}

/* Stats */

.stats-section {
    margin-top: 35px;
}

.stat-card {
    background: white;
    border: 1px solid #e7eaf0;
    border-radius: 16px;
    padding: 23px;
    height: 100%;
    transition: .25s ease;
}

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 28px rgba(16,24,40,.07);
}

.stat-label {
    color: #667085;
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 8px;
}

.stat-value {
    font-size: 25px;
    font-weight: 800;
    color: #172033;
}

/* Quick Navigation */

.quick-section {
    margin-top: 35px;
}

.quick-card {
    background: white;
    border: 1px solid #e7eaf0;
    border-radius: 18px;
    padding: 8px 24px;
    box-shadow: 0 8px 25px rgba(16,24,40,.03);
}

.quick-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 17px 0;
    border-bottom: 1px solid #edf0f4;
    text-decoration: none;
    color: #172033;
    transition: .2s ease;
}

.quick-item:last-child {
    border-bottom: none;
}

.quick-item:hover {
    color: #635bff;
    padding-left: 5px;
}

.quick-left {
    display: flex;
    align-items: center;
    gap: 13px;
}

.quick-icon {
    width: 38px;
    height: 38px;
    border-radius: 9px;
    background: #f1f3f7;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
}

.quick-name {
    font-size: 13px;
    font-weight: 600;
}

.arrow {
    color: #98a2b3;
}

/* Footer */

.footer {
    text-align: center;
    color: #98a2b3;
    font-size: 12px;
    padding: 30px 0;
}

/* Mobile */

@media (max-width: 768px) {

    .dashboard {
        padding: 30px 15px 45px;
    }

    .welcome-card {
    padding: 32px 25px;
    border-radius: 20px;
}

    .welcome-card h1 {
        font-size: 28px;
    }

    .user-email {
        display: none;
    }

}

</style>

</head>

<body>


<!-- Navbar -->

<nav class="navbar">

<div class="container">

<a class="navbar-brand" href="../index.php">
    Campus<span>Hub</span>
</a>

<div class="nav-user">

<span class="user-email">
    <?php echo htmlspecialchars($student_email); ?>
</span>

<a href="logout.php" class="logout-btn">
    Logout
</a>

</div>

</div>

</nav>


<!-- Dashboard -->

<main class="dashboard">

<div class="container">


<!-- Welcome -->

<div class="welcome-card">

<div class="welcome-content">

<div class="welcome-label">
    Student Dashboard
</div>

<h1>
    Welcome back 👋
</h1>

<p>
    Stay connected with what's happening on campus.
    Discover events, manage your registrations and make
    the most of your college experience.
</p>

</div>

</div>


<!-- Main Actions -->

<div class="section-title">
    What would you like to do?
</div>

<div class="section-subtitle">
    Manage your campus activities from one place.
</div>


<div class="row g-4">


<!-- Browse Events -->

<div class="col-md-6">

<a href="events.php" class="action-card">

<div class="action-icon">
    🎟️
</div>

<h3>
    Browse Events
</h3>

<p>
    Explore upcoming workshops, cultural programs,
    competitions and other events happening on campus.
</p>

<div class="action-link">
    Explore events →
</div>

</a>

</div>


<!-- My Registrations -->

<div class="col-md-6">

<a href="my_registrations.php" class="action-card">

<div class="action-icon">
    📋
</div>

<h3>
    My Registrations
</h3>

<p>
    View the events you have registered for and
    keep track of your participation.
</p>

<div class="action-link">
    View registrations →
</div>

</a>

</div>

</div>


<!-- Stats -->

<div class="stats-section">

<div class="section-title">
    Your Campus Activity
</div>

<div class="row g-3">


<div class="col-6 col-md-4">

<div class="stat-card">

<div class="stat-label">
    ACCOUNT
</div>

<div class="stat-value">
    Active
</div>

</div>

</div>


<div class="col-6 col-md-4">

<div class="stat-card">

<div class="stat-label">
    PORTAL
</div>

<div class="stat-value">
    Student
</div>

</div>

</div>


<div class="col-12 col-md-4">

<div class="stat-card">

<div class="stat-label">
    ACCESS
</div>

<div class="stat-value">
    Available
</div>

</div>

</div>


</div>

</div>


<!-- Quick Navigation -->

<div class="quick-section">

<div class="section-title">
    Quick Access
</div>

<div class="quick-card">


<a href="events.php" class="quick-item">

<div class="quick-left">

<div class="quick-icon">
    🔎
</div>

<div class="quick-name">
    Find an Event
</div>

</div>

<div class="arrow">
    →
</div>

</a>


<a href="my_registrations.php" class="quick-item">

<div class="quick-left">

<div class="quick-icon">
    📅
</div>

<div class="quick-name">
    View My Registrations
</div>

</div>

<div class="arrow">
    →
</div>

</a>


<a href="../index.php" class="quick-item">

<div class="quick-left">

<div class="quick-icon">
    🏠
</div>

<div class="quick-name">
    Return to CampusHub Home
</div>

</div>

<div class="arrow">
    →
</div>

</a>


</div>

</div>


</div>

</main>


<!-- Footer -->

<footer class="footer">

<div class="container">

CampusHub · College Event Management System

</div>

</footer>


</body>
</html>