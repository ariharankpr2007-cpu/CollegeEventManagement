<?php

session_start();

include("../includes/db.php");


/* =========================
   STUDENT LOGIN
========================= */

if(isset($_POST['login']))
{

    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';


    /* =========================
       BASIC VALIDATION
    ========================= */

    if($email === '' || $password === '')
    {
        echo "<script>
            alert('Please enter your email and password.');
        </script>";
    }

    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        echo "<script>
            alert('Please enter a valid email address.');
        </script>";
    }

    else
    {

        /* =========================
           FIND STUDENT
        ========================= */

        $stmt = mysqli_prepare(
            $conn,
            "SELECT email, password
             FROM students
             WHERE email = ?
             LIMIT 1"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "s",
            $email
        );

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);


        /* =========================
           VERIFY PASSWORD
        ========================= */

        if(mysqli_num_rows($result) == 1)
        {

            $student = mysqli_fetch_assoc($result);

            if(password_verify($password, $student['password']))
            {

                session_regenerate_id(true);

                $_SESSION['student_email'] = $student['email'];

                mysqli_stmt_close($stmt);

                header("Location: dashboard.php");
                exit();

            }

        }


        mysqli_stmt_close($stmt);


        echo "<script>
            alert('Invalid Email or Password');
        </script>";

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Student Login | CampusHub</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>

*{
    box-sizing:border-box;
}

body{
    margin:0;
    font-family:'Inter',sans-serif;
    background:#f5f6fa;
    min-height:100vh;
}

/* =========================
   NAVBAR
========================= */

.navbar{
    background:#0b1120;
    padding:15px 0;
}

.navbar-brand{
    color:#101a45;
    font-weight:800;
    font-size:1.15rem;
    text-decoration:none;
}

.brand-icon{
    display:inline-flex;
    width:37px;
    height:37px;
    align-items:center;
    justify-content:center;
    background:#635bff;
    border-radius:10px;
    margin-right:8px;
}

.back-link{
    color:#667085;
    text-decoration:none;
    font-size:.9rem;
    font-weight:500;
}

.back-link:hover{
    color:#635bff;
}

/* =========================
   LOGIN AREA
========================= */

.login-section{
    min-height:calc(100vh - 68px);
    display:flex;
    align-items:center;
    padding:50px 15px;
}

.login-wrapper{
    width:100%;
    max-width:1000px;
    margin:auto;
}

/* =========================
   SUCCESS MODAL
========================= */

.success-overlay {
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, 0.55);
    backdrop-filter: blur(5px);

    display: flex;
    align-items: center;
    justify-content: center;

    z-index: 9999;

    opacity: 0;
    visibility: hidden;

    transition: opacity 0.25s ease,
                visibility 0.25s ease;
}

.success-overlay.show {
    opacity: 1;
    visibility: visible;
}

.success-modal {
    width: 90%;
    max-width: 390px;

    background: white;
    border-radius: 20px;

    padding: 35px 30px;

    text-align: center;

    box-shadow: 0 25px 70px rgba(0,0,0,0.20);

    transform: scale(0.85) translateY(20px);

    transition: transform 0.3s cubic-bezier(.2,.8,.2,1);
}

.success-overlay.show .success-modal {
    transform: scale(1) translateY(0);
}

.success-icon {
    width: 65px;
    height: 65px;

    margin: 0 auto 18px;

    border-radius: 50%;

    background: #ecfdf3;
    color: #12b76a;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 30px;
    font-weight: 800;

    animation: successPop 0.45s ease;
}

@keyframes successPop {

    0% {
        transform: scale(0);
    }

    70% {
        transform: scale(1.15);
    }

    100% {
        transform: scale(1);
    }

}

.success-modal h3 {
    margin-bottom: 8px;

    color: #101828;

    font-size: 21px;
    font-weight: 800;
}

.success-modal p {
    color: #667085;

    font-size: 13px;
    line-height: 1.6;

    margin-bottom: 25px;
}

.success-button {
    width: 100%;

    border: none;

    background: #635bff;
    color: white;

    padding: 12px;

    border-radius: 9px;

    font-size: 13px;
    font-weight: 700;

    cursor: pointer;

    transition: 0.2s;
}

.success-button:hover {
    background: #5148e8;
    transform: translateY(-1px);
}

/* =========================
   LEFT PANEL
========================= */

