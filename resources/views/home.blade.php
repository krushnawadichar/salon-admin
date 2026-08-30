<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pabelo · Luxury Salon & Academy</title>
   <!-- Basic SEO -->
  <title>Pabelo Unisex Salon | Best Salon in Nagpur | Hair, Beauty, Bridal & Makeup Studio</title>

  <meta name="description" content="Pabelo Unisex Salon is one of the best salons in Nagpur, Dighori and near Taj Bagh. We offer premium haircuts, hair colour, keratin treatment, hair spa, bridal makeup, facials, skincare, nail art and professional beauty services. Book your appointment today.">

  <meta name="keywords" content="Best Salon in Nagpur, Best Salon Near Me, Best Unisex Salon in Nagpur, Best Salon in Dighori, Best Salon in Dighori Nagpur, Best Salon in Taj Bagh Nagpur, Hair Salon Nagpur, Beauty Salon Nagpur, Bridal Makeup Nagpur, Hair Spa Nagpur, Hair Colour Specialist Nagpur, Keratin Treatment Nagpur, Hair Smoothening Nagpur, Hair Botox Nagpur, Facial Nagpur, Hydra Facial Nagpur, Nail Art Nagpur, Groom Makeup Nagpur, Men's Salon Nagpur, Women's Salon Nagpur, Beauty Academy Nagpur, Pabelo Unisex Salon">

  <meta name="robots" content="index, follow, max-image-preview:large">
  <meta name="author" content="Pabelo Unisex Salon">
  <meta name="theme-color" content="#EC008C">

  <link rel="canonical" href="https://pabelotheunisexsalon.com">

  <!-- Open Graph -->
  <meta property="og:type" content="website">
  <meta property="og:title" content="Pabelo Unisex Salon | Best Salon in Nagpur">
  <meta property="og:description" content="Luxury hair, beauty, bridal makeup, skincare and grooming services in Nagpur. Visit Pabelo Unisex Salon today.">
  <meta property="og:url" content="https://pabelotheunisexsalon.com">
  <meta property="og:image" content="https://pabelotheunisexsalon.com/assets/images/og-image.jpg">
  <meta property="og:site_name" content="Pabelo Unisex Salon">

  <!-- Twitter -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Pabelo Unisex Salon | Best Salon in Nagpur">
  <meta name="twitter:description" content="Premium hair, beauty, bridal makeup and skincare services in Nagpur.">
  <meta name="twitter:image" content="https://pabelotheunisexsalon.com/assets/images/og-image.jpg">
  
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
</head>
<body>

<!-- ===== TOP NAV ===== -->
<header class="fixed top-0 w-full z-50 glass border-b border-white/5">
  <div class="max-w-7xl mx-auto px-6 md:px-12 flex items-center justify-between h-20">
    <div class="flex items-center gap-3">
      <img src="{{ asset('assets/imges/pablo.png') }}" alt="Pabelo Logo" class="h-12 md:h-24 w-auto object-contain" />
    </div>
    <nav class="hidden md:flex items-center gap-8">
      <a href="{{ route('home') }}" class="text-sm font-medium uppercase tracking-[0.15em] text-[#D4AF37] hover:text-[#EC008C] transition border-b border-[#D4AF37]/40">Home</a>
      <a href="{{ route('services') }}" class="text-sm font-medium uppercase tracking-[0.15em] text-[#a98892] hover:text-[#EC008C] transition">Services</a>
      <!-- About link added in header -->
      <a href="{{ route('about') }}" class="text-sm font-medium uppercase tracking-[0.15em] text-[#a98892] hover:text-[#EC008C] transition">About</a>
      <a href="{{ route('contact') }}" class="text-sm font-medium uppercase tracking-[0.15em] text-[#a98892] hover:text-[#EC008C] transition">Contact</a>
    </nav>
    <button id="bookNowBtn" class="bg-[#EC008C] text-white px-7 py-2.5 rounded-full text-xs font-bold uppercase tracking-widest shadow-lg shadow-[#EC008C]/20 hover:brightness-110 transition active:scale-95">
      Book Now
    </button>
  </div>
</header>

