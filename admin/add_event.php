<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: login.php");
    exit();
}

include("../includes/db.php");

if(isset($_POST['add']))
{
    $event_name = trim($_POST['event_name'] ?? '');
    $event_date = trim($_POST['event_date'] ?? '');
    $venue = trim($_POST['venue'] ?? '');
    $category = trim($_POST['category'] ?? '');

    /* =========================
       SERVER-SIDE VALIDATION
    ========================= */

    if($event_name === '' || $event_date === '' || $venue === '' || $category === '')
    {
        echo "<script>
            alert('Please fill in all event details.');
            window.history.back();
        </script>";
        exit();
    }

    /* =========================
       DATE VALIDATION
    ========================= */

    $date_object = DateTime::createFromFormat('Y-m-d', $event_date);

    if(!$date_object || $date_object->format('Y-m-d') !== $event_date)
    {
        echo "<script>
            alert('Please enter a valid event date.');
            window.history.back();
        </script>";
        exit();
    }

    /* =========================
       PREPARED INSERT
    ========================= */

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO events(event_name, event_date, venue, category)
         VALUES(?, ?, ?, ?)"
    );

    if(!$stmt)
    {
        die("Unable to prepare event creation query.");
    }

    mysqli_stmt_bind_param(
        $stmt,
        "ssss",
        $event_name,
        $event_date,
        $venue,
        $category
    );

    if(mysqli_stmt_execute($stmt))
    {
        mysqli_stmt_close($stmt);

        echo "<script>
            alert('Event Added Successfully');
            window.location='view_events.php';
        </script>";

        exit();
    }
    else
    {
        mysqli_stmt_close($stmt);

        echo "<script>
            alert('Failed to Add Event');
            window.history.back();
        </script>";

        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Create Event | CampusHub</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet"
>

<link rel="preconnect" href="https://fonts.googleapis.com">

<link
rel="preconnect"
href="https://fonts.googleapis.com"
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

.admin-label {
    color: #667085;

    font-size: 9px;

    font-weight: 800;

    letter-spacing: 1px;

    text-transform: uppercase;

    padding: 0 13px;

    margin-bottom: 10px;
}

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


/* Header */

.page-header {
    margin-bottom: 28px;
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

    margin: 0 0 7px;
}

.page-description {
    color: #667085;

    font-size: 13px;

    margin: 0;
}


/* =========================
   FORM CARD
========================= */

.form-card {
    max-width: 850px;

    background: white;

    border: 1px solid #e7eaf0;

    border-radius: 18px;

    box-shadow:
        0 12px 35px
        rgba(16,24,40,0.06);

    overflow: hidden;
}


/* Form header */

.form-card-header {
    padding: 25px 30px;

    border-bottom: 1px solid #edf0f4;

    display: flex;

    align-items: center;

    gap: 15px;
}

.form-icon {
    width: 46px;

    height: 46px;

    border-radius: 11px;

    background: #eeedff;

    display: flex;

    align-items: center;

    justify-content: center;

    font-size: 20px;
}

.form-card-header h2 {
    font-size: 16px;

    font-weight: 800;

    margin: 0 0 4px;
}

.form-card-header p {
    color: #98a2b3;

    font-size: 11px;

    margin: 0;
}


/* Form body */

.form-body {
    padding: 30px;
}


/* Labels */

.form-label {
    color: #344054;

    font-size: 12px;

    font-weight: 700;

    margin-bottom: 8px;
}

.form-control,
.form-select {
    height: 48px;

    border: 1px solid #d9dee8;

    border-radius: 10px;

    font-size: 13px;

    color: #172033;

    padding-left: 14px;

    padding-right: 14px;
}

.form-control:focus,
.form-select:focus {
    border-color: #635bff;

    box-shadow:
        0 0 0 4px
        rgba(99,91,255,0.10);
}

.form-group {
    margin-bottom: 22px;
}


/* Help text */

.form-help {
    color: #98a2b3;

    font-size: 10px;

    margin-top: 6px;
}


/* Buttons */

.button-row {
    display: flex;

    gap: 12px;

    padding-top: 8px;
}

.cancel-btn {
    height: 48px;

    padding: 0 22px;

    border: 1px solid #dfe3ea;

    background: white;

    color: #475467;

    text-decoration: none;

    border-radius: 10px;

    display: flex;

    align-items: center;

    justify-content: center;

    font-size: 12px;

    font-weight: 700;
}

.cancel-btn:hover {
    background: #f8f9fc;

    color: #172033;
}

.submit-btn {
    height: 48px;

    flex: 1;

    border: none;

    background: #635bff;

    color: white;

    border-radius: 10px;

    font-size: 12px;

    font-weight: 700;

    transition: .2s;
}

.submit-btn:hover {
    background: #5148e8;

    transform: translateY(-1px);
}


/* Information */

.info-box {
    max-width: 850px;

    margin-top: 18px;

    background: #f5f4ff;

    border: 1px solid #e6e3ff;

    border-radius: 12px;

    padding: 15px 18px;

    color: #667085;

    font-size: 11px;

    line-height: 1.6;
}

.info-box strong {
    color: #4038b5;
}


/* Footer */

.footer {
    max-width: 850px;

    text-align: center;

    color: #98a2b3;

    font-size: 10px;

    padding-top: 35px;
}


/* Mobile */

.mobile-topbar {
    display: none;
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

    .page-title {
        font-size: 25px;
    }

    .form-body {
        padding: 25px 20px;
    }

    .form-card-header {
        padding:
            22px 20px;
    }

    .button-row {
        flex-direction: column-reverse;
    }

    .cancel-btn {
        width: 100%;
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
class="sidebar-link"
>
<span class="sidebar-icon">📊</span>
Dashboard
</a>


<a
href="add_event.php"
class="sidebar-link active"
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
    <?php echo htmlspecialchars($_SESSION['admin']); ?>
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


<!-- Mobile -->

<div class="mobile-topbar">

<a
href="../index.php"
class="mobile-logo"
>
Campus<span>Hub</span>
</a>

<a
href="logout.php"
class="mobile-logout"
>
Sign out
</a>

</div>



<!-- Header -->

<div class="page-header">

<div class="page-label">
    Event Management
</div>

<h1 class="page-title">
    Create a New Event
</h1>

<p class="page-description">
    Add a new campus event that students can discover and register for.
</p>

</div>



<!-- Form -->

<div class="form-card">


<!-- Card Header -->

<div class="form-card-header">

<div class="form-icon">
    📅
</div>

<div>

<h2>
    Event Information
</h2>

<p>
    Provide the details students will see when browsing events.
</p>

</div>

</div>



<!-- Form Body -->

<div class="form-body">

<form method="POST">


<div class="row">


<!-- Event Name -->

<div class="col-md-12">

<div class="form-group">

<label class="form-label">
    Event Name
</label>

<input
type="text"
name="event_name"
class="form-control"
placeholder="Enter the event name"
required
>

<div class="form-help">
    Use a clear and recognizable name for the event.
</div>

</div>

</div>



<!-- Date -->

<div class="col-md-6">

<div class="form-group">

<label class="form-label">
    Event Date
</label>

<input
type="date"
name="event_date"
class="form-control"
required
>

</div>

</div>



<!-- Category -->

<div class="col-md-6">

<div class="form-group">

<label class="form-label">
    Category
</label>

<select
    name="category"
    class="form-select"
    required
>

    <option value="" selected disabled>
        Select event category
    </option>

    <option value="Technical">
        Technical
    </option>

    <option value="Cultural">
        Cultural
    </option>

    <option value="Sports">
        Sports
    </option>

    <option value="Workshop">
        Workshop
    </option>

    <option value="Seminar">
        Seminar
    </option>

    <option value="Hackathon">
        Hackathon
    </option>

    <option value="Coding">
        Coding
    </option>

    <option value="Symposium">
        Symposium
    </option>

    <option value="Conference">
        Conference
    </option>

    <option value="Quiz">
        Quiz
    </option>

    <option value="Debate">
        Debate
    </option>

    <option value="Literary">
        Literary
    </option>

    <option value="Arts & Design">
        Arts & Design
    </option>

    <option value="Music">
        Music
    </option>

    <option value="Dance">
        Dance
    </option>

    <option value="Entrepreneurship">
        Entrepreneurship
    </option>

    <option value="Career & Placement">
        Career & Placement
    </option>

    <option value="Club Activity">
        Club Activity
    </option>

    <option value="Social & Community">
        Social & Community
    </option>

    <option value="Fest">
        Fest
    </option>

    <option value="Competition">
        Competition
    </option>

    <option value="Other">
        Other
    </option>

</select>

</div>

</div>



<!-- Venue -->

<div class="col-md-12">

<div class="form-group">

<label class="form-label">
    Venue
</label>

<input
type="text"
name="venue"
class="form-control"
placeholder="e.g. Main Auditorium, Seminar Hall"
required
>

</div>

</div>


</div>



<!-- Buttons -->

<div class="button-row">

<a
href="dashboard.php"
class="cancel-btn"
>
Cancel
</a>


<button
type="submit"
name="add"
class="submit-btn"
>
Create Event →
</button>

</div>


</form>

</div>

</div>



<!-- Information -->

<div class="info-box">

<strong>Admin tip:</strong>
Make sure the event name, date, venue and category are
accurate before publishing. Students will use these details
to decide which events to attend.

</div>



<!-- Footer -->

<footer class="footer">

CampusHub · College Event Management System · Admin Portal

</footer>


</main>


</body>

</html>