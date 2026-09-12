<?php

session_start();

/* =========================
   ADMIN AUTHENTICATION
========================= */

if(!isset($_SESSION['admin']))
{
    header("Location: login.php");
    exit();
}

include("../includes/db.php");


/* =========================
   VALIDATE EVENT ID
========================= */

if(!isset($_GET['id']) || !ctype_digit($_GET['id']))
{
    header("Location: view_events.php");
    exit();
}

$id = (int) $_GET['id'];


/* =========================
   FETCH EVENT
========================= */

$select_stmt = mysqli_prepare(
    $conn,
    "SELECT id, event_name, event_date, venue, category
     FROM events
     WHERE id = ?
     LIMIT 1"
);

if(!$select_stmt)
{
    die("Unable to prepare event query.");
}

mysqli_stmt_bind_param(
    $select_stmt,
    "i",
    $id
);

mysqli_stmt_execute($select_stmt);

$result = mysqli_stmt_get_result($select_stmt);

if(!$result)
{
    mysqli_stmt_close($select_stmt);
    die("Unable to retrieve event.");
}

$row = mysqli_fetch_assoc($result);

mysqli_stmt_close($select_stmt);


/* =========================
   EVENT NOT FOUND
========================= */

if(!$row)
{
    header("Location: view_events.php");
    exit();
}


/* =========================
   UPDATE EVENT
========================= */

