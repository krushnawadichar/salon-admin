<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pabelo · Book Appointment</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>

        /* =====================================================
           ROOT
        ===================================================== */

        :root {
            --cream: #f7f3ed;
            --cream-dark: #eee7dc;
            --brown: #4b382c;
            --brown-light: #765c49;
            --black: #171412;
            --white: #ffffff;
            --border: #ded4c7;
            --muted: #8d8278;
            --gold: #b18a5a;
        }


        /* =====================================================
           RESET
        ===================================================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            min-height: 100vh;

            font-family: 'DM Sans', sans-serif;

            background:
                radial-gradient(
                    circle at 10% 10%,
                    rgba(177, 138, 90, 0.12),
                    transparent 30%
                ),
                radial-gradient(
                    circle at 90% 90%,
                    rgba(75, 56, 44, 0.12),
                    transparent 30%
                ),
                var(--cream);

            color: var(--black);

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 40px 20px;

            overflow-x: hidden;
        }


        /* =====================================================
           BACKGROUND DECORATION
        ===================================================== */

        .background-circle {
            position: fixed;

            width: 420px;
            height: 420px;

            border-radius: 50%;

            background: rgba(177, 138, 90, 0.07);

            filter: blur(2px);

            pointer-events: none;

            z-index: 0;
        }

        .circle-one {
            top: -180px;
            left: -150px;
        }

        .circle-two {
            bottom: -200px;
            right: -160px;

            background: rgba(75, 56, 44, 0.07);
        }


        /* =====================================================
           MAIN CONTAINER
        ===================================================== */

        .booking-wrapper {
            position: relative;
            z-index: 2;

            width: 100%;
            max-width: 1050px;

            min-height: 620px;

            background: var(--white);

            border-radius: 30px;

            overflow: hidden;

            display: grid;
            grid-template-columns: 0.95fr 1.05fr;

            box-shadow:
                0 30px 80px rgba(75, 56, 44, 0.14);

            animation: wrapperAppear 0.8s ease forwards;
        }

        @keyframes wrapperAppear {
            from {
                opacity: 0;
                transform: translateY(25px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }


        /* =====================================================
           LEFT PANEL
        ===================================================== */

        .brand-panel {
            position: relative;

            padding: 55px;

            background:
                linear-gradient(
                    145deg,
                    rgba(75, 56, 44, 0.97),
                    rgba(42, 31, 25, 0.98)
                );

            color: var(--white);

            display: flex;
            flex-direction: column;
            justify-content: space-between;

            overflow: hidden;
        }

        .brand-panel::before {
            content: "";

            position: absolute;

            width: 320px;
            height: 320px;

            border-radius: 50%;

            border: 1px solid rgba(255,255,255,0.12);

            top: -100px;
            right: -130px;
        }

        .brand-panel::after {
            content: "";

            position: absolute;

            width: 250px;
            height: 250px;

            border-radius: 50%;

            border: 1px solid rgba(255,255,255,0.08);

            bottom: -120px;
            left: -100px;
        }


        /* =====================================================
           BRAND
        ===================================================== */

        .brand {
            position: relative;
            z-index: 2;

            display: flex;
            align-items: center;

            gap: 12px;
        }

        .brand-icon {
            width: 44px;
            height: 44px;

            border-radius: 13px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: rgba(255,255,255,0.12);

            border: 1px solid rgba(255,255,255,0.15);

            font-size: 20px;
        }

        .brand-name {
            font-family: 'Playfair Display', serif;

            font-size: 26px;

            letter-spacing: 1px;
        }


        /* =====================================================
           LEFT CONTENT
        ===================================================== */

        .brand-content {
            position: relative;
            z-index: 2;

            margin-top: 50px;
        }

        .small-heading {
            color: #d9c8b5;

            font-size: 12px;

            text-transform: uppercase;

            letter-spacing: 3px;

            margin-bottom: 18px;
        }

        .brand-content h1 {
            font-family: 'Playfair Display', serif;

            font-size: clamp(42px, 5vw, 65px);

            line-height: 1.05;

            font-weight: 600;

            margin-bottom: 25px;
        }

        .brand-content h1 span {
            color: #d0a66e;
        }

        .brand-description {
            max-width: 370px;

            color: rgba(255,255,255,0.67);

            font-size: 15px;

            line-height: 1.8;
        }


        /* =====================================================
           FEATURES
        ===================================================== */

        .features {
            position: relative;
            z-index: 2;

            margin-top: 35px;
        }

        .feature {
            display: flex;
            align-items: center;

            gap: 13px;

            margin-bottom: 15px;

            color: rgba(255,255,255,0.78);

            font-size: 13px;
        }

        .feature-icon {
            width: 32px;
            height: 32px;

            border-radius: 10px;

            background: rgba(255,255,255,0.09);

            display: flex;
            align-items: center;
            justify-content: center;

            color: #d5ad79;
        }


        /* =====================================================
           LEFT FOOTER
        ===================================================== */

        .brand-footer {
            position: relative;
            z-index: 2;

            padding-top: 30px;

            border-top: 1px solid rgba(255,255,255,0.12);

            color: rgba(255,255,255,0.45);

            font-size: 12px;

            display: flex;
            align-items: center;

            gap: 7px;
        }

        .brand-footer i {
            color: #d0a66e;
        }


        /* =====================================================
           FORM PANEL
        ===================================================== */

        .form-panel {
            padding: 55px 60px;

            display: flex;
            flex-direction: column;
            justify-content: center;
        }


        /* =====================================================
           FORM HEADER
        ===================================================== */

        .form-header {
            margin-bottom: 35px;
        }

        .form-header .eyebrow {
            display: inline-flex;
            align-items: center;

            gap: 7px;

            color: var(--gold);

            font-size: 11px;

            font-weight: 700;

            letter-spacing: 2px;

            text-transform: uppercase;

            margin-bottom: 10px;
        }

        .form-header h2 {
            font-family: 'Playfair Display', serif;

            font-size: 38px;

            color: var(--brown);

            margin-bottom: 8px;
        }

        .form-header p {
            color: var(--muted);

            font-size: 14px;

            line-height: 1.6;
        }


        /* =====================================================
           FORM GROUP
        ===================================================== */

        .form-group {
            margin-bottom: 23px;
        }

        .form-label {
            display: block;

            color: var(--brown);

            font-size: 13px;

            font-weight: 700;

            margin-bottom: 9px;
        }

        .input-container {
            position: relative;
        }

        .input-icon {
            position: absolute;

            left: 17px;
            top: 50%;

            transform: translateY(-50%);

            color: var(--brown-light);

            font-size: 17px;

            z-index: 2;

            transition: 0.3s ease;
        }

        .form-control {
            width: 100%;

            height: 58px;

            border-radius: 14px;

            border: 1px solid var(--border);

            background: #faf9f7;

            padding: 0 18px 0 48px;

            color: var(--black);

            font-size: 14px;

            font-weight: 500;

            outline: none;

            transition:
                border-color 0.25s ease,
                box-shadow 0.25s ease,
                background 0.25s ease,
                transform 0.25s ease;
        }

        .form-control::placeholder {
            color: #aaa19a;

            font-weight: 400;
        }

        .form-control:hover {
            border-color: #c7b8a7;
        }

        .form-control:focus {
            background: var(--white);

            border-color: var(--brown);

            box-shadow:
                0 0 0 4px rgba(75, 56, 44, 0.08);

            transform: translateY(-1px);
        }

        .input-container:focus-within .input-icon {
            color: var(--gold);

            transform:
                translateY(-50%)
                scale(1.08);
        }


        /* =====================================================
           ERROR
        ===================================================== */

        .error-text {
            display: flex;
            align-items: center;

            gap: 6px;

            margin-top: 8px;

            padding-left: 4px;

            color: #c04d4d;

            font-size: 12px;

            font-weight: 600;
        }


        /* =====================================================
           BOOK BUTTON
        ===================================================== */

        .btn-book {
            width: 100%;

            height: 58px;

            border: none;

            border-radius: 14px;

            background: var(--brown);

            color: var(--white);

            font-family: 'DM Sans', sans-serif;

            font-size: 14px;

            font-weight: 700;

            letter-spacing: 0.4px;

            display: flex;
            align-items: center;
            justify-content: center;

            gap: 10px;

            cursor: pointer;

            margin-top: 8px;

            box-shadow:
                0 12px 25px rgba(75, 56, 44, 0.2);

            transition:
                transform 0.25s ease,
                background 0.25s ease,
                box-shadow 0.25s ease;
        }

        .btn-book i {
            font-size: 18px;

            transition: transform 0.25s ease;
        }

        .btn-book:hover {
            background: #2f211a;

            transform: translateY(-3px);

            box-shadow:
                0 18px 32px rgba(75, 56, 44, 0.25);
        }

        .btn-book:hover i {
            transform: translateX(4px);
        }

        .btn-book:active {
            transform: translateY(0);
        }


        /* =====================================================
           FORM NOTE
        ===================================================== */

        .privacy-note {
            margin-top: 18px;

            text-align: center;

            color: #aaa19a;

            font-size: 11px;

            line-height: 1.5;
        }

        .privacy-note i {
            color: var(--gold);

            margin-right: 4px;
        }


        /* =====================================================
           DIVIDER
        ===================================================== */

        .form-divider {
            display: flex;

            align-items: center;

            gap: 12px;

            margin: 28px 0 0;

            color: #b4aaa1;

            font-size: 10px;

            text-transform: uppercase;

            letter-spacing: 1.5px;
        }

        .form-divider::before,
        .form-divider::after {
            content: "";

            height: 1px;

            flex: 1;

            background: #e8e1d9;
        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 900px) {

            .booking-wrapper {
                max-width: 650px;

                grid-template-columns: 1fr;
            }

            .brand-panel {
                min-height: 400px;

                padding: 40px;
            }

            .brand-content {
                margin-top: 35px;
            }

            .brand-content h1 {
                font-size: 48px;
            }

            .features {
                display: flex;

                gap: 20px;

                flex-wrap: wrap;
            }

            .feature {
                margin-bottom: 0;
            }

            .brand-footer {
                margin-top: 30px;
            }

            .form-panel {
                padding: 45px;
            }
        }


        @media (max-width: 576px) {

            body {
                padding: 15px;
            }

            .booking-wrapper {
                border-radius: 22px;
            }

            .brand-panel {
                min-height: auto;

                padding: 32px 26px;
            }

            .brand-content {
                margin-top: 35px;
            }

            .brand-content h1 {
                font-size: 42px;
            }

            .brand-description {
                font-size: 13px;
            }

            .features {
                display: block;
            }

            .feature {
                margin-bottom: 12px;
            }

            .brand-footer {
                margin-top: 25px;
            }

            .form-panel {
                padding: 35px 25px 40px;
            }

            .form-header {
                margin-bottom: 28px;
            }

            .form-header h2 {
                font-size: 32px;
            }

            .form-control,
            .btn-book {
                height: 55px;
            }
        }


        @media (max-width: 380px) {

            .brand-panel {
                padding: 28px 20px;
            }

            .form-panel {
                padding: 30px 20px 35px;
            }

            .brand-content h1 {
                font-size: 37px;
            }

            .form-header h2 {
                font-size: 29px;
            }
        }


        /* =====================================================
           REDUCED MOTION
        ===================================================== */

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* =====================================================
   MOBILE — FORM ONLY
===================================================== */

@media (max-width: 576px) {

    body {
        padding: 0;
        background: #f7f3ed;
        align-items: flex-start;
    }

    .background-circle {
        display: none;
    }

    .booking-wrapper {
        width: 100%;
        min-height: 100vh;

        display: block;

        border-radius: 0;

        box-shadow: none;

        background: #ffffff;
    }

    /* Hide complete left/brand section */
    .brand-panel {
        display: none;
    }

    /* Show only appointment section */
    .form-panel {
        min-height: 100vh;

        padding: 45px 24px;

        justify-content: flex-start;

        background: #ffffff;
    }

    .form-header {
        margin-top: 20px;
        margin-bottom: 35px;
    }

    .form-header .eyebrow {
        font-size: 10px;
        letter-spacing: 2px;
    }

    .form-header h2 {
        font-size: 34px;
        line-height: 1.15;
    }

    .form-header p {
        font-size: 14px;
        line-height: 1.7;
    }

    .form-control {
        height: 58px;
    }

    .btn-book {
        height: 58px;
    }
}


    </style>

</head>


<body>

    <!-- Background Decoration -->
    <div class="background-circle circle-one"></div>
    <div class="background-circle circle-two"></div>


    <!-- =====================================================
         MAIN BOOKING CARD
    ===================================================== -->

    <main class="booking-wrapper">


        <!-- =================================================
             LEFT BRAND PANEL
        ================================================= -->

        <section class="brand-panel">

            <!-- BRAND -->
            <div>

                <div class="brand">

                    <div class="brand-icon">
                        <i class="bi bi-scissors"></i>
                    </div>

                    <div class="brand-name">
                        Pabelo
                    </div>

                </div>


                <!-- CONTENT -->

                <div class="brand-content">

                    <div class="small-heading">
                        Personal Care · Style · Confidence
                    </div>

                    <h1>
                        Your style,
                        <span>your moment.</span>
                    </h1>

                    <p class="brand-description">
                        Take a moment for yourself. Choose your preferred
                        appointment and let our professionals take care
                        of the rest.
                    </p>


                    <!-- FEATURES -->

                    <div class="features">

                        <div class="feature">

                            <div class="feature-icon">
                                <i class="bi bi-stars"></i>
                            </div>

                            <span>
                                Premium experience
                            </span>

                        </div>


                        <div class="feature">

                            <div class="feature-icon">
                                <i class="bi bi-clock-history"></i>
                            </div>

                            <span>
                                Respect for your time
                            </span>

                        </div>


                        <div class="feature">

                            <div class="feature-icon">
                                <i class="bi bi-heart"></i>
                            </div>

                            <span>
                                Care that feels personal
                            </span>

                        </div>

                    </div>

                </div>

            </div>


            <!-- FOOTER -->

            <div class="brand-footer">

                <i class="bi bi-shield-check"></i>

                <span>
                    Your information is kept private and secure.
                </span>

            </div>

        </section>



        <!-- =================================================
             RIGHT FORM PANEL
        ================================================= -->

        <section class="form-panel">


            <!-- FORM HEADER -->

            <div class="form-header">

                <div class="eyebrow">

                    <i class="bi bi-calendar2-heart"></i>

                    Appointment

                </div>

                <h2>
                    Let's book your visit.
                </h2>

                <p>
                    Enter your details below and we'll take care
                    of your appointment.
                </p>

            </div>



            <!-- =================================================
                 APPOINTMENT FORM
            ================================================= -->

            <form
                action="{{ route('appointment.store') }}"
                method="POST"
                id="appointmentForm"
            >

                @csrf


                <!-- NAME -->

                <div class="form-group">

                    <label
                        for="name"
                        class="form-label"
                    >
                        Full Name
                    </label>

                    <div class="input-container">

                        <i class="bi bi-person input-icon"></i>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control"
                            placeholder="Enter your full name"
                            value="{{ old('name') }}"
                            autocomplete="name"
                            required
                        >

                    </div>

                    @error('name')

                        <div class="error-text">

                            <i class="bi bi-exclamation-circle-fill"></i>

                            {{ $message }}

                        </div>

                    @enderror

                </div>



                <!-- PHONE -->

                <div class="form-group">

                    <label
                        for="phone"
                        class="form-label"
                    >
                        Mobile Number
                    </label>

                    <div class="input-container">

                        <i class="bi bi-phone input-icon"></i>

                        <input
                            type="tel"
                            id="phone"
                            name="phone"
                            class="form-control"
                            placeholder="Enter your mobile number"
                            value="{{ old('phone') }}"
                            autocomplete="tel"
                            required
                        >

                    </div>

                    @error('phone')

                        <div class="error-text">

                            <i class="bi bi-exclamation-circle-fill"></i>

                            {{ $message }}

                        </div>

                    @enderror

                </div>



                <!-- BUTTON -->

                <button
                    type="submit"
                    class="btn-book"
                    id="bookButton"
                >

                    <span>
                        Book My Appointment
                    </span>

                    <i class="bi bi-arrow-right"></i>

                </button>


            </form>


            <!-- DIVIDER -->

            <div class="form-divider">
                Pabelo
            </div>


            <!-- PRIVACY -->

            <div class="privacy-note">

                <i class="bi bi-lock-fill"></i>

                Your details are used only for appointment purposes.

            </div>


        </section>

    </main>



    <!-- =====================================================
         SWEETALERT SUCCESS
    ===================================================== -->

    @if(session('success'))

        <script>

            document.addEventListener('DOMContentLoaded', function () {

                Swal.fire({

                    icon: 'success',

                    title: 'Appointment Confirmed',

                    text: @json(session('success')),

                    confirmButtonText: 'Perfect!',

                    confirmButtonColor: '#4b382c',

                    background: '#ffffff',

                    color: '#171412',

                    backdrop: 'rgba(23, 20, 18, 0.70)',

                    customClass: {

                        popup: 'pabelo-alert'

                    }

                });

            });

        </script>

    @endif



    <!-- =====================================================
         SWEETALERT ERRORS
    ===================================================== -->

    @if ($errors->any())

        <script>

            document.addEventListener('DOMContentLoaded', function () {

                Swal.fire({

                    icon: 'error',

                    title: 'Please check your details',

                    text: @json($errors->first()),

                    confirmButtonText: 'Try Again',

                    confirmButtonColor: '#4b382c',

                    background: '#ffffff',

                    color: '#171412',

                    backdrop: 'rgba(23, 20, 18, 0.70)'

                });

            });

        </script>

    @endif



    <!-- =====================================================
         FORM SUBMIT ANIMATION
    ===================================================== -->

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const form = document.getElementById('appointmentForm');

            const button = document.getElementById('bookButton');

            if (!form || !button) {
                return;
            }

            form.addEventListener('submit', function () {

                if (!form.checkValidity()) {
                    return;
                }

                button.disabled = true;

                button.innerHTML = `
                    <span>Booking...</span>
                    <i class="bi bi-arrow-repeat"></i>
                `;

                button.style.opacity = '0.8';

            });

        });

    </script>



    <!-- Bootstrap JS -->

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>
