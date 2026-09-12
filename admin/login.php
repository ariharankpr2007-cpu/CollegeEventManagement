<?php

session_start();

include("../includes/db.php");


/* =========================
   ADMIN LOGIN
========================= */

if(isset($_POST['login']))
{

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';


    /* =========================
       BASIC VALIDATION
    ========================= */

    if($username === '' || $password === '')
    {
        echo "<script>
            alert('Please enter your username and password.');
        </script>";
    }

    else
    {

        /* =========================
           FIND ADMIN
        ========================= */

        $stmt = mysqli_prepare(
            $conn,
            "SELECT username, password
             FROM admin
             WHERE username = ?
             LIMIT 1"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "s",
            $username
        );

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);


        /* =========================
           CHECK ACCOUNT
        ========================= */

        if(mysqli_num_rows($result) == 1)
{
    $admin = mysqli_fetch_assoc($result);

    $stored_password = $admin['password'];

    $valid_password = false;


    /* =========================
       CHECK HASHED PASSWORD
    ========================= */

    if(password_verify($password, $stored_password))
    {
        $valid_password = true;
    }


    /* =========================
       LEGACY PLAINTEXT PASSWORD
    ========================= */

    elseif($password === $stored_password)
    {
        $valid_password = true;

        /*
         * Convert old plaintext password
         * into a secure hash.
         */

        $new_hash = password_hash(
            $password,
            PASSWORD_DEFAULT
        );


        $update_stmt = mysqli_prepare(
            $conn,
            "UPDATE admin
             SET password = ?
             WHERE username = ?"
        );

        if($update_stmt)
        {
            mysqli_stmt_bind_param(
                $update_stmt,
                "ss",
                $new_hash,
                $admin['username']
            );

            mysqli_stmt_execute($update_stmt);

            mysqli_stmt_close($update_stmt);
        }
    }


    /* =========================
       LOGIN SUCCESS
    ========================= */

    if($valid_password)
    {
        session_regenerate_id(true);

        $_SESSION['admin'] = $admin['username'];

        mysqli_stmt_close($stmt);

        header("Location: dashboard.php");
        exit();
    }
}
else
{
    echo "<pre>";
    echo "USERNAME FOUND: NO\n";
    echo "Entered Username: [" . $username . "]";
    echo "</pre>";
    exit();
}


        mysqli_stmt_close($stmt);


        /* =========================
           LOGIN FAILED
        ========================= */

        echo "<script>
            alert('Invalid Username or Password');
        </script>";

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin Login | CampusHub</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet"
>

<link rel="preconnect" href="https://fonts.googleapis.com">

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
    background: #f5f7fb;
    color: #172033;
}


/* Navbar */

