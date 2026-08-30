<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pabelo · Signature Services</title>
  <!-- Tailwind via CDN -->
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
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    .pb-safe { padding-bottom: env(safe-area-inset-bottom, 0.5rem); }

    /* service card — elegant + premium */
    .service-card {
      background: rgba(18, 18, 18, 0.8);
      backdrop-filter: blur(4px);
      border: 1px solid rgba(255,255,255,0.04);
      transition: all 0.25s ease;
      border-radius: 28px;
      padding: 1.5rem 0.8rem;
      text-align: center;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 0.5rem;
      position: relative;
      overflow: hidden;
    }
    .service-card::after {
      content: '';
      position: absolute;
      inset: 0;
      border-radius: 28px;
      padding: 1px;
      background: linear-gradient(145deg, rgba(212,175,55,0.1), transparent 60%);
      -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
      mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
      -webkit-mask-composite: xor;
      mask-composite: exclude;
      pointer-events: none;
    }
    .service-card:hover {
      border-color: #D4AF37;
      transform: translateY(-6px);
      box-shadow: 0 20px 40px -12px rgba(212, 175, 55, 0.15);
      background: rgba(20, 18, 16, 0.9);
    }
    .service-icon {
      width: 68px;
      height: 68px;
      border-radius: 40px;
      background: rgba(212, 175, 55, 0.07);
      border: 1px solid rgba(212, 175, 55, 0.15);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2rem;
      color: #D4AF37;
      transition: 0.2s;
    }
    .service-card:hover .service-icon {
      background: rgba(212, 175, 55, 0.14);
      border-color: #D4AF37;
      box-shadow: 0 0 24px rgba(212,175,55,0.08);
    }
    .service-card img {
      width: 68px;
      height: 68px;
      border-radius: 40px;
      object-fit: cover;
      border: 1px solid rgba(255,255,255,0.06);
    }
    .service-card h4 {
      font-weight: 600;
      font-size: 0.95rem;
      letter-spacing: 0.02em;
      color: #f0edea;
      margin-top: 0.1rem;
    }
    .service-card .badge {
      font-size: 0.6rem;
      text-transform: uppercase;
      letter-spacing: 0.12em;
      color: #a98892;
      background: rgba(255,255,255,0.03);
      padding: 0.2rem 0.8rem;
      border-radius: 40px;
      border: 1px solid rgba(255,255,255,0.04);
    }

    /* HERO — with live image */
    .services-hero {
      position: relative;
      min-height: 78vh;
      display: flex;
      align-items: center;
      border-bottom: 1px solid rgba(212,175,55,0.10);
      overflow: hidden;
    }
    .services-hero .hero-bg {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center 30%;
      z-index: 0;
      filter: brightness(0.55) saturate(1.1);
    }
    .services-hero .hero-overlay {
      position: absolute;
      inset: 0;
      background: radial-gradient(circle at 20% 30%, rgba(0,0,0,0.3) 0%, rgba(5,5,5,0.75) 90%);
      z-index: 1;
    }
    .services-hero .hero-content {
      position: relative;
      z-index: 2;
      max-width: 7xl;
      margin: 0 auto;
      padding: 6rem 1.5rem 4rem;
      text-align: center;
      width: 100%;
    }
    .services-hero .hero-glow {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 2px;
      background: linear-gradient(90deg, transparent, #D4AF37, #EC008C, transparent);
      opacity: 0.4;
      z-index: 2;
    }
    .filter-tag {
      background: rgba(212,175,55,0.06);
      border: 1px solid rgba(212,175,55,0.12);
      border-radius: 60px;
      padding: 0.3rem 1.2rem;
      font-size: 0.7rem;
      font-weight: 500;
      letter-spacing: 0.06em;
      color: #D4AF37;
      text-transform: uppercase;
    }

    /* pagination */
    .pagination button {
      width: 40px;
      height: 40px;
      border-radius: 40px;
      background: transparent;
      border: 1px solid rgba(255,255,255,0.06);
      color: #a98892;
      font-weight: 600;
      transition: 0.2s;
      cursor: pointer;
      font-size: 0.9rem;
    }
    .pagination button.active {
      background: #EC008C;
      border-color: #EC008C;
      color: #fff;
      box-shadow: 0 0 24px rgba(236,0,140,0.25);
    }
    .pagination button:hover:not(.active) {
      border-color: #D4AF37;
      color: #fff;
      background: rgba(212,175,55,0.05);
    }
    .pagination button:disabled {
      opacity: 0.25;
      pointer-events: none;
    }
    .pagination .page-num {
      min-width: 40px;
    }

    /* modal */
    .modal-overlay {
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.75);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      z-index: 999;
      display: none;
      align-items: center;
      justify-content: center;
    }
    .modal-box {
      max-width: 440px;
      width: 94%;
      background: #141414;
      border-radius: 40px;
      padding: 2.2rem 2rem;
      border: 1px solid rgba(212, 175, 55, 0.2);
      box-shadow: 0 40px 80px rgba(0,0,0,0.9);
    }
    .modal-box input {
      width: 100%;
      padding: 14px 20px;
      border-radius: 60px;
      border: 1px solid rgba(255,255,255,0.06);
      background: #1e1c1b;
      color: #fff;
      font-size: 1rem;
      outline: none;
      transition: border 0.2s;
    }
    .modal-box input:focus {
      border-color: #EC008C;
      box-shadow: 0 0 0 3px rgba(236,0,140,0.12);
    }
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
      border: 1px solid rgba(255,255,255,0.1);
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
  </style>
