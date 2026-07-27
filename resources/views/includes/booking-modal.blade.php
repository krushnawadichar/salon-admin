<!-- ===== BOOKING MODAL ===== -->
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    html { scroll-behavior: smooth; }
    body {
      background: #050505;
      color: #e5e2e1;
      font-family: 'Hanken Grotesk', sans-serif;
      overflow-x: hidden;
    }
    .glass {
      background: rgba(18, 18, 18, 0.6);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border: 1px solid rgba(255,255,255,0.06);
    }
    .glass-card {
      background: rgba(18, 18, 18, 0.65);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border: 1px solid rgba(255,255,255,0.06);
    }
    .gold-border-hover { transition: all 0.3s ease; }
    .gold-border-hover:hover {
      border-color: #D4AF37;
      box-shadow: inset 0 0 20px rgba(212, 175, 55, 0.08);
    }
    @keyframes scroll-logos {
      0% { transform: translateX(0); }
      100% { transform: translateX(-50%); }
    }
    .animate-scroll {
      animation: scroll-logos 40s linear infinite;
    }
    .animate-scroll:hover { animation-play-state: paused; }
    @keyframes heroFade {
      0% { opacity: 0; transform: scale(1.02); }
      12% { opacity: 1; transform: scale(1); }
      33% { opacity: 1; transform: scale(1); }
      45% { opacity: 0; transform: scale(1.02); }
      100% { opacity: 0; }
    }
    .hero-slide {
      animation: heroFade 12s infinite;
      position: absolute;
      inset: 0;
    }
    .hero-slide:nth-child(1) { animation-delay: 0s; }
    .hero-slide:nth-child(2) { animation-delay: 4s; }
    .hero-slide:nth-child(3) { animation-delay: 8s; }
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    .pb-safe { padding-bottom: env(safe-area-inset-bottom, 0.5rem); }
    @media (max-width: 768px) {
      .hero-title { font-size: 2.6rem; line-height: 1.1; }
      .hero-sub { font-size: 1rem; }
    }

    /* modal overlay */
    .modal-overlay {
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.7);
      backdrop-filter: blur(8px);
      z-index: 999;
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.3s ease;
    }
    .modal-overlay.active {
      opacity: 1;
      pointer-events: auto;
    }
    .modal-box {
      max-width: 420px;
      width: 92%;
      background: #121212;
      border-radius: 32px;
      padding: 2rem 1.8rem;
      border: 1px solid rgba(212, 175, 55, 0.25);
      box-shadow: 0 30px 60px rgba(0,0,0,0.8);
      transform: scale(0.95) translateY(12px);
      transition: transform 0.3s ease;
    }
    .modal-overlay.active .modal-box {
      transform: scale(1) translateY(0);
    }
    .modal-box input, .modal-box textarea {
      width: 100%;
      padding: 14px 18px;
      border-radius: 60px;
      border: 1px solid rgba(255,255,255,0.08);
      background: #1e1e1e;
      color: #fff;
      font-size: 1rem;
      outline: none;
      transition: border 0.2s;
    }
    .modal-box input:focus, .modal-box textarea:focus {
      border-color: #EC008C;
      box-shadow: 0 0 0 3px rgba(236,0,140,0.15);
    }
    .modal-box input::placeholder, .modal-box textarea::placeholder { color: #777; }
    .modal-box .btn-primary {
      background: #EC008C;
      color: #fff;
      padding: 14px;
      border-radius: 60px;
      font-weight: 700;
      font-size: 0.9rem;
      letter-spacing: 0.05em;
      border: none;
      width: 100%;
      cursor: pointer;
      transition: all 0.2s;
    }
    .modal-box .btn-primary:hover { filter: brightness(1.1); }
    .modal-box .btn-secondary {
      background: transparent;
      border: 1px solid rgba(255,255,255,0.15);
      color: #aaa;
      padding: 12px;
      border-radius: 60px;
      font-weight: 500;
      font-size: 0.9rem;
      width: 100%;
      cursor: pointer;
      transition: 0.2s;
    }
    .modal-box .btn-secondary:hover { background: rgba(255,255,255,0.04); }

    /* footer form */
    .footer-form input, .footer-form textarea {
      width: 100%;
      padding: 12px 16px;
      border-radius: 40px;
      border: 1px solid rgba(255,255,255,0.06);
      background: #111;
      color: #fff;
      font-size: 0.9rem;
      outline: none;
      transition: 0.2s;
    }
    .footer-form input:focus, .footer-form textarea:focus {
      border-color: #D4AF37;
      box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
    }
    .footer-form textarea { border-radius: 24px; resize: vertical; min-height: 90px; }
    .footer-form button {
      background: #D4AF37;
      color: #111;
      padding: 12px 28px;
      border-radius: 60px;
      font-weight: 700;
      font-size: 0.8rem;
      letter-spacing: 0.05em;
      border: none;
      cursor: pointer;
      transition: 0.2s;
    }
    .footer-form button:hover { filter: brightness(1.1); }
  </style>
<div id="bookingModal" class="modal-overlay">
  <div class="modal-box">
    <div class="flex justify-between items-center mb-5">
      <h3 class="text-2xl font-['Playfair_Display'] text-white">Book Now</h3>
      <button id="closeModalBtn" class="text-white/40 hover:text-white transition text-2xl leading-none">&times;</button>
    </div>
    <form action="{{ route('website.booking.store') }}" method="POST" id="bookingForm" class="space-y-5">
        @csrf
      <div>
        <label class="text-xs uppercase tracking-wider text-[#a98892] block mb-1.5">Full Name</label>
        <input type="text"  name="name" placeholder="Your name" required />
      </div>
      <div>
        <label class="text-xs uppercase tracking-wider text-[#a98892] block mb-1.5">Phone Number</label>
        <input type="tel"  name="phone" placeholder="+91 98765 43210" required />
      </div>
      <div>
        <label class="text-xs uppercase tracking-wider text-[#a98892] block mb-1.5">Description (optional)</label>
        <textarea  name="description" placeholder="Describe your skin, hair, and lifestyle" class="resize-none" rows="2"></textarea>
      <div class="flex flex-col gap-3 pt-2">
        <button type="submit" class="btn-primary">Book Appointment</button>
        <button type="button" id="closeModalBtn2" class="btn-secondary">Cancel</button>
      </div>
      <p class="text-[10px] text-[#666] text-center mt-2">We'll confirm within 2 hours</p>
    </form>
  </div>
</div>

<!-- ===== SCRIPT ===== -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  (function() {
    const modal = document.getElementById('bookingModal');
    const openBtns = [
      document.getElementById('bookNowBtn'),
      document.getElementById('heroBookBtn')
    ];
    const closeBtns = [
      document.getElementById('closeModalBtn'),
      document.getElementById('closeModalBtn2')
    ];

    function openModal(e) {
      e.preventDefault();
      modal.classList.add('active');
      document.body.style.overflow = 'hidden';
    }
    function closeModal(e) {
      if (e) e.preventDefault();
      modal.classList.remove('active');
      document.body.style.overflow = '';
    }

    openBtns.forEach(btn => { if (btn) btn.addEventListener('click', openModal); });
    closeBtns.forEach(btn => { if (btn) btn.addEventListener('click', closeModal); });

    modal.addEventListener('click', function(e) {
      if (e.target === modal) closeModal(e);
    });

    // document.getElementById('bookingForm').addEventListener('submit', function(e) {
    //   e.preventDefault();
    //   alert('✅ Your booking request has been received! We will get back to you shortly.');
    //   closeModal(e);
    //   this.reset();
    // });

    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && modal.classList.contains('active')) closeModal(e);
    });

    // smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(a => {
      a.addEventListener('click', function(e) {
        const href = this.getAttribute('href');
        if (href === '#') return;
        e.preventDefault();
        const target = document.querySelector(href);
        if (target) target.scrollIntoView({ behavior: 'smooth' });
      });
    });

    // footer form demo
    document.querySelector('.footer-form')?.addEventListener('submit', function(e) {
      e.preventDefault();
      alert('✨ Thank you! We\'ll reach out soon.');
      this.reset();
    });
  })();
</script>
@if(session('success'))
<script>
document.addEventListener('DOMContentLoaded', function () {

    Swal.fire({
        icon: 'success',
        title: 'Booking Successful!',
        text: '{{ session("success") }}',
        confirmButtonColor: '#EC008C',
        timer: 10000,
        timerProgressBar: true,
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false
    });

});
</script>
@endif

@if(session('error'))
<script>
document.addEventListener('DOMContentLoaded', function () {

    Swal.fire({
        icon: 'error',
        title: 'Oops!',
        text: '{{ session("error") }}',
        confirmButtonColor: '#EC008C'
    });

});
</script>
@endif