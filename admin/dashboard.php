<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: login.php");
    exit();
}

include("../includes/db.php");

$students_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM students");
$events_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM events");
$registrations_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM registrations");

if(!$students_result || !$events_result || !$registrations_result)
{
    die("Unable to load dashboard statistics.");
}

$students = mysqli_fetch_assoc($students_result)['total'];
$events = mysqli_fetch_assoc($events_result)['total'];
$registrations = mysqli_fetch_assoc($registrations_result)['total'];

$admin_username = $_SESSION['admin'];
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin Dashboard | CampusHub</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet"
>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link
href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
rel="stylesheet"
>

<style>

* {
    font-family: 'Inter', sans-serif;
}

body {
    margin: 0;
    background: #f5f7fb;
    color: #172033;
}


/* =========================
   SIDEBAR
========================= */

.sidebar {
    position: fixed;
    left: 0;
    top: 0;
    bottom: 0;

    width: 245px;

    background: #101828;

    padding: 25px 16px;

    z-index: 1000;
}

.logo {
    display: block;

    color: white;

    text-decoration: none;

    font-size: 22px;

    font-weight: 800;

    letter-spacing: -0.5px;

    padding: 0 13px;

    margin-bottom: 38px;
}

.logo span {
    color: #7c6cff;
}


/* Admin badge */

.admin-label {
    color: #667085;

    font-size: 9px;

    font-weight: 800;

    letter-spacing: 1px;

    text-transform: uppercase;

    padding: 0 13px;

    margin-bottom: 10px;
}


/* Navigation */

.sidebar-link {
    display: flex;

    align-items: center;

    gap: 12px;

    color: #aeb8c8;

    text-decoration: none;

    font-size: 12px;

    font-weight: 600;

    padding: 11px 13px;

    border-radius: 9px;

    margin-bottom: 4px;

    transition: .2s;
}

.sidebar-link:hover,
.sidebar-link.active {
    background: rgba(255,255,255,0.08);

    color: white;
}

.sidebar-icon {
    width: 20px;

    text-align: center;

    font-size: 15px;
}


/* Bottom */

.sidebar-bottom {
    position: absolute;

    bottom: 22px;

    left: 16px;

    right: 16px;
}

.sidebar-user {
    border-top: 1px solid rgba(255,255,255,0.08);

    padding-top: 18px;

    margin-bottom: 10px;
}

.user-label {
    color: #667085;

    font-size: 9px;

    font-weight: 700;

    text-transform: uppercase;

    margin-bottom: 4px;
}

.username {
    color: #d6dce7;

    font-size: 11px;

    font-weight: 600;

    word-break: break-word;
}

.logout-link {
    display: flex;

    align-items: center;

    gap: 10px;

    color: #aeb8c8;

    text-decoration: none;

    font-size: 12px;

    font-weight: 600;

    padding: 10px 13px;

    border-radius: 9px;
}

.logout-link:hover {
    color: #ff9b9b;

    background: rgba(255,255,255,0.05);
}


/* =========================
   MAIN
========================= */

.main-content {
    margin-left: 245px;

    min-height: 100vh;

    padding: 35px 40px 55px;
}


/* Topbar */

.topbar {
    display: flex;

    align-items: center;

    justify-content: space-between;

    margin-bottom: 35px;
}

.page-label {
    color: #635bff;

    font-size: 10px;

    font-weight: 800;

    letter-spacing: 1px;

    text-transform: uppercase;

    margin-bottom: 7px;
}

.page-title {
    font-size: 28px;

    font-weight: 800;

    letter-spacing: -0.8px;

    margin: 0;
}

.page-description {
    color: #667085;

    font-size: 13px;

    margin-top: 7px;

    margin-bottom: 0;
}


/* Add event */

.add-event-btn {
    display: flex;

    align-items: center;

    gap: 7px;

    background: #635bff;

    color: white;

    text-decoration: none;

    padding: 11px 16px;

    border-radius: 9px;

    font-size: 12px;

    font-weight: 700;

    transition: .2s;
}

.add-event-btn:hover {
    background: #5148e8;

    color: white;

    transform: translateY(-1px);
}


/* =========================
   STAT CARDS
========================= */

.stat-card {
    background: white;

    border: 1px solid #e7eaf0;

    border-radius: 15px;

    padding: 23px;

    height: 100%;

    transition: .2s;
}

.stat-card:hover {
    transform: translateY(-3px);

    box-shadow:
        0 12px 30px
        rgba(16,24,40,0.07);
}

.stat-top {
    display: flex;

    align-items: center;

    justify-content: space-between;

    margin-bottom: 20px;
}

