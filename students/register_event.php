<?php

session_start();

if(!isset($_SESSION['student_email']))
{
    header("Location: login.php");
    exit();
}

include("../includes/db.php");

$student_email = $_SESSION['student_email'];


/* =========================
   VALIDATE EVENT ID
========================= */

if(!isset($_GET['id']) || !ctype_digit($_GET['id']))
{
    header("Location: events.php");
    exit();
}

$event_id = (int) $_GET['id'];


/* =========================
   GET EVENT DETAILS
========================= */

$event_stmt = mysqli_prepare(
    $conn,
    "SELECT id, event_name, event_date, venue, category
     FROM events
     WHERE id = ?"
);

mysqli_stmt_bind_param(
    $event_stmt,
    "i",
    $event_id
);

mysqli_stmt_execute($event_stmt);

$event_result = mysqli_stmt_get_result($event_stmt);

if(mysqli_num_rows($event_result) == 0)
{
    mysqli_stmt_close($event_stmt);

    echo "<script>
        alert('Event not found');
        window.location='events.php';
    </script>";

    exit();
}

$event = mysqli_fetch_assoc($event_result);

mysqli_stmt_close($event_stmt);


/* =========================
   CHECK EXISTING REGISTRATION
========================= */

$check_stmt = mysqli_prepare(
    $conn,
    "SELECT event_id
     FROM registrations
     WHERE student_email = ?
     AND event_id = ?
     LIMIT 1"
);

mysqli_stmt_bind_param(
    $check_stmt,
    "si",
    $student_email,
    $event_id
);

mysqli_stmt_execute($check_stmt);

$check_result = mysqli_stmt_get_result($check_stmt);

$already_registered = mysqli_num_rows($check_result) > 0;

mysqli_stmt_close($check_stmt);


/* =========================
   CONFIRM REGISTRATION
========================= */

