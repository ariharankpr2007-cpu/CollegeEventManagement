<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CampusHub | College Events</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            color: #172033;
            background: #f7f8fc;
        }

        /* =========================
           NAVBAR
        ========================= */

        .navbar {
    background: rgba(255,255,255,.96) !important;
    padding: 13px 0;
    border-bottom: 1px solid rgba(20,30,70,.06);
    position: relative;
    z-index: 20;
}

.navbar-brand {
    font-weight: 800;
    font-size: 1.25rem;
    letter-spacing: -0.6px;
    color: #101a45 !important;
}

.brand-icon {
    display: inline-flex;
    width: 36px;
    height: 36px;
    align-items: center;
    justify-content: center;
    background: #eeeaff;
    border-radius: 10px;
    margin-right: 8px;
    font-size: 18px;
}

.nav-link {
    color: #101a45 !important;
    font-weight: 600;
    margin-left: 16px;
    padding: 10px 4px !important;
    transition: .25s;
}

.nav-link:hover,
.nav-link.active {
    color: #4f46e5 !important;
}

.nav-link.active {
    position: relative;
}

.nav-link.active::after {
    content: "";
    position: absolute;
    left: 4px;
    right: 4px;
    bottom: 2px;
    height: 2px;
    background: #635bff;
    border-radius: 5px;
}

.nav-login {
    background: white;
    border: 1px solid #d9dce8;
    border-radius: 11px;
    padding: 9px 20px !important;
    margin-left: 28px;
}

.nav-signup {
    background: linear-gradient(135deg,#5b4bff,#765cff);
    color: white !important;
    border-radius: 11px;
    padding: 10px 21px !important;
    margin-left: 10px;
}
        /* =========================
           HERO
        ========================= */

        .hero {
    min-height: 500px;
    display: flex;
    align-items: center;
    position: relative;
    overflow: hidden;

    background:
        radial-gradient(
            circle at 18% 45%,
            rgba(124,108,255,.12),
            transparent 35%
        ),
        linear-gradient(
            100deg,
            #ffffff 0%,
            #faf9ff 48%,
            #eef0ff 100%
        );
}

.hero::after {
    content: "";
    position: absolute;

    width: 520px;
    height: 520px;

    right: -180px;
    top: 30px;

    background: rgba(99,91,255,.10);

    border-radius: 50%;
    filter: blur(90px);

    pointer-events: none;
}

        .hero-content {
    max-width: 570px;
    color: #101a45;
    position: relative;
    z-index: 5;
}

       .hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;

    background: #eef2ff;
    border: 1px solid #dfe4ff;

    padding: 8px 14px;
    border-radius: 50px;

    color: #4656c8;

    font-size: .78rem;
    font-weight: 600;

    margin-bottom: 18px;
}

        .live-dot {
            width: 8px;
            height: 8px;
            background: #48e08a;
            border-radius: 50%;
        }

        .hero h1 {
    font-size: clamp(2.5rem, 4.5vw, 4rem);
    font-weight: 800;
    line-height: 1.08;
    letter-spacing: -2.5px;

    color: #101a45;

    margin-bottom: 18px;
}

.hero h1 span {
    color: #635bff;
}

        .hero p {
    max-width: 560px;

    font-size: .98rem;
    line-height: 1.65;

    color: #66708a;

    margin-bottom: 25px;
}

        .btn-primary-custom {
            background: #635bff;
            color: white;
            border: none;
            padding: 14px 25px;
            border-radius: 9px;
            font-weight: 700;
            transition: .25s;
        }

        .btn-primary-custom:hover {
            background: #5149e6;
            color: white;
            transform: translateY(-2px);
        }

       .btn-outline-custom {
    color: #101a45;

    background: rgba(255,255,255,.75);

    border: 1px solid #c9cde0;

    padding: 13px 25px;

    border-radius: 10px;

    font-weight: 600;

    margin-left: 10px;

    transition: .3s ease;
}