</head>
<body>

<!-- ===== TOP NAV ===== -->
<header class="fixed top-0 w-full z-50 glass border-b border-white/5">
  <div class="max-w-7xl mx-auto px-6 md:px-12 flex items-center justify-between h-20">
    <div class="flex items-center gap-3">
      <img src="{{ asset('assets/imges/pablo.png') }}" alt="Pabelo Logo" class="h-12 md:h-24 w-auto object-contain" />
    </div>
       <nav class="hidden md:flex items-center gap-8">
      <a href="{{ route('home') }}" class="text-sm font-medium uppercase tracking-[0.15em] text-[#a98892] hover:text-[#EC008C] transition">Home</a>
      <a href="{{ route('services') }}" class="text-sm font-medium uppercase tracking-[0.15em] text-[#D4AF37] hover:text-[#EC008C] transition border-b border-[#D4AF37]/40">Services</a>
      <!-- About link added in header -->
      <a href="{{ route('about') }}" class="text-sm font-medium uppercase tracking-[0.15em] text-[#a98892] hover:text-[#EC008C] transition">About</a>
      <a href="{{ route('contact') }}" class="text-sm font-medium uppercase tracking-[0.15em] text-[#a98892] hover:text-[#EC008C] transition">Contact</a>
    </nav>
    <button id="bookNowBtn" class="bg-[#EC008C] text-white px-7 py-2.5 rounded-full text-xs font-bold uppercase tracking-widest shadow-lg shadow-[#EC008C]/20 hover:brightness-110 transition active:scale-95">
      Book Now
    </button>
  </div>
</header>
<!-- ===== HERO WITH LIVE IMAGE ===== -->
<section class="services-hero">
  <!-- live image from unsplash (salon / luxury vibe) -->
  <img 
    class="hero-bg" 
    src="https://images.unsplash.com/photo-1560066984-138dadb4c035?w=1600&q=80" 
    alt="Luxury salon interior" 
    loading="eager" 
  />
  <div class="hero-overlay"></div>
  <div class="hero-content">
    <span class="text-[#D4AF37] text-xs font-bold uppercase tracking-[0.3em] bg-[#1a1412]/80 px-4 py-1.5 rounded-full border border-[#D4AF37]/10 inline-block backdrop-blur-sm">
      Our craft
    </span>
    <h1 class="font-['Playfair_Display'] text-5xl md:text-7xl text-white mt-4 leading-tight drop-shadow-2xl">
      Signature <span class="text-[#EC008C]">Services</span>
    </h1>
    <p class="text-[#d6c9c4] text-lg max-w-2xl mx-auto mt-4 font-light drop-shadow-lg">
      Every treatment is a ritual — precision, care, and the finest techniques.
    </p>
    <div class="mt-8 flex flex-wrap justify-center gap-3">
      <span class="filter-tag">Hair</span>
      <span class="filter-tag">Skin</span>
      <span class="filter-tag">Massage</span>
      <span class="filter-tag">Bridal</span>
    </div>
  </div>
  <div class="hero-glow"></div>
</section>

