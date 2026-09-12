<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>About | CampusHub</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: #f7f8fc;
            color: #101a45;
        }

        /* =========================
           NAVBAR
        ========================= */

        .navbar {
            background: rgba(255,255,255,.96);
            border-bottom: 1px solid #e8eaf1;
            padding: 13px 0;
        }

        .navbar-brand {
            font-size: 1.25rem;
            font-weight: 800;
            color: #101a45 !important;
        }

        .brand-icon {
            width: 36px;
            height: 36px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            background: #eeeaff;
            border-radius: 10px;

            margin-right: 8px;
        }

        .brand-purple {
            color: #635bff;
        }

        .nav-link {
            color: #101a45 !important;
            font-weight: 600;
            margin-left: 18px;
            transition: .25s;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #635bff !important;
        }

        .nav-login {
            border: 1px solid #d8dbea;
            border-radius: 11px;
            padding: 9px 20px !important;
            margin-left: 28px;
        }

        .nav-signup {
            background: linear-gradient(
                135deg,
                #5b4bff,
                #765cff
            );

            color: white !important;

            border-radius: 11px;
            padding: 10px 21px !important;
        }

        /* =========================
           HERO
        ========================= */

        .about-hero {
            padding: 90px 0 80px;

            background:
                radial-gradient(
                    circle at 20% 40%,
                    rgba(124,108,255,.12),
                    transparent 35%
                ),
                linear-gradient(
                    100deg,
                    #ffffff,
                    #f1f2ff
                );
        }

        .about-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            padding: 8px 14px;

            background: #eef2ff;
            border: 1px solid #dfe4ff;

            border-radius: 50px;

            color: #4f46c8;

            font-size: .78rem;
            font-weight: 600;

            margin-bottom: 20px;
        }

        .about-badge span {
            width: 8px;
            height: 8px;

            background: #20c997;

            border-radius: 50%;
        }

        .about-hero h1 {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 800;
            line-height: 1.08;

            letter-spacing: -2px;

            margin-bottom: 20px;
        }

        .about-hero h1 span {
            color: #635bff;
        }

        .about-hero p {
            max-width: 650px;

            color: #66708a;

            line-height: 1.75;

            font-size: 1rem;
        }

        /* =========================
           IMAGE
        ========================= */

        .about-image {
    width: 100%;
    height: 390px;
    object-fit: cover;
    object-position: center;
    display: block;

    border-radius: 24px;

    box-shadow:
        0 25px 60px rgba(30,35,80,.15);

    transition: transform .6s ease;
}

        .about-image:hover {
            transform: scale(1.02);
        }

        /* =========================
           CONTENT
        ========================= */

        .about-section {
            padding: 90px 0;
        }

        .section-label {
            color: #635bff;

            font-size: .75rem;

            font-weight: 800;

            letter-spacing: 2px;

            text-transform: uppercase;

            margin-bottom: 10px;
        }

        .section-title {
            font-size: 2.2rem;

            font-weight: 800;

            letter-spacing: -1px;

            margin-bottom: 18px;
        }

        .section-text {
            color: #66708a;

            line-height: 1.8;
        }

        /* =========================
           OBJECTIVES
        ========================= */

        .objective-card {
            background: white;

            border: 1px solid #e6e8f0;

            border-radius: 18px;

            padding: 25px;

            height: 100%;

            transition:
                transform .3s ease,
                box-shadow .3s ease;
        }

        .objective-card:hover {
            transform: translateY(-7px);

            box-shadow:
                0 20px 45px rgba(30,35,80,.10);
        }

        .objective-icon {
            width: 48px;
            height: 48px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #eeeaff;

            color: #635bff;

            border-radius: 13px;

            font-size: 20px;

            margin-bottom: 18px;
        }

        .objective-card h4 {
            font-size: 1.05rem;
            font-weight: 800;

            margin-bottom: 8px;
        }

        .objective-card p {
            color: #70798c;

            font-size: .9rem;

            line-height: 1.65;

            margin: 0;
        }

        /* =========================
           CTA
        ========================= */

        .cta {
            margin: 0 0 80px;

            padding: 50px;

            border-radius: 22px;

            background:
                linear-gradient(
                    90deg,
                    rgba(61,31,160,.97),
                    rgba(111,72,230,.88)
                ),
                url("https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1400");

            background-size: cover;
            background-position: center;

            color: white;
        }

        .cta h2 {
            font-size: 2rem;
            font-weight: 800;

            margin-bottom: 10px;
        }

        .cta p {
            color: rgba(255,255,255,.82);

            margin-bottom: 25px;
        }

        .cta-button {
            display: inline-block;

            background: white;
            color: #635bff;

            padding: 12px 25px;

            border-radius: 11px;

            text-decoration: none;

            font-weight: 700;

            transition: .3s;
        }

        .cta-button:hover {
            transform: translateY(-3px);

            color: #4f46e5;
        }

        /* =========================
           FOOTER
        ========================= */

        footer {
            background: #0b1120;

            color: white;

            padding: 45px 0 25px;
        }

        footer h5 {
            font-weight: 800;
        }

        footer p,
        footer a {
            color: #9ca8c5;
        }

        footer a {
            text-decoration: none;
        }

        footer a:hover {
            color: white;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,.08);

            margin-top: 30px;

            padding-top: 20px;

            color: #71809f;

            font-size: .85rem;
        }

        /* =========================
           MOBILE
        ========================= */

        @media(max-width: 991px) {

            .nav-login {
                margin-left: 0;
            }

            .nav-signup {
                display: inline-block;
                margin-top: 8px;
            }

            .about-hero {
                padding: 65px 0;
            }

            .about-image {
                height: 330px;
                margin-top: 30px;
            }

        }

    </style>