.login-intro{
    background:
        linear-gradient(
            145deg,
            rgba(15,23,42,.96),
            rgba(36,31,92,.94)
        );

    min-height:550px;
    border-radius:20px 0 0 20px;
    padding:55px;
    color:white;

    display:flex;
    flex-direction:column;
    justify-content:center;

    position:relative;
    overflow:hidden;
}

.login-intro::before{
    content:"";
    position:absolute;
    width:280px;
    height:280px;
    border-radius:50%;
    background:#635bff;
    opacity:.14;
    right:-100px;
    top:-90px;
}

.login-intro::after{
    content:"";
    position:absolute;
    width:200px;
    height:200px;
    border-radius:50%;
    background:#8d87ff;
    opacity:.08;
    left:-90px;
    bottom:-80px;
}

.intro-content{
    position:relative;
    z-index:2;
}

.intro-label{
    color:#aaa5ff;
    text-transform:uppercase;
    font-size:.75rem;
    font-weight:800;
    letter-spacing:1.5px;
    margin-bottom:15px;
}

.login-intro h1{
    font-size:2.8rem;
    line-height:1.1;
    font-weight:800;
    letter-spacing:-1.5px;
    margin-bottom:20px;
}

.login-intro p{
    color:rgba(255,255,255,.68);
    line-height:1.75;
    font-size:.95rem;
}

.intro-features{
    margin-top:30px;
}

.intro-feature{
    display:flex;
    align-items:center;
    gap:12px;
    margin-bottom:16px;
    color:rgba(255,255,255,.82);
    font-size:.88rem;
}

.feature-check{
    width:28px;
    height:28px;
    border-radius:8px;
    background:rgba(99,91,255,.2);
    color:#aaa5ff;

    display:flex;
    align-items:center;
    justify-content:center;
}

/* =========================
   LOGIN CARD
========================= */

.login-card{
    background:white;
    min-height:550px;
    border-radius:0 20px 20px 0;

    padding:55px;

    display:flex;
    align-items:center;

    box-shadow:0 20px 60px rgba(15,23,42,.10);
}

.login-form{
    width:100%;
    max-width:390px;
    margin:auto;
}

.login-heading{
    margin-bottom:32px;
}

.login-heading h2{
    font-weight:800;
    font-size:2rem;
    letter-spacing:-.8px;
    margin-bottom:8px;
}

.login-heading p{
    color:#7a8496;
    font-size:.9rem;
    margin:0;
}

/* =========================
   FORM
========================= */

.form-label{
    font-size:.82rem;
    font-weight:700;
    color:#30394b;
    margin-bottom:8px;
}

.form-control{
    height:50px;
    border:1px solid #dfe2e8;
    border-radius:9px;
    padding:0 15px;
    font-size:.9rem;
    transition:.2s;
}

.form-control:focus{
    border-color:#635bff;
    box-shadow:0 0 0 3px rgba(99,91,255,.10);
}

.form-control::placeholder{
    color:#a7adba;
}

