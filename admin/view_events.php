<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: login.php");
    exit();
}

include("../includes/db.php");

$sql = "SELECT id, event_name, event_date, venue, category
        FROM events
        ORDER BY event_date ASC";

$result = mysqli_query($conn, $sql);

if(!$result)
{
    die("Unable to load events.");
}

$total_events = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Manage Events | CampusHub</title>

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

/* ================= TOP BAR ================= */

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

/* ================= HEADER CARD ================= */

.header-card {
    background: white;
    border: 1px solid #eaecf0;
    border-radius: 16px;
    padding: 22px 24px;
    margin-bottom: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header-card h5 {
    margin: 0;
    font-size: 16px;
    font-weight: 700;
}

.event-count {
    color: #667085;
    font-size: 13px;
    margin-top: 4px;
}

.add-btn {
    background: #635bff;
    color: white;
    border: none;
    padding: 10px 16px;
    border-radius: 9px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
}

.add-btn:hover {
    background: #5148e5;
    color: white;
}

/* ================= TABLE CARD ================= */

.table-card {
    background: white;
    border: 1px solid #eaecf0;
    border-radius: 16px;
    overflow: hidden;
}

.table-wrapper {
    overflow-x: auto;
}

table {
    margin: 0 !important;
    min-width: 850px;
}

thead th {
    background: #f9fafb !important;
    color: #667085 !important;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .5px;
    padding: 16px 18px !important;
    border-bottom: 1px solid #eaecf0 !important;
    white-space: nowrap;
}

tbody td {
    padding: 17px 18px !important;
    vertical-align: middle;
    border-bottom: 1px solid #f2f4f7 !important;
    font-size: 13px;
    color: #344054;
}

tbody tr:last-child td {
    border-bottom: none !important;
}

tbody tr:hover {
    background: #fafbff;
}

.event-id {
    color: #98a2b3;
    font-weight: 600;
}

.event-name {
    color: #101828;
    font-weight: 700;
}

.event-date {
    font-weight: 600;
}

.venue {
    color: #667085;
}

/* ================= CATEGORY ================= */

.category {
    display: inline-flex;
    align-items: center;
    padding: 6px 10px;
    border-radius: 20px;
    background: #f2f4ff;
    color: #5148e5;
    font-size: 11px;
    font-weight: 700;
}

/* ================= ACTION BUTTONS ================= */

.action-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 7px 12px;
    border-radius: 7px;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    margin-right: 5px;
}

.edit-btn {
    background: #fff4e5;
    color: #b54708;
}

.edit-btn:hover {
    background: #ffe7c2;
    color: #8f3d05;
}

.delete-btn {
    background: #fef3f2;
    color: #b42318;
}

.delete-btn:hover {
    background: #fee4e2;
    color: #912018;
}

/* ================= EMPTY STATE ================= */

.empty-state {
    text-align: center;
    padding: 65px 20px;
}

.empty-icon {
    width: 58px;
    height: 58px;
    margin: 0 auto 18px;
    border-radius: 14px;
    background: #f2f4f7;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 25px;
}

.empty-state h5 {
    font-size: 17px;
    font-weight: 700;
}

.empty-state p {
    color: #667085;
    font-size: 13px;
    margin-bottom: 20px;
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

    .topbar {
        align-items: flex-start;
    }

    .page-title h1 {
        font-size: 23px;
    }

    .admin-info {
        display: none;
    }

    .header-card {
        padding: 18px;
        align-items: flex-start;
        gap: 15px;
        flex-direction: column;
    }

    .add-btn {
        width: 100%;
        text-align: center;
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

    <a href="logout.php" style="color:white;text-decoration:none;font-size:13px;">
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

            <h1>Manage Events</h1>

            <p>Create, edit and manage all campus events.</p>

        </div>

        <div class="admin-info">

            <div class="avatar">
                <?php echo strtoupper(substr($_SESSION['admin'],0,1)); ?>
            </div>

            <div>

                <div class="admin-name">
                    <?php echo htmlspecialchars($_SESSION['admin']); ?>
                </div>

                <div class="admin-role">
                    Administrator
                </div>

            </div>

        </div>

    </div>


    <!-- HEADER CARD -->

    <div class="header-card">

        <div>

            <h5>All Events</h5>

            <div class="event-count">

                <?php echo $total_events; ?>

                <?php echo ($total_events == 1) ? "event" : "events"; ?>

                currently available

            </div>

        </div>

        <a href="add_event.php" class="add-btn">
            + Add New Event
        </a>

    </div>


    <!-- TABLE -->

    <div class="table-card">

        <?php if($total_events > 0) { ?>

        <div class="table-wrapper">

            <table class="table align-middle">

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Event</th>

                        <th>Date</th>

                        <th>Venue</th>

                        <th>Category</th>

                        <th>Actions</th>

                    </tr>

                </thead>

                <tbody>

                <?php

                mysqli_data_seek($result, 0);

                while($row=mysqli_fetch_assoc($result))
                {

                ?>

                    <tr>

                        <td>

                            <span class="event-id">

                                #<?php echo htmlspecialchars($row['id']); ?>

                            </span>

                        </td>


                        <td>

                            <span class="event-name">

                                <?php echo htmlspecialchars($row['event_name']); ?>

                            </span>

                        </td>


                        <td>

                            <span class="event-date">

                                <?php echo htmlspecialchars($row['event_date']); ?>

                            </span>

                        </td>


                        <td>

                            <span class="venue">

                                <?php echo htmlspecialchars($row['venue']); ?>

                            </span>

                        </td>


                        <td>

                            <span class="category">

                                <?php echo htmlspecialchars($row['category']); ?>

                            </span>

                        </td>


                        <td>

                            <a
                                href="edit_event.php?id=<?php echo $row['id']; ?>"
                                class="action-btn edit-btn"
                            >
                                Edit
                            </a>

                            <a
                                href="delete_event.php?id=<?php echo $row['id']; ?>"
                                class="action-btn delete-btn"
                                onclick="return confirm('Are you sure you want to delete this event?');"
                            >
                                Delete
                            </a>

                        </td>

                    </tr>

                <?php

                }

                ?>

                </tbody>

            </table>

        </div>

        <?php } else { ?>

            <!-- EMPTY STATE -->

            <div class="empty-state">

                <div class="empty-icon">
                    📅
                </div>

                <h5>No events yet</h5>

                <p>
                    You haven't created any campus events.
                    Add your first event to get started.
                </p>

                <a href="add_event.php" class="add-btn">
                    + Create First Event
                </a>

            </div>

        <?php } ?>

    </div>

</div>

</body>

</html>