</head>


<body>


<!-- =========================
     NAVBAR
========================= -->

<nav class="navbar navbar-expand-lg">

    <div class="container">

        <a class="navbar-brand"
           href="index.php">

            <span class="brand-icon">🎓</span>

            Campus<span class="brand-purple">Hub</span>

        </a>


        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>


        <div
            class="collapse navbar-collapse"
            id="navbarNav">

            <ul class="navbar-nav ms-auto align-items-lg-center">

                <li class="nav-item">

                    <a class="nav-link"
                       href="index.php">

                        Home

                    </a>

                </li>


                <li class="nav-item">

                    <a class="nav-link"
                       href="students/events.php">

                        Events

                    </a>

                </li>


                <li class="nav-item">

                    <a class="nav-link active"
                       href="about.php">

                        About

                    </a>

                </li>


                <li class="nav-item">

                    <a class="nav-link"
                       href="contact.php">

                        Contact

                    </a>

                </li>


                <li class="nav-item">

                    <a class="nav-link nav-login"
                       href="students/login.php">

                        Login

                    </a>

                </li>


                <li class="nav-item">

                    <a class="nav-link nav-signup"
                       href="students/register.php">

                        Sign Up

                    </a>

                </li>

            </ul>

        </div>

    </div>

</nav>


<!-- =========================
     ABOUT HERO
========================= -->

<section class="about-hero">

    <div class="container">

        <div class="row align-items-center g-5">

            <div class="col-lg-6">

                <div class="about-badge">

                    <span></span>

                    About CampusHub

                </div>


                <h1>

                    Making campus life
                    <span>more connected.</span>

                </h1>


                <p>

                    CampusHub is a modern college event
                    management platform designed to make
                    discovering, registering and managing
                    campus events simple and convenient.

                </p>

            </div>


            <div class="col-lg-6">

                <img
                    class="about-image"
                    src="images/about-campus.png"
                    alt="Students on a college campus">

            </div>

        </div>

    </div>

</section>


<!-- =========================
     ABOUT
========================= -->

<section class="about-section">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-9 text-center">

                <div class="section-label">
                    OUR PURPOSE
                </div>

                <h2 class="section-title">

                    One platform for
                    every campus experience

                </h2>

                <p class="section-text">

                    The College Event Management System is
                    a web-based application developed to
                    simplify the management of college events.
                    It enables students to register for events
                    online while allowing administrators to
                    create, update and manage events efficiently.

                </p>

            </div>

        </div>

    </div>