.stat-icon {
    width: 43px;

    height: 43px;

    border-radius: 11px;

    display: flex;

    align-items: center;

    justify-content: center;

    font-size: 18px;
}

.icon-purple {
    background: #eeedff;
}

.icon-blue {
    background: #eaf3ff;
}

.icon-green {
    background: #eafbf3;
}

.stat-label {
    color: #667085;

    font-size: 11px;

    font-weight: 700;

    text-transform: uppercase;

    letter-spacing: .3px;

    margin-bottom: 5px;
}

.stat-number {
    font-size: 29px;

    font-weight: 800;

    letter-spacing: -1px;

    color: #172033;
}

.stat-link {
    color: #635bff;

    text-decoration: none;

    font-size: 10px;

    font-weight: 700;
}

.stat-link:hover {
    text-decoration: underline;
}


/* =========================
   QUICK ACTIONS
========================= */

.section {
    margin-top: 35px;
}

.section-heading {
    font-size: 17px;

    font-weight: 800;

    margin-bottom: 5px;
}

.section-description {
    color: #667085;

    font-size: 12px;

    margin-bottom: 18px;
}


.quick-card {
    background: white;

    border: 1px solid #e7eaf0;

    border-radius: 14px;

    padding: 20px;

    height: 100%;

    text-decoration: none;

    color: inherit;

    display: block;

    transition: .2s;
}

.quick-card:hover {
    color: inherit;

    transform: translateY(-3px);

    box-shadow:
        0 12px 28px
        rgba(16,24,40,0.07);
}

.quick-icon {
    width: 42px;

    height: 42px;

    border-radius: 10px;

    background: #f1f3f7;

    display: flex;

    align-items: center;

    justify-content: center;

    font-size: 17px;

    margin-bottom: 15px;
}

.quick-card h3 {
    font-size: 14px;

    font-weight: 700;

    margin-bottom: 6px;
}

.quick-card p {
    color: #667085;

    font-size: 11px;

    line-height: 1.6;

    margin-bottom: 14px;
}

.quick-link {
    color: #635bff;

    font-size: 11px;

    font-weight: 700;
}


/* =========================
   OVERVIEW
========================= */

.overview-card {
    background: white;

    border: 1px solid #e7eaf0;

    border-radius: 15px;

    padding: 25px;
}

.overview-row {
    display: flex;

    align-items: center;

    justify-content: space-between;

    padding: 14px 0;

    border-bottom: 1px solid #edf0f4;
}

.overview-row:last-child {
    border-bottom: none;

    padding-bottom: 0;
}

.overview-left {
    display: flex;

    align-items: center;

    gap: 12px;
}

.overview-icon {
    width: 35px;

    height: 35px;

    border-radius: 8px;

    background: #f3f4f7;

    display: flex;

    align-items: center;

    justify-content: center;

    font-size: 14px;
}

.overview-name {
    font-size: 12px;

    font-weight: 600;
}

.overview-value {
    font-size: 12px;

    font-weight: 800;

    color: #635bff;
}


/* Footer */

.footer {
    text-align: center;

    color: #98a2b3;

    font-size: 10px;

    padding-top: 35px;
}


/* =========================
   MOBILE
========================= */

.mobile-topbar {
    display: none;
}

@media(max-width:900px)
{

    .sidebar {
        width: 205px;
    }

    .main-content {
        margin-left: 205px;

        padding:
            30px 25px;
    }

}

@media(max-width:700px)
{

    .sidebar {
        display: none;
    }

    .main-content {
        margin-left: 0;

        padding:
            25px 15px 45px;
    }

    .mobile-topbar {
        display: flex;

        align-items: center;

        justify-content: space-between;

        background: #101828;

        margin:
            -25px -15px 28px;

        padding:
            15px;
    }

    .mobile-logo {
        color: white;

        text-decoration: none;

        font-size: 20px;

        font-weight: 800;
    }

    .mobile-logo span {
        color: #7c6cff;
    }

    .mobile-logout {
        color: #cbd5e1;

        text-decoration: none;

        font-size: 11px;

        font-weight: 700;
    }

    .topbar {
        display: block;
    }

    .add-event-btn {
        display: inline-flex;

        margin-top: 18px;
    }

    .page-title {
        font-size: 25px;
    }

}

</style>

</head>


<body>


<!-- =========================
     SIDEBAR
========================= -->

<aside class="sidebar">

<a href="../index.php" class="logo">
    Campus<span>Hub</span>
</a>


<div class="admin-label">
    Administration
</div>


<a
href="dashboard.php"
class="sidebar-link active"
>
<span class="sidebar-icon">📊</span>
Dashboard
</a>


<a
href="add_event.php"
class="sidebar-link"
>
<span class="sidebar-icon">➕</span>
Add Event
</a>


