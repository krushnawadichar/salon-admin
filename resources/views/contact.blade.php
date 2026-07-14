<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pabelo · Contact Us</title>
  <!-- Tailwind CSS via CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,700&family=Hanken+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <!-- Material Symbols -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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
    .pb-safe { padding-bottom: env(safe-area-inset-bottom, 0.5rem); }
    .contact-icon {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 52px;
      height: 52px;
      border-radius: 60px;
      background: rgba(212, 175, 55, 0.08);
      border: 1px solid rgba(212, 175, 55, 0.15);
      flex-shrink: 0;
    }
    .contact-icon .material-symbols-outlined {
      color: #D4AF37;
      font-size: 26px;
    }
    .footer-form input, .footer-form textarea {
      width: 100%;
      padding: 14px 18px;
      border-radius: 60px;
      border: 1px solid rgba(255,255,255,0.06);
      background: #111;
      color: #fff;
      font-size: 0.9rem;
      outline: none;
      transition: 0.2s;
    }
    .footer-form input:focus, .footer-form textarea:focus {
      border-color: #D4AF37;
      box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.08);
    }
    .footer-form textarea { border-radius: 24px; resize: vertical; min-height: 100px; }
    .footer-form button {
      background: #D4AF37;
      color: #111;
      padding: 14px 32px;
      border-radius: 60px;
      font-weight: 700;
      font-size: 0.8rem;
      letter-spacing: 0.05em;
      border: none;
      cursor: pointer;
      transition: 0.2s;
    }
    .footer-form button:hover { filter: brightness(1.1); }
    .modal-overlay { display: none; } /* kept for consistency, not used on contact page */
  </style>
</head>
<body>

<!-- ===== TOP NAV (EXACT SAME AS HOMEPAGE) ===== -->
<header class="fixed top-0 w-full z-50 glass border-b border-white/5">
  <div class="max-w-7xl mx-auto px-6 md:px-12 flex items-center justify-between h-20">
    <div class="flex items-center gap-3">
      <!-- same logo as homepage -->
      <img src="{{ asset('assets/imges/pablo.png') }}" alt="Pabelo Logo" class="h-12 md:h-24 w-auto object-contain" />
    </div>
     <nav class="hidden md:flex items-center gap-8">
      <a href="{{ route('home') }}" class="text-sm font-medium uppercase tracking-[0.15em] text-[#a98892] hover:text-[#EC008C] transition">Home</a>
      <a href="{{ route('services') }}" class="text-sm font-medium uppercase tracking-[0.15em] text-[#a98892] hover:text-[#EC008C] transition">Services</a>
      <!-- About link added in header -->
      <a href="{{ route('about') }}" class="text-sm font-medium uppercase tracking-[0.15em] text-[#a98892] hover:text-[#EC008C] transitionx`">About</a>
      <a href="{{ route('contact') }}" class="text-sm font-medium uppercase tracking-[0.15em] text-[#D4AF37] hover:text-[#EC008C] transition border-b border-[#D4AF37]/40">Contact</a>
    </nav>
    <button id="bookNowBtn" class="bg-[#EC008C] text-white px-7 py-2.5 rounded-full text-xs font-bold uppercase tracking-widest shadow-lg shadow-[#EC008C]/20 hover:brightness-110 transition active:scale-95">
      Book Now
    </button>
  </div>
</header>

