<?php

$conn = mysqli_connect(
    "YOUR_DATABASE_HOST",
    "YOUR_DATABASE_USERNAME",
    "YOUR_DATABASE_PASSWORD",
    "YOUR_DATABASE_NAME"
);

if (!$conn) {
    die("Database connection failed.");
}

?>