if(isset($_POST['update']))
{
    $name = trim($_POST['event_name'] ?? '');
    $date = trim($_POST['event_date'] ?? '');
    $venue = trim($_POST['venue'] ?? '');
    $category = trim($_POST['category'] ?? '');


    /* =========================
       BASIC VALIDATION
    ========================= */

    if($name === '' || $date === '' || $venue === '' || $category === '')
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

    $date_object = DateTime::createFromFormat('Y-m-d', $date);

    if(!$date_object || $date_object->format('Y-m-d') !== $date)
    {
        echo "<script>
            alert('Please enter a valid event date.');
            window.history.back();
        </script>";
        exit();
    }


    /* =========================
       PREPARED UPDATE
    ========================= */

    $update_stmt = mysqli_prepare(
        $conn,
        "UPDATE events
         SET event_name = ?,
             event_date = ?,
             venue = ?,
             category = ?
         WHERE id = ?"
    );

    if(!$update_stmt)
    {
        die("Unable to prepare update query.");
    }

    mysqli_stmt_bind_param(
        $update_stmt,
        "ssssi",
        $name,
        $date,
        $venue,
        $category,
        $id
    );


    /* =========================
       EXECUTE UPDATE
    ========================= */

    if(mysqli_stmt_execute($update_stmt))
    {
        mysqli_stmt_close($update_stmt);

        echo "<script>
            alert('Event Updated Successfully');
            window.location='view_events.php';
        </script>";

        exit();
    }
    else
    {
        mysqli_stmt_close($update_stmt);

        echo "<script>
            alert('Failed to update event.');
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

<title>Edit Event | CampusHub</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>

* {
    font-family: 'Inter', sans-serif;
}

body {
    background: #f5f7fb;
    color: #101828;
    margin: 0;
}

/* ================= SIDEBAR ================= */

.sidebar {
    width: 250px;
    height: 100vh;
    background: #101828;
    position: fixed;
    left: 0;
    top: 0;
    padding: 28px 18px;
    z-index: 1000;
}

.logo {
    color: white;
    font-size: 22px;
    font-weight: 800;
    padding: 0 14px;
    margin-bottom: 35px;
}

.logo span {
    color: #7c6cff;
}

.nav-title {
    color: #98a2b3;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 0 14px;
    margin-bottom: 12px;
}

.sidebar a {
    display: flex;
    align-items: center;
    gap: 12px;
    color: #d0d5dd;
    text-decoration: none;
    padding: 12px 14px;
    border-radius: 10px;
    margin-bottom: 6px;
    font-size: 14px;
    font-weight: 500;
    transition: 0.2s;
}

.sidebar a:hover {
    background: #1d2939;
    color: white;
}

.sidebar a.active {
    background: #635bff;
    color: white;
}

.sidebar-icon {
    width: 20px;
    text-align: center;
}

/* ================= MAIN ================= */

.main {
    margin-left: 250px;
    padding: 35px;
}

/* ================= TOPBAR ================= */

.topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.page-title h1 {
    font-size: 28px;
    font-weight: 800;
    margin-bottom: 6px;
}

.page-title p {
    color: #667085;
    margin: 0;
    font-size: 14px;
}

.admin-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.avatar {
    width: 42px;
    height: 42px;
    background: #635bff;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
}

.admin-name {
    font-size: 13px;
    font-weight: 700;
}

.admin-role {
    font-size: 11px;
    color: #667085;
}

/* ================= FORM CARD ================= */

.form-card {
    max-width: 760px;
    background: white;
    border: 1px solid #eaecf0;
    border-radius: 16px;
    padding: 30px;
}

.form-header {
    padding-bottom: 22px;
    border-bottom: 1px solid #eaecf0;
    margin-bottom: 25px;
}

.form-header h4 {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 5px;
}

.form-header p {
    color: #667085;
    font-size: 13px;
    margin: 0;
}

/* ================= FORM ================= */

.form-label {
    font-size: 13px;
    font-weight: 600;
    color: #344054;
    margin-bottom: 8px;
}

.form-control,
.form-select {
    border: 1px solid #d0d5dd;
    border-radius: 9px;
    padding: 11px 13px;
    font-size: 13px;
    min-height: 46px;
}

.form-control:focus,
.form-select:focus {
    border-color: #635bff;
    box-shadow: 0 0 0 3px rgba(99,91,255,0.12);
}

.form-section {
    margin-bottom: 20px;
}

/* ================= BUTTONS ================= */

.button-row {
    display: flex;
    gap: 12px;
    margin-top: 28px;
}

.update-btn {
    flex: 1;
    background: #635bff;
    border: none;
    color: white;
    padding: 12px;
    border-radius: 9px;
    font-size: 13px;
    font-weight: 700;
}

.update-btn:hover {
    background: #5148e5;
}

.cancel-btn {
    flex: 1;
    background: white;
    border: 1px solid #d0d5dd;
    color: #344054;
    padding: 12px;
    border-radius: 9px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    text-align: center;
}

.cancel-btn:hover {
    background: #f9fafb;
    color: #101828;
}

/* ================= EVENT ID ================= */

.event-id-box {
    background: #f9fafb;
    border: 1px solid #eaecf0;
    border-radius: 9px;
    padding: 12px 14px;
    margin-bottom: 25px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.event-id-label {
    font-size: 12px;
    color: #667085;
}

.event-id-value {
    font-size: 13px;
    font-weight: 700;
    color: #635bff;
}

/* ================= MOBILE ================= */

.mobile-topbar {
    display: none;
}

@media(max-width: 900px) {

    .sidebar {
        display: none;
    }

    .main {
        margin-left: 0;
        padding: 20px;
    }

    .mobile-topbar {
        display: flex;
        background: #101828;
        color: white;
        padding: 16px 20px;
        align-items: center;
        justify-content: space-between;
    }

    .mobile-logo {
        font-size: 20px;
        font-weight: 800;
    }

    .mobile-logo span {
        color: #7c6cff;
    }

    .topbar {
        margin-top: 25px;
    }

}

@media(max-width: 600px) {

    .main {
        padding: 15px;
    }

    .page-title h1 {
        font-size: 23px;
    }

    .admin-info {
        display: none;
    }

    .form-card {
        padding: 20px;
    }

    .button-row {
        flex-direction: column;
    }

}

</style>

</head>

<body>

<!-- ================= MOBILE TOPBAR ================= -->

<div class="mobile-topbar">

    <div class="mobile-logo">
        Campus<span>Hub</span>
    </div>

    <a href="logout.php"
       style="color:white;text-decoration:none;font-size:13px;">
        Sign out
    </a>

</div>


<!-- ================= SIDEBAR ================= -->

<div class="sidebar">

    <div class="logo">
        Campus<span>Hub</span>
    </div>

    <div class="nav-title">
        Administration
    </div>

    <a href="dashboard.php">

        <span class="sidebar-icon">▦</span>

        Dashboard

    </a>

    <a href="add_event.php">

        <span class="sidebar-icon">＋</span>

        Add Event

    </a>

    <a href="view_events.php" class="active">

        <span class="sidebar-icon">◫</span>

        Manage Events

    </a>

    <a href="view_registrations.php">

        <span class="sidebar-icon">◎</span>

        Registrations

    </a>


    <div style="position:absolute;bottom:25px;left:18px;right:18px;">

        <a href="logout.php">

            <span class="sidebar-icon">↪</span>

            Sign Out

        </a>

    </div>

</div>


<!-- ================= MAIN ================= -->

<div class="main">

    <!-- TOP BAR -->

    <div class="topbar">

        <div class="page-title">

            <h1>Edit Event</h1>

            <p>Update the details of an existing campus event.</p>

        </div>


        <div class="admin-info">

            <div class="avatar">

                <?php
                echo strtoupper(
                    substr($_SESSION['admin'],0,1)
                );
                ?>

            </div>

            <div>

                <div class="admin-name">

                    <?php
                    echo htmlspecialchars($_SESSION['admin']);
                    ?>

                </div>

                <div class="admin-role">
                    Administrator
                </div>

            </div>

        </div>

    </div>


    <!-- FORM -->

    <div class="form-card">

        <div class="form-header">

            <h4>Event Information</h4>

            <p>
                Make the necessary changes and save the updated event.
            </p>

        </div>


        <!-- EVENT ID -->

        <div class="event-id-box">

            <span class="event-id-label">
                Event ID
            </span>

            <span class="event-id-value">
                #<?php echo htmlspecialchars($row['id']); ?>
            </span>

        </div>


        <form method="POST">


            <!-- EVENT NAME -->

            <div class="form-section">

                <label class="form-label">
                    Event Name
                </label>

                <input
                    type="text"
                    name="event_name"
                    class="form-control"
                    value="<?php echo htmlspecialchars($row['event_name']); ?>"
                    placeholder="Enter event name"
                    required
                >

            </div>


            <!-- DATE -->

            <div class="form-section">

                <label class="form-label">
                    Event Date
                </label>

                <input
                    type="date"
                    name="event_date"
                    class="form-control"
                    value="<?php echo htmlspecialchars($row['event_date']); ?>"
                    required
                >

            </div>


            <!-- VENUE -->

            <div class="form-section">

                <label class="form-label">
                    Venue
                </label>

                <input
                    type="text"
                    name="venue"
                    class="form-control"
                    value="<?php echo htmlspecialchars($row['venue']); ?>"
                    placeholder="Enter event venue"
                    required
                >

            </div>


            <!-- CATEGORY -->

            <div class="form-section">

                <label class="form-label">
                    Category
                </label>

                <select
                    name="category"
                    class="form-select"
                    required
                >

                    <option value="" disabled>
                        Select event category
                    </option>

                    <option value="Technical"
                        <?php if($row['category']=="Technical") echo "selected"; ?>>
                        Technical
                    </option>

                    <option value="Cultural"
                        <?php if($row['category']=="Cultural") echo "selected"; ?>>
                        Cultural
                    </option>

                    <option value="Sports"
                        <?php if($row['category']=="Sports") echo "selected"; ?>>
                        Sports
                    </option>

                    <option value="Workshop"
                        <?php if($row['category']=="Workshop") echo "selected"; ?>>
                        Workshop
                    </option>

                    <option value="Seminar"
                        <?php if($row['category']=="Seminar") echo "selected"; ?>>
                        Seminar
                    </option>

                    <option value="Hackathon"
                        <?php if($row['category']=="Hackathon") echo "selected"; ?>>
                        Hackathon
                    </option>

                    <option value="Coding"
                        <?php if($row['category']=="Coding") echo "selected"; ?>>
                        Coding
                    </option>

                    <option value="Symposium"
                        <?php if($row['category']=="Symposium") echo "selected"; ?>>
                        Symposium
                    </option>

                    <option value="Conference"
                        <?php if($row['category']=="Conference") echo "selected"; ?>>
                        Conference
                    </option>

                    <option value="Quiz"
                        <?php if($row['category']=="Quiz") echo "selected"; ?>>
                        Quiz
                    </option>

                    <option value="Debate"
                        <?php if($row['category']=="Debate") echo "selected"; ?>>
                        Debate
                    </option>

                    <option value="Literary"
                        <?php if($row['category']=="Literary") echo "selected"; ?>>
                        Literary
                    </option>

                    <option value="Arts & Design"
                        <?php if($row['category']=="Arts & Design") echo "selected"; ?>>
                        Arts & Design
                    </option>

                    <option value="Music"
                        <?php if($row['category']=="Music") echo "selected"; ?>>
                        Music
                    </option>

                    <option value="Dance"
                        <?php if($row['category']=="Dance") echo "selected"; ?>>
                        Dance
                    </option>

                    <option value="Entrepreneurship"
                        <?php if($row['category']=="Entrepreneurship") echo "selected"; ?>>
                        Entrepreneurship
                    </option>

                    <option value="Career & Placement"
                        <?php if($row['category']=="Career & Placement") echo "selected"; ?>>
                        Career & Placement
                    </option>

                    <option value="Club Activity"
                        <?php if($row['category']=="Club Activity") echo "selected"; ?>>
                        Club Activity
                    </option>

                    <option value="Social & Community"
                        <?php if($row['category']=="Social & Community") echo "selected"; ?>>
                        Social & Community
                    </option>

                    <option value="Fest"
                        <?php if($row['category']=="Fest") echo "selected"; ?>>
                        Fest
                    </option>

                    <option value="Competition"
                        <?php if($row['category']=="Competition") echo "selected"; ?>>
                        Competition
                    </option>

                    <option value="Other"
                        <?php if($row['category']=="Other") echo "selected"; ?>>
                        Other
                    </option>

                </select>

            </div>


            <!-- BUTTONS -->

            <div class="button-row">

                <a
                    href="view_events.php"
                    class="cancel-btn"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    name="update"
                    class="update-btn"
                >
                    Save Changes
                </button>

            </div>

        </form>

    </div>

</div>

</body>

</html>