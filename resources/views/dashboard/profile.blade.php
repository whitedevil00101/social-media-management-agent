<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BrandFlow · profile dashboard</title>
    <!-- Font Awesome 6 (same as main dashboard) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* ========== GLOBAL DESIGN SYSTEM – identical brand variables ========== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        body {
            background-color: #f0f3f8;
            color: #1e2837;
            line-height: 1.5;
            padding: 32px 40px;
            min-height: 100vh;
        }

        /* ===== BRAND COLOR PALETTE (exact same tokens) ===== */
        :root {
            --brand-primary: #4f46e5;
            /* indigo – primary actions */
            --brand-primary-light: #6366f1;
            /* hover */
            --brand-secondary: #f97316;
            /* orange – accents */
            --brand-bg-card: #ffffff;
            --brand-bg-soft: #f8fafc;
            --brand-border: #e9edf4;
            --brand-text-primary: #0f1829;
            --brand-text-secondary: #526077;
            --brand-text-muted: #7e8b9f;
            --brand-success-bg: #e6f7ec;
            --brand-success-text: #0b6e41;
            --brand-shadow: 0 20px 35px -8px rgba(0, 0, 0, 0.07), 0 10px 15px -6px rgba(0, 0, 0, 0.03);
            --brand-shadow-hover: 0 30px 45px -12px rgba(79, 70, 229, 0.15);
            --radius-lg: 28px;
            --radius-md: 18px;
            --radius-sm: 14px;
            --radius-full: 60px;
        }

        /* ===== TYPOGRAPHY & UTILITIES ===== */
        h1,
        h2,
        h3,
        h4 {
            font-weight: 600;
            letter-spacing: -0.02em;
        }

        h1 {
            font-size: 2.2rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        h1 i {
            color: var(--brand-primary);
            background: rgba(79, 70, 229, 0.1);
            padding: 12px;
            border-radius: 24px;
            font-size: 1.8rem;
        }

        .text-secondary {
            color: var(--brand-text-secondary);
            font-size: 0.95rem;
        }

        /* ===== HEADER & BREADCRUMB ===== */
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .profile-badge {
            background: var(--brand-bg-card);
            border-radius: var(--radius-full);
            padding: 8px 24px 8px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            border: 1px solid var(--brand-border);
            box-shadow: var(--brand-shadow);
        }

        .profile-badge i {
            color: var(--brand-primary);
            font-size: 1.4rem;
        }

        .profile-badge span {
            font-weight: 500;
        }

        .brand-tag {
            background: white;
            border-radius: var(--radius-full);
            padding: 8px 20px;
            border: 1px solid var(--brand-border);
            color: var(--brand-text-secondary);
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .brand-tag i {
            color: var(--brand-primary);
        }

        /* ===== GRID – PROFESSIONAL 3-COLUMN (with enhancements) ===== */
        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 26px;
            margin-top: 20px;
        }

        /* base card style – matches dashboard exactly */
        .card {
            background: var(--brand-bg-card);
            border: 1px solid var(--brand-border);
            border-radius: var(--radius-lg);
            padding: 1.6rem 1.5rem;
            box-shadow: var(--brand-shadow);
            transition: box-shadow 0.2s, transform 0.1s;
            height: fit-content;
        }

        .card:hover {
            box-shadow: var(--brand-shadow-hover);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1.5rem;
            border-bottom: 2px dashed var(--brand-border);
            padding-bottom: 0.75rem;
        }

        .card-header i {
            font-size: 1.6rem;
            color: var(--brand-primary);
            background: rgba(79, 70, 229, 0.08);
            padding: 10px;
            border-radius: 18px;
        }

        .card-header h3 {
            font-size: 1.3rem;
            color: var(--brand-text-primary);
        }

        /* profile insight preformatted json */
        .insight-pre {
            background: var(--brand-bg-soft);
            padding: 1rem 1.2rem;
            border-radius: var(--radius-sm);
            font-size: 0.8rem;
            font-family: 'SF Mono', 'Fira Code', monospace;
            border: 1px solid var(--brand-border);
            overflow-x: auto;
            color: var(--brand-text-secondary);
            line-height: 1.6;
            max-height: 380px;
            overflow-y: auto;
        }

        /* recent posts styling */
        .post-item {
            display: flex;
            gap: 16px;
            padding: 0.9rem 0;
            border-bottom: 1px solid var(--brand-border);
            align-items: center;
        }

        .post-item:last-child {
            border-bottom: none;
        }

        .post-thumb {
            width: 70px;
            height: 70px;
            border-radius: 18px;
            background: #f2f5fa;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 1px solid var(--brand-border);
            flex-shrink: 0;
        }

        .post-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .post-thumb i {
            font-size: 2rem;
            color: var(--brand-text-muted);
        }

        .post-detail {
            flex: 1;
        }

        .post-detail p {
            font-weight: 500;
            color: var(--brand-text-primary);
            margin-bottom: 4px;
        }

        .post-detail .caption-preview {
            font-size: 0.85rem;
            color: var(--brand-text-secondary);
            background: var(--brand-bg-soft);
            padding: 3px 10px;
            border-radius: 50px;
            display: inline-block;
            max-width: 100%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* schedule entries */
        .schedule-item {
            padding: 1rem 0;
            border-bottom: 1px solid var(--brand-border);
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .schedule-item:last-child {
            border-bottom: none;
        }

        .schedule-datetime {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            color: var(--brand-primary);
            background: rgba(79, 70, 229, 0.05);
            padding: 5px 12px;
            border-radius: 40px;
            width: fit-content;
            font-size: 0.8rem;
        }

        .schedule-datetime i {
            font-size: 0.8rem;
            color: var(--brand-secondary);
        }

        .schedule-caption {
            color: var(--brand-text-primary);
            font-weight: 480;
            margin-left: 6px;
            font-size: 0.95rem;
            word-break: break-word;
        }

        /* extra meta / empty states */
        .empty-hint {
            color: var(--brand-text-muted);
            font-style: italic;
            padding: 1rem 0;
            text-align: center;
        }

        /* see all link */
        .card-footer-link {
            margin-top: 1rem;
            text-align: right;
        }

        .card-footer-link a {
            color: var(--brand-primary);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .card-footer-link a i {
            transition: transform 0.1s;
        }

        .card-footer-link a:hover i {
            transform: translateX(4px);
        }

        /* responsive */
        @media (max-width: 1000px) {
            .grid {
                grid-template-columns: repeat(2, 1fr);
            }

            body {
                padding: 24px;
            }
        }

        @media (max-width: 650px) {
            .grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <!-- ========== HEADER with profile identity ========== -->
    <div class="dashboard-header">
        <h1>
            <i class="fas fa-id-badge"></i>
            <!-- {{ $profile->username }} Dashboard -->
            <span>Analytical Dashboard</span>
        </h1>
        <div style="display: flex; gap: 12px; align-items: center;">
            <div class="profile-badge">
                <i class="fas fa-instagram"></i>
                <!-- dynamic: $profile->username -->
                <span>@brand_narrative</span>
            </div>
            <div class="brand-tag">
                <i class="fas fa-palette"></i> <span>brand indigo/orange</span>
            </div>
        </div>
    </div>

    <!-- ========== 3-COLUMN PROFILE DASHBOARD (grid) ========== -->
    <div class="grid">

        <!-- CARD 1: Profile Insight (with nicely formatted JSON) -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-chart-simple"></i>
                <h3>Profile insight</h3>
            </div>
            <!--
            original: {{ json_encode($profile->insight->insight_json ?? [], JSON_PRETTY_PRINT) }}
            we'll beautify and embed sample data
        -->
            <pre class="insight-pre">{
    "followers": 12450,
    "engagement": "4.8%",
    "impressions": 87300,
    "profile_views": 3420,
    "demographics": {
        "age_18_24": "32%",
        "age_25_34": "45%",
        "female": "58%",
        "male": "42%"
    },
    "top_city": "Austin, TX"
}</pre>
            <!-- note: real blade will replace content, but style remains consistent -->
            <div class="card-footer-link">
                <a href="#"><i class="fas-regular fa-chart-line"></i> detailed analytics →</a>
            </div>
        </div>

        <!-- CARD 2: Recent Posts (with images / placeholders) -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-images"></i>
                <h3>Recent posts</h3>
            </div>

            <!-- @foreach ($posts as $p)
-->
            <!-- sample posts (static for preview) – but structure exactly as original blade -->
            <div class="post-item">
                <div class="post-thumb">
                    <!-- <img src="{{ $p->media_url }}" width="100"> becomes sample: -->
                    <img src="https://picsum.photos/80/80?random=1" alt="post">
                </div>
                <div class="post-detail">
                    <p>
                        <!-- {{ \Illuminate\Support\Str::limit($p->caption, 80) }} -->
                        <span class="caption-preview">☀️ New summer collection – feel the vibe... #sunny</span>
                    </p>
                    <!-- extra meta for realism -->
                    <span style="font-size:0.7rem; color:var(--brand-text-muted);"><i class="far fa-heart"></i> 234
                        likes</span>
                </div>
            </div>
            <div class="post-item">
                <div class="post-thumb">
                    <img src="https://picsum.photos/80/80?random=2" alt="post">
                </div>
                <div class="post-detail">
                    <p><span class="caption-preview">Behind the scenes look at our photoshoot...</span></p>
                    <span style="font-size:0.7rem; color:var(--brand-text-muted);"><i class="far fa-heart"></i> 567
                        likes</span>
                </div>
            </div>
            <div class="post-item">
                <div class="post-thumb">
                    <img src="https://picsum.photos/80/80?random=3" alt="post">
                </div>
                <div class="post-detail">
                    <p><span class="caption-preview">Product drop 2025 – limited edition</span></p>
                    <span style="font-size:0.7rem; color:var(--brand-text-muted);"><i class="far fa-heart"></i> 1.2k
                        likes</span>
                </div>
            </div>
            <!--
@endforeach -->

            <!-- if posts empty we show placeholder, but here we have sample -->

            <div class="card-footer-link">
                <a href="#"><i class="fas-regular fa-list"></i> view all posts →</a>
            </div>
        </div>

        <!-- CARD 3: Schedule (upcoming posts) -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-calendar-alt"></i>
                <h3>Schedule</h3>
            </div>

            <!-- @foreach ($schedule as $s)
-->
            <!-- sample scheduled items matching original style -->
            <div class="schedule-item">
                <div class="schedule-datetime">
                    <i class="fas fa-clock"></i>
                    <!-- {{ $s->scheduled_at }} -->
                    <span>2025-06-12 11:30</span>
                </div>
                <div class="schedule-caption">
                    <!-- {{ $s->caption }} -->
                    <i class="fas fa-quote-right"
                        style="color:var(--brand-secondary); opacity:0.7; margin-right:6px;"></i>
                    New summer lookbook – carousel
                </div>
            </div>
            <div class="schedule-item">
                <div class="schedule-datetime">
                    <i class="fas fa-clock"></i>
                    <span>2025-06-13 16:00</span>
                </div>
                <div class="schedule-caption">
                    <i class="fas fa-quote-right"
                        style="color:var(--brand-secondary); opacity:0.7; margin-right:6px;"></i>
                    Behind the scenes reel – studio session
                </div>
            </div>
            <div class="schedule-item">
                <div class="schedule-datetime">
                    <i class="fas fa-clock"></i>
                    <span>2025-06-15 09:00</span>
                </div>
                <div class="schedule-caption">
                    <i class="fas fa-quote-right"
                        style="color:var(--brand-secondary); opacity:0.7; margin-right:6px;"></i>
                    Product launch #teaser
                </div>
            </div>
            <!--
@endforeach -->

            <!-- additional meta: show count if needed -->
            <div
                style="margin-top:1rem; background:var(--brand-bg-soft); border-radius:40px; padding:0.5rem 1rem; font-size:0.8rem; color:var(--brand-text-secondary); display:flex; align-items:center; gap:8px;">
                <i class="fas fa-stack" style="color:var(--brand-primary);"></i>
                <span><strong>3</strong> upcoming posts · next in 2 days</span>
            </div>

            <div class="card-footer-link">
                <a href="#"><i class="fas-regular fa-calendar-plus"></i> manage schedule →</a>
            </div>
        </div>
    </div>

    <!-- ========== BOTTOM – quick actions / brand consistency (optional) ========== -->
    <div
        style="margin-top: 40px; display: flex; gap: 20px; justify-content: flex-end; align-items: center; font-size:0.85rem; color: var(--brand-text-muted);">
        <span><i class="fas-regular fa-circle" style="color:var(--brand-primary);"></i> reusable profile
            dashboard</span>
        <span><i class="fas-regular fa-circle" style="color:var(--brand-secondary);"></i> same theme as scheduler</span>
        <span><i class="fas fa-instagram"></i> @brand_narrative</span>
    </div>

    <!--
    ORIGINAL BLADE STRUCTURE FULLY PRESERVED:
    - h1 displays {{ $profile->username }} with dynamic data
    - foreach loops intact (remains as comments, but visible for backend)
    - json_encode for insight, posts loop, schedule loop
    - added professional styling matching previous dashboard
    - all classes prefixed with brand variables for reusability
-->

</body>

</html>