</section>


<!-- =========================
     OBJECTIVES
========================= -->

<section class="about-section pt-0">

    <div class="container">

        <div class="text-center mb-5">

            <div class="section-label">
                WHAT WE AIM TO ACHIEVE
            </div>

            <h2 class="section-title">
                Built to simplify campus events
            </h2>

        </div>


        <div class="row g-4">


            <div class="col-md-4">

                <div class="objective-card">

                    <div class="objective-icon">
                        📄
                    </div>

                    <h4>
                        Reduce Paperwork
                    </h4>

                    <p>
                        Replace manual registration processes
                        with a simple digital experience.
                    </p>

                </div>

            </div>


            <div class="col-md-4">

                <div class="objective-card">

                    <div class="objective-icon">
                        📅
                    </div>

                    <h4>
                        Easy Event Registration
                    </h4>

                    <p>
                        Allow students to discover events
                        and register online in just a few clicks.
                    </p>

                </div>

            </div>


            <div class="col-md-4">

                <div class="objective-card">

                    <div class="objective-icon">
                        🗂️
                    </div>

                    <h4>
                        Centralized Management
                    </h4>

                    <p>
                        Keep college events organized through
                        one centralized platform.
                    </p>

                </div>

            </div>


            <div class="col-md-4">

                <div class="objective-card">

                    <div class="objective-icon">
                        🔐
                    </div>

                    <h4>
                        Secure Login
                    </h4>

                    <p>
                        Provide separate secure access for
                        students and administrators.
                    </p>

                </div>

            </div>


            <div class="col-md-4">

                <div class="objective-card">

                    <div class="objective-icon">
                        📊
                    </div>

                    <h4>
                        Efficient Tracking
                    </h4>

                    <p>
                        Make it easier to manage events and
                        monitor student registrations.
                    </p>

                </div>

            </div>


            <div class="col-md-4">

                <div class="objective-card">

                    <div class="objective-icon">
                        🎓
                    </div>

                    <h4>
                        Better Campus Experience
                    </h4>

                    <p>
                        Connect students with meaningful
                        academic and extracurricular experiences.
                    </p>

                </div>

            </div>


        </div>

    </div>

</section>


<!-- =========================
     CTA
========================= -->

<div class="container">

    <section class="cta">

        <h2>
            Ready to explore campus events?
        </h2>

        <p>
            Discover what's happening around your campus
            and start participating today.
        </p>

        <a
            href="students/events.php"
            class="cta-button">

            Explore Events →

        </a>

    </section>

</div>


<!-- =========================
     FOOTER
========================= -->

<footer>

    <div class="container">

        <div class="row g-4">


            <div class="col-lg-6">

                <h5>
                    🎓 CampusHub
                </h5>

                <p class="mt-3">

                    A centralized college event management
                    platform designed to connect students
                    with meaningful campus experiences.

                </p>

            </div>


            <div class="col-md-3">

                <h6>
                    Platform
                </h6>

                <div class="mt-3">

                    <p>
                        <a href="index.php">
                            Home
                        </a>
                    </p>

                    <p>
                        <a href="students/events.php">
                            Events
                        </a>
                    </p>

                    <p>
                        <a href="about.php">
                            About
                        </a>
                    </p>

                    <p>
                        <a href="contact.php">
                            Contact
                        </a>
                    </p>

                </div>

            </div>


            <div class="col-md-3">

                <h6>
                    Account
                </h6>

                <div class="mt-3">

                    <p>
                        <a href="students/login.php">
                            Login
                        </a>
                    </p>

                    <p>
                        <a href="students/register.php">
                            Sign Up
                        </a>
                    </p>

                </div>

            </div>


        </div>


        <div class="footer-bottom">

            © 2026 CampusHub. College Event Management System.

        </div>

    </div>

</footer>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


</body>

</html>