<main class="pt-20">

  <!-- ===== HERO ===== -->
  <section class="relative h-[90vh] md:h-screen w-full overflow-hidden">
    <div class="absolute inset-0">
      <div class="hero-slide"><img src="https://images.unsplash.com/photo-1560066984-138dadb4c035?w=1600&q=80" alt="Salon interior" class="w-full h-full object-cover" /></div>
      <div class="hero-slide"><img src="https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?w=1600&q=80" alt="Hair styling" class="w-full h-full object-cover" /></div>
      <div class="hero-slide"><img src="https://images.unsplash.com/photo-1580618672591-eb180b1a973f?w=1600&q=80" alt="Academy training" class="w-full h-full object-cover" /></div>
      <div class="absolute inset-0 bg-gradient-to-t from-[#050505] via-[#050505]/40 to-[#050505]/20 z-10"></div>
      <div class="absolute inset-0 bg-gradient-to-r from-[#050505]/70 via-transparent to-[#050505]/30 z-10"></div>
    </div>
    <div class="relative z-20 max-w-7xl mx-auto px-6 md:px-12 h-full flex flex-col justify-center items-center text-center">
      <span class="text-[#D4AF37] text-xs font-bold uppercase tracking-[0.3em] mb-4">Est. 2022</span>
      <h1 class="hero-title font-['Playfair_Display'] text-5xl md:text-7xl font-bold text-white leading-tight max-w-4xl">
        Pabelo Unisex Salon <br /><span class="text-[#EC008C] italic">Premium Hair, Beauty & Bridal Studio.</span>
      </h1>
      <p class="hero-sub text-lg md:text-xl text-[#e2bdc8] max-w-2xl mt-6 mb-10 font-light">
       Transform your look with expert hairstylists, professional makeup artists and advanced beauty treatments. Experience premium salon services designed for both women and men.
      </p>
      <div class="flex flex-col sm:flex-row gap-4">
        <button id="heroBookBtn" class="bg-[#EC008C] text-white px-10 py-4 rounded-full font-bold text-sm uppercase tracking-widest shadow-2xl shadow-[#EC008C]/30 hover:brightness-110 transition active:scale-95">
          Book appointment
        </button>
        <button class="border border-[#D4AF37] text-[#D4AF37] px-10 py-4 rounded-full font-bold text-sm uppercase tracking-widest hover:bg-[#D4AF37]/10 transition active:scale-95">
          Explore academy
        </button>
      </div>
    </div>
  </section>

  <!-- ===== LOGO STRIP ===== -->
  <div class="bg-[#0e0e0e] border-y border-white/5 py-6 overflow-hidden">
    <div class="flex items-center gap-16 animate-scroll whitespace-nowrap w-max">
      <span class="text-2xl font-bold uppercase tracking-widest text-white/30">L'ORÉAL</span>
      <span class="text-2xl font-bold uppercase tracking-widest text-white/30">KÉRASTASE</span>
      <span class="text-2xl font-bold uppercase tracking-widest text-white/30">DYSON</span>
      <span class="text-2xl font-bold uppercase tracking-widest text-white/30">OLAPLEX</span>
      <span class="text-2xl font-bold uppercase tracking-widest text-white/30">WELLA</span>
      <span class="text-2xl font-bold uppercase tracking-widest text-white/30">MAC</span>
      <span class="text-2xl font-bold uppercase tracking-widest text-white/30">L'ORÉAL</span>
      <span class="text-2xl font-bold uppercase tracking-widest text-white/30">KÉRASTASE</span>
      <span class="text-2xl font-bold uppercase tracking-widest text-white/30">DYSON</span>
      <span class="text-2xl font-bold uppercase tracking-widest text-white/30">OLAPLEX</span>
      <span class="text-2xl font-bold uppercase tracking-widest text-white/30">WELLA</span>
      <span class="text-2xl font-bold uppercase tracking-widest text-white/30">MAC</span>
    </div>
  </div>

  <!-- ===== SERVICES ===== -->
  <section id="services" class="py-20 px-6 md:px-12 bg-[#0e0e0e]">
    <div class="max-w-7xl mx-auto">
      <div class="flex flex-wrap justify-between items-end mb-12">
        <div>
          <span class="text-[#EC008C] text-xs font-bold uppercase tracking-[0.2em]">Our Craft</span>
          <h2 class="font-['Playfair_Display'] text-4xl md:text-5xl text-white mt-1">Artistry in Every Detail</h2>
          <p class="text-[#a98892] text-lg mt-2">Curated salon experiences tailored to your identity.</p>
        </div>
        <a href="#" class="text-[#D4AF37] font-bold text-sm uppercase tracking-widest flex items-center gap-2 hover:gap-4 transition-all mt-4 md:mt-0">
          Full menu <span class="material-symbols-outlined text-sm">arrow_forward</span>
        </a>
      </div>
      <div class="grid md:grid-cols-12 gap-6 md:h-[520px]">
        <div class="md:col-span-8 relative group rounded-2xl overflow-hidden gold-border-hover border border-white/5">
          <img src="https://images.unsplash.com/photo-1562322140-8baeececf3df?w=800&q=80" alt="Hair design" class="w-full h-full object-cover group-hover:scale-105 transition duration-700" />
          <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
          <div class="absolute bottom-0 left-0 p-8">
            <span class="text-[#EC008C] text-xs font-bold uppercase tracking-widest">Salon Mastery</span>
            <h3 class="text-3xl font-['Playfair_Display'] text-white mt-1">Precision Hair Design</h3>
            <p class="text-[#e2bdc8] max-w-sm mt-2 opacity-0 group-hover:opacity-100 transition duration-500">Architectural cuts to high-fidelity color transformations.</p>
            <button class="mt-4 bg-white/10 backdrop-blur border border-white/20 text-white px-6 py-2 rounded-full text-sm font-bold uppercase tracking-widest hover:bg-[#EC008C] hover:border-[#EC008C] transition">Explore</button>
          </div>
        </div>
        <div class="md:col-span-4 grid grid-rows-2 gap-6">
          <div class="relative group rounded-2xl overflow-hidden gold-border-hover border border-white/5">
            <img src="https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?w=600&q=80" alt="Skin" class="w-full h-full object-cover group-hover:scale-105 transition duration-700" />
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
            <div class="absolute bottom-0 left-0 p-6">
              <h4 class="text-xl font-bold text-white">Skin Rejuvenation</h4>
              <p class="text-[#e2bdc8] text-sm">Advanced clinical aesthetics.</p>
            </div>
          </div>
          <div class="relative group rounded-2xl overflow-hidden gold-border-hover border border-white/5">
            <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?w=600&q=80" alt="Makeup" class="w-full h-full object-cover group-hover:scale-105 transition duration-700" />
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
            <div class="absolute bottom-0 left-0 p-6">
              <h4 class="text-xl font-bold text-white">Couture Makeup</h4>
              <p class="text-[#e2bdc8] text-sm">Red carpet &amp; bridal excellence.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== EXPERIENCE ===== -->
  <section id="experience" class="py-20 px-6 md:px-12 bg-[#050505]">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-16">
        <span class="text-[#EC008C] text-xs font-bold uppercase tracking-[0.3em]">Our Signature Ritual</span>
        <h2 class="font-['Playfair_Display'] text-4xl md:text-5xl text-white mt-2">The Pabelo Experience</h2>
      </div>
      <div class="grid md:grid-cols-4 gap-8">
        <div class="text-center group"><div class="w-16 h-16 mx-auto rounded-full bg-white/5 border border-[#EC008C]/30 flex items-center justify-center group-hover:bg-[#EC008C] transition mb-5"><span class="material-symbols-outlined text-white">local_bar</span></div><h4 class="text-xl font-bold text-white">Welcome Ritual</h4><p class="text-[#a98892] text-sm mt-2">Aromatherapy &amp; artisanal drinks.</p></div>
        <div class="text-center group"><div class="w-16 h-16 mx-auto rounded-full bg-white/5 border border-[#EC008C]/30 flex items-center justify-center group-hover:bg-[#EC008C] transition mb-5"><span class="material-symbols-outlined text-white">forum</span></div><h4 class="text-xl font-bold text-white">Deep Consult</h4><p class="text-[#a98892] text-sm mt-2">One-on-one with master artists.</p></div>
        <div class="text-center group"><div class="w-16 h-16 mx-auto rounded-full bg-white/5 border border-[#EC008C]/30 flex items-center justify-center group-hover:bg-[#EC008C] transition mb-5"><span class="material-symbols-outlined text-white">content_cut</span></div><h4 class="text-xl font-bold text-white">Technical Mastery</h4><p class="text-[#a98892] text-sm mt-2">Precision with world-class tools.</p></div>
        <div class="text-center group"><div class="w-16 h-16 mx-auto rounded-full bg-white/5 border border-[#EC008C]/30 flex items-center justify-center group-hover:bg-[#EC008C] transition mb-5"><span class="material-symbols-outlined text-white">auto_awesome</span></div><h4 class="text-xl font-bold text-white">The Reveal</h4><p class="text-[#a98892] text-sm mt-2">Final transformation &amp; aftercare.</p></div>
      </div>
    </div>
  </section>

  <!-- ===== GALLERY ===== -->
  <section class="py-20 px-6 md:px-12 bg-[#0e0e0e]">
    <div class="max-w-7xl mx-auto">
      <div class="flex flex-wrap justify-between items-end mb-10">
        <div><span class="text-[#D4AF37] text-xs font-bold uppercase tracking-[0.2em]">Our Atelier</span><h2 class="font-['Playfair_Display'] text-4xl md:text-5xl text-white">Industrial Luxe Space</h2></div>
        <div class="flex gap-3 mt-4 md:mt-0"><button class="w-11 h-11 rounded-full border border-white/10 flex items-center justify-center hover:bg-[#EC008C] transition"><span class="material-symbols-outlined text-sm">chevron_left</span></button><button class="w-11 h-11 rounded-full border border-white/10 flex items-center justify-center hover:bg-[#EC008C] transition"><span class="material-symbols-outlined text-sm">chevron_right</span></button></div>
      </div>
      <div class="flex gap-5 overflow-x-auto no-scrollbar snap-x">
        <div class="min-w-[280px] md:min-w-[420px] h-72 rounded-2xl overflow-hidden snap-center relative group flex-shrink-0"><img src="{{ asset('assets/imges/gallery/1.jpeg') }}" alt="Hair Treatment" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" /><div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center"><span class="text-white font-bold tracking-widest">HAIR TREATMENT</span></div></div>
        <div class="min-w-[280px] md:min-w-[420px] h-72 rounded-2xl overflow-hidden snap-center relative group flex-shrink-0"><img src="{{ asset('assets/imges/gallery/2.jpeg') }}" alt="Hair Styling" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" /><div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center"><span class="text-white font-bold tracking-widest">HAIR STYLING</span></div></div>
        <div class="min-w-[280px] md:min-w-[420px] h-72 rounded-2xl overflow-hidden snap-center relative group flex-shrink-0"><img src="{{ asset('assets/imges/gallery/3.jpeg') }}" alt="Beauty Services" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" /><div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center"><span class="text-white font-bold tracking-widest">BEAUTY SERVICES</span></div></div>
        <div class="min-w-[280px] md:min-w-[420px] h-72 rounded-2xl overflow-hidden snap-center relative group flex-shrink-0"><img src="{{ asset('assets/imges/gallery/4.jpeg') }}" alt="Men's Grooming" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" /><div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center"><span class="text-white font-bold tracking-widest">MEN'S GROOMING</span></div></div>
        <div class="min-w-[280px] md:min-w-[420px] h-72 rounded-2xl overflow-hidden snap-center relative group flex-shrink-0"><img src="{{ asset('assets/imges/gallery/5.jpeg') }}" alt="Salon Exterior" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" /><div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center"><span class="text-white font-bold tracking-widest">SALON EXTERIOR</span></div></div>
      </div>
    </div>
  </section>

  <!-- ===== ACADEMY ===== -->
  <section id="academy" class="py-20 px-6 md:px-12 bg-[#050505] relative">
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-12 items-center">
      <div>
        <span class="text-[#EC008C] text-xs font-bold uppercase tracking-[0.3em]">Pabelo Academy</span>
        <h2 class="font-['Playfair_Display'] text-4xl md:text-6xl text-white leading-tight mt-2">Master the Craft. <br /><span class="text-[#D4AF37]">Build your Legacy.</span></h2>
        <div class="space-y-6 mt-10">
          <div class="flex gap-4"><div class="w-12 h-12 rounded-full bg-white/5 border border-[#D4AF37] flex items-center justify-center flex-shrink-0"><span class="material-symbols-outlined text-[#D4AF37]">school</span></div><div><h4 class="text-lg font-bold text-white">Accredited Curriculum</h4><p class="text-[#a98892]">Globally recognized certifications.</p></div></div>
          <div class="flex gap-4"><div class="w-12 h-12 rounded-full bg-white/5 border border-[#EC008C] flex items-center justify-center flex-shrink-0"><span class="material-symbols-outlined text-[#EC008C]">precision_manufacturing</span></div><div><h4 class="text-lg font-bold text-white">Live Industry Projects</h4><p class="text-[#a98892]">Train in a luxury salon environment.</p></div></div>
        </div>
        <button class="bg-[#D4AF37] text-black font-bold px-10 py-4 rounded-full text-sm uppercase tracking-widest mt-8 hover:brightness-110 transition active:scale-95">Download Prospectus</button>
      </div>
      <div class="glass-card p-4 rounded-3xl">
        <div class="aspect-video rounded-2xl overflow-hidden relative border border-white/5">
          <img src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=800&q=80" alt="Academy training" class="w-full h-full object-cover" />
          <div class="absolute inset-0 flex items-center justify-center group cursor-pointer"><div class="w-20 h-20 rounded-full bg-[#EC008C]/90 flex items-center justify-center group-hover:scale-110 transition shadow-xl"><span class="material-symbols-outlined text-white text-5xl">play_arrow</span></div></div>
        </div>
        <div class="flex justify-between items-center mt-4 px-2"><div><p class="text-xs font-bold uppercase text-white">Virtual Tour</p><p class="text-[#a98892] text-sm">Explore our facilities</p></div><span class="text-[#EC008C] font-bold">2:45</span></div>
      </div>
    </div>
  </section>

  <!-- ===== TESTIMONIALS ===== -->
  <section id="testimonials" class="py-20 px-6 md:px-12 bg-[#0e0e0e]">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-14"><h2 class="font-['Playfair_Display'] text-4xl md:text-5xl text-white italic underline decoration-[#EC008C] underline-offset-8">Client Wall of Fame</h2><p class="text-[#a98892] text-lg mt-2">Voices of transformation from our valued patrons.</p></div>
      <div class="grid md:grid-cols-3 gap-8">
        <div class="glass-card p-8 rounded-2xl border-l-4 border-[#EC008C]"><div class="flex items-center gap-2 mb-5"><span class="material-symbols-outlined text-[#D4AF37]">star</span><span class="material-symbols-outlined text-[#D4AF37]">star</span><span class="material-symbols-outlined text-[#D4AF37]">star</span><span class="material-symbols-outlined text-[#D4AF37]">star</span><span class="material-symbols-outlined text-[#D4AF37]">star</span><span class="bg-[#EC008C]/10 text-[#EC008C] text-[10px] font-bold px-2 py-0.5 rounded ml-2 flex items-center"><span class="material-symbols-outlined text-[12px]">verified</span> VERIFIED</span></div><p class="text-[#e5e2e1] italic leading-relaxed mb-8">"The transformation was beyond my expectations. The attention to detail makes every visit special."</p><div class="flex items-center gap-4"><img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&q=80" alt="Aria" class="w-12 h-12 rounded-full object-cover border-2 border-[#EC008C]/30" /><div><p class="text-white font-bold">Aria Sharma</p><p class="text-[#a98892] text-xs uppercase">Fashion Designer</p></div></div></div>
        <div class="glass-card p-8 rounded-2xl border-l-4 border-[#D4AF37]"><div class="flex items-center gap-2 mb-5"><span class="material-symbols-outlined text-[#D4AF37]">star</span><span class="material-symbols-outlined text-[#D4AF37]">star</span><span class="material-symbols-outlined text-[#D4AF37]">star</span><span class="material-symbols-outlined text-[#D4AF37]">star</span><span class="material-symbols-outlined text-[#D4AF37]">star</span><span class="bg-[#D4AF37]/10 text-[#D4AF37] text-[10px] font-bold px-2 py-0.5 rounded ml-2 flex items-center"><span class="material-symbols-outlined text-[12px]">verified</span> VERIFIED</span></div><p class="text-[#e5e2e1] italic leading-relaxed mb-8">"The Pabelo Academy gave me the technical edge I needed. The mentors are true masters."</p><div class="flex items-center gap-4"><img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&q=80" alt="Vikram" class="w-12 h-12 rounded-full object-cover border-2 border-[#D4AF37]/30" /><div><p class="text-white font-bold">Vikram Malhotra</p><p class="text-[#a98892] text-xs uppercase">Academy Alumni</p></div></div></div>
        <div class="glass-card p-8 rounded-2xl border-l-4 border-[#EC008C]"><div class="flex items-center gap-2 mb-5"><span class="material-symbols-outlined text-[#D4AF37]">star</span><span class="material-symbols-outlined text-[#D4AF37]">star</span><span class="material-symbols-outlined text-[#D4AF37]">star</span><span class="material-symbols-outlined text-[#D4AF37]">star</span><span class="material-symbols-outlined text-[#D4AF37]">star</span><span class="bg-[#EC008C]/10 text-[#EC008C] text-[10px] font-bold px-2 py-0.5 rounded ml-2 flex items-center"><span class="material-symbols-outlined text-[12px]">verified</span> VERIFIED</span></div><p class="text-[#e5e2e1] italic leading-relaxed mb-8">"The best bridal makeup experience in the city. They understood my vision perfectly."</p><div class="flex items-center gap-4"><img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&q=80" alt="Riya" class="w-12 h-12 rounded-full object-cover border-2 border-[#EC008C]/30" /><div><p class="text-white font-bold">Riya Kapoor</p><p class="text-[#a98892] text-xs uppercase">Happy Bride</p></div></div></div>
      </div>
    </div>
  </section>

  <!-- ===== NEW SECTION: IMAGE + FORM (before footer) ===== -->
  <section class="py-20 px-6 md:px-12 bg-[#0e0e0e] border-t border-white/5">
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-12 items-center">
      <!-- left image -->
      <div class="rounded-3xl overflow-hidden shadow-2xl shadow-black/50">
        <img src="https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?w=800&q=80" alt="Salon experience" class="w-full h-full object-cover max-h-[420px] md:max-h-[500px] w-full" />
      </div>
      <!-- right form -->
      <div class="glass-card p-8 md:p-10 rounded-3xl border border-white/5">
        <div class="flex items-center gap-2 mb-2">
          <span class="text-[#D4AF37] text-xs font-bold uppercase tracking-[0.2em]">Get in touch</span>
          <span class="w-8 h-px bg-[#D4AF37]/40"></span>
        </div>
        <h3 class="font-['Playfair_Display'] text-3xl md:text-4xl text-white mb-2">Let’s create <br /><span class="text-[#EC008C]">your next look</span></h3>
        <p class="text-[#a98892] text-sm mb-6">Fill in the details and we’ll reach out within 2 hours.</p>
        <form class="footer-form space-y-4">
          <div>
            <input type="text" placeholder="Full name" required class="w-full" />
          </div>
          <div>
            <input type="tel" placeholder="Phone number" required class="w-full" />
          </div>
          <div>
            <input type="email" placeholder="Email address" class="w-full" />
          </div>
          <div>
            <textarea placeholder="Tell us about your vision…" class="w-full"></textarea>
          </div>
          <button type="submit" class="w-full md:w-auto">Send message</button>
          <p class="text-[10px] text-[#666] mt-2">We respect your privacy. No spam.</p>
        </form>
      </div>
    </div>
  </section>

</main>

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

</body>
</html>