<!-- ===== SERVICES GRID + PAGINATION ===== -->
<section id="services" class="py-12 px-6 md:px-12 bg-[#050505]">
  <div class="max-w-7xl mx-auto">

    <!-- header bar -->
    <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
      <div class="flex items-center gap-4">
        <span class="text-[#a98892] text-sm font-medium">All services</span>
        <span class="text-[#D4AF37] text-sm font-bold bg-[#1a1412] px-3 py-0.5 rounded-full border border-[#D4AF37]/10" id="totalCount">39</span>
      </div>
      <div class="text-[#a98892] text-sm tracking-wide">
        Showing <span id="rangeStart" class="text-white font-medium">1</span>–<span id="rangeEnd" class="text-white font-medium">12</span>
      </div>
    </div>

    <!-- grid -->
    <div id="serviceGrid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-5">
      <!-- JS renders -->
    </div>

    <!-- pagination -->
    <div class="pagination flex flex-wrap items-center justify-center gap-2 mt-14">
      <button id="prevPage" disabled>
        <span class="material-symbols-outlined text-base">chevron_left</span>
      </button>
      <div id="pageNumbers" class="flex gap-1.5"></div>
      <button id="nextPage">
        <span class="material-symbols-outlined text-base">chevron_right</span>
      </button>
    </div>
  </div>
</section>

<!-- ===== FOOTER ===== -->
<footer class="bg-[#050505] border-t border-white/5 px-6 md:px-12 py-12">
  <div class="max-w-7xl mx-auto">
    <div class="grid md:grid-cols-4 gap-8">
      <div class="md:col-span-1"><div class="flex items-center gap-3 mb-4">
                <img src="{{ asset('assets/imges/pablo.png') }}" alt="Pabelo Logo" class="h-12 md:h-24 w-auto object-contain" />
    </div><p class="text-[#a98892] text-sm max-w-xs">Redefining luxury salon services and professional beauty education since 2022.</p><div class="flex gap-3 mt-6"><a href="#" class="w-9 h-9 rounded-full border border-white/10 flex items-center justify-center hover:bg-[#EC008C] transition"><span class="material-symbols-outlined text-sm text-white">public</span></a><a href="#" class="w-9 h-9 rounded-full border border-white/10 flex items-center justify-center hover:bg-[#EC008C] transition"><span class="material-symbols-outlined text-sm text-white">camera</span></a><a href="#" class="w-9 h-9 rounded-full border border-white/10 flex items-center justify-center hover:bg-[#EC008C] transition"><span class="material-symbols-outlined text-sm text-white">mail</span></a></div></div>
      <div><h5 class="text-[#D4AF37] text-xs font-bold uppercase tracking-widest mb-4">Salon</h5><ul class="space-y-2 text-[#a98892] text-sm"><li><a href="#" class="hover:text-white transition">Hair Care</a></li><li><a href="#" class="hover:text-white transition">Skin Therapy</a></li><li><a href="#" class="hover:text-white transition">Makeup Artistry</a></li><li><a href="#" class="hover:text-white transition">Bridal Studio</a></li></ul></div>
      <div><h5 class="text-[#D4AF37] text-xs font-bold uppercase tracking-widest mb-4">Academy</h5><ul class="space-y-2 text-[#a98892] text-sm"><li><a href="#" class="hover:text-white transition">Hair Dressing</a></li><li><a href="#" class="hover:text-white transition">Cosmetology</a></li><li><a href="#" class="hover:text-white transition">Short Courses</a></li><li><a href="#" class="hover:text-white transition">Enrollment</a></li></ul></div>
      <div><h5 class="text-[#D4AF37] text-xs font-bold uppercase tracking-widest mb-4">Contact</h5><ul class="space-y-2 text-[#a98892] text-sm"><li class="flex items-center gap-2"><span class="material-symbols-outlined text-sm">location_on</span> Mumbai, MH, India</li><li class="flex items-center gap-2"><span class="material-symbols-outlined text-sm">call</span> +91 98765 43210</li><li class="flex items-center gap-2"><span class="material-symbols-outlined text-sm">schedule</span> 10 AM – 8 PM</li></ul></div>
    </div>
    <div class="border-t border-white/5 mt-10 pt-6 flex flex-col md:flex-row justify-between items-center text-xs text-[#a98892] gap-4 md:gap-0">
      <p>© 2026 Pabelo Unisex Salon &amp; Academy</p>
      <p>Designed &amp; Developed by <a href="https://codekrupa.com/" target="_blank" rel="noopener noreferrer" class="text-[#D4AF37] hover:text-white hover:underline transition font-medium">Codekrupa IT Solution</a></p>
      <div class="flex gap-6 mt-3 md:mt-0">
        <a href="#" class="hover:text-white transition">Privacy</a>
        <a href="#" class="hover:text-white transition">Terms</a>
      </div>
    </div>
  </div>
</footer>

