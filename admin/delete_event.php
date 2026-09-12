<?php

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: login.php");
    exit();
}

include("../includes/db.php");

/* Validate event ID */

if(!isset($_GET['id']) || !ctype_digit($_GET['id']))
{
    header("Location: view_events.php");
    exit();
}

$id = (int) $_GET['id'];


/* Check whether event exists */

$check = mysqli_prepare(
    $conn,
    "SELECT id FROM events WHERE id = ?"
);

mysqli_stmt_bind_param($check, "i", $id);

mysqli_stmt_execute($check);

$result = mysqli_stmt_get_result($check);

if(mysqli_num_rows($result) == 0)
{
    mysqli_stmt_close($check);

    echo "<script>
        alert('Event not found.');
        window.location='view_events.php';
    </script>";

    exit();
}

mysqli_stmt_close($check);


/* Delete event */

$delete = mysqli_prepare(
    $conn,
    "DELETE FROM events WHERE id = ?"
);

mysqli_stmt_bind_param($delete, "i", $id);

if(mysqli_stmt_execute($delete))
{
    mysqli_stmt_close($delete);

    echo "<script>
        alert('Event deleted successfully.');
        window.location='view_events.php';
    </script>";

    exit();
}
else
{
    mysqli_stmt_close($delete);

    echo "<script>
        alert('Unable to delete the event.');
        window.location='view_events.php';
    </script>";

    exit();
}

?>