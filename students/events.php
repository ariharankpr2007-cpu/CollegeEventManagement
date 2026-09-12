<?php
session_start();

if(!isset($_SESSION['student_email']))
{
    header("Location: login.php");
    exit();
}

include("../includes/db.php");

$result = mysqli_query($conn,"SELECT * FROM events");
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Explore Events | CampusHub</title>

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
    background:
        radial-gradient(circle at 10% 0%, rgba(99,91,255,.05), transparent 28%),
        #f7f8fc;
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

.nav-links {
    display: flex;
    align-items: center;
    gap: 10px;
}

.nav-link-custom {
    color: #667085;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    padding: 8px 12px;
    border-radius: 7px;
}

.nav-link-custom:hover,
.nav-link-custom.active {
    color: #635bff;
    background: #f5f4ff;
}

.logout-btn {
    color: #635bff;
    background: #f5f4ff;
    border: 1px solid #e4e1ff;
    padding: 8px 14px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 12px;
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

.events-page {
    padding: 48px 20px 65px;
    animation: pageFade .55s ease both;
}

@keyframes pageFade {
    from {
        opacity: 0;
        transform: translateY(12px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Header */

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 30px;
}

.header-label {
    color: #635bff;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 9px;
}

.page-header h1 {
    font-size: 36px;
    font-weight: 800;
    letter-spacing: -1.3px;
    margin: 0 0 9px;
    line-height: 1.15;
}

.page-header p {
    color: #667085;
    font-size: 14px;
    margin: 0;
    line-height: 1.6;
}

/* Search */

.search-box {
    width: 290px;
    position: relative;
}

.search-box input {
    height: 48px;
    border: 1px solid #dfe3ea;
    border-radius: 12px;
    padding: 0 16px;
    font-size: 13px;
    background: white;
    box-shadow: 0 5px 18px rgba(16,24,40,.04);
    transition: .25s ease;
}

.search-box input:focus {
    border-color: #635bff;
    box-shadow: 0 0 0 4px rgba(99,91,255,0.10);
    outline: none;
}

/* Event card */

.event-card {
    background: white;
    border: 1px solid #e7eaf0;
    border-radius: 20px;
    overflow: hidden;
    height: 100%;
    transition: .3s ease;
    display: flex;
    flex-direction: column;
    box-shadow: 0 6px 20px rgba(16,24,40,.03);
}

.event-card:hover {
    transform: translateY(-7px);
    box-shadow: 0 22px 45px rgba(16,24,40,.11);
    border-color: #dedbff;
}

.event-item {
    animation: cardAppear .5s ease both;
}

.event-item:nth-child(2) {
    animation-delay: .05s;
}

.event-item:nth-child(3) {
    animation-delay: .10s;
}

.event-item:nth-child(4) {
    animation-delay: .15s;
}

.event-item:nth-child(5) {
    animation-delay: .20s;
}

.event-item:nth-child(6) {
    animation-delay: .25s;
}

@keyframes cardAppear {
    from {
        opacity: 0;
        transform: translateY(15px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Event visual */

.event-visual {
    height: 175px;
    background:
        radial-gradient(circle at 85% 15%, rgba(124,108,255,.28), transparent 28%),
        linear-gradient(135deg, #101a45 0%, #292261 100%);
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.event-visual::before {
    content: "";
    width: 180px;
    height: 180px;
    border-radius: 50%;
    background: rgba(124,108,255,0.20);
    position: absolute;
    top: -90px;
    right: -50px;
}

.event-visual::after {
    content: "";
    width: 130px;
    height: 130px;
    border-radius: 50%;
    background: rgba(255,255,255,0.05);
    position: absolute;
    bottom: -70px;
    left: -30px;
}

.event-symbol {
    position: relative;
    z-index: 2;
    font-size: 50px;
    filter: drop-shadow(0 8px 15px rgba(0,0,0,.18));
    transition: .3s ease;
}

.event-card:hover .event-symbol {
    transform: scale(1.12) rotate(-4deg);
}

/* Category */

.category-badge {
    position: absolute;
    top: 14px;
    left: 14px;
    z-index: 3;
    background: rgba(255,255,255,0.94);
    color: #344054;
    padding: 6px 10px;
    border-radius: 20px;
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
}

/* Card body */

.event-body {
    padding: 22px;
    display: flex;
    flex-direction: column;
    flex: 1;
}

.event-title {
    font-size: 17px;
    font-weight: 800;
    color: #172033;
    margin-bottom: 18px;
    line-height: 1.35;
}

.event-info {
    display: flex;
    align-items: flex-start;
    gap: 11px;
    margin-bottom: 12px;
}

.info-icon {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    background: #f1f3f7;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    flex-shrink: 0;
}

.info-text {
    padding-top: 2px;
}

.info-label {
    display: block;
    color: #98a2b3;
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    margin-bottom: 2px;
}

.info-value {
    color: #344054;
    font-size: 12px;
    font-weight: 600;
    word-break: break-word;
}

/* Register button */

.register-btn {
    width: 100%;
    height: 46px;
    border-radius: 10px;
    background: linear-gradient(135deg, #635bff, #765cff);
    color: white;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    font-weight: 700;
    margin-top: auto;
    transition: .25s ease;
    box-shadow: 0 7px 16px rgba(99,91,255,.16);
}

.register-btn:hover {
    background: linear-gradient(135deg, #554ce8, #6850ee);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 10px 22px rgba(99,91,255,.24);
}

/* Empty state */

.empty-state {
    background: white;
    border: 1px solid #e7eaf0;
    border-radius: 18px;
    padding: 70px 25px;
    text-align: center;
}

.empty-icon {
    font-size: 45px;
    margin-bottom: 15px;
}

.empty-state h3 {
    font-size: 19px;
    font-weight: 800;
}

.empty-state p {
    color: #667085;
    font-size: 13px;
}

/* Bottom */

.bottom-nav {
    margin-top: 40px;
    display: flex;
    justify-content: center;
    gap: 12px;
}

.bottom-nav a {
    text-decoration: none;
    font-size: 12px;
    font-weight: 700;
    padding: 10px 16px;
    border-radius: 9px;
    border: 1px solid #dfe3ea;
    color: #475467;
    background: white;
}

.bottom-nav a:hover {
    color: #635bff;
    border-color: #635bff;
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

    .events-page {
        padding: 30px 15px 50px;
    }

    .page-header {
        display: block;
    }

    .page-header h1 {
    font-size: 29px;
}

.page-header p {
    font-size: 13px;
}

.event-visual {
    height: 165px;
}

    .search-box {
        width: 100%;
        margin-top: 20px;
    }

    .nav-links {
        gap: 3px;
    }

    .nav-link-custom {
        display: none;
    }

}

</style>

</head>

<body>


<!-- Navbar -->

<nav class="navbar">

<div class="container">

<div class="d-flex align-items-center justify-content-between w-100">

<a class="navbar-brand" href="../index.php">
    Campus<span>Hub</span>
</a>

<div class="nav-links">

<a href="dashboard.php" class="nav-link-custom">
    Dashboard
</a>

<a href="my_registrations.php" class="nav-link-custom">
    My Registrations
</a>

<a href="logout.php" class="logout-btn">
    Logout
</a>

</div>

</div>

</div>

</nav>


<!-- Events Page -->

<main class="events-page">

<div class="container">


<!-- Header -->

<div class="page-header">

<div>

<div class="header-label">
    Campus Events
</div>

<h1>
    Explore what's happening
</h1>

<p>
    Discover events, activities and opportunities happening across your campus.
</p>

</div>


<div class="search-box">

<input
    type="text"
    id="eventSearch"
    class="form-control"
    placeholder="Search events..."
>

</div>

</div>


<!-- Event Grid -->

<div class="row g-4" id="eventGrid">

<?php

if(mysqli_num_rows($result) > 0)
{

while($row=mysqli_fetch_assoc($result))
{

?>

<div class="col-md-6 col-lg-4 event-item">

<div class="event-card">


<!-- Event Visual -->

<div class="event-visual">

<div class="category-badge">
    <?php echo htmlspecialchars($row['category']); ?>
</div>

<div class="event-symbol">
    🎫
</div>

</div>


<!-- Event Details -->

<div class="event-body">

<div class="event-title">
    <?php echo htmlspecialchars($row['event_name']); ?>
</div>


<div class="event-info">

<div class="info-icon">
    📅
</div>

<div class="info-text">

<span class="info-label">
    Date
</span>

<span class="info-value">
    <?php echo htmlspecialchars($row['event_date']); ?>
</span>

</div>

</div>


<div class="event-info">

<div class="info-icon">
    📍
</div>

<div class="info-text">

<span class="info-label">
    Venue
</span>

<span class="info-value">
    <?php echo htmlspecialchars($row['venue']); ?>
</span>

</div>

</div>


<div class="event-info">

<div class="info-icon">
    🏷️
</div>

<div class="info-text">

<span class="info-label">
    Category
</span>

<span class="info-value">
    <?php echo htmlspecialchars($row['category']); ?>
</span>

</div>

</div>


<a
    href="register_event.php?id=<?php echo $row['id']; ?>"
    class="register-btn"
>
    Register for Event →
</a>


</div>

</div>

</div>

<?php

}

}
else
{

?>

<div class="col-12">

<div class="empty-state">

<div class="empty-icon">
    📅
</div>

<h3>
    No events available
</h3>

<p>
    There are currently no events available for registration.
    Please check again later.
</p>

</div>

</div>

<?php

}

?>

</div>


<!-- Bottom Navigation -->

<div class="bottom-nav">

<a href="dashboard.php">
    ← Dashboard
</a>

<a href="my_registrations.php">
    My Registrations
</a>

</div>


</div>

</main>


<!-- Footer -->

<footer class="footer">

CampusHub · College Event Management System

</footer>


<script>

/* Event Search */

document.getElementById("eventSearch").addEventListener("keyup", function()
{

    let searchValue = this.value.toLowerCase();

    let events = document.querySelectorAll(".event-item");

    events.forEach(function(event)
    {

        let text = event.innerText.toLowerCase();

        if(text.includes(searchValue))
        {
            event.style.display = "";
        }
        else
        {
            event.style.display = "none";
        }

    });

});

</script>


</body>
</html>