.btn-outline-custom:hover {
    background: white;
    color: #4f46e5;

    border-color: #8d87ff;

    transform: translateY(-3px);
}

        .btn-outline-custom:hover {
            background: white;
            color: #172033;
        }

        /* =========================
           STATS
        ========================= */

        .stats-wrapper {
    margin-top: -25px;
    position: relative;
    z-index: 10;
}

        .stats-card {
    background: rgba(255,255,255,.96);

    border: 1px solid #e4e6ef;

    border-radius: 18px;

    box-shadow:
        0 18px 50px rgba(25,35,80,.08);

    padding: 25px 30px;
}

        .stat {
    display: flex;
    align-items: center;

    justify-content: center;

    gap: 16px;

    text-align: left;

    border-right: 1px solid #e4e6ef;

    min-height: 70px;
}

.stat:last-child {
    border-right: none;
}

.stat h3 {
    font-size: 1.8rem;

    font-weight: 800;

    color: #101a45;

    margin: 0 0 3px;
}

.stat p {
    color: #70798c;

    margin: 0;

    font-size: .78rem;
}

.stat-icon {
    width: 54px;
    height: 54px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    font-size: 21px;
}

.stat-icon.purple {
    background: #eeeaff;
    color: #635bff;
}

.stat-icon.green {
    background: #e7faf2;
    color: #12b76a;
}

.stat-icon.blue {
    background: #e8f1ff;
    color: #2675ff;
}

        .stat:last-child {
            border-right: none;
        }

        .stat h3 {
            font-size: 1.9rem;
            font-weight: 800;
            margin-bottom: 5px;
        }

        .stat p {
            color: #70798c;
            margin: 0;
            font-size: .9rem;
        }

        /* =========================
           SECTION
        ========================= */

        .section {
            padding: 100px 0;
        }

        .section-label {
            color: #635bff;
            text-transform: uppercase;
            font-weight: 800;
            font-size: .78rem;
            letter-spacing: 1.5px;
            margin-bottom: 10px;
        }

        .section-title {
            font-size: 2.4rem;
            font-weight: 800;
            letter-spacing: -1px;
            margin-bottom: 12px;
        }

        .section-description {
            color: #70798c;
            max-width: 620px;
            line-height: 1.7;
        }

        /* =========================
           FEATURE CARDS
        ========================= */

        .feature-card {
    height: 100%;
    background: #ffffff;
    border: 1px solid #e7e9f2;
    border-radius: 18px;
    padding: 12px 12px 28px;
    overflow: hidden;
    position: relative;
    transition: transform .35s ease, box-shadow .35s ease, border-color .35s ease;
}

.feature-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 22px 50px rgba(35, 25, 90, .12);
    border-color: rgba(99, 91, 255, .18);
}

.feature-image-wrapper {
    position: relative;
    width: 100%;
    height: 185px;
    overflow: hidden;
    border-radius: 13px;
    margin-bottom: 28px;
}

.feature-image-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform .6s cubic-bezier(.2,.8,.2,1);
}

.feature-card:hover .feature-image-wrapper img {
    transform: scale(1.06);
}

.feature-icon {
    position: absolute;
    top: 165px;
    left: 28px;

    width: 52px;
    height: 52px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #efefff;
    border: 5px solid white;
    border-radius: 14px;

    color: #635bff;
    font-size: 1.25rem;

    box-shadow: 0 8px 20px rgba(20,20,60,.10);
    z-index: 2;
}

.feature-card h4 {
    font-weight: 800;
    font-size: 1.25rem;
    margin: 0 16px 12px;
    color: #101a45;
}

.feature-card p {
    color: #66708a;
    line-height: 1.7;
    margin: 0 16px;
    font-size: .94rem;
}

        
        /* =========================
           CTA
        ========================= */

        .cta {
    position: relative;

    min-height: 225px;

    display: flex;
    align-items: center;

    background:
        linear-gradient(
            90deg,
            rgba(52,24,150,.96),
            rgba(105,55,225,.78)
        ),
        url("https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1400");

    background-size: cover;
    background-position: center;

    border-radius: 20px;

    padding: 45px;

    color: white;

    overflow: hidden;

    box-shadow:
        0 18px 45px rgba(75,45,170,.18);
}

.cta::after {
    content: "";

    position: absolute;

    width: 450px;
    height: 450px;

    right: -180px;
    top: -150px;

    background: rgba(255,255,255,.12);

    border-radius: 50%;

    filter: blur(20px);

    animation: ctaGlow 5s ease-in-out infinite;
}

.cta h2 {
    font-weight: 800;

    font-size: 2rem;

    margin: 0;
}

