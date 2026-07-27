<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pabelo · Appointment</title>
  <!-- Bootstrap 5 + Icons + SweetAlert2 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    /* ----- reset / base ----- */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
      background: radial-gradient(circle at 20% 30%, #f9b8d4, #c77dff, #6a11cb, #2575fc);
      background-size: 300% 300%;
      animation: gradientFlow 14s ease-in-out infinite alternate;
      padding: 1.5rem;
      margin: 0;
    }

    @keyframes gradientFlow {
      0% { background-position: 0% 0%; }
      50% { background-position: 70% 40%; }
      100% { background-position: 20% 80%; }
    }

    /* ----- main card • glassmorphism + float ----- */
    .appointment-card {
      width: 100%;
      max-width: 520px;
      border: none;
      border-radius: 48px;
      background: rgba(255, 255, 255, 0.12);
      backdrop-filter: blur(18px) saturate(180%);
      -webkit-backdrop-filter: blur(18px) saturate(180%);
      box-shadow: 0 30px 60px rgba(0, 0, 0, 0.35), 0 0 0 1px rgba(255, 255, 255, 0.08) inset;
      padding: 0.2rem;
      transition: transform 0.4s cubic-bezier(0.2, 0.9, 0.3, 1.1);
      animation: cardFloat 5s ease-in-out infinite;
    }

    @keyframes cardFloat {
      0%, 100% { transform: translateY(0px) scale(1); }
      50% { transform: translateY(-14px) scale(1.01); }
    }

    .appointment-card:hover {
      animation-play-state: paused;
      transform: scale(1.01) translateY(-8px);
      box-shadow: 0 40px 80px rgba(0, 0, 0, 0.5);
    }

    /* header */
    .card-header {
      background: transparent;
      border: none;
      text-align: center;
      padding: 2rem 1.5rem 0.5rem 1.5rem;
    }

    .icon-wrapper {
      width: 90px;
      height: 90px;
      background: rgba(255, 255, 255, 0.18);
      backdrop-filter: blur(4px);
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0 auto 16px;
      font-size: 44px;
      color: #fff;
      box-shadow: 0 12px 28px rgba(0, 0, 0, 0.2);
      transition: 0.3s;
    }

    .icon-wrapper i {
      filter: drop-shadow(0 4px 8px rgba(0,0,0,0.1));
    }

    .card-header h2 {
      color: #fff;
      font-weight: 700;
      font-size: 2.1rem;
      letter-spacing: -0.5px;
      text-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
      margin-bottom: 4px;
    }

    .card-header .subhead {
      color: rgba(255, 255, 255, 0.85);
      font-weight: 300;
      letter-spacing: 0.5px;
      font-size: 0.95rem;
      border-top: 1px solid rgba(255,255,255,0.2);
      display: inline-block;
      padding-top: 6px;
    }

    /* body */
    .card-body {
      padding: 2rem 2rem 2.2rem 2rem;
    }

    .form-label {
      color: rgba(255, 255, 255, 0.95);
      font-weight: 600;
      font-size: 0.95rem;
      letter-spacing: 0.4px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .form-label i {
      font-size: 1.2rem;
      opacity: 0.8;
    }

    .input-group-custom {
      position: relative;
    }

    .form-control {
      border-radius: 40px;
      padding: 16px 22px;
      border: none;
      background: rgba(255, 255, 255, 0.85);
      backdrop-filter: blur(4px);
      font-weight: 500;
      color: #1e1e2f;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
      transition: all 0.3s ease;
    }

    .form-control:focus {
      transform: scale(1.02);
      background: rgba(255, 255, 255, 0.98);
      box-shadow: 0 0 0 5px rgba(255, 255, 255, 0.35), 0 8px 28px rgba(106, 17, 203, 0.2);
      outline: none;
    }

    .form-control::placeholder {
      color: #6b6b80;
      font-weight: 300;
      opacity: 0.7;
    }

    /* error text */
    .error-text {
      color: #ffe2e2;
      font-weight: 500;
      font-size: 0.85rem;
      margin-top: 6px;
      padding-left: 18px;
      display: flex;
      align-items: center;
      gap: 6px;
      text-shadow: 0 2px 6px rgba(0,0,0,0.2);
    }

    .error-text i {
      font-size: 1rem;
    }

    /* button */
    .btn-book {
      border: none;
      border-radius: 60px;
      padding: 18px 24px;
      background: #fff;
      color: #4a2c7c;
      font-weight: 700;
      font-size: 1.15rem;
      letter-spacing: 0.8px;
      transition: all 0.35s cubic-bezier(0.2, 0.9, 0.3, 1.2);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
      margin-top: 12px;
    }

    .btn-book i {
      font-size: 1.4rem;
      transition: 0.3s;
    }

    .btn-book:hover {
      transform: translateY(-5px) scale(1.02);
      background: #ffffff;
      color: #6a11cb;
      box-shadow: 0 20px 40px rgba(255, 255, 255, 0.45), 0 0 0 2px rgba(255, 255, 255, 0.3);
    }

    .btn-book:active {
      transform: scale(0.97);
    }

    /* extra decorative details */
    .card-footer {
      background: transparent;
      border: none;
      text-align: center;
      color: rgba(255,255,255,0.5);
      font-size: 0.75rem;
      padding: 0 0 1.2rem 0;
      letter-spacing: 1px;
    }

    /* small screens */
    @media (max-width: 480px) {
      .card-body {
        padding: 1.5rem;
      }
      .card-header h2 {
        font-size: 1.8rem;
      }
      .icon-wrapper {
        width: 70px;
        height: 70px;
        font-size: 34px;
      }
    }

    /* ----- sparkle / glass shine (extra flair) ----- */
    .appointment-card::before {
      content: '';
      position: absolute;
      top: -12%;
      left: -10%;
      width: 40%;
      height: 40%;
      background: radial-gradient(circle, rgba(255,255,255,0.25) 0%, transparent 70%);
      border-radius: 50%;
      pointer-events: none;
      filter: blur(20px);
      opacity: 0.5;
    }

    .appointment-card {
      position: relative;
      overflow: hidden;
    }

    .appointment-card::after {
      content: '';
      position: absolute;
      bottom: -10%;
      right: -10%;
      width: 50%;
      height: 50%;
      background: radial-gradient(circle, rgba(255,215,245,0.15) 0%, transparent 70%);
      border-radius: 50%;
      pointer-events: none;
      filter: blur(30px);
    }

    /* custom scroll */
    ::-webkit-scrollbar {
      width: 0;
    }
  </style>
</head>
<body>

<div class="appointment-card">
  <div class="card-header">
    <div class="icon-wrapper">
      <i class="bi bi-scissors"></i>
    </div>
    <h2>Pabelo</h2>
    <span class="subhead"><i class="bi bi-clock me-1"></i> book your moment</span>
  </div>

  <div class="card-body">
    <form action="{{ route('appointment.store') }}" method="POST" id="appointmentForm">
      @csrf

      <!-- Name -->
      <div class="mb-4">
        <label class="form-label">
          <i class="bi bi-person-circle"></i> Your Name
        </label>
        <div class="input-group-custom">
          <input type="text"
                 name="name"
                 class="form-control"
                 placeholder="e.g. Emma Watson"
                 value="{{ old('name') }}"
                 required>
        </div>
        @error('name')
          <div class="error-text">
            <i class="bi bi-exclamation-triangle-fill"></i> {{ $message }}
          </div>
        @enderror
      </div>

      <!-- Phone -->
      <div class="mb-4">
        <label class="form-label">
          <i class="bi bi-phone"></i> Mobile Number
        </label>
        <div class="input-group-custom">
          <input type="text"
                 name="phone"
                 class="form-control"
                 placeholder="+1 234 567 890"
                 value="{{ old('phone') }}"
                 required>
        </div>
        @error('phone')
          <div class="error-text">
            <i class="bi bi-exclamation-triangle-fill"></i> {{ $message }}
          </div>
        @enderror
      </div>

      <button type="submit" class="btn-book w-100">
        <i class="bi bi-calendar-check"></i> Book Appointment
      </button>
    </form>

    <!-- extra decor: tiny note -->
    <div class="mt-3 text-center" style="color: rgba(255,255,255,0.5); font-size: 0.8rem; letter-spacing: 0.3px;">
      <i class="bi bi-droplet me-1"></i> we respect your time
    </div>
  </div>
</div>

<!-- ========== SWEETALERT NOTIFICATIONS ========== -->
@if(session('success'))
<script>
  (function() {
    Swal.fire({
      icon: 'success',
      title: '✨ Appointment Booked!',
      text: '{{ session('success') }}',
      confirmButtonColor: '#6a11cb',
      confirmButtonText: 'Perfect!',
      background: 'rgba(255,255,255,0.92)',
      backdrop: 'rgba(0,0,0,0.3)',
      showClass: {
        popup: 'animate__animated animate__fadeInUp'
      },
      hideClass: {
        popup: 'animate__animated animate__fadeOutDown'
      }
    });
  })();
</script>
@endif

@if ($errors->any())
<script>
  (function() {
    // collect first error message
    let firstError = '{{ $errors->first() }}';
    Swal.fire({
      icon: 'error',
      title: 'Oops!',
      text: firstError || 'Please check your details.',
      confirmButtonColor: '#d33',
      confirmButtonText: 'Try again',
      background: 'rgba(255,255,255,0.92)',
      backdrop: 'rgba(0,0,0,0.3)',
    });
  })();
</script>
@endif

<!-- (optional) extra smoothness for floating labels -->
<script>
  (function() {
    // enhance placeholder animation: remove "required" visual redundancy
    const inputs = document.querySelectorAll('.form-control');
    inputs.forEach(inp => {
      inp.addEventListener('focus', function() {
        this.closest('.input-group-custom')?.classList.add('focused');
      });
      inp.addEventListener('blur', function() {
        this.closest('.input-group-custom')?.classList.remove('focused');
      });
    });
  })();
</script>

<!-- Bootstrap JS (optional for any toggles, but not strictly needed) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>