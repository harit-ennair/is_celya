<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sì Celya — Institut de beauté premium à Casablanca. Coiffure, soins du visage, manucure russe, épilation et maquillage haute précision.">
    <title>Sì Celya — Institut de Beauté</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cormorant-garamond:300,400,500,600,700|plus-jakarta-sans:300,400,500,600,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ─── Light-theme overrides ─── */
        .glass-nav-light {
            background: rgba(250, 247, 242, 0.92);
            backdrop-filter: blur(20px) saturate(1.6);
            -webkit-backdrop-filter: blur(20px) saturate(1.6);
        }

        /* Hero image mask — soft fade on the left */
        .hero-image-mask {
            -webkit-mask-image: linear-gradient(to right, transparent 0%, black 8%);
            mask-image: linear-gradient(to right, transparent 0%, black 8%);
        }

        /* Warm card shadow */
        .card-warm {
            box-shadow: 0 4px 24px rgba(59, 10, 18, 0.06);
            transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94), box-shadow 0.4s ease;
        }
        .card-warm:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 48px rgba(59, 10, 18, 0.10);
        }

        /* Service badge */
        .service-badge {
            background: rgba(250, 247, 242, 0.92);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        /* Video play button */
        .video-play-btn {
            transition: transform 0.3s ease, opacity 0.3s ease;
        }
        .group:hover .video-play-btn {
            transform: scale(1.1);
        }

        /* Staggered reveal for children */
        .reveal-stagger > * {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        .reveal-stagger.revealed > *:nth-child(1) { transition-delay: 0.05s; }
        .reveal-stagger.revealed > *:nth-child(2) { transition-delay: 0.12s; }
        .reveal-stagger.revealed > *:nth-child(3) { transition-delay: 0.19s; }
        .reveal-stagger.revealed > *:nth-child(4) { transition-delay: 0.26s; }
        .reveal-stagger.revealed > *:nth-child(5) { transition-delay: 0.33s; }
        .reveal-stagger.revealed > *:nth-child(6) { transition-delay: 0.40s; }
        .reveal-stagger.revealed > * {
            opacity: 0;
            transform: translateY(20px);
        }
        .reveal-stagger.revealed > * {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body class="bg-cream text-ink antialiased font-sans overflow-x-hidden">

    {{-- ═══════════════════════════════════════════════════════════
       NAVIGATION
    ═══════════════════════════════════════════════════════════ --}}
    <nav id="main-nav" class="fixed top-0 inset-x-0 z-50 glass-nav-light shadow-sm">
        <div class="max-w-[1400px] mx-auto px-6 lg:px-10 flex items-center justify-between h-[72px]">
            {{-- Logo --}}
            <a href="/" class="flex items-center gap-3" id="nav-logo">
                <img src="{{ asset('images/logo.jpg') }}" alt="Sì Celya" class="h-10 w-auto rounded-md">
            </a>

            {{-- Desktop links --}}
            <div class="hidden md:flex items-center gap-10">
                <a href="#services" class="text-ink-soft hover:text-burgundy text-sm tracking-wide transition-colors duration-300 hover-underline">Nos Services</a>
                <a href="#galerie" class="text-ink-soft hover:text-burgundy text-sm tracking-wide transition-colors duration-300 hover-underline">Galerie</a>
                <a href="#produits" class="text-ink-soft hover:text-burgundy text-sm tracking-wide transition-colors duration-300 hover-underline">Produits</a>
                <a href="#contact" class="text-ink-soft hover:text-burgundy text-sm tracking-wide transition-colors duration-300 hover-underline">Contact</a>
            </div>

            {{-- CTA --}}
            <a href="#contact" id="nav-cta" class="hidden md:inline-flex items-center gap-2 px-6 py-2.5 bg-burgundy text-cream text-sm tracking-wider hover:bg-burgundy-light transition-all duration-300 rounded-full">
                Réserver
            </a>

            {{-- Mobile hamburger --}}
            <button id="mobile-menu-btn" class="md:hidden text-ink-soft hover:text-burgundy transition-colors" aria-label="Menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        {{-- Mobile menu --}}
        <div id="mobile-menu" class="md:hidden hidden bg-cream/95 backdrop-blur-xl border-t border-sand-deep/50">
            <div class="px-6 py-6 flex flex-col gap-4">
                <a href="#services" class="text-ink-soft hover:text-burgundy text-base tracking-wide transition-colors">Nos Services</a>
                <a href="#galerie" class="text-ink-soft hover:text-burgundy text-base tracking-wide transition-colors">Galerie</a>
                <a href="#produits" class="text-ink-soft hover:text-burgundy text-base tracking-wide transition-colors">Produits</a>
                <a href="#contact" class="inline-flex items-center justify-center px-6 py-3 bg-burgundy text-cream text-sm tracking-wider rounded-full hover:bg-burgundy-light transition-all mt-2">Réserver</a>
            </div>
        </div>
    </nav>

    {{-- ═══════════════════════════════════════════════════════════
       HERO — Split design: text left, model image right
    ═══════════════════════════════════════════════════════════ --}}
    <section id="hero" class="relative min-h-[100dvh] bg-sand flex items-center overflow-hidden">
        <div class="max-w-[1400px] mx-auto px-6 lg:px-10 w-full grid grid-cols-1 lg:grid-cols-2 gap-8 items-center pt-20 lg:pt-0">
            {{-- Left: Text content --}}
            <div class="relative z-10 py-10 lg:py-0">
                <p class="text-burgundy text-sm tracking-[0.2em] uppercase mb-4 animate-fade-in-up font-medium">Institut de Beauté</p>
                <h1 class="font-serif text-5xl md:text-6xl lg:text-7xl font-light text-ink leading-[1.08] mb-6 animate-fade-in-up" style="animation-delay: 0.1s">
                    Sublimez<br>
                    votre <span class="text-burgundy italic">beauté</span>
                </h1>
                <p class="text-ink-muted text-lg font-light leading-relaxed max-w-md mb-10 animate-fade-in-up" style="animation-delay: 0.25s">
                    Découvrez un univers de soins experts et de prestations sur-mesure dans un cadre d'exception.
                </p>
                <div class="flex flex-wrap items-center gap-4 animate-fade-in-up" style="animation-delay: 0.4s">
                    <a href="#contact" class="inline-flex items-center gap-3 px-8 py-4 bg-burgundy text-cream font-medium text-sm tracking-wider hover:bg-burgundy-light transition-all duration-300 rounded-full">
                        Prendre rendez-vous
                    </a>
                    <a href="#services" class="inline-flex items-center gap-2 px-6 py-4 text-ink-soft text-sm tracking-wide hover:text-burgundy transition-colors duration-300">
                        Nos services
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>

                {{-- Mini stats strip --}}
                <div class="flex items-center gap-8 mt-14 pt-8 border-t border-sand-deep animate-fade-in-up" style="animation-delay: 0.55s">
                    <div>
                        <span class="block text-burgundy font-serif text-2xl font-medium">{{ $services->count() }}+</span>
                        <span class="text-ink-faint text-xs tracking-wider uppercase mt-0.5 block">Prestations</span>
                    </div>
                    <div class="w-px h-10 bg-sand-deep"></div>
                    <div>
                        <span class="block text-burgundy font-serif text-2xl font-medium">{{ $serviceCategories->count() }}</span>
                        <span class="text-ink-faint text-xs tracking-wider uppercase mt-0.5 block">Univers</span>
                    </div>
                    <div class="w-px h-10 bg-sand-deep"></div>
                    <div>
                        <span class="block text-burgundy font-serif text-2xl font-medium">100%</span>
                        <span class="text-ink-faint text-xs tracking-wider uppercase mt-0.5 block">Sur-mesure</span>
                    </div>
                </div>
            </div>

            {{-- Right: Hero video --}}
            <div class="relative hidden lg:block h-[100dvh]">
                <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover object-center" poster="{{ asset('images/hero-model.jpeg') }}">
                    <source src="{{ asset('videos/hero-showcase.mp4') }}" type="video/mp4">
                </video>
            </div>

        </div>

        {{-- Mobile hero image --}}
        <div class="lg:hidden absolute inset-0 z-0 opacity-15">
            <img src="{{ asset('images/hero-model.jpeg') }}" alt="" class="w-full h-full object-cover">
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════════
       SECTION 1 : L'EXPÉRIENCE SÌ CELYA (Style Flaunter — Texte gauche, Collage décalé droite)
    ═══════════════════════════════════════════════════════════ --}}
    <section class="py-24 lg:py-36 bg-cream border-b border-sand-deep/30 overflow-hidden">
        <div class="max-w-[1400px] mx-auto px-6 lg:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                {{-- Left: Editorial narrative --}}
                <div class="lg:col-span-5 reveal">
                    <p class="text-burgundy text-xs font-semibold tracking-[0.25em] uppercase mb-4">L'Expérience Sì Celya</p>
                    <h2 class="font-serif text-4xl sm:text-5xl lg:text-[3.5rem] font-light text-ink leading-[1.08] mb-6">
                        Une approche singulière où l'excellence rencontre le <span class="italic text-burgundy">bien-être</span>.
                    </h2>
                    <p class="text-ink-muted text-base lg:text-lg leading-relaxed mb-8 max-w-lg">
                        Dans un écrin confidentiel au cœur de Casablanca, nos praticiennes expertes célèbrent votre éclat à travers des rituels sur-mesure, des techniques d'avant-garde et des soins d'exception.
                    </p>
                    <div class="flex flex-wrap items-center gap-6 pt-2">
                        <a href="#contact" class="inline-flex items-center justify-center px-8 py-4 bg-[#181415] hover:bg-burgundy text-cream text-xs font-semibold tracking-[0.18em] uppercase rounded-full transition-all duration-300 shadow-sm active:scale-[0.98]">
                            Prendre rendez-vous
                        </a>
                        <a href="#services" class="group inline-flex items-center gap-2.5 text-ink-soft hover:text-burgundy text-xs font-semibold tracking-[0.18em] uppercase transition-colors duration-300">
                            <span>Explorer nos rituels</span>
                            <span class="group-hover:translate-x-1.5 transition-transform duration-300">→</span>
                        </a>
                    </div>
                </div>

                {{-- Right: Staggered photo collage (Flaunter inspired) --}}
                <div class="lg:col-span-7 relative pt-6 lg:pt-0 reveal">
                    <div class="grid grid-cols-12 gap-4 sm:gap-6 items-start">
                        {{-- Top-right main portrait --}}
                        <div class="col-span-7 col-start-6 relative">
                            <div class="aspect-[3/4] rounded-2xl overflow-hidden editorial-shadow collage-item">
                                <img
                                    src="{{ asset('images/services/soin-anti-age.jpg') }}"
                                    alt="Soin haute précision Sì Celya"
                                    class="w-full h-full object-cover"
                                    loading="lazy"
                                >
                            </div>
                            {{-- Floating pill badge --}}
                            <div class="absolute -bottom-4 -left-6 bg-ivory/95 backdrop-blur-md px-5 py-3 rounded-full editorial-shadow border border-sand-deep/40 hidden sm:flex items-center gap-2.5 z-20">
                                <span class="w-2 h-2 rounded-full bg-burgundy"></span>
                                <span class="text-ink text-xs font-medium tracking-wider">Protocoles 100% sur-mesure</span>
                            </div>
                        </div>

                        {{-- Middle-left overlapping secondary image --}}
                        <div class="col-span-6 col-start-1 -mt-24 sm:-mt-36 relative z-10">
                            <div class="aspect-[4/5] rounded-2xl overflow-hidden editorial-shadow-lg collage-item">
                                <img
                                    src="{{ asset('images/services/manucure-russe.jpg') }}"
                                    alt="Manucure haute précision"
                                    class="w-full h-full object-cover"
                                    loading="lazy"
                                >
                            </div>
                        </div>

                        {{-- Bottom-right ambiance shot --}}
                        <div class="col-span-6 col-start-7 -mt-10 sm:-mt-16 relative">
                            <div class="aspect-[4/3] rounded-2xl overflow-hidden editorial-shadow collage-item">
                                <img
                                    src="{{ asset('images/salon-ambiance.jpg') }}"
                                    alt="Atmosphère Sì Celya"
                                    class="w-full h-full object-cover"
                                    loading="lazy"
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════════
       SECTION 2 : NOS UNIVERS DE SOINS (Style Flaunter — Collage & Vidéo gauche, Accordéon éditorial droite)
    ═══════════════════════════════════════════════════════════ --}}
    <section id="services" class="py-24 lg:py-36 bg-sand/40 border-b border-sand-deep/30 overflow-hidden">
        <div class="max-w-[1400px] mx-auto px-6 lg:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
                {{-- Left: Live video & photo collage --}}
                <div class="lg:col-span-6 relative reveal">
                    <div class="relative">
                        {{-- Featured atmospheric video --}}
                        <div class="w-[88%] rounded-2xl overflow-hidden editorial-shadow collage-item relative group">
                            <video autoplay muted loop playsinline class="w-full aspect-[4/5] object-cover">
                                <source src="{{ asset('videos/manucure-elegante.mp4') }}" type="video/mp4">
                            </video>
                            <div class="absolute inset-0 bg-gradient-to-t from-ink/50 via-transparent to-transparent pointer-events-none"></div>
                            <div class="absolute bottom-5 left-5 right-5 flex items-center justify-between text-cream pointer-events-none">
                                <span class="font-serif text-lg tracking-wide">La Haute Précision du Geste</span>
                                <span class="text-xs tracking-widest uppercase opacity-80">En direct</span>
                            </div>
                        </div>

                        {{-- Overlapping detail photo --}}
                        <div class="w-[58%] absolute -bottom-10 right-0 z-10">
                            <div class="aspect-[4/3] rounded-2xl overflow-hidden editorial-shadow-lg collage-item border-2 border-ivory">
                                <img
                                    src="{{ asset('images/services/soin-capillaire.jpg') }}"
                                    alt="Soin capillaire d'exception"
                                    class="w-full h-full object-cover"
                                    loading="lazy"
                                >
                            </div>
                        </div>
                    </div>

                    {{-- Small decorative note below --}}
                    <div class="mt-16 pt-4 max-w-sm">
                        <p class="text-ink-muted text-xs uppercase tracking-[0.2em] font-medium">✦ Des rituels exclusifs</p>
                        <p class="text-ink-soft text-sm mt-1 leading-relaxed">
                            Chaque soin est réalisé avec des produits de renommée internationale pour un résultat immédiat et durable.
                        </p>
                    </div>
                </div>

                {{-- Right: Editorial categories & services accordion --}}
                <div class="lg:col-span-6 reveal">
                    <p class="text-burgundy text-xs font-semibold tracking-[0.25em] uppercase mb-4">Nos Univers</p>
                    <h2 class="font-serif text-4xl sm:text-5xl font-light text-ink leading-[1.12] mb-6">
                        Des cartes de soins pensées pour sublimer <span class="italic text-burgundy">chaque instant</span>.
                    </h2>
                    <p class="text-ink-muted text-base leading-relaxed mb-10">
                        Explorez nos univers et déroulez chaque catégorie pour découvrir le détail de nos prestations et leurs tarifs.
                    </p>

                    {{-- Editorial Accordion List --}}
                    <div class="divide-y divide-sand-deep/80 border-y border-sand-deep/80">
                        @foreach ($serviceCategories->take(6) as $index => $category)
                            <div class="py-5 group cursor-pointer service-accordion-item"
                                 onclick="toggleAccordion(this)">
                                <div class="flex items-center justify-between gap-4">
                                    <div class="flex items-baseline gap-4">
                                        <span class="text-xs font-mono text-ink-faint tracking-wider">0{{ $index + 1 }}</span>
                                        <h3 class="font-serif text-xl sm:text-2xl font-normal text-ink group-hover:text-burgundy transition-colors duration-300">
                                            {{ $category->name }}
                                        </h3>
                                    </div>
                                    <div class="flex items-center gap-4 flex-shrink-0">
                                        <span class="text-xs font-medium text-ink-muted hidden sm:inline-block">
                                            Dès {{ number_format($category->services->min('price'), 0) }} DH
                                        </span>
                                        <div class="w-8 h-8 rounded-full bg-cream flex items-center justify-center group-hover:bg-[#181415] transition-colors duration-300">
                                            <svg class="w-3.5 h-3.5 text-ink group-hover:text-cream transition-transform duration-300 chevron-accordion" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                {{-- Expandable Drawer --}}
                                <div class="accordion-drawer max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                                    <div class="pt-5 pb-2 pl-8 space-y-3">
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                            @foreach ($category->services as $service)
                                                <div class="flex items-center justify-between p-3 rounded-xl bg-ivory/80 border border-sand-deep/40 text-xs">
                                                    <span class="text-ink font-medium">{{ $service->name }}</span>
                                                    <span class="text-burgundy font-semibold ml-3">{{ number_format($service->price, 0) }} DH</span>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="pt-2 flex justify-end">
                                            <a href="#contact" class="inline-flex items-center gap-1.5 text-xs text-burgundy font-semibold hover:underline">
                                                <span>Réserver dans cet univers</span>
                                                <span>→</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Bottom action --}}
                    <div class="mt-10 flex flex-wrap items-center gap-6">
                        <a href="#contact" class="inline-flex items-center justify-center px-8 py-4 bg-[#181415] hover:bg-burgundy text-cream text-xs font-semibold tracking-[0.18em] uppercase rounded-full transition-all duration-300 shadow-sm">
                            Prendre rendez-vous
                        </a>
                        <a href="#galerie" class="group inline-flex items-center gap-2 text-ink-soft hover:text-burgundy text-xs font-semibold tracking-[0.18em] uppercase transition-colors duration-300">
                            <span>Voir les coulisses</span>
                            <span class="group-hover:translate-x-1.5 transition-transform duration-300">→</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════════
       SECTION 3 : EN COULISSES & GESTUELLE (Galerie Vidéo Éditoriale)
    ═══════════════════════════════════════════════════════════ --}}
    <section id="galerie" class="py-24 lg:py-36 bg-cream border-b border-sand-deep/30 overflow-hidden">
        <div class="max-w-[1400px] mx-auto px-6 lg:px-10">
            {{-- Header --}}
            <div class="max-w-2xl mb-16 reveal">
                <p class="text-burgundy text-xs font-semibold tracking-[0.25em] uppercase mb-4">En Coulisses</p>
                <h2 class="font-serif text-4xl sm:text-5xl font-light text-ink leading-tight">
                    L'exigence du geste au cœur d'une <span class="italic text-burgundy">atmosphère feutrée</span>.
                </h2>
                <p class="text-ink-muted text-base mt-4">
                    Poussez les portes de notre institut et plongez dans l'art de nos soins capturés sur le vif.
                </p>
            </div>

            {{-- Asymmetric editorial showcase (Flaunter style) --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch reveal">
                {{-- Main prominent video (Left) --}}
                <div class="lg:col-span-7 relative group rounded-3xl overflow-hidden editorial-shadow-lg">
                    <video muted loop playsinline class="w-full h-full min-h-[420px] lg:min-h-[580px] object-cover cursor-pointer"
                           onclick="this.paused ? this.play() : this.pause()"
                           onmouseenter="this.play()" onmouseleave="this.pause()">
                        <source src="{{ asset('videos/soin-visage.mp4') }}" type="video/mp4">
                    </video>
                    <div class="absolute inset-0 bg-gradient-to-t from-ink/70 via-transparent to-transparent pointer-events-none"></div>
                    <div class="absolute bottom-8 left-8 right-8 flex items-end justify-between pointer-events-none text-cream">
                        <div>
                            <span class="text-xs tracking-[0.2em] uppercase opacity-80 block mb-1">Rituel Visage</span>
                            <h4 class="font-serif text-2xl sm:text-3xl font-light">Soin Éclat & Jeunesse</h4>
                        </div>
                        <div class="w-12 h-12 rounded-full bg-ivory/90 backdrop-blur-md flex items-center justify-center text-burgundy opacity-90 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-5 h-5 ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>
                </div>

                {{-- Stacked companion items (Right) --}}
                <div class="lg:col-span-5 flex flex-col justify-between gap-8">
                    {{-- Secondary video --}}
                    <div class="relative group rounded-3xl overflow-hidden editorial-shadow aspect-[16/10] sm:aspect-[16/9]">
                        <video muted loop playsinline class="w-full h-full object-cover cursor-pointer"
                               onclick="this.paused ? this.play() : this.pause()"
                               onmouseenter="this.play()" onmouseleave="this.pause()">
                            <source src="{{ asset('videos/si-celya-intro.mp4') }}" type="video/mp4">
                        </video>
                        <div class="absolute inset-0 bg-gradient-to-t from-ink/60 via-transparent to-transparent pointer-events-none"></div>
                        <div class="absolute bottom-6 left-6 right-6 flex items-end justify-between pointer-events-none text-cream">
                            <div>
                                <span class="text-xs tracking-[0.2em] uppercase opacity-80 block">Signature</span>
                                <h4 class="font-serif text-xl font-light">L'Art des Ongles</h4>
                            </div>
                            <div class="w-10 h-10 rounded-full bg-ivory/90 backdrop-blur-md flex items-center justify-center text-burgundy opacity-90 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-4 h-4 ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                        </div>
                    </div>

                    {{-- Tertiary photo + atmospheric testimonial --}}
                    <div class="p-8 sm:p-10 rounded-3xl bg-ivory editorial-shadow border border-sand-deep/40 flex flex-col justify-between flex-1">
                        <div>
                            <span class="text-burgundy text-xs font-semibold tracking-[0.25em] uppercase block mb-3">L'Institut</span>
                            <blockquote class="font-serif text-2xl sm:text-3xl font-light text-ink leading-snug italic mb-4">
                                "Un lieu pensé comme un sanctuaire de sérénité et de beauté absolue."
                            </blockquote>
                        </div>
                        <div class="pt-6 border-t border-sand-deep/50 flex items-center justify-between">
                            <span class="text-xs text-ink-muted tracking-wider uppercase">Casablanca · Maroc</span>
                            <a href="#contact" class="text-xs font-semibold text-burgundy hover:underline tracking-wider uppercase">Nous rendre visite →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════════
       SECTION 4 : CITATION HAUTE COUTURE
    ═══════════════════════════════════════════════════════════ --}}
    <section class="py-20 lg:py-28 bg-sand/30 border-b border-sand-deep/30 relative overflow-hidden">
        <div class="max-w-[1000px] mx-auto px-6 text-center reveal">
            <span class="text-burgundy/60 text-xs tracking-[0.3em] uppercase block mb-6 font-semibold">Devise</span>
            <blockquote class="font-serif text-3xl sm:text-4xl lg:text-5xl font-light text-ink leading-snug italic">
                "La beauté commence au moment où vous décidez d'être vous-même."
            </blockquote>
            <footer class="mt-8 text-ink-muted text-xs tracking-[0.25em] uppercase font-medium">Coco Chanel</footer>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════════
       SECTION 5 : CURATION BEAUTÉ (Produits d'exception)
    ═══════════════════════════════════════════════════════════ --}}
    <section id="produits" class="py-24 lg:py-36 bg-cream border-b border-sand-deep/30 overflow-hidden">
        <div class="max-w-[1400px] mx-auto px-6 lg:px-10">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-16 reveal">
                <div>
                    <p class="text-burgundy text-xs font-semibold tracking-[0.25em] uppercase mb-4">La Boutique</p>
                    <h2 class="font-serif text-4xl sm:text-5xl font-light text-ink leading-tight">
                        Curation <span class="italic text-burgundy">Beauté</span>
                    </h2>
                    <p class="text-ink-muted text-base mt-3 max-w-md">
                        Une sélection exclusive de soins professionnels pour prolonger l'expérience de l'institut chez vous.
                    </p>
                </div>
                <div class="mt-6 md:mt-0">
                    <a href="#contact" class="inline-flex items-center gap-2 text-xs font-semibold text-burgundy hover:text-burgundy-light tracking-[0.18em] uppercase">
                        <span>Commander ou se renseigner</span>
                        <span>→</span>
                    </a>
                </div>
            </div>

            @if ($featuredProducts->count() > 0)
                @php
                    $productImages = [
                        'creme-hydratante.jpg',
                        'serum-vitamine-c.jpg',
                        'gommage-sucre.jpg',
                        'huile-precieuse.jpg',
                        'brume-oreiller.jpg',
                        'creme-hydratante.jpg',
                    ];
                @endphp
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 reveal">
                    @foreach ($featuredProducts->take(4) as $index => $product)
                        <div class="group cursor-pointer">
                            <div class="bg-ivory rounded-2xl overflow-hidden editorial-shadow collage-item border border-sand-deep/30">
                                <div class="img-zoom-container aspect-square relative">
                                    <img
                                        src="{{ asset('images/products/' . ($productImages[$index] ?? 'creme-hydratante.jpg')) }}"
                                        alt="{{ $product->name }}"
                                        class="w-full h-full object-cover"
                                        loading="lazy"
                                    >
                                    @if ($product->category)
                                        <div class="absolute top-3 left-3">
                                            <span class="px-3 py-1 rounded-full bg-cream/90 backdrop-blur-sm text-[10px] font-semibold tracking-wider text-ink uppercase">
                                                {{ $product->category->name }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="pt-4 px-1">
                                <h3 class="font-serif text-lg text-ink font-normal group-hover:text-burgundy transition-colors duration-300">
                                    {{ $product->name }}
                                </h3>
                                <p class="text-burgundy font-semibold text-sm mt-1">
                                    {{ number_format($product->price, 0) }} DH
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════════
       SECTION 6 : CONTACT & RÉSERVATION PRIVÉE
    ═══════════════════════════════════════════════════════════ --}}
    <section id="contact" class="py-24 lg:py-36 bg-sand/40 overflow-hidden">
        <div class="max-w-[1400px] mx-auto px-6 lg:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
                {{-- Left: Contact narrative & address --}}
                <div class="lg:col-span-5 reveal">
                    <p class="text-burgundy text-xs font-semibold tracking-[0.25em] uppercase mb-4">Réservation Privée</p>
                    <h2 class="font-serif text-4xl sm:text-5xl font-light text-ink leading-tight mb-6">
                        Prête à vous offrir un moment d'<span class="italic text-burgundy">exception</span> ?
                    </h2>
                    <p class="text-ink-muted text-base leading-relaxed mb-10 max-w-md">
                        Réservez votre prestation ou contactez-nous directement pour concevoir votre rituel sur-mesure.
                    </p>

                    <div class="space-y-6 mb-10">
                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-2xl bg-ivory editorial-shadow flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-5 h-5 text-burgundy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <span class="text-ink text-sm font-medium block">Adresse</span>
                                <span class="text-ink-muted text-sm">Casablanca, Maroc</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-2xl bg-ivory editorial-shadow flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-5 h-5 text-burgundy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <span class="text-ink text-sm font-medium block">Téléphone</span>
                                <a href="tel:+212600000000" class="text-burgundy hover:text-burgundy-light text-sm font-medium transition-colors">+212 6 00 00 00 00</a>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-2xl bg-ivory editorial-shadow flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-5 h-5 text-burgundy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <span class="text-ink text-sm font-medium block">Horaires d'ouverture</span>
                                <span class="text-ink-muted text-sm">Lundi – Samedi : 9h00 – 20h00</span>
                            </div>
                        </div>
                    </div>

                    {{-- Atmosphere preview thumbnail --}}
                    <div class="rounded-2xl overflow-hidden editorial-shadow">
                        <img src="{{ asset('images/salon-ambiance.jpg') }}" alt="Institut Sì Celya" class="w-full h-44 object-cover" loading="lazy">
                    </div>
                </div>

                {{-- Right: Reservation form --}}
                <div class="lg:col-span-7 reveal">
                    <div class="bg-ivory rounded-3xl p-8 sm:p-12 editorial-shadow-lg border border-sand-deep/40">
                        <h3 class="font-serif text-3xl text-ink mb-2">Demande de Rendez-vous</h3>
                        <p class="text-ink-muted text-sm mb-8">Renseignez vos coordonnées, nous confirmerons votre créneau sous 24h.</p>
                        <form id="contact-form" class="space-y-5">
                            @csrf
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label for="name" class="block text-ink-soft text-xs font-semibold tracking-wider uppercase mb-2">Nom complet</label>
                                    <input type="text" id="name" name="name" required
                                        class="w-full bg-cream/70 border border-sand-deep text-ink px-4 py-3.5 text-sm rounded-xl focus:border-burgundy focus:outline-none focus:ring-1 focus:ring-burgundy transition-all placeholder:text-ink-faint"
                                        placeholder="Ex: Sofia Alami">
                                </div>
                                <div>
                                    <label for="phone" class="block text-ink-soft text-xs font-semibold tracking-wider uppercase mb-2">Téléphone</label>
                                    <input type="tel" id="phone" name="phone" required
                                        class="w-full bg-cream/70 border border-sand-deep text-ink px-4 py-3.5 text-sm rounded-xl focus:border-burgundy focus:outline-none focus:ring-1 focus:ring-burgundy transition-all placeholder:text-ink-faint"
                                        placeholder="+212 6 XX XX XX XX">
                                </div>
                            </div>

                            <div>
                                <label for="service" class="block text-ink-soft text-xs font-semibold tracking-wider uppercase mb-2">Prestation souhaitée</label>
                                <select id="service" name="service"
                                    class="w-full bg-cream/70 border border-sand-deep text-ink px-4 py-3.5 text-sm rounded-xl focus:border-burgundy focus:outline-none focus:ring-1 focus:ring-burgundy transition-all appearance-none cursor-pointer">
                                    <option value="">Sélectionnez un univers ou une prestation</option>
                                    @foreach ($serviceCategories as $category)
                                        <optgroup label="{{ $category->name }}">
                                            @foreach ($category->services as $service)
                                                <option value="{{ $service->id }}">
                                                    {{ $service->name }} — {{ number_format($service->price, 0) }} DH
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="message" class="block text-ink-soft text-xs font-semibold tracking-wider uppercase mb-2">Message ou créneau préféré (optionnel)</label>
                                <textarea id="message" name="message" rows="3"
                                    class="w-full bg-cream/70 border border-sand-deep text-ink px-4 py-3.5 text-sm rounded-xl focus:border-burgundy focus:outline-none focus:ring-1 focus:ring-burgundy transition-all placeholder:text-ink-faint resize-none"
                                    placeholder="Indiquez la date ou l'horaire souhaité..."></textarea>
                            </div>

                            <button type="submit" id="submit-btn"
                                class="w-full bg-[#181415] hover:bg-burgundy text-cream font-semibold text-xs tracking-[0.2em] uppercase py-4 rounded-xl transition-all duration-300 shadow-sm active:scale-[0.98]">
                                Confirmer la demande de réservation
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════════
       SECTION 7 : FOOTER LUXE (Style Flaunter — Profond, Sombre & Raffiné)
    ═══════════════════════════════════════════════════════════ --}}
    <footer class="py-16 lg:py-24 bg-[#181415] text-cream relative overflow-hidden">
        <div class="max-w-[1400px] mx-auto px-6 lg:px-10">
            <div class="flex flex-col items-center text-center">
                {{-- Logo brandmark --}}
                <a href="/" class="inline-block mb-8 group">
                    <span class="font-serif text-3xl sm:text-4xl italic text-cream font-light tracking-wide group-hover:text-gold transition-colors duration-300">
                        Sì Celya
                    </span>
                    <span class="block text-[11px] tracking-[0.3em] uppercase text-cream/60 mt-1">Maison de Beauté · Casablanca</span>
                </a>

                {{-- Primary links --}}
                <div class="flex flex-wrap items-center justify-center gap-8 sm:gap-12 mb-10 text-xs tracking-[0.2em] uppercase font-medium text-cream/70">
                    <a href="#services" class="hover:text-cream transition-colors duration-300">Nos Univers</a>
                    <a href="#galerie" class="hover:text-cream transition-colors duration-300">En Coulisses</a>
                    <a href="#produits" class="hover:text-cream transition-colors duration-300">Curation</a>
                    <a href="#contact" class="hover:text-cream transition-colors duration-300">Réservation</a>
                </div>

                {{-- Social & Direct contact --}}
                <div class="flex items-center gap-6 mb-12 text-cream/60">
                    <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="hover:text-cream transition-colors text-xs tracking-wider uppercase">Instagram</a>
                    <span class="opacity-30">·</span>
                    <a href="https://tiktok.com" target="_blank" rel="noopener noreferrer" class="hover:text-cream transition-colors text-xs tracking-wider uppercase">TikTok</a>
                    <span class="opacity-30">·</span>
                    <a href="https://wa.me/212600000000" target="_blank" rel="noopener noreferrer" class="hover:text-cream transition-colors text-xs tracking-wider uppercase">WhatsApp</a>
                </div>

                {{-- Divider --}}
                <div class="w-full max-w-xs h-px bg-cream/10 mb-8"></div>

                {{-- Legal notice --}}
                <div class="text-[11px] text-cream/40 tracking-wider">
                    <p>&copy; {{ date('Y') }} Sì Celya. Tous droits réservés. Prestations haute précision à Casablanca.</p>
                </div>
            </div>
        </div>
    </footer>

    {{-- ═══════════════════════════════════════════════════════════
       SCRIPTS
    ═══════════════════════════════════════════════════════════ --}}
    <script>
        function toggleAccordion(item) {
            const drawer = item.querySelector('.accordion-drawer');
            const chevron = item.querySelector('.chevron-accordion');
            const isOpen = !drawer.classList.contains('max-h-0');

            // Close other drawers for clean single-focus editorial view
            document.querySelectorAll('.accordion-drawer').forEach(d => {
                d.classList.add('max-h-0');
                d.classList.remove('max-h-[800px]');
            });
            document.querySelectorAll('.chevron-accordion').forEach(c => {
                c.classList.remove('rotate-180');
            });

            if (!isOpen) {
                drawer.classList.remove('max-h-0');
                drawer.classList.add('max-h-[800px]');
                chevron.classList.add('rotate-180');
            }
        }

        document.addEventListener('DOMContentLoaded', () => {

            // ─── Open first accordion item by default ───
            const firstItem = document.querySelector('.service-accordion-item');
            if (firstItem) {
                const firstDrawer = firstItem.querySelector('.accordion-drawer');
                const firstChevron = firstItem.querySelector('.chevron-accordion');
                if (firstDrawer && firstChevron) {
                    firstDrawer.classList.remove('max-h-0');
                    firstDrawer.classList.add('max-h-[800px]');
                    firstChevron.classList.add('rotate-180');
                }
            }

            // ─── Scroll Reveal ───
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.12 });

            document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

            // ─── Mobile menu toggle ───
            const menuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            menuBtn?.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });

            // Close mobile menu on link click
            mobileMenu?.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => mobileMenu.classList.add('hidden'));
            });

            // ─── Contact Form Demo Handler ───
            const form = document.getElementById('contact-form');
            form?.addEventListener('submit', (e) => {
                e.preventDefault();
                const btn = document.getElementById('submit-btn');
                const originalText = btn.innerText;
                btn.disabled = true;
                btn.innerText = 'Demande envoyée avec succès ✓';
                btn.classList.remove('bg-[#181415]', 'hover:bg-burgundy');
                btn.classList.add('bg-emerald-800');
                setTimeout(() => {
                    form.reset();
                    btn.disabled = false;
                    btn.innerText = originalText;
                    btn.classList.remove('bg-emerald-800');
                    btn.classList.add('bg-[#181415]', 'hover:bg-burgundy');
                }, 4000);
            });

            // ─── Smooth scroll for anchor links ───
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', (e) => {
                    e.preventDefault();
                    const target = document.querySelector(anchor.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                });
            });
        });
    </script>
</body>
</html>