<!-- ===== MAIN CONTENT: CONTACT PAGE ===== -->
<main class="pt-20">

  <!-- Hero / page title -->
  <section class="relative py-20 md:py-28 px-6 md:px-12 bg-[#0e0e0e] border-b border-white/5">
    <div class="max-w-7xl mx-auto">
      <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
          <span class="text-[#EC008C] text-xs font-bold uppercase tracking-[0.3em]">Get in touch</span>
          <h1 class="font-['Playfair_Display'] text-4xl md:text-6xl text-white mt-2 leading-tight">Let’s Connect <br /><span class="text-[#D4AF37]">in style.</span></h1>
          <p class="text-[#a98892] text-lg max-w-xl mt-3">We’re here to answer your questions, book your appointment, or help you start your journey with Pabelo Academy.</p>
        </div>
        <div class="flex gap-3">
          <a href="tel:+919876543210" class="glass-card px-6 py-3 rounded-full border border-white/5 flex items-center gap-2 hover:border-[#D4AF37] transition">
            <span class="material-symbols-outlined text-[#D4AF37] text-sm">call</span>
            <span class="text-sm font-medium">+91 98765 43210</span>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== CONTACT GRID: FORM + DETAILS ===== -->
  <section class="py-20 px-6 md:px-12 bg-[#050505]">
    <div class="max-w-7xl mx-auto grid md:grid-cols-5 gap-12">
      <!-- left: contact info -->
      <div class="md:col-span-2 space-y-10">
        <div>
          <h3 class="text-[#D4AF37] text-sm font-bold uppercase tracking-widest mb-6">Visit us</h3>
          <div class="flex gap-5 items-start">
            <div class="contact-icon"><span class="material-symbols-outlined">location_on</span></div>
            <div><p class="text-white font-medium">Pabelo Luxury Salon</p><p class="text-[#a98892] text-sm">Bandra West, Mumbai, Maharashtra 400050</p><p class="text-[#a98892] text-sm mt-1">India</p></div>
          </div>
        </div>
        <div>
          <h3 class="text-[#D4AF37] text-sm font-bold uppercase tracking-widest mb-6">Contact</h3>
          <div class="flex gap-5 items-start">
            <div class="contact-icon"><span class="material-symbols-outlined">call</span></div>
            <div><p class="text-white font-medium">Phone</p><p class="text-[#a98892] text-sm">+91 98765 43210</p><p class="text-[#a98892] text-sm">+91 98765 43211 (Academy)</p></div>
          </div>
          <div class="flex gap-5 items-start mt-6">
            <div class="contact-icon"><span class="material-symbols-outlined">mail</span></div>
            <div><p class="text-white font-medium">Email</p><p class="text-[#a98892] text-sm">hello@pabelo.in</p><p class="text-[#a98892] text-sm">academy@pabelo.in</p></div>
          </div>
        </div>
        <div>
          <h3 class="text-[#D4AF37] text-sm font-bold uppercase tracking-widest mb-6">Hours</h3>
          <div class="flex gap-5 items-start">
            <div class="contact-icon"><span class="material-symbols-outlined">schedule</span></div>
            <div><p class="text-white font-medium">Salon</p><p class="text-[#a98892] text-sm">Mon – Sat: 10:00 AM – 8:00 PM</p><p class="text-[#a98892] text-sm">Sun: 11:00 AM – 6:00 PM</p><p class="text-white font-medium mt-2">Academy</p><p class="text-[#a98892] text-sm">Mon – Fri: 9:00 AM – 6:00 PM</p></div>
          </div>
        </div>
        <div class="pt-4 border-t border-white/5">
          <p class="text-[#a98892] text-sm flex items-center gap-2"><span class="material-symbols-outlined text-[#D4AF37] text-sm">verified</span> We respond within 2 hours</p>
        </div>
      </div>

      <!-- right: contact form (enhanced footer form style) -->
      <div class="md:col-span-3">
        <div class="glass-card p-8 md:p-10 rounded-3xl border border-white/5">
          <div class="flex items-center gap-2 mb-4">
            <span class="text-[#D4AF37] text-xs font-bold uppercase tracking-[0.2em]">Send a message</span>
            <span class="w-8 h-px bg-[#D4AF37]/40"></span>
          </div>
          <h3 class="font-['Playfair_Display'] text-3xl md:text-4xl text-white mb-1">We’d love to <br /><span class="text-[#EC008C]">hear from you</span></h3>
          <p class="text-[#a98892] text-sm mb-6">Fill in the details and we’ll reach out within 2 hours.</p>
          <form class="footer-form space-y-5">
            <div class="grid md:grid-cols-2 gap-4">
              <div><input type="text" placeholder="Full name" required class="w-full" /></div>
              <div><input type="tel" placeholder="Phone number" required class="w-full" /></div>
            </div>
            <div><input type="email" placeholder="Email address" class="w-full" /></div>
            <div><textarea placeholder="Tell us about your vision, query, or appointment request…" class="w-full"></textarea></div>
            <div class="flex flex-wrap items-center gap-4">
              <button type="submit" class="w-full md:w-auto px-10">Send message</button>
              <span class="text-[10px] text-[#666]">We respect your privacy. No spam.</span>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== MAP / LOCATION (simple representation) ===== -->
  <section class="py-10 px-6 md:px-12 bg-[#0e0e0e] border-t border-white/5">
    <div class="max-w-7xl mx-auto">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d3722.056297754504!2d79.13176242393659!3d21.1103215849748!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e6!4m5!1s0x3bd4b89bad9a8243%3A0x479322094652520a!2sDighori%2C%20Nagpur%2C%20Maharashtra!3m2!1d21.1105995!2d79.1355318!4m5!1s0x3bd4b9bddfe6c605%3A0x5eeff6ab6b3d806a!2s%23Pabelo%20the%20unisex%20seloon%20%26%20academy%2C%20Vaibhav%20Nagar%2C%20Dighori%2C%20Nagpur%2C%20Maharashtra%20440034!3m2!1d21.1095728!2d79.1331926!5e0!3m2!1sen!2sin!4v1784044673413!5m2!1sen!2sin"
            width="100%"
            height="450"
            style="border:0;"
            allowfullscreen
            loading="lazy"
            referrerpolicy="strict-origin-when-cross-origin">
        </iframe>
    </div>
  </section>

