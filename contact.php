<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Contact | CampusHub</title>

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
           CONTACT HERO
        ========================= */

        .contact-hero {
            padding: 90px 0 70px;

            background:
                radial-gradient(
                    circle at 18% 40%,
                    rgba(124,108,255,.12),
                    transparent 35%
                ),
                linear-gradient(
                    100deg,
                    #ffffff,
                    #f1f2ff
                );
        }

        .contact-badge {
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

            margin-bottom: 18px;
        }

        .contact-badge span {
            width: 8px;
            height: 8px;

            background: #20c997;

            border-radius: 50%;
        }

        .contact-hero h1 {
            font-size: clamp(2.5rem, 5vw, 4rem);

            font-weight: 800;

            line-height: 1.08;

            letter-spacing: -2px;

            margin-bottom: 20px;
        }

        .contact-hero h1 span {
            color: #635bff;
        }

        .contact-hero p {
            max-width: 620px;

            color: #66708a;

            line-height: 1.75;

            font-size: 1rem;
        }

        /* =========================
           CONTACT CONTENT
        ========================= */

        .contact-section {
            padding: 75px 0 90px;
        }

        .contact-card {
            background: white;

            border: 1px solid #e5e7ef;

            border-radius: 20px;

            padding: 32px;

            height: 100%;

            box-shadow:
                0 12px 35px rgba(30,35,80,.05);
        }

        .contact-card h3 {
            font-size: 1.35rem;

            font-weight: 800;

            margin-bottom: 25px;
        }

        /* =========================
           CONTACT INFO
        ========================= */

        .contact-info {
            display: flex;

            align-items: flex-start;

            gap: 15px;

            padding: 17px 0;

            border-bottom: 1px solid #eef0f5;
        }

        .contact-info:last-child {
            border-bottom: none;
        }

        .contact-icon {
            width: 48px;
            height: 48px;

            flex-shrink: 0;

            display: flex;

            align-items: center;
            justify-content: center;

            background: #eeeaff;

            color: #635bff;

            border-radius: 13px;

            font-size: 20px;
        }

        .contact-info h5 {
            margin: 0 0 5px;

            font-size: .95rem;

            font-weight: 800;
        }

        .contact-info p {
            margin: 0;

            color: #70798c;

            font-size: .88rem;

            line-height: 1.55;
        }

        /* =========================
           FORM
        ========================= */

        .form-label {
            font-size: .85rem;

            font-weight: 600;

            color: #273154;

            margin-bottom: 7px;
        }

        .form-control {
            border: 1px solid #dfe2eb;

            border-radius: 11px;

            padding: 12px 14px;

            font-size: .9rem;

            box-shadow: none;

            transition: .25s;
        }

        .form-control:focus {
            border-color: #8d87ff;

            box-shadow:
                0 0 0 3px rgba(99,91,255,.10);
        }

        textarea.form-control {
            min-height: 125px;

            resize: vertical;
        }

        .contact-button {
            border: none;

            background:
                linear-gradient(
                    135deg,
                    #5b4bff,
                    #765cff
                );

            color: white;

            padding: 12px 25px;

            border-radius: 11px;

            font-weight: 700;

            transition: .3s;
        }

        .contact-button:hover {
            transform: translateY(-3px);

            box-shadow:
                0 10px 25px rgba(99,91,255,.25);
        }

        /* =========================
           CTA
        ========================= */

        .contact-cta {
            margin-top: 30px;

            padding: 35px;

            border-radius: 20px;

            background:
                linear-gradient(
                    100deg,
                    #35209d,
                    #7655e8
                );

            color: white;
        }

        .contact-cta h3 {
            font-size: 1.45rem;

            font-weight: 800;

            margin-bottom: 8px;
        }

        .contact-cta p {
            color: rgba(255,255,255,.8);

            margin: 0;
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

        footer h6 {
            font-weight: 700;
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

            .contact-hero {
                padding: 65px 0;
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

            <span class="brand-icon">
                🎓
            </span>

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

                    <a class="nav-link"
                       href="about.php">

                        About

                    </a>

                </li>


                <li class="nav-item">

                    <a class="nav-link active"
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
     CONTACT HERO
========================= -->

<section class="contact-hero">

    <div class="container">

        <div class="text-center">

            <div class="contact-badge">

                <span></span>

                Contact CampusHub

            </div>


            <h1>

                Let's stay
                <span>connected.</span>

            </h1>


            <p class="mx-auto">

                Have a question, suggestion or need help
                with CampusHub? We'd love to hear from you.
                Reach out using the information below.

            </p>

        </div>

    </div>

</section>


<!-- =========================
     CONTACT SECTION
========================= -->

<section class="contact-section">

    <div class="container">

        <div class="row g-4">


            <!-- CONTACT INFORMATION -->

            <div class="col-lg-5">

                <div class="contact-card">

                    <h3>
                        Get in touch
                    </h3>


                    <div class="contact-info">

                        <div class="contact-icon">
                            ✉️
                        </div>

                        <div>

                            <h5>
                                Email
                            </h5>

                            <p>
                                ariharankpr2007@gmail.com
                            </p>

                        </div>

                    </div>


                    <div class="contact-info">

                        <div class="contact-icon">
                            📞
                        </div>

                        <div>

                            <h5>
                                Phone
                            </h5>

                            <p>
                                +91 9498411460
                            </p>

                        </div>

                    </div>


                    <div class="contact-info">

                        <div class="contact-icon">
                            📍
                        </div>

                        <div>

                            <h5>
                                Address
                            </h5>

                            <p>
                                KCG College, Karapakkam
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            <!-- CONTACT FORM -->

            <div class="col-lg-7">

                <div class="contact-card">

                    <h3>
                        Send us a message
                    </h3>


                    <form>

                        <div class="row g-3">


                            <div class="col-md-6">

                                <label class="form-label">
                                    Your Name
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter your name">

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Email Address
                                </label>

                                <input
                                    type="email"
                                    class="form-control"
                                    placeholder="Enter your email">

                            </div>


                            <div class="col-12">

                                <label class="form-label">
                                    Subject
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="What is this about?">

                            </div>


                            <div class="col-12">

                                <label class="form-label">
                                    Message
                                </label>

                                <textarea
                                    class="form-control"
                                    placeholder="Write your message here..."></textarea>

                            </div>


                            <div class="col-12">

                                <button
                                    type="button"
                                    class="contact-button">

                                    Send Message →

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>


        <!-- CTA -->

        <div class="contact-cta">

            <h3>
                Ready to explore campus events?
            </h3>

            <p>
                Discover upcoming events and connect
                with your campus community.
            </p>

            <a
                href="students/events.php"
                class="btn btn-light mt-3">

                Explore Events →

            </a>

        </div>

    </div>

</section>


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