.password-row{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.forgot{
    color:#635bff;
    text-decoration:none;
    font-size:.78rem;
    font-weight:600;
}

.forgot:hover{
    text-decoration:underline;
}

/* =========================
   BUTTON
========================= */

.login-btn{
    width:100%;
    height:50px;
    border:none;
    border-radius:9px;

    background:#635bff;
    color:white;

    font-weight:700;
    font-size:.9rem;

    transition:.25s;
}

.login-btn:hover{
    background:#5149e6;
    transform:translateY(-1px);
    box-shadow:0 8px 20px rgba(99,91,255,.22);
}

/* =========================
   REGISTER
========================= */

.register-text{
    text-align:center;
    margin-top:25px;
    color:#7a8496;
    font-size:.85rem;
}

.register-text a{
    color:#635bff;
    text-decoration:none;
    font-weight:700;
}

.register-text a:hover{
    text-decoration:underline;
}

.divider{
    display:flex;
    align-items:center;
    gap:12px;
    margin:25px 0;
    color:#a0a7b5;
    font-size:.75rem;
}

.divider::before,
.divider::after{
    content:"";
    height:1px;
    background:#e8eaf0;
    flex:1;
}

/* =========================
   SECURITY NOTE
========================= */

.security-note{
    text-align:center;
    color:#9aa2b1;
    font-size:.72rem;
    margin-top:22px;
}

/* =========================
   MOBILE
========================= */

@media(max-width:768px){

    .login-section{
        padding:30px 15px;
    }

    .login-intro{
        display:none;
    }

    .login-card{
        border-radius:18px;
        min-height:auto;
        padding:40px 25px;
    }

    .login-heading h2{
        font-size:1.8rem;
    }

}

</style>

</head>

<body>

<!-- =========================
     REGISTRATION SUCCESS
========================= -->

<div class="success-overlay" id="successOverlay">

    <div class="success-modal">

        <div class="success-icon">
            ✓
        </div>

        <h3>
            Registration Successful
        </h3>

        <p>
            Your CampusHub student account has been
            created successfully. You can now sign in
            and explore campus events.
        </p>

        <button
            type="button"
            class="success-button"
            onclick="closeSuccess()"
        >
            Continue to Login →
        </button>

    </div>

</div>


<!-- =========================
     NAVBAR
========================= -->

<nav class="navbar">

    <div class="container d-flex justify-content-between align-items-center">

        <a href="../index.php" class="navbar-brand">

            <span class="brand-icon">🎓</span>

            CampusHub

        </a>

        <a href="../index.php" class="back-link">

            ← Back to Home

        </a>

    </div>

</nav>


<!-- =========================
     LOGIN
========================= -->

<section class="login-section">

    <div class="login-wrapper">

        <div class="row g-0">


            <!-- LEFT SIDE -->

            <div class="col-lg-6">

                <div class="login-intro">

                    <div class="intro-content">

                        <div class="intro-label">
                            Student Portal
                        </div>

                        <h1>
                            Welcome back to your campus.
                        </h1>

                        <p>
                            Sign in to discover upcoming events,
                            manage your registrations and stay
                            connected with everything happening
                            around your college.
                        </p>


                        <div class="intro-features">

                            <div class="intro-feature">

                                <span class="feature-check">
                                    ✓
                                </span>

                                Discover upcoming events

                            </div>


                            <div class="intro-feature">

                                <span class="feature-check">
                                    ✓
                                </span>

                                Register for events online

                            </div>


                            <div class="intro-feature">

                                <span class="feature-check">
                                    ✓
                                </span>

                                Manage your registrations

                            </div>


                            <div class="intro-feature">

                                <span class="feature-check">
                                    ✓
                                </span>

                                Access your student dashboard

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- RIGHT SIDE -->

            <div class="col-lg-6">

                <div class="login-card">

                    <div class="login-form">


                        <div class="login-heading">

                            <h2>
                                Student Login
                            </h2>

                            <p>
                                Enter your credentials to continue.
                            </p>

                        </div>


                        <form method="POST">


                            <!-- EMAIL -->

                            <div class="mb-4">

                                <label class="form-label">
                                    Email Address
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    placeholder="you@example.com"
                                    autocomplete="email"
                                    required
                                >

                            </div>


                            <!-- PASSWORD -->

                            <div class="mb-4">

                                <div class="password-row mb-2">

                                    <label class="form-label mb-0">
                                        Password
                                    </label>

                                    <a href="#" class="forgot">
                                        Forgot password?
                                    </a>

                                </div>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="Enter your password"
                                    autocomplete="current-password"
                                    required
                                >

                            </div>


                            <!-- LOGIN -->

                            <button
                                type="submit"
                                name="login"
                                class="login-btn">

                                Sign In →

                            </button>


                        </form>


                        <div class="divider">
                            OR
                        </div>


                        <div class="register-text">

                            Don't have a student account?

                            <a href="register.php">
                                Create an account
                            </a>

                        </div>


                        <div class="security-note">

                            🔒 Your student account is protected

                        </div>


                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

function showSuccess()
{
    const overlay = document.getElementById("successOverlay");

    if(overlay)
    {
        overlay.classList.add("show");
    }
}


function closeSuccess()
{
    const overlay = document.getElementById("successOverlay");

    if(overlay)
    {
        overlay.classList.remove("show");
    }

    setTimeout(function()
    {
        window.location.href = "login.php";

    }, 250);
}


document.addEventListener("DOMContentLoaded", function()
{

    const params = new URLSearchParams(
        window.location.search
    );


    if(params.get("registered") === "1")
    {

        showSuccess();


        /* Remove parameter from URL */

        window.history.replaceState(
            {},
            document.title,
            window.location.pathname
        );

    }

});

</script>

</body>
</html>