</main>

<!-- ===== FOOTER (EXACT SAME AS HOMEPAGE, with Contact link added) ===== -->
<footer class="bg-[#050505] border-t border-white/5 px-6 md:px-12 py-12">
  <div class="max-w-7xl mx-auto">
    <div class="grid md:grid-cols-4 gap-8">
      <div class="md:col-span-1">
        <div class="flex items-center gap-3 mb-4">
          <img src="{{ asset('assets/imges/pablo.png') }}" alt="Pabelo Logo" class="h-12 md:h-24 w-auto object-contain" />
        </div>
        <p class="text-[#a98892] text-sm max-w-xs">Redefining luxury salon services and professional beauty education since 2022.</p>
        <div class="flex gap-3 mt-6">
          <a href="#" class="w-9 h-9 rounded-full border border-white/10 flex items-center justify-center hover:bg-[#EC008C] transition"><span class="material-symbols-outlined text-sm text-white">public</span></a>
          <a href="#" class="w-9 h-9 rounded-full border border-white/10 flex items-center justify-center hover:bg-[#EC008C] transition"><span class="material-symbols-outlined text-sm text-white">camera</span></a>
          <a href="#" class="w-9 h-9 rounded-full border border-white/10 flex items-center justify-center hover:bg-[#EC008C] transition"><span class="material-symbols-outlined text-sm text-white">mail</span></a>
        </div>
      </div>
      <div>
        <h5 class="text-[#D4AF37] text-xs font-bold uppercase tracking-widest mb-4">Salon</h5>
        <ul class="space-y-2 text-[#a98892] text-sm">
          <li><a href="#" class="hover:text-white transition">Hair Care</a></li>
          <li><a href="#" class="hover:text-white transition">Skin Therapy</a></li>
          <li><a href="#" class="hover:text-white transition">Makeup Artistry</a></li>
          <li><a href="#" class="hover:text-white transition">Bridal Studio</a></li>
        </ul>
      </div>
      <div>
        <h5 class="text-[#D4AF37] text-xs font-bold uppercase tracking-widest mb-4">Academy</h5>
        <ul class="space-y-2 text-[#a98892] text-sm">
          <li><a href="#" class="hover:text-white transition">Hair Dressing</a></li>
          <li><a href="#" class="hover:text-white transition">Cosmetology</a></li>
          <li><a href="#" class="hover:text-white transition">Short Courses</a></li>
          <li><a href="#" class="hover:text-white transition">Enrollment</a></li>
        </ul>
      </div>
      <div>
        <h5 class="text-[#D4AF37] text-xs font-bold uppercase tracking-widest mb-4">Contact</h5>
        <ul class="space-y-2 text-[#a98892] text-sm">
          <li class="flex items-center gap-2"><span class="material-symbols-outlined text-sm">location_on</span> Mumbai, MH, India</li>
          <li class="flex items-center gap-2"><span class="material-symbols-outlined text-sm">call</span> +91 98765 43210</li>
          <li class="flex items-center gap-2"><span class="material-symbols-outlined text-sm">schedule</span> 10 AM – 8 PM</li>
          <!-- footer contact link added -->
          <li class="mt-2"><a href="{{ route('contact') }}" class="text-[#D4AF37] hover:text-white transition text-sm font-medium">Contact Us →</a></li>
        </ul>
      </div>
    </div>
    <div class="border-t border-white/5 mt-10 pt-6 flex flex-col md:flex-row justify-between items-center text-xs text-[#a98892]">
      <p>© 2026 Pabelo Unisex Salon &amp; Academy</p>
      <div class="flex gap-6 mt-3 md:mt-0">
        <a href="#" class="hover:text-white transition">Privacy</a>
        <a href="#" class="hover:text-white transition">Terms</a>
        <a href="{{ route('contact') }}" class="hover:text-[#D4AF37] transition">Contact</a>
      </div>
    </div>
  </div>
