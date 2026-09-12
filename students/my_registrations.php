<?php
session_start();

if(!isset($_SESSION['student_email']))
{
    header("Location: login.php");
    exit();
}

include("../includes/db.php");

$email = $_SESSION['student_email'];

$sql = "SELECT events.event_name,
               events.event_date,
               events.venue,
               events.category
        FROM registrations
        JOIN events
        ON registrations.event_id = events.id
        WHERE registrations.student_email = ?
        ORDER BY events.event_date ASC";

$stmt = mysqli_prepare($conn, $sql);

if(!$stmt)
{
    die("Database query preparation failed.");
}

mysqli_stmt_bind_param($stmt, "s", $email);

if(!mysqli_stmt_execute($stmt))
{
    mysqli_stmt_close($stmt);
    die("Database query execution failed.");
}

$result = mysqli_stmt_get_result($stmt);

if(!$result)
{
    mysqli_stmt_close($stmt);
    die("Unable to retrieve registrations.");
}

$registration_count = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>My Registrations | CampusHub</title>

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
    background: #101828;
    padding: 15px 0;
}

.navbar-brand {
    color: white !important;
    font-size: 22px;
    font-weight: 800;
    letter-spacing: -0.5px;
}

.navbar-brand span {
    color: #7c6cff;
}

.nav-links {
    display: flex;
    align-items: center;
    gap: 8px;
}

.nav-link-custom {
    color: #cbd5e1;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    padding: 8px 12px;
    border-radius: 7px;
}

.nav-link-custom:hover,
.nav-link-custom.active {
    color: white;
    background: rgba(255,255,255,0.08);
}

.logout-btn {
    color: #e5e7eb;
    border: 1px solid rgba(255,255,255,0.15);
    padding: 8px 14px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 12px;
    font-weight: 600;
}

.logout-btn:hover {
    color: white;
    background: rgba(255,255,255,0.08);
}


/* Main */

.registrations-page {
    padding: 45px 20px 65px;
}


/* Header */

.page-header {
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
    font-size: 32px;
    font-weight: 800;
    letter-spacing: -1px;
    margin-bottom: 8px;
}

.page-header p {
    color: #667085;
    font-size: 14px;
    margin: 0;
}


/* Summary */

.summary-card {
    background: white;
    border: 1px solid #e7eaf0;
    border-radius: 16px;
    padding: 20px 23px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 28px;
}

.summary-left {
    display: flex;
    align-items: center;
    gap: 14px;
}

.summary-icon {
    width: 44px;
    height: 44px;
    border-radius: 11px;
    background: #eeedff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 19px;
}

.summary-title {
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 3px;
}

.summary-description {
    color: #98a2b3;
    font-size: 11px;
}

.summary-number {
    font-size: 25px;
    font-weight: 800;
    color: #635bff;
}


/* Registration Cards */

.registration-card {
    background: white;
    border: 1px solid #e7eaf0;
    border-radius: 17px;
    overflow: hidden;
    height: 100%;
    transition: 0.2s;
}

.registration-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(16,24,40,0.08);
}


/* Card Top */

.card-top {
    background: linear-gradient(
        135deg,
        #101828,
        #293653
    );

    padding: 20px 22px;
    color: white;
    position: relative;
    overflow: hidden;
}

.card-top::after {
    content: "";

    width: 120px;
    height: 120px;

    border-radius: 50%;

    background: rgba(124,108,255,0.15);

    position: absolute;

    right: -45px;
    top: -65px;
}

.registered-badge {
    display: inline-block;

    background: rgba(255,255,255,0.11);

    color: #c8c3ff;

    padding: 5px 9px;

    border-radius: 20px;

    font-size: 9px;

    font-weight: 800;

    text-transform: uppercase;

    letter-spacing: .6px;

    margin-bottom: 12px;
}

.card-top h2 {
    font-size: 17px;
    font-weight: 800;
    margin: 0;
    position: relative;
    z-index: 2;
}


/* Card Body */

.card-body-custom {
    padding: 22px;
}

.event-detail {
    display: flex;
    align-items: center;
    gap: 11px;
    margin-bottom: 13px;
}

.detail-icon {
    width: 32px;
    height: 32px;
    background: #f3f4f7;
    border-radius: 8px;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 14px;

    flex-shrink: 0;
}

.detail-text {
    min-width: 0;
}

.detail-label {
    display: block;

    color: #98a2b3;

    font-size: 9px;

    font-weight: 800;

    text-transform: uppercase;

    margin-bottom: 2px;
}

.detail-value {
    color: #344054;

    font-size: 12px;

    font-weight: 600;

    word-break: break-word;
}


/* Status */

.status {
    display: flex;
    align-items: center;
    gap: 7px;

    background: #ecfdf3;

    border: 1px solid #abefc6;

    border-radius: 8px;

    padding: 9px 11px;

    margin-top: 20px;

    color: #067647;

    font-size: 11px;

    font-weight: 700;
}

