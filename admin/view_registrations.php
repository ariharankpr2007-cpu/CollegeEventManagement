<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: login.php");
    exit();
}

include("../includes/db.php");

$sql = "SELECT registrations.student_email,
               events.event_name,
               events.event_date
        FROM registrations
        INNER JOIN events
        ON registrations.event_id = events.id
        ORDER BY events.event_date ASC";

$result = mysqli_query($conn, $sql);

if(!$result)
{
    die("Unable to load registrations.");
}

$total_registrations = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Registrations | CampusHub</title>

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

/* ================= SUMMARY ================= */

.summary-card {
    background: white;
    border: 1px solid #eaecf0;
    border-radius: 16px;
    padding: 22px 24px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.summary-left {
    display: flex;
    align-items: center;
    gap: 15px;
}

.summary-icon {
    width: 46px;
    height: 46px;
    border-radius: 12px;
    background: #f2f4ff;
    color: #635bff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 21px;
}

.summary-title {
    font-size: 13px;
    color: #667085;
    margin-bottom: 3px;
}

.summary-number {
    font-size: 23px;
    font-weight: 800;
    color: #101828;
}

/* ================= TABLE CARD ================= */

.table-card {
    background: white;
    border: 1px solid #eaecf0;
    border-radius: 16px;
    overflow: hidden;
}

.table-header {
    padding: 20px 24px;
    border-bottom: 1px solid #eaecf0;
}

.table-header h5 {
    margin: 0;
    font-size: 16px;
    font-weight: 700;
}

.table-header p {
    margin: 5px 0 0;
    color: #667085;
    font-size: 12px;
}

.table-wrapper {
    overflow-x: auto;
}

table {
    margin: 0 !important;
    min-width: 750px;
}

thead th {
    background: #f9fafb !important;
    color: #667085 !important;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .5px;
    padding: 16px 20px !important;
    border-bottom: 1px solid #eaecf0 !important;
    white-space: nowrap;
}

tbody td {
    padding: 17px 20px !important;
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

/* ================= STUDENT ================= */

.student-cell {
    display: flex;
    align-items: center;
    gap: 11px;
}

.student-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #eef0ff;
    color: #635bff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: 700;
}

.student-email {
    font-weight: 600;
    color: #101828;
}

/* ================= EVENT ================= */

.event-name {
    font-weight: 700;
    color: #101828;
}

.date-badge {
    display: inline-flex;
    padding: 6px 10px;
    border-radius: 7px;
    background: #f2f4f7;
    color: #475467;
    font-size: 11px;
    font-weight: 600;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 6px 10px;
    border-radius: 20px;
    background: #ecfdf3;
    color: #027a48;
    font-size: 11px;
    font-weight: 700;
}

.status-dot {
    width: 6px;
    height: 6px;
    background: #12b76a;
    border-radius: 50%;
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

.dashboard-btn {
    display: inline-block;
    background: #635bff;
    color: white;
    padding: 10px 16px;
    border-radius: 9px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
}

.dashboard-btn:hover {
    background: #5148e5;
    color: white;
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

    .summary-card {
        padding: 18px;
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


    <a href="view_events.php">

        <span class="sidebar-icon">◫</span>

        Manage Events

    </a>


    <a href="view_registrations.php" class="active">

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

            <h1>Registrations</h1>

            <p>
                View students registered for campus events.
            </p>

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


    <!-- SUMMARY -->

    <div class="summary-card">

        <div class="summary-left">

            <div class="summary-icon">
                ◎
            </div>

            <div>

                <div class="summary-title">
                    Total Registrations
                </div>

                <div class="summary-number">

                    <?php echo $total_registrations; ?>

                </div>

            </div>

        </div>

    </div>


    <!-- REGISTRATION TABLE -->

    <div class="table-card">


        <div class="table-header">

            <h5>
                Student Registrations
            </h5>

            <p>
                A complete list of students currently registered for events.
            </p>

        </div>


        <?php if($total_registrations > 0) { ?>


        <div class="table-wrapper">

            <table class="table align-middle">


                <thead>

                    <tr>

                        <th>Student</th>

                        <th>Event</th>

                        <th>Event Date</th>

                        <th>Status</th>

                    </tr>

                </thead>


                <tbody>


                <?php

                mysqli_data_seek($result, 0);

                while($row=mysqli_fetch_assoc($result))
                {

                    $email = $row['student_email'];

                    $initial = strtoupper(
                        substr($email,0,1)
                    );

                ?>


                    <tr>


                        <!-- STUDENT -->

                        <td>

                            <div class="student-cell">

                                <div class="student-avatar">

                                    <?php echo htmlspecialchars($initial); ?>

                                </div>

                                <div class="student-email">

                                    <?php
                                    echo htmlspecialchars($email);
                                    ?>

                                </div>

                            </div>

                        </td>


                        <!-- EVENT -->

                        <td>

                            <span class="event-name">

                                <?php
                                echo htmlspecialchars(
                                    $row['event_name']
                                );
                                ?>

                            </span>

                        </td>


                        <!-- DATE -->

                        <td>

                            <span class="date-badge">

                                <?php
                                echo htmlspecialchars(
                                    $row['event_date']
                                );
                                ?>

                            </span>

                        </td>


                        <!-- STATUS -->

                        <td>

                            <span class="status-badge">

                                <span class="status-dot"></span>

                                Registered

                            </span>

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
                ◎
            </div>

            <h5>
                No registrations yet
            </h5>

            <p>
                Students haven't registered for any events yet.
            </p>

            <a
                href="dashboard.php"
                class="dashboard-btn"
            >
                Back to Dashboard
            </a>

        </div>


        <?php } ?>


    </div>


</div>

</body>

</html>