</footer>

<!-- ===== MOBILE BOTTOM NAV (with Contact link) ===== -->
<nav class="md:hidden fixed bottom-0 w-full z-50 glass rounded-t-xl border-t border-white/5 pb-safe">
  <div class="flex justify-around items-center h-16">
    <a href="{{ url('/') }}" class="flex flex-col items-center text-[#EC008C]"><span class="material-symbols-outlined" data-weight="fill">home</span><span class="text-[8px] uppercase font-bold">Home</span></a>
    <a href="{{ route('services') }}" class="flex flex-col items-center text-[#a98892]"><span class="material-symbols-outlined">content_cut</span><span class="text-[8px] uppercase font-bold">Services</span></a>
    <a href="{{ route('about') }}" class="flex flex-col items-center text-[#a98892]"><span class="material-symbols-outlined">school</span><span class="text-[8px] uppercase font-bold">About</span></a>
    <a href="{{ route('contact') }}" class="flex flex-col items-center text-[#a98892]"><span class="material-symbols-outlined">star</span><span class="text-[8px] uppercase font-bold">Contact</span></a>
  </div>
</nav>

<!-- ===== SCRIPT (minimal, keeps booking modal handlers alive but not used) ===== -->
<script>
  (function() {
    // booking modal placeholder (not used on contact page, but keep for consistency)
    const bookBtn = document.getElementById('bookNowBtn');
    if (bookBtn) {
      bookBtn.addEventListener('click', function(e) {
        e.preventDefault();
        alert('📅 Booking modal would open here. (You can integrate your own booking flow.)');
      });
    }
    // footer form demo
    document.querySelector('.footer-form')?.addEventListener('submit', function(e) {
      e.preventDefault();
      alert('✨ Thank you! We\'ll reach out soon.');
      this.reset();
    });
    // smooth scroll for internal links
    document.querySelectorAll('a[href^="#"]').forEach(a => {
      a.addEventListener('click', function(e) {
        const href = this.getAttribute('href');
        if (href === '#') return;
        e.preventDefault();
        const target = document.querySelector(href);
        if (target) target.scrollIntoView({ behavior: 'smooth' });
      });
    });
  })();
</script>

</body>
</html>