.status-dot {
    width: 7px;
    height: 7px;

    border-radius: 50%;

    background: #12b76a;
}


/* Empty */

.empty-state {
    background: white;

    border: 1px solid #e7eaf0;

    border-radius: 18px;

    padding: 65px 25px;

    text-align: center;
}

.empty-icon {
    font-size: 45px;
    margin-bottom: 15px;
}

.empty-state h2 {
    font-size: 20px;
    font-weight: 800;
    margin-bottom: 8px;
}

.empty-state p {
    color: #667085;
    font-size: 13px;
    margin-bottom: 22px;
}

.browse-btn {
    display: inline-block;

    background: #635bff;

    color: white;

    text-decoration: none;

    padding: 11px 18px;

    border-radius: 9px;

    font-size: 12px;

    font-weight: 700;
}

.browse-btn:hover {
    background: #5148e8;
    color: white;
}


/* Bottom Navigation */

.bottom-navigation {
    margin-top: 35px;

    display: flex;

    justify-content: center;

    gap: 12px;
}

.bottom-navigation a {
    background: white;

    border: 1px solid #dfe3ea;

    color: #475467;

    text-decoration: none;

    padding: 10px 16px;

    border-radius: 9px;

    font-size: 12px;

    font-weight: 700;
}

.bottom-navigation a:hover {
    color: #635bff;
    border-color: #635bff;
}


/* Footer */

.footer {
    text-align: center;
    color: #98a2b3;
    font-size: 12px;
    padding: 28px;
}


/* Mobile */

@media(max-width:768px)
{

    .registrations-page {
        padding: 30px 15px 50px;
    }

    .page-header h1 {
        font-size: 27px;
    }

    .summary-card {
        padding: 18px;
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

<a
href="../index.php"
class="navbar-brand"
>
Campus<span>Hub</span>
</a>


<div class="nav-links">

<a
href="dashboard.php"
class="nav-link-custom"
>
Dashboard
</a>

<a
href="events.php"
class="nav-link-custom"
>
Browse Events
</a>

<a
href="logout.php"
class="logout-btn"
>
Logout
</a>

</div>

</div>

</div>

</nav>



<!-- Main -->

<main class="registrations-page">

<div class="container">


<!-- Header -->

<div class="page-header">

<div class="header-label">
    Student Activity
</div>

<h1>
    My Registrations
</h1>

<p>
    Keep track of the events you've registered for.
</p>

</div>



<!-- Summary -->

<div class="summary-card">

<div class="summary-left">

<div class="summary-icon">
    📋
</div>

<div>

<div class="summary-title">
    Registered Events
</div>

<div class="summary-description">
    Your current event registrations
</div>

</div>

</div>


<div class="summary-number">
    <?php echo $registration_count; ?>
</div>

</div>



<!-- Registration List -->

<?php

if($registration_count > 0)
{

?>

<div class="row g-4">

<?php

while($row=mysqli_fetch_assoc($result))
{

?>

<div class="col-md-6 col-lg-4">

<div class="registration-card">


<!-- Card Header -->

<div class="card-top">

<div class="registered-badge">
    ✓ Registered
</div>

<h2>
    <?php echo htmlspecialchars($row['event_name']); ?>
</h2>

</div>


<!-- Card Body -->

<div class="card-body-custom">


<div class="event-detail">

<div class="detail-icon">
    📅
</div>

<div class="detail-text">

<span class="detail-label">
    Date
</span>

<span class="detail-value">
    <?php echo htmlspecialchars($row['event_date']); ?>
</span>

</div>

</div>



<div class="event-detail">

<div class="detail-icon">
    📍
</div>

<div class="detail-text">

<span class="detail-label">
    Venue
</span>

<span class="detail-value">
    <?php echo htmlspecialchars($row['venue']); ?>
</span>

</div>

</div>



<div class="event-detail">

<div class="detail-icon">
    🏷️
</div>

<div class="detail-text">

<span class="detail-label">
    Category
</span>

<span class="detail-value">
    <?php echo htmlspecialchars($row['category']); ?>
</span>

</div>

</div>



<!-- Status -->

<div class="status">

<span class="status-dot"></span>

Registration confirmed

</div>


</div>

</div>

</div>

<?php

}

?>

</div>

<?php

}
else
{

?>


<!-- Empty State -->

<div class="empty-state">

<div class="empty-icon">
    📅
</div>

<h2>
    No registrations yet
</h2>

<p>
    You haven't registered for any events yet.
    Explore the available events and find something interesting.
</p>

<a
href="events.php"
class="browse-btn"
>
    Explore Events →
</a>

</div>


<?php

}

?>


<!-- Bottom Navigation -->

<div class="bottom-navigation">

<a href="dashboard.php">
    ← Dashboard
</a>

<a href="events.php">
    Browse Events
</a>

</div>


</div>

</main>



<!-- Footer -->

<footer class="footer">

CampusHub · College Event Management System

</footer>


</body>

</html>