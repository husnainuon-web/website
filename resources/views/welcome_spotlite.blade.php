<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Spotlite | Industrial Supply Solutions</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800" rel="stylesheet" />
        <style>
            :root {
                --spotlite-green: #165c3f;
                --spotlite-green-dark: #0f452e;
                --spotlite-green-soft: #e8f5ee;
                --spotlite-text: #18332a;
                --spotlite-muted: #546a60;
                --spotlite-bg: #f6faf7;
                --spotlite-card: #ffffff;
                --spotlite-border: rgba(22, 92, 63, 0.12);
            }

            * { box-sizing: border-box; }
            html { scroll-behavior: smooth; }
            body {
                margin: 0;
                font-family: 'Instrument Sans', sans-serif;
                background: linear-gradient(180deg, #f4faf6 0%, #eef6f1 100%);
                color: var(--spotlite-text);
                line-height: 1.6;
            }
            a { text-decoration: none; }
            .container {
                width: min(1160px, calc(100% - 32px));
                margin: 0 auto;
            }
            .topbar {
                position: sticky;
                top: 0;
                z-index: 20;
                backdrop-filter: blur(12px);
                background: rgba(246, 250, 247, 0.82);
                border-bottom: 1px solid rgba(22, 92, 63, 0.08);
            }
            .nav {
                display: flex;
                align-items: center;
                justify-content: space-between;
                min-height: 78px;
                gap: 20px;
            }
            .brand {
                display: inline-flex;
                align-items: center;
                gap: 12px;
                font-weight: 800;
                letter-spacing: 0.14em;
                color: var(--spotlite-green-dark);
                text-transform: uppercase;
            }
            .brand-mark {
                width: 38px;
                height: 38px;
                border-radius: 12px;
                background: linear-gradient(135deg, var(--spotlite-green), #2a8a5d);
                color: white;
                display: grid;
                place-items: center;
                box-shadow: 0 12px 25px rgba(22, 92, 63, 0.24);
            }
            .nav-links {
                display: flex;
                align-items: center;
                gap: 24px;
                flex-wrap: wrap;
            }
            .nav-links a, .nav-actions a {
                color: var(--spotlite-muted);
                font-weight: 600;
            }
            .nav-actions {
                display: flex;
                align-items: center;
                gap: 12px;
                flex-wrap: wrap;
            }
            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                border-radius: 12px;
                padding: 0.9rem 1.4rem;
                font-weight: 700;
                border: 1px solid transparent;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }
            .btn:hover { transform: translateY(-1px); }
            .btn-outline {
                border-color: rgba(22, 92, 63, 0.18);
                background: rgba(255,255,255,0.55);
                color: var(--spotlite-green-dark);
            }
            .btn-primary {
                background: linear-gradient(135deg, var(--spotlite-green), #1a6c46);
                color: #fff;
                box-shadow: 0 18px 30px rgba(22, 92, 63, 0.24);
            }
            .hero {
                padding: 56px 0 24px;
            }
            .hero-shell {
                display: grid;
                grid-template-columns: 1.12fr 0.88fr;
                align-items: center;
                gap: 32px;
                background: rgba(255,255,255,0.34);
                border: 1px solid var(--spotlite-border);
                border-radius: 28px;
                box-shadow: 0 24px 60px rgba(22, 92, 63, 0.08);
                overflow: hidden;
            }
            .hero-copy {
                padding: 56px 52px;
            }
            .eyebrow {
                display: inline-flex;
                margin-bottom: 18px;
                padding: 0.45rem 0.8rem;
                border-radius: 999px;
                background: var(--spotlite-green-soft);
                color: var(--spotlite-green-dark);
                font-weight: 700;
                font-size: 0.8rem;
                letter-spacing: 0.06em;
                text-transform: uppercase;
            }
            h1 {
                margin: 0;
                font-size: clamp(2.4rem, 4vw, 4.1rem);
                line-height: 1.02;
                color: var(--spotlite-text);
                letter-spacing: -.05em;
            }
            .hero-copy p {
                font-size: 1.05rem;
                color: var(--spotlite-muted);
                margin: 22px 0 0;
                max-width: 620px;
            }
            .hero-actions {
                margin-top: 30px;
                display: flex;
                flex-wrap: wrap;
                gap: 14px;
            }
            .hero-stats {
                margin-top: 34px;
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 16px;
            }
            .stat {
                border: 1px solid var(--spotlite-border);
                background: rgba(255,255,255,0.55);
                border-radius: 18px;
                padding: 18px 16px;
            }
            .stat strong {
                display: block;
                font-size: 1.25rem;
                color: var(--spotlite-green-dark);
            }
            .stat span {
                color: var(--spotlite-muted);
                font-size: 0.92rem;
            }
            .hero-visual {
                position: relative;
                background: linear-gradient(135deg, #d8f0e2 0%, #b4ddc4 45%, #e5f6eb 100%);
                min-height: 540px;
                padding: 36px 28px;
            }
            .visual-card {
                position: relative;
                max-width: 420px;
                margin: 0 auto;
                background: rgba(255,255,255,0.78);
                border: 1px solid rgba(23, 82, 61, 0.1);
                border-radius: 28px;
                box-shadow: 0 30px 70px rgba(23, 82, 61, 0.18);
                padding: 26px 22px;
            }
            .badge {
                display: inline-flex;
                padding: 0.45rem 0.7rem;
                border-radius: 999px;
                background: #ecf8f0;
                color: var(--spotlite-green-dark);
                font-weight: 700;
                font-size: 0.78rem;
            }
            .visual-list {
                list-style: none;
                margin: 22px 0 0;
                padding: 0;
                display: grid;
                gap: 14px;
            }
            .visual-list li {
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 12px 14px;
                border-radius: 14px;
                background: rgba(255,255,255,0.7);
                border: 1px solid rgba(22,92,63,0.08);
                font-weight: 600;
            }
            .check {
                width: 26px;
                height: 26px;
                border-radius: 50%;
                background: linear-gradient(135deg, var(--spotlite-green), #2d9a62);
                display: grid;
                place-items: center;
                color: white;
                font-weight: 900;
                font-size: 0.82rem;
                box-shadow: 0 10px 20px rgba(22,92,63,0.2);
            }
            .mini-panels {
                position: absolute;
                inset: auto auto 34px 24px;
                display: grid;
                gap: 12px;
            }
            .mini-panel {
                background: rgba(255,255,255,0.8);
                border: 1px solid rgba(22,92,63,0.08);
                border-radius: 16px;
                padding: 10px 12px;
                min-width: 170px;
                box-shadow: 0 12px 30px rgba(22,92,63,0.12);
            }
            .mini-panel small {
                color: var(--spotlite-muted);
                display: block;
            }
            .mini-panel strong {
                font-size: 1rem;
            }
            section {
                padding: 28px 0;
            }
            .section-header {
                margin-bottom: 24px;
            }
            .section-header h2 {
                margin: 0;
                font-size: clamp(1.8rem, 2vw, 2.6rem);
                letter-spacing: -.04em;
            }
            .section-header p {
                margin: 10px 0 0;
                font-size: 1rem;
                color: var(--spotlite-muted);
            }
            .categories, .features {
                display: grid;
                gap: 18px;
            }
            .categories {
                grid-template-columns: repeat(4, minmax(0, 1fr));
            }
            .features {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
            .category, .feature {
                background: rgba(255,255,255,0.6);
                border: 1px solid var(--spotlite-border);
                border-radius: 22px;
                padding: 22px 18px;
                box-shadow: 0 16px 35px rgba(22,92,63,0.04);
            }
            .category {
                min-height: 200px;
            }
            .category-icon {
                width: 56px;
                height: 56px;
                border-radius: 16px;
                background: linear-gradient(135deg, var(--spotlite-green-soft), rgba(121, 176, 146, 0.22));
                display: grid;
                place-items: center;
                color: var(--spotlite-green-dark);
                font-size: 1.5rem;
                margin-bottom: 16px;
            }
            .category h3, .feature h3 {
                margin: 0 0 8px;
                font-size: 1.12rem;
            }
            .category p, .feature p {
                margin: 0;
                color: var(--spotlite-muted);
            }
            .cta {
                padding: 38px 0 60px;
            }
            .cta-box {
                background: linear-gradient(135deg, var(--spotlite-green-dark), var(--spotlite-green));
                border-radius: 28px;
                padding: 40px 32px;
                color: white;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 20px;
                flex-wrap: wrap;
            }
            .cta-box h3 {
                margin: 0;
                font-size: clamp(1.6rem, 2vw, 2.2rem);
                letter-spacing: -.04em;
            }
            .cta-box p {
                margin: 10px 0 0;
                color: rgba(255,255,255,0.85);
            }
            .cta-box .btn {
                background: white;
                color: var(--spotlite-green-dark);
                border-color: rgba(255,255,255,0.7);
            }
            footer {
                padding: 18px 0 40px;
                color: var(--spotlite-muted);
                font-size: 0.95rem;
            }
            .footer-inner {
                border-top: 1px solid var(--spotlite-border);
                padding-top: 24px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 16px;
                flex-wrap: wrap;
            }
            @media (max-width: 900px) {
                .hero-shell, .categories, .features { grid-template-columns: 1fr; }
                .hero-copy { padding: 38px 28px; }
                .hero-visual { min-height: 450px; }
            }
            @media (max-width: 640px) {
                .nav { align-items: flex-start; flex-direction: column; }
                .nav-links, .nav-actions { width: 100%; }
                .nav-links { justify-content: space-between; }
                .nav-actions { justify-content: flex-start; }
                .hero-stats { grid-template-columns: 1fr; }
            }
        </style>
    </head>
    <body>
        <header class="topbar">
            <div class="container nav">
                <a href="{{ url('/') }}" class="brand" aria-label="Spotlite home">
                    <span class="brand-mark">S</span>
                    <span>SPOTLITE</span>
                </a>

                <nav class="nav-links" aria-label="Main navigation">
                    <a href="#categories">Categories</a>
                    <a href="#solutions">Solutions</a>
                    <a href="#why-spotlite">Why Spotlite</a>
                    <a href="#contact">Contact</a>
                </nav>

                <div class="nav-actions">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-outline">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </header>

        <main>
            <section class="hero">
                <div class="container hero-shell">
                    <div class="hero-copy">
                        <span class="eyebrow">Reliable industrial supply</span>
                        <h1>Smarter sourcing for businesses that need results.</h1>
                        <p>
                            Spotlite helps manufacturers, contractors, and growing operations source dependable products,
                            manage purchases efficiently, and keep projects moving with confidence.
                        </p>

                        <div class="hero-actions">
                            <a href="#categories" class="btn btn-primary">Explore products</a>
                            <a href="#contact" class="btn btn-outline">Request a quote</a>
                        </div>

                        <div class="hero-stats">
                            <div class="stat">
                                <strong>2,500+</strong>
                                <span>Products in stock</span>
                            </div>
                            <div class="stat">
                                <strong>96%</strong>
                                <span>Repeat customer rate</span>
                            </div>
                            <div class="stat">
                                <strong>24/7</strong>
                                <span>Support for buyers</span>
                            </div>
                        </div>
                    </div>

                    <div class="hero-visual" aria-label="Spotlite product preview">
                        <div class="visual-card">
                            <span class="badge">Fast-moving inventory</span>
                            <ul class="visual-list">
                                <li><span class="check">✓</span> Industrial fasteners and hardware</li>
                                <li><span class="check">✓</span> Safety equipment and PPE essentials</li>
                                <li><span class="check">✓</span> Electrical, plumbing and maintenance supplies</li>
                                <li><span class="check">✓</span> Tailored recommendations for your workflow</li>
                            </ul>
                        </div>

                        <div class="mini-panels">
                            <div class="mini-panel">
                                <small>Top category</small>
                                <strong>Maintenance Supplies</strong>
                            </div>
                            <div class="mini-panel">
                                <small>Average delivery</small>
                                <strong>48 hours</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="categories">
                <div class="container">
                    <div class="section-header">
                        <h2>Choose the category that fits your operation.</h2>
                        <p>From everyday essentials to specialist requirements, Spotlite keeps your procurement simple and dependable.</p>
                    </div>

                    <div class="categories">
                        <article class="category">
                            <div class="category-icon">🧰</div>
                            <h3>Tools & Hardware</h3>
                            <p>Reliable tools, fasteners, and workshop essentials for daily operations.</p>
                        </article>
                        <article class="category">
                            <div class="category-icon">⚡</div>
                            <h3>Electrical</h3>
                            <p>Cables, fittings, switches, and components built for safe, efficient installations.</p>
                        </article>
                        <article class="category">
                            <div class="category-icon">🛡️</div>
                            <h3>Safety & PPE</h3>
                            <p>Protective gear and compliance-focused equipment for safer workplaces.</p>
                        </article>
                        <article class="category">
                            <div class="category-icon">🏭</div>
                            <h3>Industrial Materials</h3>
                            <p>High-quality materials for production, maintenance, and facility continuity.</p>
                        </article>
                    </div>
                </div>
            </section>

            <section id="solutions">
                <div class="container">
                    <div class="section-header">
                        <h2>Built for procurement teams and growing businesses.</h2>
                        <p>Spotlite brings together product selection, pricing visibility, and support in one streamlined experience.</p>
                    </div>

                    <div class="features">
                        <article class="feature">
                            <h3>Easy product discovery</h3>
                            <p>Browse relevant categories quickly, compare offerings, and find the right items for your next job.</p>
                        </article>
                        <article class="feature">
                            <h3>Quotations that move fast</h3>
                            <p>Request pricing and get clear commercial information without unnecessary back-and-forth.</p>
                        </article>
                        <article class="feature">
                            <h3>Support when you need it</h3>
                            <p>Reach the team for guidance, product questions, and order follow-up as your project progresses.</p>
                        </article>
                    </div>
                </div>
            </section>

            <section id="why-spotlite">
                <div class="container">
                    <div class="section-header">
                        <h2>Why businesses choose Spotlite</h2>
                        <p>We focus on dependable supply, clear communication, and practical support from first inquiry to final delivery.</p>
                    </div>

                    <div class="features">
                        <article class="feature">
                            <h3>Dependable inventory</h3>
                            <p>Keep operations moving with products you can source consistently and confidently.</p>
                        </article>
                        <article class="feature">
                            <h3>Commercial clarity</h3>
                            <p>Get transparent pricing and straightforward ordering that saves time across teams.</p>
                        </article>
                        <article class="feature">
                            <h3>Operational flexibility</h3>
                            <p>Serve projects of different sizes with a supply approach that adapts to real-world demand.</p>
                        </article>
                    </div>
                </div>
            </section>

            <section class="cta" id="contact">
                <div class="container">
                    <div class="cta-box">
                        <div>
                            <h3>Ready to simplify your next purchase?</h3>
                            <p>Talk to Spotlite about the products, quantities, and support your business needs.</p>
                        </div>
                        <a href="{{ route('register') }}" class="btn">Get started</a>
                    </div>
                </div>
            </section>
        </main>

        <footer>
            <div class="container footer-inner">
                <span>© {{ date('Y') }} Spotlite. All rights reserved.</span>
                <span>Industrial supply solutions for modern businesses</span>
            </div>
        </footer>
    </body>
</html>