.navbar {
    background: #101828;
    padding: 16px 0;
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

.home-link {
    color: #cbd5e1;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
}

.home-link:hover {
    color: white;
}


/* Main */

.login-wrapper {
    min-height: calc(100vh - 73px);

    display: flex;

    align-items: center;

    justify-content: center;

    padding: 45px 20px;
}


/* Card */

.login-card {
    width: 100%;
    max-width: 950px;

    background: white;

    border-radius: 22px;

    overflow: hidden;

    box-shadow:
        0 20px 60px rgba(16,24,40,0.10);

    display: flex;
}


/* Left */

.login-left {

    width: 47%;

    background:
        linear-gradient(
            145deg,
            #101828,
            #1c2942
        );

    color: white;

    padding: 55px 45px;

    position: relative;

    overflow: hidden;
}

.login-left::before {

    content: "";

    position: absolute;

    width: 300px;
    height: 300px;

    border-radius: 50%;

    background:
        rgba(124,108,255,0.16);

    right: -120px;
    top: -150px;
}

.login-left::after {

    content: "";

    position: absolute;

    width: 180px;
    height: 180px;

    border-radius: 50%;

    background:
        rgba(124,108,255,0.08);

    left: -70px;
    bottom: -90px;
}

.left-content {

    position: relative;

    z-index: 2;
}


.admin-badge {

    display: inline-block;

    background:
        rgba(255,255,255,0.09);

    color: #bdb7ff;

    padding: 8px 12px;

    border-radius: 20px;

    font-size: 10px;

    font-weight: 800;

    letter-spacing: 1px;

    margin-bottom: 25px;
}


.login-left h1 {

    font-size: 34px;

    font-weight: 800;

    line-height: 1.2;

    letter-spacing: -1px;

    margin-bottom: 18px;
}


.login-left p {

    color: #b8c2d3;

    font-size: 14px;

    line-height: 1.7;

    max-width: 370px;

    margin-bottom: 35px;
}


/* Admin features */

.admin-feature {

    display: flex;

    align-items: center;

    gap: 13px;

    margin-bottom: 17px;
}

.feature-icon {

    width: 38px;
    height: 38px;

    border-radius: 10px;

    background:
        rgba(255,255,255,0.08);

    display: flex;

    align-items: center;

    justify-content: center;

    font-size: 16px;
}

.admin-feature span {

    color: #d6dce7;

    font-size: 12px;

    font-weight: 500;
}


/* Right */

.login-right {

    width: 53%;

    padding: 55px 50px;

    display: flex;

    align-items: center;
}


.form-wrapper {

    width: 100%;

    max-width: 390px;

    margin: auto;
}


.form-label {

    font-size: 12px;

    font-weight: 700;

    color: #344054;

    margin-bottom: 8px;
}


.form-control {

    height: 48px;

    border:
        1px solid #d9dee8;

    border-radius: 10px;

    padding:
        0 14px;

    font-size: 13px;

    transition: .2s;
}


.form-control:focus {

    border-color: #635bff;

    box-shadow:
        0 0 0 4px
        rgba(99,91,255,0.10);
}


.form-group {

    margin-bottom: 20px;
}


/* Title */

.form-title {

    font-size: 27px;

    font-weight: 800;

    letter-spacing: -0.7px;

    margin-bottom: 7px;
}


.form-subtitle {

    color: #667085;

    font-size: 13px;

    line-height: 1.6;

    margin-bottom: 30px;
}


/* Password */

.password-wrapper {

    position: relative;
}

.password-wrapper .form-control {

    padding-right: 55px;
}

.password-toggle {

    position: absolute;

    right: 13px;

    top: 50%;

    transform: translateY(-50%);

    border: none;

    background: transparent;

    color: #667085;

    font-size: 11px;

    font-weight: 700;

    cursor: pointer;
}


/* Login */

.login-btn {

    width: 100%;

    height: 49px;

    border: none;

    border-radius: 10px;

    background: #635bff;

    color: white;

    font-size: 13px;

    font-weight: 700;

    margin-top: 4px;

    transition: .2s;
}

.login-btn:hover {

    background: #5148e8;

    transform: translateY(-1px);
}


/* Security */

.security-note {

    display: flex;

    align-items: center;

    gap: 8px;

    margin-top: 22px;

    padding: 12px 13px;

    background: #f8f9fc;

    border: 1px solid #edf0f4;

    border-radius: 9px;

    color: #667085;

    font-size: 10px;

    line-height: 1.5;
}


/* Mobile */

@media(max-width:800px)
{

    .login-card {

        flex-direction: column;

    }

    .login-left,
    .login-right {

        width: 100%;

    }

    .login-left {

        padding: 40px 30px;

    }

    .login-left h1 {

        font-size: 28px;

    }

    .login-right {

        padding: 40px 30px;

    }

}


@media(max-width:500px)
{

    .login-wrapper {

        padding:
            25px 12px;

    }

    .login-left,
    .login-right {

        padding:
            30px 22px;

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


<a
href="../index.php"
class="home-link"
>
← Back to Home
</a>

</div>

</div>

</nav>



<!-- Login -->

<div class="login-wrapper">

<div class="login-card">


<!-- Left Panel -->

<div class="login-left">

<div class="left-content">

<div class="admin-badge">
    ADMIN PORTAL
</div>


<h1>
    Manage your campus events.
</h1>


<p>
    Access the CampusHub administration portal to
    create events, manage registrations and keep
    your college activities organized.
</p>


<div class="admin-feature">

<div class="feature-icon">
    📅
</div>

<span>
    Create and manage campus events
</span>

</div>


<div class="admin-feature">

<div class="feature-icon">
    👥
</div>

<span>
    Monitor student registrations
</span>

</div>


<div class="admin-feature">

<div class="feature-icon">
    📊
</div>

<span>
    Keep track of campus activity
</span>

</div>


<div class="admin-feature">

<div class="feature-icon">
    ⚙️
</div>

<span>
    Manage your event platform
</span>

</div>

</div>

</div>



<!-- Right Panel -->

<div class="login-right">

<div class="form-wrapper">


<div class="form-title">
    Admin sign in
</div>


<div class="form-subtitle">
    Enter your administrator credentials to continue.
</div>


<form method="POST">


<div class="form-group">

<label class="form-label">
    Username
</label>

<input
type="text"
name="username"
class="form-control"
placeholder="Enter your username"
autocomplete="username"
required
>

</div>



<div class="form-group">

<label class="form-label">
    Password
</label>


<div class="password-wrapper">

<input
type="password"
name="password"
id="adminPassword"
class="form-control"
placeholder="Enter your password"
autocomplete="current-password"
required
>


<button
type="button"
class="password-toggle"
onclick="toggleAdminPassword()"
>
Show
</button>

</div>

</div>



<button
type="submit"
name="login"
class="login-btn"
>
Sign in to Admin Portal →
</button>


<div class="security-note">

<span>🔒</span>

<span>
    Authorized administrators only. Please keep your
    login credentials secure.
</span>

</div>


</form>

</div>

</div>


</div>

</div>



<script>

function toggleAdminPassword()
{

    const password =
        document.getElementById("adminPassword");

    const button =
        document.querySelector(".password-toggle");


    if(password.type === "password")
    {
        password.type = "text";
        button.textContent = "Hide";
    }
    else
    {
        password.type = "password";
        button.textContent = "Show";
    }

}

</script>


</body>

</html>