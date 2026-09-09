<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sì Celya Beauty Center | Haute Beauté & Rituels d'Exception</title>
    <meta name="description" content="Sì Celya Beauty Center — Maison de beauté & rituels d'exception. Soins visage, massages relaxants, beauté du regard et produits haut de gamme.">
    <meta property="og:title" content="Sì Celya Beauty Center">
    <meta property="og:description" content="Maison de beauté & rituels d'exception à votre service.">
    <meta property="og:image" content="{{ asset('images/logo.png') }}">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500&family=Great+Vibes&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Lucide Icons --}}
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js" defer></script>

    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-cream text-ink font-sans antialiased overflow-x-hidden">

    {{-- ═══════════════════════════════════════════════════════
         NAVIGATION — LV-style sticky luxury nav
         ═══════════════════════════════════════════════════════ --}}
    <nav id="main-nav" class="fixed top-0 left-0 right-0 z-50 glass-nav transition-all duration-500">
        <div class="max-w-[1400px] mx-auto px-6 lg:px-10">
            <div class="flex items-center justify-between h-16 lg:h-20">
                {{-- Left: Mobile menu + Nav links --}}
                <div class="flex items-center gap-8">
                    <button id="mobile-menu-btn" class="lg:hidden cursor-pointer" aria-label="Menu">
                        <i data-lucide="menu" class="w-5 h-5 text-burgundy"></i>
                    </button>
                    <div class="hidden lg:flex items-center gap-8">
                        <a href="#rituels" class="text-xs font-medium tracking-[0.2em] uppercase text-burgundy hover-underline cursor-pointer">Rituels</a>
                        <a href="#maison" class="text-xs font-medium tracking-[0.2em] uppercase text-burgundy hover-underline cursor-pointer">La Maison</a>
                        <a href="#boutique" class="text-xs font-medium tracking-[0.2em] uppercase text-burgundy hover-underline cursor-pointer">Boutique</a>
                    </div>
                </div>

                {{-- Center: Logo --}}
                <a href="/" class="absolute left-1/2 -translate-x-1/2">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Sì Celya" class="h-10 lg:h-12 w-auto">
                </a>

                {{-- Right: CTA + icons --}}
                <div class="flex items-center gap-6">
                    <a href="https://www.instagram.com/si_celya_beauty_center" target="_blank" rel="noopener" class="hidden sm:block" aria-label="Instagram">
                        <i data-lucide="instagram" class="w-[18px] h-[18px] text-burgundy"></i>
                    </a>
                    <a href="#contact" class="hidden sm:block" aria-label="Téléphone">
                        <i data-lucide="phone" class="w-[18px] h-[18px] text-burgundy"></i>
                    </a>
                    <a href="#rendez-vous"
                       class="hidden md:inline-flex items-center gap-2 px-5 py-2.5 text-[11px] font-semibold tracking-[0.2em] uppercase
                              bg-burgundy text-cream rounded-full hover:bg-burgundy-light transition-colors duration-300 cursor-pointer">
                        Réserver
                    </a>
                </div>
            </div>
        </div>

        {{-- Mobile menu overlay --}}
        <div id="mobile-menu" class="fixed inset-0 bg-cream z-[60] translate-x-full transition-transform duration-500 ease-in-out lg:hidden">
            <div class="flex items-center justify-between px-6 h-16">
                <img src="{{ asset('images/logo.jpg') }}" alt="Sì Celya" class="h-10 w-auto">
                <button id="mobile-menu-close" class="cursor-pointer" aria-label="Fermer le menu">
                    <i data-lucide="x" class="w-6 h-6 text-burgundy"></i>
                </button>
            </div>
            <div class="flex flex-col items-center justify-center gap-8 pt-16">
                <a href="#rituels" class="text-sm font-medium tracking-[0.3em] uppercase text-burgundy mobile-nav-link">Rituels & Soins</a>
                <a href="#maison" class="text-sm font-medium tracking-[0.3em] uppercase text-burgundy mobile-nav-link">La Maison</a>
                <a href="#boutique" class="text-sm font-medium tracking-[0.3em] uppercase text-burgundy mobile-nav-link">Boutique</a>
                <a href="#atmosphere" class="text-sm font-medium tracking-[0.3em] uppercase text-burgundy mobile-nav-link">L'Atmosphère</a>
                <a href="https://www.instagram.com/si_celya_beauty_center" target="_blank" rel="noopener" class="text-sm font-medium tracking-[0.3em] uppercase text-burgundy mobile-nav-link">Instagram</a>
                <div class="mt-8">
                    <a href="#rendez-vous"
                       class="inline-flex items-center gap-2 px-8 py-3 text-xs font-semibold tracking-[0.2em] uppercase
                              bg-burgundy text-cream rounded-full">
                        Prendre Rendez-vous
                    </a>
                </div>
            </div>
        </div>
    </nav>

    {{-- ═══════════════════════════════════════════════════════
         HERO — Full viewport Louis Vuitton-style cinematic hero
         ═══════════════════════════════════════════════════════ --}}
    <section id="hero" class="relative min-h-screen flex items-center pt-24 pb-16 lg:pt-20 lg:pb-20 overflow-hidden">
        {{-- Hero Background Image --}}
        <div class="absolute inset-0">
            <img src="{{ asset('images/hero-model.jpg') }}"
                 alt="Sì Celya Beauty Center — expérience beauté d'exception"
                 class="w-full h-full object-cover object-[65%_center] lg:object-center"
                 loading="eager">
            {{-- Gradient overlays for text readability --}}
            <div class="absolute inset-0 bg-gradient-to-t from-burgundy-deep/90 via-burgundy-deep/25 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-burgundy-deep/70 via-burgundy-deep/20 to-transparent"></div>
        </div>

        {{-- Ambient neon accent strip at very top --}}
        <div class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-transparent via-neon-pink/60 to-transparent"></div>

        {{-- Hero Content --}}
        <div class="relative z-10 max-w-[1400px] mx-auto px-6 lg:px-10 w-full">
            <div class="max-w-2xl">
                {{-- Category badge --}}
                <p class="text-[11px] font-medium tracking-[0.35em] uppercase text-gold-light/80 mb-5 animate-fade-in-up">
                    Maison de Beauté & Rituels d'Exception
                </p>

                {{-- Hero Headline --}}
                <h1 class="font-serif text-4xl sm:text-5xl lg:text-7xl text-white leading-[1.05] tracking-[-0.02em] mb-6"
                    style="animation: fade-in-up 0.8s ease-out 0.15s both;">
                    Révélez votre<br>
                    <span class="italic text-gold-light">éclat singulier</span>
                </h1>

                {{-- Subtext --}}
                <p class="text-sm sm:text-base text-white/70 leading-relaxed max-w-md mb-10 font-light"
                   style="animation: fade-in-up 0.8s ease-out 0.3s both;">
                    Un sanctuaire dédié à la beauté et au bien-être, où chaque soin est un rituel d'exception conçu pour sublimer votre peau.
                </p>

                {{-- CTAs — LV style: clean underline text link + bordered button --}}
                <div class="flex flex-wrap items-center gap-6" style="animation: fade-in-up 0.8s ease-out 0.45s both;">
                    <a href="#rituels"
                       class="inline-flex items-center gap-3 px-7 py-3 text-[11px] font-semibold tracking-[0.2em] uppercase
                              bg-white text-burgundy-deep rounded-none hover:bg-gold-light transition-colors duration-300 cursor-pointer">
                        Découvrir les Rituels
                    </a>
                    <a href="#rendez-vous"
                       class="inline-flex items-center gap-2 text-[11px] font-medium tracking-[0.2em] uppercase
                              text-white/90 border-b border-white/40 pb-1 hover:border-gold-light hover:text-gold-light transition-colors duration-300 cursor-pointer">
                        Réserver une Séance
                    </a>
                </div>
            </div>
        </div>

        {{-- Scroll indicator --}}
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-10 flex flex-col items-center gap-2 opacity-60">
            <span class="text-[9px] tracking-[0.3em] uppercase text-white/50">Découvrir</span>
            <div class="w-px h-8 bg-gradient-to-b from-white/40 to-transparent animate-float"></div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════
         MARQUEE TICKER — LV-style tracked uppercase
         ═══════════════════════════════════════════════════════ --}}
    <div class="bg-burgundy-deep py-3.5 overflow-hidden">
        <div class="flex animate-marquee whitespace-nowrap">
            @for ($i = 0; $i < 3; $i++)
                <span class="text-[10px] tracking-[0.4em] uppercase text-gold-light/60 mx-8">
                    Soins Visage Haute Précision
                </span>
                <span class="text-neon-pink/40 mx-2">✦</span>
                <span class="text-[10px] tracking-[0.4em] uppercase text-gold-light/60 mx-8">
                    Massages Relaxants
                </span>
                <span class="text-neon-pink/40 mx-2">✦</span>
                <span class="text-[10px] tracking-[0.4em] uppercase text-gold-light/60 mx-8">
                    Beauté du Regard
                </span>
                <span class="text-neon-pink/40 mx-2">✦</span>
                <span class="text-[10px] tracking-[0.4em] uppercase text-gold-light/60 mx-8">
                    Manucure Russe
                </span>
                <span class="text-neon-pink/40 mx-2">✦</span>
                <span class="text-[10px] tracking-[0.4em] uppercase text-gold-light/60 mx-8">
                    Aromathérapie & Bien-Être
                </span>
                <span class="text-neon-pink/40 mx-2">✦</span>
            @endfor
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════
         LA MAISON — Editorial story section (Flaunter asymmetric)
         ═══════════════════════════════════════════════════════ --}}
    <section id="maison" class="py-20 lg:py-32 bg-cream">
        <div class="max-w-[1400px] mx-auto px-6 lg:px-10">
            {{-- Section heading --}}
            <div class="text-center mb-16 lg:mb-24 reveal">
                <p class="text-[10px] font-medium tracking-[0.4em] uppercase text-ink-muted mb-4">L'Écrin</p>
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl text-burgundy tracking-[-0.02em] leading-[1.1]">
                    La Maison Sì Celya
                </h2>
                <div class="w-12 h-px bg-gold mx-auto mt-6"></div>
            </div>

            {{-- Asymmetric editorial grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                {{-- Left: Tall image --}}
                <div class="lg:col-span-5 reveal">
                    <div class="relative img-zoom-container rounded-sm overflow-hidden aspect-[3/4]">
                        <img src="{{ asset('images/services/soin-anti-age.jpg') }}"
                             alt="Soin signature Sì Celya"
                             class="w-full h-full object-cover"
                             loading="lazy">
                        {{-- Floating badge --}}
                        <div class="absolute bottom-4 left-4 bg-burgundy-deep/80 backdrop-blur-sm px-4 py-2 rounded-sm">
                            <p class="text-[9px] tracking-[0.3em] uppercase text-gold-light">Rituel Signature</p>
                        </div>
                    </div>
                </div>

                {{-- Center: Editorial text --}}
                <div class="lg:col-span-4 py-8 reveal reveal-delay-1">
                    <p class="text-[10px] font-medium tracking-[0.35em] uppercase text-gold-muted mb-6">Notre Philosophie</p>
                    <h3 class="font-serif text-2xl lg:text-3xl text-burgundy leading-snug mb-6 tracking-[-0.01em]">
                        Où l'art de la beauté<br>
                        <span class="italic">rencontre l'excellence</span>
                    </h3>
                    <p class="text-sm text-ink-soft leading-[1.8] mb-6">
                        Chez Sì Celya, chaque geste est un rituel. Nous allions le savoir-faire de la cosmétologie française à une approche holistique du bien-être, pour vous offrir des soins d'une rare précision.
                    </p>
                    <p class="text-sm text-ink-soft leading-[1.8] mb-8">
                        Notre écrin intimiste est conçu pour éveiller vos sens et révéler la beauté qui sommeille en vous.
                    </p>
                    <a href="#rituels"
                       class="inline-flex items-center gap-2 text-[11px] font-semibold tracking-[0.2em] uppercase
                              text-burgundy border-b border-burgundy/40 pb-1 hover:border-burgundy transition-colors duration-300 cursor-pointer">
                        Explorer nos Rituels
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                    </a>
                </div>

                {{-- Right: Staggered smaller image --}}
                <div class="lg:col-span-3 lg:pt-24 reveal reveal-delay-2">
                    <div class="img-zoom-container rounded-sm overflow-hidden aspect-[4/5]">
                        <img src="{{ asset('images/salon-ambiance.jpg') }}"
                             alt="Ambiance salon Sì Celya"
                             class="w-full h-full object-cover"
                             loading="lazy">
                    </div>
                    <p class="text-[10px] tracking-[0.25em] uppercase text-ink-faint mt-4 text-center">
                        L'Atmosphère Sì Celya
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════
         NOS RITUELS — Services & treatments from DB
         ═══════════════════════════════════════════════════════ --}}
    <section id="rituels" class="py-20 lg:py-32 bg-sand">
        <div class="max-w-[1400px] mx-auto px-6 lg:px-10">
            {{-- Section heading --}}
            <div class="text-center mb-16 reveal">
                <p class="text-[10px] font-medium tracking-[0.4em] uppercase text-ink-muted mb-4">Nos Rituels</p>
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl text-burgundy tracking-[-0.02em] leading-[1.1]">
                    Soins & Expériences
                </h2>
                <div class="w-12 h-px bg-gold mx-auto mt-6"></div>
            </div>

            {{-- Services Grid: LV 4-up category grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-5">
                @foreach ($services as $index => $service)
                    <div class="group reveal reveal-delay-{{ ($index % 4) + 1 }}">
                        <div class="relative img-zoom-container rounded-sm overflow-hidden aspect-[3/4] mb-4">
                            <img src="{{ asset('images/' . $service->image_path) }}"
                                 alt="{{ $service->name }}"
                                 class="w-full h-full object-cover"
                                 loading="lazy">
                            {{-- Hover overlay --}}
                            <div class="absolute inset-0 bg-burgundy-deep/0 group-hover:bg-burgundy-deep/40 transition-colors duration-500 flex items-end justify-center pb-6">
                                <a href="#rendez-vous"
                                   class="opacity-0 group-hover:opacity-100 translate-y-3 group-hover:translate-y-0 transition-all duration-400
                                          px-5 py-2 text-[10px] font-semibold tracking-[0.2em] uppercase bg-white text-burgundy-deep cursor-pointer">
                                    Réserver
                                </a>
                            </div>
                            {{-- Duration badge --}}
                            <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-2.5 py-1 rounded-sm">
                                <span class="text-[10px] font-medium tracking-wide text-burgundy">{{ $service->duration }} min</span>
                            </div>
                        </div>
                        {{-- Service info --}}
                        <div class="text-center">
                            <h3 class="font-serif text-lg text-burgundy mb-1.5">{{ $service->name }}</h3>
                            <p class="text-[11px] text-ink-muted leading-relaxed mb-2 px-2 line-clamp-2">{{ $service->description }}</p>
                            <p class="text-sm font-medium text-gold-muted">{{ number_format($service->price, 0, ',', ' ') }} €</p>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- View all link --}}
            <div class="text-center mt-12 reveal">
                <a href="#rendez-vous"
                   class="inline-flex items-center gap-2 text-[11px] font-semibold tracking-[0.2em] uppercase
                          text-burgundy border-b border-burgundy/30 pb-1 hover:border-burgundy transition-colors duration-300 cursor-pointer">
                    Voir Tous les Soins
                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════
         NEON EXPERIENCE LOUNGE — Dark capsule with neon ambiance
         ═══════════════════════════════════════════════════════ --}}
    <section id="atmosphere" class="relative py-28 lg:py-40 bg-burgundy-deep overflow-hidden">
        {{-- Ambient glow effects --}}
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full bg-neon-pink/5 blur-[120px] pointer-events-none"></div>
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-neon-pink/30 to-transparent"></div>
        <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-neon-pink/30 to-transparent"></div>

        <div class="relative z-10 max-w-[900px] mx-auto px-6 text-center">
            {{-- Neon script headline --}}
            <p class="text-[10px] font-medium tracking-[0.4em] uppercase text-neon-pink-light/60 mb-8 reveal">
                L'Atmosphère
            </p>

            <h2 class="font-script text-4xl sm:text-5xl lg:text-7xl neon-pink-glow-subtle mb-6 reveal reveal-delay-1">
                Sì Celya
            </h2>

            <div class="neon-line-pink w-24 mx-auto mb-8 reveal reveal-delay-2"></div>

            <p class="font-serif text-xl sm:text-2xl lg:text-3xl text-white/80 italic leading-snug mb-4 tracking-[-0.01em] reveal reveal-delay-2">
                « Révélez votre éclat singulier »
            </p>

            <p class="text-sm text-white/40 leading-relaxed max-w-md mx-auto mb-10 reveal reveal-delay-3">
                Un espace où la lumière rencontre le savoir-faire, où chaque soin devient une expérience sensorielle inoubliable.
            </p>

            <a href="#rendez-vous"
               class="inline-flex items-center gap-3 px-8 py-3 text-[11px] font-semibold tracking-[0.25em] uppercase
                      neon-border-pink text-neon-pink-light rounded-full hover:bg-neon-pink/10 transition-colors duration-300 cursor-pointer reveal reveal-delay-3">
                <i data-lucide="sparkles" class="w-4 h-4"></i>
                Vivre l'Expérience
            </a>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════
         BOUTIQUE — Curated products from DB
         ═══════════════════════════════════════════════════════ --}}
    <section id="boutique" class="py-20 lg:py-32 bg-cream">
        <div class="max-w-[1400px] mx-auto px-6 lg:px-10">
            {{-- Section heading --}}
            <div class="text-center mb-16 reveal">
                <p class="text-[10px] font-medium tracking-[0.4em] uppercase text-ink-muted mb-4">La Boutique</p>
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl text-burgundy tracking-[-0.02em] leading-[1.1]">
                    L'Écrin Beauté
                </h2>
                <div class="w-12 h-px bg-gold mx-auto mt-6"></div>
            </div>

            {{-- Products grid: LV editorial style --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10">
                @foreach ($featuredProducts as $index => $product)
                    <div class="group luxury-card-hover reveal reveal-delay-{{ ($index % 3) + 1 }}">
                        <div class="relative img-zoom-container bg-sand rounded-sm overflow-hidden aspect-square mb-5">
                            <img src="{{ asset('images/' . $product->image_path) }}"
                                 alt="{{ $product->name }}"
                                 class="w-full h-full object-cover mix-blend-multiply"
                                 loading="lazy">
                            {{-- Category badge --}}
                            @if ($product->category)
                                <div class="absolute top-3 left-3 bg-cream/90 backdrop-blur-sm px-3 py-1 rounded-sm">
                                    <span class="text-[9px] font-medium tracking-[0.2em] uppercase text-burgundy">{{ $product->category->name }}</span>
                                </div>
                            @endif
                        </div>
                        {{-- Product info --}}
                        <h3 class="font-serif text-lg text-burgundy mb-1.5 group-hover:text-burgundy-light transition-colors">{{ $product->name }}</h3>
                        <p class="text-[11px] text-ink-muted leading-relaxed mb-3 line-clamp-2">{{ $product->description }}</p>
                        <p class="text-sm font-medium text-ink">{{ number_format($product->price, 2, ',', ' ') }} €</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════
         INSTAGRAM & SOCIAL PROOF
         ═══════════════════════════════════════════════════════ --}}
    <section class="py-20 lg:py-28 bg-sand">
        <div class="max-w-[1400px] mx-auto px-6 lg:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                {{-- Left: Editorial text --}}
                <div class="reveal">
                    <p class="text-[10px] font-medium tracking-[0.4em] uppercase text-ink-muted mb-4">Suivez-nous</p>
                    <h2 class="font-serif text-3xl sm:text-4xl text-burgundy tracking-[-0.02em] leading-[1.1] mb-6">
                        @si_celya_beauty_center
                    </h2>
                    <p class="text-sm text-ink-soft leading-[1.8] mb-8">
                        Retrouvez nos dernières créations, inspirations et coulisses de notre Maison sur Instagram. Rejoignez une communauté passionnée par la beauté authentique.
                    </p>
                    <a href="https://www.instagram.com/si_celya_beauty_center"
                       target="_blank" rel="noopener"
                       class="inline-flex items-center gap-3 px-7 py-3 text-[11px] font-semibold tracking-[0.2em] uppercase
                              bg-burgundy text-cream rounded-none hover:bg-burgundy-light transition-colors duration-300 cursor-pointer">
                        <i data-lucide="instagram" class="w-4 h-4"></i>
                        Suivre sur Instagram
                    </a>
                </div>

                {{-- Right: Image mosaic --}}
                <div class="grid grid-cols-3 gap-2.5 reveal reveal-delay-1">
                    @php
                        $instaImages = [
                            'services/cils-regard.jpg',
                            'services/manucure-russe.jpg',
                            'services/epilation-smooth.jpg',
                            'services/soin-capillaire.jpg',
                            'services/visage-express.jpg',
                            'services/massage-relaxant.jpg',
                        ];
                    @endphp
                    @foreach ($instaImages as $img)
                        <div class="img-zoom-container rounded-sm overflow-hidden aspect-square">
                            <img src="{{ asset('images/' . $img) }}"
                                 alt="Sì Celya Instagram"
                                 class="w-full h-full object-cover"
                                 loading="lazy">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════
         RENDEZ-VOUS — Booking CTA Section
         ═══════════════════════════════════════════════════════ --}}
    <section id="rendez-vous" class="relative py-24 lg:py-32 bg-burgundy overflow-hidden">
        {{-- Subtle neon ambient --}}
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-gold/30 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-burgundy-dark/50 to-transparent pointer-events-none"></div>

        <div class="relative z-10 max-w-[800px] mx-auto px-6 text-center">
            <div class="reveal">
                <p class="text-[10px] font-medium tracking-[0.4em] uppercase text-gold-light/60 mb-6">Rendez-vous</p>

                <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl text-white leading-[1.1] tracking-[-0.02em] mb-6">
                    Réservez votre<br>
                    <span class="italic text-gold-light">moment d'exception</span>
                </h2>

                <p class="text-sm text-white/50 leading-relaxed max-w-md mx-auto mb-10">
                    Prenez rendez-vous et laissez nos expertes vous guider vers la version la plus éclatante de vous-même.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="tel:+33123456789"
                       class="inline-flex items-center gap-3 px-8 py-3.5 text-[11px] font-semibold tracking-[0.2em] uppercase
                              bg-gold text-burgundy-deep hover:bg-gold-light transition-colors duration-300 cursor-pointer">
                        <i data-lucide="phone" class="w-4 h-4"></i>
                        Appeler le Salon
                    </a>
                    <a href="https://www.instagram.com/si_celya_beauty_center"
                       target="_blank" rel="noopener"
                       class="inline-flex items-center gap-3 px-8 py-3.5 text-[11px] font-semibold tracking-[0.2em] uppercase
                              border border-white/20 text-white/80 hover:bg-white/5 transition-colors duration-300 cursor-pointer">
                        <i data-lucide="message-circle" class="w-4 h-4"></i>
                        Via Instagram
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════
         FOOTER — Prestige editorial footer
         ═══════════════════════════════════════════════════════ --}}
    <footer id="contact" class="bg-burgundy-deep py-16 lg:py-20">
        <div class="max-w-[1400px] mx-auto px-6 lg:px-10">
            {{-- Top: Logo + tagline --}}
            <div class="text-center mb-14">
                <img src="{{ asset('images/logo-transparent.png') }}" alt="Sì Celya" class="h-12 lg:h-14 w-auto mx-auto mb-4 invert opacity-90">
                <p class="text-[10px] tracking-[0.35em] uppercase text-white/30">Beauty Center</p>
            </div>

            {{-- Links grid --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 lg:gap-16 mb-14">
                <div>
                    <h4 class="text-[10px] font-semibold tracking-[0.3em] uppercase text-gold-light/60 mb-5">Rituels</h4>
                    <ul class="space-y-3">
                        <li><a href="#rituels" class="text-xs text-white/40 hover:text-white/70 transition-colors cursor-pointer">Soins Visage</a></li>
                        <li><a href="#rituels" class="text-xs text-white/40 hover:text-white/70 transition-colors cursor-pointer">Massages</a></li>
                        <li><a href="#rituels" class="text-xs text-white/40 hover:text-white/70 transition-colors cursor-pointer">Beauté du Regard</a></li>
                        <li><a href="#rituels" class="text-xs text-white/40 hover:text-white/70 transition-colors cursor-pointer">Soins Corps</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-[10px] font-semibold tracking-[0.3em] uppercase text-gold-light/60 mb-5">Boutique</h4>
                    <ul class="space-y-3">
                        <li><a href="#boutique" class="text-xs text-white/40 hover:text-white/70 transition-colors cursor-pointer">Soins Visage</a></li>
                        <li><a href="#boutique" class="text-xs text-white/40 hover:text-white/70 transition-colors cursor-pointer">Soins Corps</a></li>
                        <li><a href="#boutique" class="text-xs text-white/40 hover:text-white/70 transition-colors cursor-pointer">Aromathérapie</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-[10px] font-semibold tracking-[0.3em] uppercase text-gold-light/60 mb-5">La Maison</h4>
                    <ul class="space-y-3">
                        <li><a href="#maison" class="text-xs text-white/40 hover:text-white/70 transition-colors cursor-pointer">Notre Histoire</a></li>
                        <li><a href="#atmosphere" class="text-xs text-white/40 hover:text-white/70 transition-colors cursor-pointer">L'Atmosphère</a></li>
                        <li><a href="#rendez-vous" class="text-xs text-white/40 hover:text-white/70 transition-colors cursor-pointer">Rendez-vous</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-[10px] font-semibold tracking-[0.3em] uppercase text-gold-light/60 mb-5">Contact</h4>
                    <ul class="space-y-3">
                        <li class="text-xs text-white/40">Lun – Sam : 9h – 19h</li>
                        <li><a href="tel:+33123456789" class="text-xs text-white/40 hover:text-white/70 transition-colors cursor-pointer">+33 1 23 45 67 89</a></li>
                        <li><a href="https://www.instagram.com/si_celya_beauty_center" target="_blank" rel="noopener" class="text-xs text-white/40 hover:text-white/70 transition-colors cursor-pointer">@si_celya_beauty_center</a></li>
                    </ul>
                </div>
            </div>

            {{-- Bottom bar --}}
            <div class="border-t border-white/10 pt-8 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-[10px] text-white/20 tracking-wide">
                    &copy; {{ date('Y') }} Sì Celya Beauty Center. Tous droits réservés.
                </p>
                <div class="flex items-center gap-5">
                    <a href="https://www.instagram.com/si_celya_beauty_center" target="_blank" rel="noopener" aria-label="Instagram" class="text-white/30 hover:text-neon-pink-light transition-colors cursor-pointer">
                        <i data-lucide="instagram" class="w-4 h-4"></i>
                    </a>
                    <a href="#" aria-label="Facebook" class="text-white/30 hover:text-white/60 transition-colors cursor-pointer">
                        <i data-lucide="facebook" class="w-4 h-4"></i>
                    </a>
                    <a href="#" aria-label="WhatsApp" class="text-white/30 hover:text-white/60 transition-colors cursor-pointer">
                        <i data-lucide="message-circle" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    {{-- ═══════════════════════════════════════════════════════
         SCRIPTS
         ═══════════════════════════════════════════════════════ --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize Lucide icons
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }

            // Mobile menu toggle
            const menuBtn = document.getElementById('mobile-menu-btn');
            const menuClose = document.getElementById('mobile-menu-close');
            const mobileMenu = document.getElementById('mobile-menu');

            if (menuBtn && mobileMenu) {
                menuBtn.addEventListener('click', () => {
                    mobileMenu.classList.remove('translate-x-full');
                    mobileMenu.classList.add('translate-x-0');
                });
            }
            if (menuClose && mobileMenu) {
                menuClose.addEventListener('click', () => {
                    mobileMenu.classList.remove('translate-x-0');
                    mobileMenu.classList.add('translate-x-full');
                });
            }

            // Close mobile menu on link click
            document.querySelectorAll('.mobile-nav-link').forEach(link => {
                link.addEventListener('click', () => {
                    if (mobileMenu) {
                        mobileMenu.classList.remove('translate-x-0');
                        mobileMenu.classList.add('translate-x-full');
                    }
                });
            });

            // Scroll-based nav background opacity
            const nav = document.getElementById('main-nav');
            if (nav) {
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 80) {
                        nav.classList.add('shadow-sm');
                    } else {
                        nav.classList.remove('shadow-sm');
                    }
                }, { passive: true });
            }

            // Intersection Observer for scroll reveal
            const revealElements = document.querySelectorAll('.reveal');
            if (revealElements.length > 0) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('revealed');
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.1,
                    rootMargin: '0px 0px -50px 0px'
                });

                revealElements.forEach(el => observer.observe(el));
            }
        });
    </script>
</body>
</html>