<a
href="view_events.php"
class="sidebar-link"
>
<span class="sidebar-icon">📅</span>
Manage Events
</a>


<a
href="view_registrations.php"
class="sidebar-link"
>
<span class="sidebar-icon">👥</span>
Registrations
</a>


<div class="sidebar-bottom">

<div class="sidebar-user">

<div class="user-label">
    Signed in as
</div>

<div class="username">
    <?php echo htmlspecialchars($admin_username); ?>
</div>

</div>


<a
href="logout.php"
class="logout-link"
>
<span>↪</span>
Sign out
</a>

</div>

</aside>



<!-- =========================
     MAIN
========================= -->

<main class="main-content">


<!-- Mobile Topbar -->

<div class="mobile-topbar">

<a href="../index.php" class="mobile-logo">
    Campus<span>Hub</span>
</a>

<a href="logout.php" class="mobile-logout">
    Sign out
</a>

</div>



<!-- Topbar -->

<div class="topbar">

<div>

<div class="page-label">
    Administration
</div>

<h1 class="page-title">
    Admin Dashboard
</h1>

<p class="page-description">
    Manage your campus events and monitor student activity.
</p>

</div>


<a
href="add_event.php"
class="add-event-btn"
>
＋ Add New Event
</a>

</div>



<!-- =========================
     STATISTICS
========================= -->

<div class="row g-4">


<!-- Students -->

<div class="col-md-4">

<div class="stat-card">

<div class="stat-top">

<div class="stat-icon icon-purple">
    👨‍🎓
</div>

</div>


<div class="stat-label">
    Total Students
</div>

<div class="stat-number">
    <?php echo $students; ?>
</div>


</div>

</div>



<!-- Events -->

<div class="col-md-4">

<div class="stat-card">

<div class="stat-top">

<div class="stat-icon icon-blue">
    📅
</div>

</div>


<div class="stat-label">
    Total Events
</div>

<div class="stat-number">
    <?php echo $events; ?>
</div>


</div>

</div>



<!-- Registrations -->

<div class="col-md-4">

<div class="stat-card">

<div class="stat-top">

<div class="stat-icon icon-green">
    🎟️
</div>

</div>


<div class="stat-label">
    Total Registrations
</div>

<div class="stat-number">
    <?php echo $registrations; ?>
</div>


</div>

</div>


</div>



<!-- =========================
     QUICK ACTIONS
========================= -->

<section class="section">

<div class="section-heading">
    Quick Actions
</div>

<div class="section-description">
    Access the most frequently used administration tools.
</div>


<div class="row g-3">


<div class="col-md-4">

<a
href="add_event.php"
class="quick-card"
>

<div class="quick-icon">
    ➕
</div>

<h3>
    Create an Event
</h3>

<p>
    Add a new event with its date, venue and category.
</p>

<div class="quick-link">
    Create event →
</div>

</a>

</div>



<div class="col-md-4">

<a
href="view_events.php"
class="quick-card"
>

<div class="quick-icon">
    📅
</div>

<h3>
    Manage Events
</h3>

<p>
    View existing events and update or remove them.
</p>

<div class="quick-link">
    Manage events →
</div>

</a>

</div>



<div class="col-md-4">

<a
href="view_registrations.php"
class="quick-card"
>

<div class="quick-icon">
    👥
</div>

<h3>
    View Registrations
</h3>

<p>
    Review students registered for your campus events.
</p>

<div class="quick-link">
    View registrations →
</div>

</a>

</div>


</div>

</section>



<!-- =========================
     SYSTEM OVERVIEW
========================= -->

<section class="section">

<div class="section-heading">
    Platform Overview
</div>

<div class="section-description">
    Current CampusHub system activity.
</div>


<div class="overview-card">


<div class="overview-row">

<div class="overview-left">

<div class="overview-icon">
    👨‍🎓
</div>

<div class="overview-name">
    Registered Students
</div>

</div>

<div class="overview-value">
    <?php echo $students; ?>
</div>

</div>



<div class="overview-row">

<div class="overview-left">

<div class="overview-icon">
    📅
</div>

<div class="overview-name">
    Published Events
</div>

</div>

<div class="overview-value">
    <?php echo $events; ?>
</div>

</div>



<div class="overview-row">

<div class="overview-left">

<div class="overview-icon">
    🎟️
</div>

<div class="overview-name">
    Event Registrations
</div>

</div>

<div class="overview-value">
    <?php echo $registrations; ?>
</div>

</div>


</div>

</section>



<!-- Footer -->

<footer class="footer">

CampusHub · College Event Management System · Admin Portal

</footer>


</main>


</body>

</html>