.cta p {
    color: rgba(255,255,255,.82);

    max-width: 620px;
}

        /* =========================
           FOOTER
        ========================= */

        footer {
            background: #0b1120;
            color: white;
            padding: 55px 0 25px;
        }

        .footer-brand {
            font-weight: 800;
            font-size: 1.2rem;
        }

        .footer-text {
            color: #8d96a8;
            line-height: 1.7;
            max-width: 400px;
        }

        .footer-links a {
            color: #9ba4b5;
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
            transition: .2s;
        }

        .footer-links a:hover {
            color: white;
        }

        .copyright {
            border-top: 1px solid rgba(255,255,255,.08);
            margin-top: 35px;
            padding-top: 20px;
            color: #727c8e;
            font-size: .85rem;
        }

        /* =========================
           MOBILE
        ========================= */

        @media(max-width: 768px) {

            .hero {
                min-height: 620px;
                background-position: 60% center;
            }

            .hero h1 {
                letter-spacing: -1.5px;
            }

            .btn-outline-custom {
                margin-left: 0;
                margin-top: 10px;
            }

           .stat {
    border-right: none;

    border-bottom: 1px solid #e9ebf2;

    padding: 15px;

    justify-content: flex-start;
}

.stat:last-child {
    border-bottom: none;
}

.stats-wrapper {
    margin-top: 25px;
}

            .section {
                padding: 70px 0;
            }

            .cta {
                padding: 40px 25px;
            }
        }

        /* =========================================
   SCROLL REVEAL
========================================= */

.scroll-reveal {
    opacity: 0;
    transform: translateY(45px);
    transition:
        opacity .8s ease,
        transform .8s cubic-bezier(.2,.8,.2,1);
}

.scroll-reveal.visible {
    opacity: 1;
    transform: translateY(0);
}


/* Different directions */

.reveal-left {
    transform: translateX(-45px);
}

.reveal-right {
    transform: translateX(45px);
}

.reveal-left.visible,
.reveal-right.visible {
    transform: translateX(0);
}


/* Staggered cards */

.scroll-reveal:nth-child(1) {
    transition-delay: .05s;
}

.scroll-reveal:nth-child(2) {
    transition-delay: .15s;
}

.scroll-reveal:nth-child(3) {
    transition-delay: .25s;
}


/* Mobile */

@media (max-width: 768px) {

    .scroll-reveal,
    .reveal-left,
    .reveal-right {
        transform: translateY(25px);
    }

    .scroll-reveal.visible,
    .reveal-left.visible,
    .reveal-right.visible {
        transform: translateY(0);
    }

}
        /* =========================================
   CAMPUSHUB ANIMATIONS
========================================= */

/* Page entrance */
body {
    animation: pageEnter 0.7s ease both;
}