<!-- ===== MOBILE BOTTOM NAV ===== -->
<nav class="md:hidden fixed bottom-0 w-full z-50 glass rounded-t-xl border-t border-white/5 pb-safe">
  <div class="flex justify-around items-center h-16">
    <a href="{{ url('/') }}" class="flex flex-col items-center text-[#EC008C]"><span class="material-symbols-outlined" data-weight="fill">home</span><span class="text-[8px] uppercase font-bold">Home</span></a>
    <a href="{{ route('services') }}" class="flex flex-col items-center text-[#a98892]"><span class="material-symbols-outlined">content_cut</span><span class="text-[8px] uppercase font-bold">Services</span></a>
    <a href="{{ route('about') }}" class="flex flex-col items-center text-[#a98892]"><span class="material-symbols-outlined">school</span><span class="text-[8px] uppercase font-bold">About</span></a>
    <a href="{{ route('contact') }}" class="flex flex-col items-center text-[#a98892]"><span class="material-symbols-outlined">star</span><span class="text-[8px] uppercase font-bold">Contact</span></a>
  </div>
</nav>
@include('includes.booking-modal')





<!-- ===== SCRIPT ===== -->
<script>
  (function() {
    // ----- 39 services with real images & icons -----
    const services = [
      { id: 1, name: "Mens Haircut", icon: "content_cut", img: "https://images.unsplash.com/photo-1585747860715-2ba37e788b70?w=120&q=80" },
      { id: 2, name: "Beard", icon: "face", img: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=120&q=80" },
      { id: 3, name: "Mens Threading", icon: "spa", img: "https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?w=120&q=80" },
      { id: 4, name: "Women Haircut", icon: "face_4", img: "https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?w=120&q=80" },
      { id: 5, name: "Advance Haircut", icon: "brush", img: "https://images.unsplash.com/photo-1562322140-8baeececf3df?w=120&q=80" },
      { id: 6, name: "Women Threading", icon: "spa", img: "https://images.unsplash.com/photo-1483985988355-763728e1935b?w=120&q=80" },
      { id: 7, name: "Straightening", icon: "straighten", img: "https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=120&q=80" },
      { id: 8, name: "Smoothing", icon: "smooth", img: "https://images.unsplash.com/photo-1580618672591-eb180b1a973f?w=120&q=80" },
      { id: 9, name: "Rebonding", icon: "rebonding", img: "https://images.unsplash.com/photo-1560066984-138dadb4c035?w=120&q=80" },
      { id: 10, name: "Botox", icon: "science", img: "https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?w=120&q=80" },
      { id: 11, name: "Nanoplastia", icon: "magic", img: "https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=120&q=80" },
      { id: 12, name: "Keratin", icon: "spa", img: "https://images.unsplash.com/photo-1585747860715-2ba37e788b70?w=120&q=80" },
      { id: 13, name: "Dandruff Treatment", icon: "cleaning_services", img: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=120&q=80" },
      { id: 14, name: "Toning", icon: "palette", img: "https://images.unsplash.com/photo-1562322140-8baeececf3df?w=120&q=80" },
      { id: 15, name: "Tones", icon: "palette", img: "https://images.unsplash.com/photo-1483985988355-763728e1935b?w=120&q=80" },
      { id: 16, name: "Fruit Facial", icon: "apple", img: "https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?w=120&q=80" },
      { id: 17, name: "Skin Whitening", icon: "brightness_high", img: "https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?w=120&q=80" },
      { id: 18, name: "Wine Facial", icon: "wine_bar", img: "https://images.unsplash.com/photo-1580618672591-eb180b1a973f?w=120&q=80" },
      { id: 19, name: "De-Tan", icon: "wb_sunny", img: "https://images.unsplash.com/photo-1562322140-8baeececf3df?w=120&q=80" },
      { id: 20, name: "Ubtan Radiance", icon: "spa", img: "https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?w=120&q=80" },
      { id: 21, name: "24ct Gold Facial", icon: "workspace_premium", img: "https://images.unsplash.com/photo-1585747860715-2ba37e788b70?w=120&q=80" },
      { id: 22, name: "Diamond Facial", icon: "diamond", img: "https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?w=120&q=80" },
      { id: 23, name: "Skin Tightening", icon: "fitbit", img: "https://images.unsplash.com/photo-1483985988355-763728e1935b?w=120&q=80" },
      { id: 24, name: "Pearl Facial", icon: "circle", img: "https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?w=120&q=80" },
      { id: 25, name: "O3+ Facial", icon: "science", img: "https://images.unsplash.com/photo-1580618672591-eb180b1a973f?w=120&q=80" },
      { id: 26, name: "Basic Clean Up", icon: "cleaning", img: "https://images.unsplash.com/photo-1560066984-138dadb4c035?w=120&q=80" },
      { id: 27, name: "Advance Clean Up", icon: "cleaning_services", img: "https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=120&q=80" },
      { id: 28, name: "Kakadu Plum Facial", icon: "spa", img: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=120&q=80" },
      { id: 29, name: "Gotu Kola Facial", icon: "spa", img: "https://images.unsplash.com/photo-1585747860715-2ba37e788b70?w=120&q=80" },
      { id: 30, name: "Platinum Sheen Facial", icon: "workspace_premium", img: "https://images.unsplash.com/photo-1483985988355-763728e1935b?w=120&q=80" },
      { id: 31, name: "Hydra Glow Facial", icon: "water_drop", img: "https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?w=120&q=80" },
      { id: 32, name: "Sheet Mask", icon: "face", img: "https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?w=120&q=80" },
      { id: 33, name: "Nose Strip", icon: "filter_alt", img: "https://images.unsplash.com/photo-1562322140-8baeececf3df?w=120&q=80" },
      { id: 34, name: "Rubber Mask", icon: "mask", img: "https://images.unsplash.com/photo-1580618672591-eb180b1a973f?w=120&q=80" },
      { id: 35, name: "Head Massage", icon: "spa", img: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=120&q=80" },
      { id: 36, name: "Foot Massage", icon: "pedal_bike", img: "https://images.unsplash.com/photo-1483985988355-763728e1935b?w=120&q=80" },
      { id: 37, name: "Back Massage", icon: "spa", img: "https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?w=120&q=80" },
      { id: 38, name: "Nail Filing", icon: "content_cut", img: "https://images.unsplash.com/photo-1585747860715-2ba37e788b70?w=120&q=80" },
      { id: 39, name: "Nail Paint / Polish", icon: "brush", img: "https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?w=120&q=80" }
    ];

    const perPage = 12;
    let currentPage = 1;
    const totalPages = Math.ceil(services.length / perPage);

    const grid = document.getElementById('serviceGrid');
    const pageNumbers = document.getElementById('pageNumbers');
    const prevBtn = document.getElementById('prevPage');
    const nextBtn = document.getElementById('nextPage');
    const rangeStart = document.getElementById('rangeStart');
    const rangeEnd = document.getElementById('rangeEnd');
    const totalCount = document.getElementById('totalCount');

    function renderPage(page) {
      const start = (page - 1) * perPage;
      const end = Math.min(start + perPage, services.length);
      const pageItems = services.slice(start, end);

      rangeStart.textContent = start + 1;
      rangeEnd.textContent = end;
      totalCount.textContent = services.length;

      grid.innerHTML = pageItems.map(s => `
        <div class="service-card">
          <div class="service-icon">
            ${s.img ? `<img src="${s.img}" alt="${s.name}" loading="lazy" />` : `<span class="material-symbols-outlined">${s.icon || 'star'}</span>`}
          </div>
          <h4>${s.name}</h4>
          <span class="badge">service</span>
        </div>
      `).join('');

      renderPagination(page);
      prevBtn.disabled = page === 1;
      nextBtn.disabled = page === totalPages;
    }

    function renderPagination(active) {
      let html = '';
      const maxVisible = 5;
      let startPage = Math.max(1, active - Math.floor(maxVisible/2));
      let endPage = Math.min(totalPages, startPage + maxVisible - 1);
      if (endPage - startPage < maxVisible - 1) startPage = Math.max(1, endPage - maxVisible + 1);

      for (let i = startPage; i <= endPage; i++) {
        html += `<button class="page-num ${i === active ? 'active' : ''}" data-page="${i}">${i}</button>`;
      }
      pageNumbers.innerHTML = html;

      document.querySelectorAll('.page-num').forEach(btn => {
        btn.addEventListener('click', function(e) {
          const page = parseInt(this.dataset.page);
          if (page !== currentPage) {
            currentPage = page;
            renderPage(currentPage);
          }
        });
      });
    }

    prevBtn.addEventListener('click', () => {
      if (currentPage > 1) { currentPage--; renderPage(currentPage); }
    });
    nextBtn.addEventListener('click', () => {
      if (currentPage < totalPages) { currentPage++; renderPage(currentPage); }
    });

    renderPage(1);

  })();
</script>
</body>
</html>