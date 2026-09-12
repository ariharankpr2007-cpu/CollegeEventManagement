<?php
session_start();

include("../includes/db.php");

/* =========================
   STUDENT REGISTRATION
========================= */

if(isset($_POST['register']))
{

    /* Get and clean input */

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $department = trim($_POST['department'] ?? '');
    $year = trim($_POST['year'] ?? '');
    $password = $_POST['password'] ?? '';


    /* =========================
       BASIC VALIDATION
    ========================= */

    if(
        $name === '' ||
        $email === '' ||
        $phone === '' ||
        $department === '' ||
        $year === '' ||
        $password === ''
    )
    {
        echo "<script>
            alert('Please fill in all fields.');
        </script>";

    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        echo "<script>
            alert('Please enter a valid email address.');
        </script>";

    }
    elseif(strlen($password) < 6)
    {
        echo "<script>
            alert('Password must contain at least 6 characters.');
        </script>";

    }
    else
    {

        /* =========================
           CHECK EXISTING EMAIL
        ========================= */

        $check_stmt = mysqli_prepare(
            $conn,
            "SELECT id FROM students WHERE email = ? LIMIT 1"
        );

        mysqli_stmt_bind_param(
            $check_stmt,
            "s",
            $email
        );

        mysqli_stmt_execute($check_stmt);

        $check_result = mysqli_stmt_get_result($check_stmt);

        $email_exists = mysqli_num_rows($check_result) > 0;

        mysqli_stmt_close($check_stmt);


        if($email_exists)
        {
            echo "<script>
                alert('An account with this email already exists. Please sign in.');
            </script>";
        }
        else
        {

            /* =========================
               HASH PASSWORD
            ========================= */

            $hashed_password = password_hash(
                $password,
                PASSWORD_DEFAULT
            );


            /* =========================
               INSERT STUDENT
            ========================= */

            $insert_stmt = mysqli_prepare(
                $conn,
                "INSERT INTO students
                (name, email, phone, department, year, password)
                VALUES (?, ?, ?, ?, ?, ?)"
            );

            mysqli_stmt_bind_param(
                $insert_stmt,
                "ssssss",
                $name,
                $email,
                $phone,
                $department,
                $year,
                $hashed_password
            );


            if(mysqli_stmt_execute($insert_stmt))
{
    mysqli_stmt_close($insert_stmt);

    // Automatically log in the newly registered student
    session_regenerate_id(true);

    $_SESSION['student_email'] = $email;

    // Go directly to student dashboard
    header("Location: dashboard.php");
    exit();
}
            else
            {
                mysqli_stmt_close($insert_stmt);

                echo "<script>
                    alert('Registration Failed. Please try again.');
                </script>";
            }

        }

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Create Student Account | CampusHub</title>

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
    background: #ffffff;
    padding: 14px 0;
    border-bottom: 1px solid #eef0f5;
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

.home-link {
    color: #667085;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
}

.home-link:hover {
    color: #635bff;
}

/* Main */

.register-wrapper {
    min-height: calc(100vh - 73px);
    display: flex;
    align-items: center;
    padding: 50px 20px;
}

.register-card {
    width: 100%;
    max-width: 1050px;
    margin: auto;
    background: white;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(16, 24, 40, 0.10);
    display: flex;
}

/* Left */

.register-left {
    width: 42%;
    background:
    radial-gradient(circle at 85% 15%, rgba(124,108,255,.22), transparent 30%),
    linear-gradient(145deg, #101a45 0%, #25205f 100%);
    color: white;
    padding: 55px 45px;
    position: relative;
    overflow: hidden;
}

.register-left::before {
    content: "";
    position: absolute;
    width: 240px;
    height: 240px;
    border-radius: 50%;
    background: rgba(124, 108, 255, 0.18);
    top: -90px;
    right: -80px;
}

.register-left::after {
    content: "";
    position: absolute;
    width: 180px;
    height: 180px;
    border-radius: 50%;
    background: rgba(99, 91, 255, 0.10);
    bottom: -70px;
    left: -60px;
}

.register-content {
    position: relative;
    z-index: 2;
}

.badge-campus {
    display: inline-block;
    background: rgba(124, 108, 255, 0.18);
    color: #b8b0ff;
    padding: 8px 13px;
    border-radius: 30px;
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 25px;
}

.register-left h1 {
    font-size: 34px;
    line-height: 1.2;
    font-weight: 800;
    letter-spacing: -1px;
    margin-bottom: 18px;
}

.register-left p {
    color: #aeb9ca;
    font-size: 15px;
    line-height: 1.7;
    margin-bottom: 35px;
}

/* Benefits */

.benefit {
    display: flex;
    align-items: center;
    gap: 13px;
    margin-bottom: 18px;
}

.benefit-icon {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    background: rgba(255,255,255,0.08);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 17px;
}

.benefit span {
    font-size: 14px;
    color: #d7deea;
}

/* Right */

.register-right {
    width: 58%;
    padding: 45px 50px;
}

.form-title {
    font-size: 27px;
    font-weight: 800;
    color: #172033;
    margin-bottom: 7px;
}

.form-subtitle {
    color: #667085;
    font-size: 14px;
    margin-bottom: 30px;
}

.form-label {
    font-size: 13px;
    font-weight: 600;
    color: #344054;
    margin-bottom: 8px;
}

.form-control {
    height: 50px;
    border: 1px solid #d9dee8;
    border-radius: 10px;
    padding: 0 14px;
    font-size: 14px;
    transition: 0.2s;
}

.form-control:focus {
    border-color: #635bff;
    box-shadow: 0 0 0 4px rgba(99, 91, 255, 0.10);
}

.form-group {
    margin-bottom: 20px;
}

.register-btn {
    height: 50px;
    border: none;
    border-radius: 10px;
    background: #635bff;
    color: white;
    font-size: 14px;
    font-weight: 700;
    width: 100%;
    transition: 0.2s;
    margin-top: 5px;
}

.register-btn:hover {
    background: linear-gradient(135deg, #554ce8, #6850ee);
    transform: translateY(-2px);
    box-shadow: 0 12px 25px rgba(99,91,255,.25);
}

.login-text {
    text-align: center;
    color: #667085;
    font-size: 13px;
    margin-top: 22px;
}

.login-text a {
    color: #635bff;
    text-decoration: none;
    font-weight: 700;
}

.login-text a:hover {
    text-decoration: underline;
}

.password-wrapper {
    position: relative;
}

.password-wrapper .form-control {
    padding-right: 50px;
}

.password-toggle {
    position: absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);
    border: none;
    background: transparent;
    color: #667085;
    cursor: pointer;
    font-size: 13px;
}

/* Mobile */

@media (max-width: 850px) {

    .register-card {
        flex-direction: column;
    }

    .register-left,
    .register-right {
        width: 100%;
    }

    .register-left {
        padding: 40px 30px;
    }

    .register-left h1 {
        font-size: 28px;
    }

    .register-right {
        padding: 35px 30px;
    }

}

@media (max-width: 500px) {

    .register-wrapper {
        padding: 25px 12px;
    }

    .register-left,
    .register-right {
        padding: 30px 22px;
    }

    .register-left p {
        margin-bottom: 25px;
    }

}

</style>

</head>

<body>

<!-- Navbar -->

<nav class="navbar">

<div class="container">

<a class="navbar-brand" href="../index.php">
    Campus<span>Hub</span>
</a>

<a href="../index.php" class="home-link">
    ← Back to Home
</a>

</div>

</nav>


<!-- Registration -->

<div class="register-wrapper">

<div class="register-card">

<!-- Left Panel -->

<div class="register-left">

<div class="register-content">

<div class="badge-campus">
    STUDENT PORTAL
</div>

<h1>
    Your campus journey starts here.
</h1>

<p>
    Create your CampusHub account and stay connected with
    events, activities and opportunities happening across
    your college campus.
</p>


<div class="benefit">

<div class="benefit-icon">
    ✓
</div>

<span>
    Discover upcoming college events
</span>

</div>


<div class="benefit">

<div class="benefit-icon">
    ✓
</div>

<span>
    Register for events in seconds
</span>

</div>


<div class="benefit">

<div class="benefit-icon">
    ✓
</div>

<span>
    Keep track of your registrations
</span>

</div>


<div class="benefit">

<div class="benefit-icon">
    ✓
</div>

<span>
    One account for your campus activities
</span>

</div>

</div>

</div>


<!-- Right Panel -->

<div class="register-right">

<div class="form-title">
    Create your account
</div>

<div class="form-subtitle">
    Enter your details to get started with CampusHub.
</div>


<form method="POST">

<div class="row">

<!-- Name -->

<div class="col-md-6">

<div class="form-group">

<label class="form-label">
    Full Name
</label>

<input
    type="text"
    name="name"
    class="form-control"
    placeholder="Enter your full name"
    required
>

</div>

</div>


<!-- Email -->

<div class="col-md-6">

<div class="form-group">

<label class="form-label">
    Email Address
</label>

<input
    type="email"
    name="email"
    class="form-control"
    placeholder="you@example.com"
    required
>

</div>

</div>


<!-- Phone -->

<div class="col-md-6">

<div class="form-group">

<label class="form-label">
    Phone Number
</label>

<input
    type="tel"
    name="phone"
    class="form-control"
    placeholder="Enter phone number"
    required
>

</div>

</div>


<!-- Department -->

<div class="col-md-6">

<div class="form-group">

<label class="form-label">
    Department
</label>

<input
    type="text"
    name="department"
    class="form-control"
    placeholder="e.g. Computer Science"
    required
>

</div>

</div>


<!-- Year -->

<div class="col-md-6">

<div class="form-group">

<label class="form-label">
    Academic Year
</label>

<select name="year" class="form-control" required>

<option value="" selected disabled>
    Select your year
</option>

<option value="1st Year">
    1st Year
</option>

<option value="2nd Year">
    2nd Year
</option>

<option value="3rd Year">
    3rd Year
</option>

<option value="4th Year">
    4th Year
</option>

</select>

</div>

</div>


<!-- Password -->

<div class="col-md-6">

<div class="form-group">

<label class="form-label">
    Password
</label>

<div class="password-wrapper">

<input
    type="password"
    name="password"
    id="password"
    class="form-control"
    placeholder="Create a password"
    required
>

<button
    type="button"
    class="password-toggle"
    onclick="togglePassword()"
>
    Show
</button>

</div>

</div>

</div>

</div>


<button
    type="submit"
    name="register"
    class="register-btn"
>
    Create Student Account
</button>


<div class="login-text">

Already have an account?

<a href="login.php">
    Sign in
</a>

</div>

</form>

</div>

</div>

</div>


<script>

function togglePassword()
{
    const password = document.getElementById("password");
    const button = document.querySelector(".password-toggle");

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