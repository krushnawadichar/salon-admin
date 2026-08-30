<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pabelo · About Us</title>
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
    .hero-about {
      background: linear-gradient(135deg, #0b0b0b 0%, #1a0f12 100%);
    }
    .about-stat {
      background: rgba(18, 18, 18, 0.5);
      backdrop-filter: blur(4px);
      border: 1px solid rgba(255,255,255,0.04);
      border-radius: 32px;
      padding: 1.8rem 1.2rem;
      text-align: center;
      transition: 0.3s;
    }
    .about-stat:hover {
      border-color: #D4AF37;
      background: rgba(212, 175, 55, 0.04);
    }
    .about-stat .number {
      font-size: 2.8rem;
      font-weight: 700;
      font-family: 'Playfair Display', serif;
      color: #D4AF37;
      line-height: 1;
    }
    .footer-form input, .footer-form textarea { display: none; } /* not used on about page, kept for consistency */
  </style>
</head>
<body>

<!-- ===== TOP NAV (EXACT SAME AS HOMEPAGE + ABOUT LINK) ===== -->
<header class="fixed top-0 w-full z-50 glass border-b border-white/5">
  <div class="max-w-7xl mx-auto px-6 md:px-12 flex items-center justify-between h-20">
    <div class="flex items-center gap-3">
      <img src="{{ asset('assets/imges/pablo.png') }}" alt="Pabelo Logo" class="h-12 md:h-24 w-auto object-contain" />
    </div>
         <nav class="hidden md:flex items-center gap-8">
      <a href="{{ route('home') }}" class="text-sm font-medium uppercase tracking-[0.15em] text-[#a98892] hover:text-[#EC008C] transition">Home</a>
      <a href="{{ route('services') }}" class="text-sm font-medium uppercase tracking-[0.15em] text-[#a98892] hover:text-[#EC008C] transition">Services</a>
      <!-- About link added in header -->
      <a href="{{ route('about') }}" class="text-sm font-medium uppercase tracking-[0.15em] text-[#D4AF37] hover:text-[#EC008C] transition border-b border-[#D4AF37]/40">About</a>
      <a href="{{ route('contact') }}" class="text-sm font-medium uppercase tracking-[0.15em] text-[#a98892] hover:text-[#EC008C] transition">Contact</a>
    </nav>
    <button id="bookNowBtn" class="bg-[#EC008C] text-white px-7 py-2.5 rounded-full text-xs font-bold uppercase tracking-widest shadow-lg shadow-[#EC008C]/20 hover:brightness-110 transition active:scale-95">
      Book Now
    </button>
  </div>
</header>

<!-- ===== MAIN CONTENT: ABOUT PAGE ===== -->
<main class="pt-20">

  <!-- ===== HERO SECTION WITH LIVE IMAGE ===== -->
  <section class="relative min-h-[75vh] md:min-h-[80vh] w-full overflow-hidden hero-about">
    <div class="absolute inset-0">
      <!-- live image from unsplash (salon / luxury vibe) -->
      <img src="https://images.unsplash.com/photo-1585747860715-2ba37e788b70?w=1600&q=80" alt="Pabelo luxury salon interior" class="w-full h-full object-cover opacity-40" />
      <div class="absolute inset-0 bg-gradient-to-r from-[#050505]/90 via-[#050505]/60 to-transparent"></div>
      <div class="absolute inset-0 bg-gradient-to-t from-[#050505] via-transparent to-transparent"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-6 md:px-12 h-full flex flex-col justify-center items-start min-h-[75vh] md:min-h-[80vh]">
      <span class="text-[#D4AF37] text-xs font-bold uppercase tracking-[0.3em] mb-4">Our Story</span>
      <h1 class="font-['Playfair_Display'] text-5xl md:text-7xl font-bold text-white leading-tight max-w-3xl">
        Where Artistry <br /><span class="text-[#EC008C]">Meets Elegance</span>
      </h1>
      <p class="text-lg md:text-xl text-[#e2bdc8] max-w-xl mt-6 font-light">
        Pabelo is more than a salon — it's a sanctuary for self-expression, crafted with precision and passion since 2022.
      </p>
      <div class="flex flex-wrap gap-4 mt-8">
        <button class="bg-[#D4AF37] text-black px-8 py-3 rounded-full font-bold text-sm uppercase tracking-widest hover:brightness-110 transition active:scale-95">Our Philosophy</button>
        <button class="border border-white/20 text-white px-8 py-3 rounded-full font-bold text-sm uppercase tracking-widest hover:bg-white/5 transition active:scale-95">Meet the Team</button>
      </div>
    </div>
  </section>

  <!-- ===== STATS / MILESTONES ===== -->
  <section class="py-16 px-6 md:px-12 bg-[#0e0e0e] border-y border-white/5">
    <div class="max-w-7xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-6">
      <div class="about-stat"><div class="number">5+</div><p class="text-[#a98892] text-sm mt-1 uppercase tracking-wider">Years of Excellence</p></div>
      <div class="about-stat"><div class="number">2.5K</div><p class="text-[#a98892] text-sm mt-1 uppercase tracking-wider">Happy Clients</p></div>
      <div class="about-stat"><div class="number">15+</div><p class="text-[#a98892] text-sm mt-1 uppercase tracking-wider">Award-Winning Team</p></div>
      <div class="about-stat"><div class="number">100%</div><p class="text-[#a98892] text-sm mt-1 uppercase tracking-wider">Ethical Products</p></div>
    </div>
  </section>

  <!-- ===== ABOUT CONTENT ===== -->
  <section class="py-20 px-6 md:px-12 bg-[#050505]">
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-16 items-center">
      <div>
        <span class="text-[#EC008C] text-xs font-bold uppercase tracking-[0.3em]">Who we are</span>
        <h2 class="font-['Playfair_Display'] text-4xl md:text-5xl text-white mt-2 leading-tight">A Legacy of <br /><span class="text-[#D4AF37]">Luxury &amp; Learning</span></h2>
        <div class="space-y-5 mt-8 text-[#c8b5bb]">
          <p>Founded in 2022, Pabelo Unisex Salon &amp; Academy was born from a vision to create a space where beauty is both an art and a science. Our founder, with decades of experience in the fashion capitals, brought together a team of master stylists, makeup artists, and educators.</p>
          <p>We believe that true luxury lies in personalization — every service, every product, every interaction is tailored to you. Our academy extends this philosophy, training the next generation of beauty professionals with a curriculum that blends creativity, technique, and business acumen.</p>
          <p>Today, Pabelo stands as a beacon of excellence in Mumbai, serving discerning clients and nurturing talent from across India.</p>
        </div>
        <div class="flex flex-wrap gap-6 mt-10">
          <div><span class="block text-[#D4AF37] font-bold text-xl">Mission</span><p class="text-[#a98892] text-sm max-w-xs">To empower individuals through transformative beauty experiences and education.</p></div>
          <div><span class="block text-[#D4AF37] font-bold text-xl">Vision</span><p class="text-[#a98892] text-sm max-w-xs">To be India's most revered luxury beauty destination and academy.</p></div>
        </div>
      </div>
      <div class="grid grid-cols-2 gap-4">
        <div class="rounded-2xl overflow-hidden border border-white/5 h-64"><img src="https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?w=600&q=80" alt="Styling" class="w-full h-full object-cover" /></div>
        <div class="rounded-2xl overflow-hidden border border-white/5 h-64 mt-8"><img src="https://images.unsplash.com/photo-1560066984-138dadb4c035?w=600&q=80" alt="Salon" class="w-full h-full object-cover" /></div>
        <div class="rounded-2xl overflow-hidden border border-white/5 h-64 col-span-2"><img src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=800&q=80" alt="Academy" class="w-full h-full object-cover" /></div>
      </div>
    </div>
  </section>

  <!-- ===== TEAM / VALUES ===== -->
  <section class="py-20 px-6 md:px-12 bg-[#0e0e0e] border-t border-white/5">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-14">
        <span class="text-[#D4AF37] text-xs font-bold uppercase tracking-[0.3em]">Our Ethos</span>
        <h2 class="font-['Playfair_Display'] text-4xl md:text-5xl text-white mt-2">Crafted with <span class="text-[#EC008C]">Integrity</span></h2>
        <p class="text-[#a98892] text-lg max-w-2xl mx-auto mt-3">Every service, every product, every interaction is rooted in our core values.</p>
      </div>
      <div class="grid md:grid-cols-3 gap-8">
        <div class="glass-card p-8 rounded-3xl text-center border-t-4 border-[#D4AF37]">
          <span class="material-symbols-outlined text-5xl text-[#D4AF37] mb-4">handshake</span>
          <h4 class="text-xl font-bold text-white">Trust &amp; Transparency</h4>
          <p class="text-[#a98892] text-sm mt-2">We believe in honest consultations and clear communication, ensuring you always feel informed and confident.</p>
        </div>
        <div class="glass-card p-8 rounded-3xl text-center border-t-4 border-[#EC008C]">
          <span class="material-symbols-outlined text-5xl text-[#EC008C] mb-4">spa</span>
          <h4 class="text-xl font-bold text-white">Holistic Wellness</h4>
          <p class="text-[#a98892] text-sm mt-2">Beauty is more than skin deep. Our treatments are designed to nurture your well-being inside and out.</p>
        </div>
        <div class="glass-card p-8 rounded-3xl text-center border-t-4 border-[#D4AF37]">
          <span class="material-symbols-outlined text-5xl text-[#D4AF37] mb-4">psychology</span>
          <h4 class="text-xl font-bold text-white">Continuous Innovation</h4>
          <p class="text-[#a98892] text-sm mt-2">We invest in the latest techniques, products, and education to bring you the forefront of beauty.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== TESTIMONIALS / SOCIAL PROOF ===== -->
  <section class="py-20 px-6 md:px-12 bg-[#050505] border-t border-white/5">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-14">
        <span class="text-[#EC008C] text-xs font-bold uppercase tracking-[0.3em]">Voices of Trust</span>
        <h2 class="font-['Playfair_Display'] text-4xl md:text-5xl text-white">What Our Community Says</h2>
      </div>
      <div class="grid md:grid-cols-3 gap-8">
        <div class="glass-card p-8 rounded-2xl border-l-4 border-[#D4AF37]">
          <div class="flex items-center gap-2 mb-4"><span class="material-symbols-outlined text-[#D4AF37]">star</span><span class="material-symbols-outlined text-[#D4AF37]">star</span><span class="material-symbols-outlined text-[#D4AF37]">star</span><span class="material-symbols-outlined text-[#D4AF37]">star</span><span class="material-symbols-outlined text-[#D4AF37]">star</span></div>
          <p class="text-[#e5e2e1] italic leading-relaxed">"Pabelo is my go-to for every special occasion. Their attention to detail is unmatched."</p>
          <div class="flex items-center gap-4 mt-6"><img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&q=80" alt="client" class="w-10 h-10 rounded-full object-cover border border-[#D4AF37]/30" /><div><p class="text-white font-bold text-sm">Nina Patel</p><p class="text-[#a98892] text-xs">Entrepreneur</p></div></div>
        </div>
        <div class="glass-card p-8 rounded-2xl border-l-4 border-[#EC008C]">
          <div class="flex items-center gap-2 mb-4"><span class="material-symbols-outlined text-[#D4AF37]">star</span><span class="material-symbols-outlined text-[#D4AF37]">star</span><span class="material-symbols-outlined text-[#D4AF37]">star</span><span class="material-symbols-outlined text-[#D4AF37]">star</span><span class="material-symbols-outlined text-[#D4AF37]">star</span></div>
          <p class="text-[#e5e2e1] italic leading-relaxed">"The academy gave me the skills and confidence to start my own salon. Forever grateful."</p>
          <div class="flex items-center gap-4 mt-6"><img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&q=80" alt="alumni" class="w-10 h-10 rounded-full object-cover border border-[#EC008C]/30" /><div><p class="text-white font-bold text-sm">Arjun Singh</p><p class="text-[#a98892] text-xs">Academy Alumni</p></div></div>
        </div>
        <div class="glass-card p-8 rounded-2xl border-l-4 border-[#D4AF37]">
          <div class="flex items-center gap-2 mb-4"><span class="material-symbols-outlined text-[#D4AF37]">star</span><span class="material-symbols-outlined text-[#D4AF37]">star</span><span class="material-symbols-outlined text-[#D4AF37]">star</span><span class="material-symbols-outlined text-[#D4AF37]">star</span><span class="material-symbols-outlined text-[#D4AF37]">star</span></div>
          <p class="text-[#e5e2e1] italic leading-relaxed">"The most luxurious salon experience in Mumbai. I always leave feeling like a star."</p>
          <div class="flex items-center gap-4 mt-6"><img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&q=80" alt="client" class="w-10 h-10 rounded-full object-cover border border-[#D4AF37]/30" /><div><p class="text-white font-bold text-sm">Maya Rao</p><p class="text-[#a98892] text-xs">Media Professional</p></div></div>
        </div>
      </div>
    </div>
  </section>

</main>

<!-- ===== FOOTER (WITH ABOUT LINK ADDED) ===== -->
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
        <h5 class="text-[#D4AF37] text-xs font-bold uppercase tracking-widest mb-4">Quick Links</h5>
        <ul class="space-y-2 text-[#a98892] text-sm">
          <li><a href="#" class="hover:text-white transition">Home</a></li>
          <li><a href="{{ route('about') }}" class="hover:text-[#D4AF37] transition">About Us</a></li>
          <li><a href="{{ route('contact') }}" class="hover:text-[#D4AF37] transition">Contact</a></li>
          <li><a href="#" class="hover:text-white transition">Careers</a></li>
        </ul>
        <p class="mt-4 text-xs text-[#666]">📍 Mumbai, MH, India</p>
      </div>
    </div>
    <div class="border-t border-white/5 mt-10 pt-6 flex flex-col md:flex-row justify-between items-center text-xs text-[#a98892] gap-4 md:gap-0">
      <p>© 2026 Pabelo Unisex Salon &amp; Academy</p>
      <p>Designed &amp; Developed by <a href="https://codekrupa.com/" target="_blank" rel="noopener noreferrer" class="text-[#D4AF37] hover:text-white hover:underline transition font-medium">Codekrupa IT Solution</a></p>
      <div class="flex gap-6 mt-3 md:mt-0">
        <a href="#" class="hover:text-white transition">Privacy</a>
        <a href="#" class="hover:text-white transition">Terms</a>
        <a href="{{ route('about') }}" class="hover:text-[#D4AF37] transition">About</a>
        <a href="{{ route('contact') }}" class="hover:text-[#D4AF37] transition">Contact</a>
      </div>
    </div>
  </div>
</footer>

<!-- ===== MOBILE BOTTOM NAV (WITH ABOUT LINK) ===== -->
<nav class="md:hidden fixed bottom-0 w-full z-50 glass rounded-t-xl border-t border-white/5 pb-safe">
  <div class="flex justify-around items-center h-16">
    <a href="{{ url('/') }}" class="flex flex-col items-center text-[#EC008C]"><span class="material-symbols-outlined" data-weight="fill">home</span><span class="text-[8px] uppercase font-bold">Home</span></a>
    <a href="{{ route('services') }}" class="flex flex-col items-center text-[#a98892]"><span class="material-symbols-outlined">content_cut</span><span class="text-[8px] uppercase font-bold">Services</span></a>
    <a href="{{ route('about') }}" class="flex flex-col items-center text-[#a98892]"><span class="material-symbols-outlined">school</span><span class="text-[8px] uppercase font-bold">About</span></a>
    <a href="{{ route('contact') }}" class="flex flex-col items-center text-[#a98892]"><span class="material-symbols-outlined">star</span><span class="text-[8px] uppercase font-bold">Contact</span></a>
  </div>`
</nav>

@include('includes.booking-modal')


</body>
</html>