@keyframes pageEnter {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

/* Navbar */
.navbar {
    animation: navbarDrop 0.7s ease both;
}

@keyframes navbarDrop {
    from {
        opacity: 0;
        transform: translateY(-25px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Hero */
.hero-content {
    animation: heroReveal 1s cubic-bezier(.2,.8,.2,1) both;
}

@keyframes heroReveal {
    from {
        opacity: 0;
        transform: translateY(35px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Hero badge */
.hero-badge {
    animation: badgeReveal .8s ease .15s both;
}

@keyframes badgeReveal {
    from {
        opacity: 0;
        transform: translateY(-15px) scale(.95);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

/* Live indicator */
.live-dot {
    animation: livePulse 1.8s infinite;
}

@keyframes livePulse {
    0%, 100% {
        box-shadow: 0 0 0 0 rgba(72,224,138,.5);
    }

    50% {
        box-shadow: 0 0 0 7px rgba(72,224,138,0);
    }
}

/* Hero buttons */
.btn-primary-custom,
.btn-outline-custom {
    transition: all .3s ease;
}

.btn-primary-custom:hover,
.btn-outline-custom:hover {
    transform: translateY(-3px);
}

/* Stats */
.stats-wrapper {
    animation: statsReveal .9s ease .35s both;
}

@keyframes statsReveal {
    from {
        opacity: 0;
        transform: translateY(35px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Feature section */
.section-label {
    animation: fadeUp .7s ease both;
}

.section-title {
    animation: fadeUp .7s ease .1s both;
}

.section-description {
    animation: fadeUp .7s ease .2s both;
}

@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Feature cards */
.feature-card {
    transition:
        transform .35s ease,
        box-shadow .35s ease,
        border-color .35s ease;
}

.feature-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 22px 50px rgba(15,23,42,.13);
}

/* Feature icons */
.feature-icon {
    transition: transform .35s ease;
}

.feature-card:hover .feature-icon {
    transform: scale(1.1) rotate(-4deg);
}

/* CTA */
.cta {
    animation: ctaReveal .8s ease both;
}

@keyframes ctaReveal {
    from {
        opacity: 0;
        transform: translateY(30px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* CTA purple glow */
.cta::after {
    animation: ctaGlow 5s ease-in-out infinite;
}

@keyframes ctaGlow {
    0%, 100% {
        transform: scale(1);
    }

    50% {
        transform: scale(1.15);
    }
}

/* Footer */
footer {
    animation: footerReveal .8s ease both;
}

@keyframes footerReveal {
    from {
        opacity: 0;
    }

    to {
        opacity: 1;
    }
}

/* Better mobile behavior */
@media (max-width: 768px) {

    .hero-content {
        animation-name: mobileHero;
    }

    @keyframes mobileHero {
        from {
            opacity: 0;
            transform: translateY(25px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .feature-card:hover {
        transform: translateY(-5px);
    }
}

/* Accessibility */
@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        animation-duration: .01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: .01ms !important;
    }
}
/* =========================================
   HERO PREMIUM ANIMATION
========================================= */

/* Moving background glow */
.hero::before {
    content: "";
    position: absolute;
    width: 500px;
    height: 500px;
    left: -180px;
    top: 50%;
    border-radius: 50%;
    background: rgba(99, 91, 255, 0.18);
    filter: blur(90px);
    animation: heroGlow 7s ease-in-out infinite;
    pointer-events: none;
}

@keyframes heroGlow {
    0%, 100% {
        transform: translate(0, -50%) scale(1);
    }

    50% {
        transform: translate(80px, -45%) scale(1.15);
    }
}


/* Make hero content stay above glow */
.hero-content {
    position: relative;
    z-index: 2;
}


/* Heading animation */
.hero h1 {
    animation: titleReveal 1s cubic-bezier(.16,1,.3,1) .25s both;
}

@keyframes titleReveal {
    from {
        opacity: 0;
        transform: translateY(35px);
        filter: blur(6px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
        filter: blur(0);
    }
}


/* Description */
.hero p {
    animation: paragraphReveal .8s ease .45s both;
}

@keyframes paragraphReveal {
    from {
        opacity: 0;
        transform: translateY(20px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}


/* Buttons */
.hero-content > div:last-child {
    animation: buttonsReveal .8s ease .6s both;
}

@keyframes buttonsReveal {
    from {
        opacity: 0;
        transform: translateY(18px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}


/* Primary button glow */
.btn-primary-custom {
    position: relative;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(99, 91, 255, .25);
}

.btn-primary-custom::before {
    content: "";
    position: absolute;
    top: 0;
    left: -120%;
    width: 70%;
    height: 100%;
    background: linear-gradient(
        100deg,
        transparent,
        rgba(255,255,255,.25),
        transparent
    );
    transform: skewX(-20deg);
    transition: left .6s ease;
}

.btn-primary-custom:hover::before {
    left: 150%;
}


/* Outline button */
.btn-outline-custom {
    backdrop-filter: blur(8px);
}

.btn-outline-custom:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(255,255,255,.12);
}


/* Badge breathing effect */
.hero-badge {
    animation:
        badgeReveal .8s ease .15s both,
        badgeFloat 4s ease-in-out 1.2s infinite;
}

@keyframes badgeFloat {
    0%, 100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-4px);
    }
}


/* Mobile */
@media (max-width: 768px) {

    .hero::before {
        width: 350px;
        height: 350px;
        left: -180px;
    }

    .hero h1 {
        animation-name: mobileTitleReveal;
    }

    @keyframes mobileTitleReveal {
        from {
            opacity: 0;
            transform: translateY(25px);
            filter: blur(4px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
            filter: blur(0);
        }
    }
}
/* =========================================
   ANIMATED STAT COUNTERS
========================================= */

.counter {
    display: inline-block;
    min-width: 90px;
    transition: transform .3s ease;
}

.counter.counting {
    transform: scale(1.05);
}
/* =========================================
   CTA SCROLL ANIMATION
========================================= */

.cta.scroll-reveal {
    opacity: 0;
    transform: translateY(45px) scale(.98);
    transition:
        opacity .9s ease,
        transform .9s cubic-bezier(.2,.8,.2,1);
}

.cta.scroll-reveal.visible {
    opacity: 1;
    transform: translateY(0) scale(1);
}


/* CTA heading */
.cta.scroll-reveal h2 {
    transition: transform .6s ease;
}

.cta.scroll-reveal.visible h2 {
    transform: translateY(0);
}


/* CTA button */
.cta.scroll-reveal .btn-primary-custom {
    transition:
        transform .3s ease,
        box-shadow .3s ease;
}

.cta.scroll-reveal.visible .btn-primary-custom {
    animation: ctaButtonPop .7s ease .25s both;
}

@keyframes ctaButtonPop {

    from {
        opacity: 0;
        transform: translateY(15px) scale(.95);
    }

    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }

}
/* =========================================
   FEATURE CARD IMAGES
========================================= */

.feature-image {
    width: 100%;
    height: 190px;
    object-fit: cover;
    border-radius: 14px;
    margin-bottom: 24px;
    display: block;
    transition: transform .5s ease;
}

.feature-card {
    overflow: hidden;
}

.feature-card:hover .feature-image {
    transform: scale(1.05);
}

.feature-image-wrapper {
    overflow: hidden;
    border-radius: 14px;
    margin-bottom: 24px;
}

.feature-image-wrapper img {
    width: 100%;
    height: 190px;
    object-fit: cover;
    display: block;
    transition: transform .5s cubic-bezier(.2,.8,.2,1);
}

.feature-card:hover .feature-image-wrapper img {
    transform: scale(1.06);
}
/* =========================================
   MODERN HERO IMAGE
========================================= */

.hero-visual {
    position: relative;
    width: 100%;
    max-width: 560px;
    margin-left: auto;
    padding: 25px;
}

.hero-image-frame {
    position: relative;

    overflow: hidden;

    height: 400px;

    border-radius: 0 0 28px 28px;

    border: none;

    box-shadow: none;
}

.hero-image-frame::after {
    content: "";

    position: absolute;

    inset: 0;

    background:
        linear-gradient(
            90deg,
            rgba(255,255,255,.08),
            transparent 35%
        );

    pointer-events: none;
}

.hero-image-frame img {
    width: 100%;
    height: 100%;

    object-fit: cover;

    display: block;

    transition: transform 1s ease;
}

.hero-image-frame:hover img {
    transform: scale(1.03);
}

.hero-image-frame img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 1s ease;
}

.hero-image-frame:hover img {
    transform: scale(1.06);
}


/* Floating event card */

.hero-floating-card {
    position: absolute;
    left: -5px;
    bottom: 75px;
    display: flex;
    align-items: center;
    gap: 12px;
    background: rgba(255,255,255,.96);
    color: #172033;
    padding: 14px 18px;
    border-radius: 15px;
    box-shadow: 0 18px 45px rgba(0,0,0,.22);
    animation: floatingCard 4s ease-in-out infinite;
    z-index: 3;
}

.floating-icon {
    width: 42px;
    height: 42px;
    border-radius: 11px;
    background: #efefff;
    color: #635bff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}

.hero-floating-card strong,
.hero-student-card strong {
    display: block;
    font-size: .88rem;
}

.hero-floating-card span,
.hero-student-card span {
    display: block;
    color: #70798c;
    font-size: .72rem;
    margin-top: 2px;
}

@keyframes floatingCard {

    0%, 100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-9px);
    }

}


/* Student card */

.hero-student-card {
    position: absolute;
    right: -10px;
    top: 65px;
    display: flex;
    align-items: center;
    gap: 10px;
    background: rgba(255,255,255,.96);
    color: #172033;
    padding: 13px 17px;
    border-radius: 15px;
    box-shadow: 0 18px 45px rgba(0,0,0,.20);
    animation: studentCardFloat 4.5s ease-in-out infinite;
    z-index: 3;
}

.student-dot {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    background: #ecfdf3;
    color: #12b76a;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
}

/* Mobile */

@media (max-width: 991px) {

    .hero {
        padding: 70px 0;
    }

    .hero-visual {
        margin: 20px auto 0;
    }

}

@media (max-width: 576px) {

    .hero-image-frame {
        height: 380px;
    }

    .hero-floating-card {
        left: -5px;
        bottom: 45px;
    }

    .hero-student-card {
        right: -5px;
        top: 35px;
    }

}
/* =========================================
   HERO COMMUNITY
========================================= */

.hero-community {
    display: flex;
    align-items: center;

    gap: 12px;

    margin-top: 20px;
}

.avatar-group {
    display: flex;
    align-items: center;
}

.avatar-group span {
    width: 30px;
    height: 30px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #eeeaff;

    border: 2px solid white;

    border-radius: 50%;

    font-size: 14px;

    margin-left: -7px;
}

.avatar-group span:first-child {
    margin-left: 0;
}

.community-text strong {
    display: block;

    font-size: .82rem;

    color: #101a45;
}

.community-text small {
    display: block;

    font-size: .72rem;

    color: #70798c;

    margin-top: 2px;
}
.cta-buttons {
    display: flex;
    gap: 14px;
    flex-wrap: wrap;
}

.cta-primary {
    background: white;
    color: #635bff;

    padding: 12px 25px;

    border-radius: 11px;

    font-weight: 700;
}

.cta-primary:hover {
    background: #f7f7ff;
    color: #5149e6;

    transform: translateY(-3px);
}

.cta-secondary {
    color: white;

    border: 1px solid rgba(255,255,255,.55);

    padding: 12px 25px;

    border-radius: 11px;

    font-weight: 600;
}

.cta-secondary:hover {
    background: rgba(255,255,255,.12);
    color: white;

    transform: translateY(-3px);
}
    </style>
</head>

<body>
   

<!-- =========================
     NAVBAR
========================= -->

<nav class="navbar navbar-expand-lg navbar-dark">

    <div class="container">

        <a class="navbar-brand" href="index.php">
            <span class="brand-icon">🎓</span>
            CampusHub
        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto align-items-lg-center">

    <li class="nav-item">
        <a class="nav-link active" href="index.php">
            Home
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="students/events.php">
            Events
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="about.php">
            About
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="contact.php">
            Contact
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link nav-login" href="students/login.php">
            Login
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link nav-signup" href="students/register.php">
            Sign Up
        </a>
    </li>

</ul>

        </div>

    </div>

</nav>


<!-- =========================
     HERO
========================= -->

<section class="hero">

    <div class="container">

        <div class="row align-items-center g-5">

            <!-- LEFT SIDE -->
            <div class="col-lg-6">

                <div class="hero-content">

                    <div class="hero-badge">
                        <span class="live-dot"></span>
                        Your campus. Your events. One platform.
                    </div>

                    <h1>
                        Discover what's<br>
                        happening <span>on campus.</span>
                    </h1>

                    <p>
                        Explore college events, discover new experiences,
                        connect with your campus community and register
                        for events in just a few clicks.
                    </p>

                    <div class="hero-buttons">

                        <a href="students/register.php"
                           class="btn btn-primary-custom">
                            Get Started →
                        </a>

                        <a href="#features"
                           class="btn btn-outline-custom">
                            Explore Platform
                        </a>

                    </div>

                    <!-- COMMUNITY -->
                    <div class="hero-community">

                        <div class="avatar-group">

                            <span>👩🏻</span>
                            <span>👨🏽</span>
                            <span>👩🏾</span>
                            <span>👨🏻</span>
                            <span>👩🏻</span>

                        </div>

                        <div class="community-text">

                            <strong>
                                Join 1,000+ students
                            </strong>

                            <small>
                                Already exploring events
                            </small>

                        </div>

                    </div>

                </div>

            </div>


            <!-- RIGHT SIDE -->
            <div class="col-lg-6">

                <div class="hero-visual">

                    <div class="hero-image-frame">

                        <img
                            src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=1200"
                            alt="College students collaborating on campus">

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- =========================
     STATS
========================= -->

<div class="container stats-wrapper">

    <div class="stats-card">

        <div class="row">

            <div class="col-md-4 stat">

    <div class="stat-icon purple">
        📅
    </div>

    <div>
        <h3 class="counter" data-target="50">0+</h3>
        <p>Campus Events</p>
    </div>

</div>


<div class="col-md-4 stat">

    <div class="stat-icon green">
        👥
    </div>

    <div>
        <h3 class="counter" data-target="1000">0+</h3>
        <p>Student Registrations</p>
    </div>

</div>


<div class="col-md-4 stat">

    <div class="stat-icon blue">
        ◷
    </div>

    <div>
        <h3 class="counter" data-target="24">0/7</h3>
        <p>Online Access</p>
    </div>

</div>

    </div>

</div>


<!-- =========================
     FEATURES
========================= -->

<section class="section" id="features">

    <div class="container">

        <div class="text-center mb-5 scroll-reveal">

            <div class="section-label">
                Built for campus life
            </div>

            <h2 class="section-title">
                Everything you need to manage events
            </h2>

            <p class="section-description mx-auto">
                A centralized platform designed to simplify event
                discovery, registration and administration for
                modern educational institutions.
            </p>

        </div>


        <div class="row g-4">

            <div class="col-md-4 scroll-reveal">

    <div class="feature-card">

    <div class="feature-image-wrapper">

        <img
            src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=900"
            alt="College event">

    </div>

    <div class="feature-icon">
        📅
    </div>

    <h4>Event Management</h4>

    <p>
        Create, organize and manage academic, technical,
        cultural and extracurricular events from one
        centralized platform.
    </p>

</div>

            </div>


            <div class="col-md-4 scroll-reveal">

    <div class="feature-card">

        <div class="feature-image-wrapper">

            <img
                src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=900"
                alt="Students on campus">

        </div>

        <div class="feature-icon">
            🎓
        </div>

        <h4>Student Registration</h4>

        <p>
            Give students a simple and convenient way to
            discover events and register online without
            paperwork.
        </p>

    </div>

</div>


            <div class="col-md-4 scroll-reveal">

    <div class="feature-card">

        <div class="feature-image-wrapper">

            <img
                src="https://images.unsplash.com/photo-1556761175-b413da4baf72?w=900"
                alt="Team collaboration">

        </div>

        <div class="feature-icon">
            📊
        </div>

        <h4>Smart Administration</h4>

        <p>
            Administrators can manage events and monitor
            registrations through an organized dashboard.
        </p>

    </div>

</div>

        </div>

    </div>

</section>


<!-- =========================
     CTA
========================= -->

<section class="pb-5">

    <div class="container">

        <div class="cta scroll-reveal">

            <div class="position-relative" style="z-index:2;">

                <h2>
                    Ready to experience campus events differently?
                </h2>

                <p class="mt-3 mb-4">
                    Create your student account and start exploring
                    upcoming college events today.
                </p>

                <div class="cta-buttons">

    <a href="students/register.php"
       class="btn cta-primary">
        Get Started →
    </a>

    <a href="about.php"
       class="btn cta-secondary">
        Learn More
    </a>

</div>

            </div>

        </div>

    </div>

</section>


<!-- =========================
     FOOTER
========================= -->

<footer>

    <div class="container">

        <div class="row g-5">

            <div class="col-md-6">

                <div class="footer-brand mb-3">
                    🎓 CampusHub
                </div>

                <p class="footer-text">
                    A centralized college event management platform
                    designed to connect students with meaningful
                    campus experiences.
                </p>

            </div>


            <div class="col-md-3">

                <h6 class="mb-3">
                    Platform
                </h6>

                <div class="footer-links">

                    <a href="index.php">
                        Home
                    </a>

                    <a href="about.php">
                        About
                    </a>

                    <a href="contact.php">
                        Contact
                    </a>

                </div>

            </div>


            <div class="col-md-3">

                <h6 class="mb-3">
                    Access
                </h6>

                <div class="footer-links">

                    <a href="students/login.php">
                        Student Login
                    </a>

                    <a href="students/register.php">
                        Student Registration
                    </a>

                    <a href="admin/login.php">
                        Admin Login
                    </a>

                </div>

            </div>

        </div>


        <div class="copyright">

            © 2026 CampusHub. College Event Management System.

        </div>

    </div>

</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="js/animations.js"></script>

</body>

</html>