if(isset($_POST['confirm_registration']))
{

    /* Check again at submission time */

    $check_stmt = mysqli_prepare(
        $conn,
        "SELECT event_id
         FROM registrations
         WHERE student_email = ?
         AND event_id = ?
         LIMIT 1"
    );

    mysqli_stmt_bind_param(
        $check_stmt,
        "si",
        $student_email,
        $event_id
    );

    mysqli_stmt_execute($check_stmt);

    $check_result = mysqli_stmt_get_result($check_stmt);

    if(mysqli_num_rows($check_result) > 0)
    {
        mysqli_stmt_close($check_stmt);

        echo "<script>
            alert('You have already registered for this event');
            window.location='my_registrations.php';
        </script>";

        exit();
    }

    mysqli_stmt_close($check_stmt);


    /* Insert registration safely */

    $insert_stmt = mysqli_prepare(
        $conn,
        "INSERT INTO registrations(student_email, event_id)
         VALUES(?, ?)"
    );

    mysqli_stmt_bind_param(
        $insert_stmt,
        "si",
        $student_email,
        $event_id
    );


    if(mysqli_stmt_execute($insert_stmt))
    {
        mysqli_stmt_close($insert_stmt);

        echo "<script>
            alert('Registration Successful');
            window.location='my_registrations.php';
        </script>";

        exit();
    }
    else
    {
        mysqli_stmt_close($insert_stmt);

        echo "<script>
            alert('Registration Failed');
            window.location='events.php';
        </script>";

        exit();
    }
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Register for Event | CampusHub</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet"
>

<link
rel="preconnect"
href="https://fonts.googleapis.com"
>

<link
rel="preconnect"
href="https://fonts.gstatic.com"
crossorigin
>

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
    box-shadow: 0 2px 12px rgba(16,24,40,.04);
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

.nav-link {
    color: #667085 !important;
    font-size: 13px;
    font-weight: 600;
    transition: .2s ease;
}

.nav-link:hover {
    color: #635bff !important;
}


/* Main */

.registration-page {
    min-height: calc(100vh - 70px);
    padding: 55px 20px;
    animation: registrationFade .55s ease both;
}

@keyframes registrationFade {
    from {
        opacity: 0;
        transform: translateY(12px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}


/* Back */

.back-link {
    display: inline-flex;
    align-items: center;
    color: #667085;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 20px;
    transition: .2s ease;
}

.back-link:hover {
    color: #635bff;
    transform: translateX(-3px);
}


/* Main Card */

.confirm-card {
    max-width: 900px;
    margin: auto;
    background: white;
    border-radius: 24px;
    overflow: hidden;
    border: 1px solid #e7eaf0;
    box-shadow: 0 22px 60px rgba(16,24,40,.09);
}


/* Header */

.event-header {
    background:
        radial-gradient(circle at 85% 15%, rgba(124,108,255,.25), transparent 28%),
        radial-gradient(circle at 10% 100%, rgba(99,91,255,.12), transparent 30%),
        linear-gradient(135deg, #101a45 0%, #292261 100%);
    padding: 48px 45px;
    color: white;
    position: relative;
    overflow: hidden;
}

.event-header::after {
    content: "";
    position: absolute;

    width: 280px;
    height: 280px;

    border-radius: 50%;

    background: rgba(124,108,255,0.16);

    right: -100px;
    top: -150px;
}

.event-header-content {
    position: relative;
    z-index: 2;
}

.category {
    display: inline-block;

    background: rgba(255,255,255,0.12);

    color: #c9c4ff;

    padding: 7px 12px;

    border-radius: 20px;

    font-size: 10px;

    font-weight: 800;

    text-transform: uppercase;

    letter-spacing: .6px;

    margin-bottom: 15px;
}

.event-header h1 {
    font-size: 34px;
    font-weight: 800;
    letter-spacing: -1px;
    margin-bottom: 10px;
    line-height: 1.15;
}

.event-header p {
    color: #b9c3d4;
    font-size: 13px;
    margin: 0;
}


/* Content */

.confirm-content {
    padding: 40px 45px;
}


/* Section */

.section-label {
    font-size: 11px;
    font-weight: 800;
    color: #635bff;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 20px;
}


/* Details */

.event-details {
    display: grid;

    grid-template-columns:
    repeat(3, 1fr);

    gap: 15px;

    margin-bottom: 35px;
}

.detail-box {
    background: #fafaff;
    border: 1px solid #e9e7ff;
    border-radius: 15px;
    padding: 20px;
    transition: .25s ease;
}

.detail-box:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(16,24,40,.06);
    border-color: #ddd9ff;
}

.detail-icon {
    font-size: 19px;
    margin-bottom: 10px;
}

.detail-label {
    color: #98a2b3;
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    margin-bottom: 5px;
}

.detail-value {
    color: #344054;
    font-size: 13px;
    font-weight: 700;
    word-break: break-word;
}


/* Notice */

.notice {
    background: #f5f4ff;
    border: 1px solid #e6e3ff;
    border-radius: 12px;
    padding: 17px 18px;
    margin-bottom: 30px;
}

.notice-title {
    color: #4038b5;
    font-size: 12px;
    font-weight: 800;
    margin-bottom: 5px;
}

.notice-text {
    color: #667085;
    font-size: 12px;
    line-height: 1.6;
    margin: 0;
}


/* Buttons */

.action-row {
    display: flex;
    gap: 12px;
}

.cancel-btn {
    flex: 1;

    height: 48px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 10px;

    border: 1px solid #dfe3ea;

    background: white;

    color: #475467;

    text-decoration: none;

    font-size: 13px;

    font-weight: 700;
}

.cancel-btn:hover {
    background: #f8f9fc;
    color: #172033;
}

.confirm-btn {
    flex: 2;
    height: 50px;
    border: none;
    border-radius: 10px;
    background: linear-gradient(135deg, #635bff, #765cff);
    color: white;
    font-size: 13px;
    font-weight: 700;
    transition: .25s ease;
    box-shadow: 0 8px 18px rgba(99,91,255,.18);
}

.confirm-btn:hover {
    background: linear-gradient(135deg, #554ce8, #6850ee);
    transform: translateY(-2px);
    box-shadow: 0 12px 25px rgba(99,91,255,.25);
}


/* Already registered */

.registered-box {
    background: linear-gradient(135deg, #ecfdf3, #f5fff9);
    border: 1px solid #abefc6;
    border-radius: 15px;
    padding: 22px;
    text-align: center;
    margin-bottom: 25px;
}

.registered-icon {
    font-size: 25px;
    margin-bottom: 7px;
}

.registered-title {
    color: #067647;
    font-weight: 800;
    font-size: 14px;
    margin-bottom: 5px;
}

.registered-text {
    color: #475467;
    font-size: 12px;
    margin-bottom: 15px;
}

.view-registration {
    display: inline-block;

    background: #067647;

    color: white;

    text-decoration: none;

    padding: 9px 16px;

    border-radius: 8px;

    font-size: 12px;

    font-weight: 700;
}

.view-registration:hover {
    color: white;
    background: #05603a;
}


/* Footer */

.footer {
    text-align: center;
    color: #98a2b3;
    font-size: 12px;
    padding: 25px;
}


/* Mobile */

@media(max-width: 700px)
{

    .registration-page {
        padding: 30px 15px;
    }

    .event-header {
        padding: 32px 25px;
    }

    .event-header h1 {
        font-size: 25px;
    }

    .confirm-content {
        padding: 30px 25px;
    }

    .event-details {
        grid-template-columns: 1fr;
    }

    .action-row {
        flex-direction: column;
    }

    .cancel-btn,
    .confirm-btn {
        flex: none;
        width: 100%;
    }

}

</style>

</head>


<body>


<!-- Navbar -->

<nav class="navbar">

<div class="container">

<div class="d-flex justify-content-between align-items-center">

<a
href="../index.php"
class="navbar-brand"
>
Campus<span>Hub</span>
</a>


<div>

<a
href="dashboard.php"
class="nav-link text-decoration-none me-3"
>
Dashboard
</a>

<a
href="my_registrations.php"
class="nav-link text-decoration-none"
>
My Registrations
</a>

</div>

</div>

</div>

</nav>



<!-- Registration Page -->

<main class="registration-page">

<div class="container">

<a
href="events.php"
class="back-link"
>
← Back to Events
</a>


<div class="confirm-card">


<!-- Event Header -->

<div class="event-header">

<div class="event-header-content">

<div class="category">

<?php
echo htmlspecialchars($event['category']);
?>

</div>


<h1>

<?php
echo htmlspecialchars($event['event_name']);
?>

</h1>


<p>
You're one step away from registering for this event.
</p>

</div>

</div>



<!-- Details -->

<div class="confirm-content">


<div class="section-label">
Event Details
</div>


<div class="event-details">


<div class="detail-box">

<div class="detail-icon">
📅
</div>

<div class="detail-label">
Date
</div>

<div class="detail-value">

<?php
echo htmlspecialchars($event['event_date']);
?>

</div>

</div>



<div class="detail-box">

<div class="detail-icon">
📍
</div>

<div class="detail-label">
Venue
</div>

<div class="detail-value">

<?php
echo htmlspecialchars($event['venue']);
?>

</div>

</div>



<div class="detail-box">

<div class="detail-icon">
🏷️
</div>

<div class="detail-label">
Category
</div>

<div class="detail-value">

<?php
echo htmlspecialchars($event['category']);
?>

</div>

</div>


</div>



<?php if($already_registered) { ?>


<!-- Already Registered -->

<div class="registered-box">

<div class="registered-icon">
✓
</div>

<div class="registered-title">
You're already registered
</div>

<div class="registered-text">
This event is already in your registration list.
</div>

<a
href="my_registrations.php"
class="view-registration"
>
View My Registration
</a>

</div>


<?php } else { ?>


<!-- Notice -->

<div class="notice">

<div class="notice-title">
Before you continue
</div>

<p class="notice-text">
Please review the event details above. By confirming,
you will be registered for this event using your
CampusHub student account.
</p>

</div>



<!-- Confirmation -->

<form method="POST">

<div class="action-row">

<a
href="events.php"
class="cancel-btn"
>
Cancel
</a>


<button
type="submit"
name="confirm_registration"
class="confirm-btn"
>
Confirm Registration →
</button>

</div>

</form>


<?php } ?>


</div>

</div>

</div>

</div>

</main>



<footer class="footer">

CampusHub · College Event Management System

</footer>


</body>

</html>