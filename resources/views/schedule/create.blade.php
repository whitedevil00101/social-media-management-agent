<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BrandFlow · professional Instagram dashboard</title>
    <!-- Font & icon library (Font Awesome 6) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* ========== GLOBAL DESIGN SYSTEM (brand variables) ========== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        body {
            background-color: #f0f3f8;   /* soft grey-blue background */
            color: #1e2837;
            line-height: 1.5;
            padding: 24px 32px;
            min-height: 100vh;
        }

        /* ===== BRAND COLOR PALETTE (reusable tokens) ===== */
        :root {
            --brand-primary: #4f46e5;        /* indigo – primary actions */
            --brand-primary-light: #6366f1;   /* hover states */
            --brand-secondary: #f97316;       /* orange – accents, warnings */
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

        /* ===== TYPOGRAPHY & UTILITY CLASSES ===== */
        h1, h2, h3 {
            font-weight: 600;
            letter-spacing: -0.02em;
        }

        h1 {
            font-size: 2rem;
        }

        h2 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .text-secondary {
            color: var(--brand-text-secondary);
            font-size: 0.95rem;
        }

        /* ===== LAYOUT – DASHBOARD GRID ===== */
        .dashboard {
            max-width: 1440px;
            margin: 0 auto;
        }

        /* header with brand identity */
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            background: var(--brand-primary);
            width: 48px;
            height: 48px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.8rem;
            box-shadow: 0 12px 18px -8px rgba(79, 70, 229, 0.4);
        }

        .brand-tag {
            background: white;
            border-radius: var(--radius-full);
            padding: 8px 20px;
            font-weight: 500;
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

        /* metrics cards row */
        .metric-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 32px;
        }

        .metric-card {
            background: var(--brand-bg-card);
            border-radius: var(--radius-md);
            padding: 1.4rem 1.5rem;
            box-shadow: var(--brand-shadow);
            border: 1px solid var(--brand-border);
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .metric-icon {
            width: 52px;
            height: 52px;
            border-radius: 20px;
            background: rgba(79, 70, 229, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--brand-primary);
            font-size: 1.8rem;
        }

        .metric-content h3 {
            font-size: 1.8rem;
            line-height: 1.2;
            color: var(--brand-text-primary);
        }

        .metric-content p {
            color: var(--brand-text-secondary);
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* main two-column layout */
        .dashboard-main {
            display: grid;
            grid-template-columns: 1.3fr 2fr;
            gap: 26px;
            margin-bottom: 30px;
        }

        /* left column – schedule form card (extends original) */
        .card {
            background: var(--brand-bg-card);
            border-radius: var(--radius-lg);
            padding: 2rem 1.8rem;
            box-shadow: var(--brand-shadow);
            border: 1px solid var(--brand-border);
            transition: box-shadow 0.2s;
        }

        .card:hover {
            box-shadow: var(--brand-shadow-hover);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 1.75rem;
        }

        .card-header i {
            font-size: 1.6rem;
            color: var(--brand-primary);
            background: rgba(79, 70, 229, 0.08);
            padding: 8px;
            border-radius: 16px;
        }

        .card-header h3 {
            font-size: 1.4rem;
        }

        /* form elements – reusable */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 550;
            font-size: 0.9rem;
            color: var(--brand-text-secondary);
            margin-bottom: 6px;
        }

        .form-group label i {
            color: var(--brand-primary);
            width: 18px;
        }

        .form-control, select, textarea, input[type="datetime-local"], input[type="file"] {
            width: 100%;
            background: var(--brand-bg-card);
            border: 1.5px solid var(--brand-border);
            border-radius: var(--radius-sm);
            padding: 0.9rem 1.2rem;
            font-size: 0.95rem;
            color: var(--brand-text-primary);
            transition: 0.15s;
        }

        .form-control:focus, select:focus, textarea:focus, input[type="datetime-local"]:focus {
            outline: none;
            border-color: var(--brand-primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.15);
        }

        /* custom file input */
        input[type="file"] {
            padding: 0.6rem 1.2rem;
            background: #fafcff;
        }

        input[type="file"]::file-selector-button {
            background: var(--brand-primary);
            color: white;
            border: none;
            border-radius: 40px;
            padding: 0.5rem 1.5rem;
            margin-right: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.15s;
        }

        input[type="file"]::file-selector-button:hover {
            background: var(--brand-primary-light);
        }

        select {
            appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="%23526077" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>');
            background-repeat: no-repeat;
            background-position: right 1.2rem center;
            background-size: 1rem;
        }

        .btn-primary {
            background: var(--brand-primary);
            color: white;
            border: none;
            border-radius: var(--radius-full);
            padding: 1rem 2rem;
            font-size: 1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            width: 100%;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 10px 20px -5px rgba(79, 70, 229, 0.4);
            margin-top: 10px;
        }

        .btn-primary:hover {
            background: var(--brand-primary-light);
            transform: translateY(-2px);
            box-shadow: 0 20px 30px -8px rgba(79, 70, 229, 0.5);
        }

        .alert-success {
            background: var(--brand-success-bg);
            color: var(--brand-success-text);
            padding: 1rem 1.5rem;
            border-radius: var(--radius-full);
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
            border-left: 6px solid #2b8c5e;
        }

        /* right column – queue & insights */
        .queue-card {
            background: var(--brand-bg-card);
            border-radius: var(--radius-lg);
            padding: 1.8rem 1.8rem 1rem 1.8rem;
            box-shadow: var(--brand-shadow);
            border: 1px solid var(--brand-border);
            height: fit-content;
        }

        .queue-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .queue-header h3 {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .badge {
            background: rgba(79, 70, 229, 0.1);
            padding: 4px 14px;
            border-radius: var(--radius-full);
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--brand-primary);
        }

        .post-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 1rem 0;
            border-bottom: 1px solid var(--brand-border);
        }

        .post-item:last-child {
            border-bottom: none;
        }

        .post-thumb {
            width: 56px;
            height: 56px;
            background: linear-gradient(145deg, #eef2f6, #ffffff);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: var(--brand-primary);
            border: 1px solid var(--brand-border);
        }

        .post-info {
            flex: 1;
        }

        .post-info p {
            font-weight: 550;
            color: var(--brand-text-primary);
            margin-bottom: 4px;
        }

        .post-meta {
            display: flex;
            gap: 16px;
            font-size: 0.8rem;
            color: var(--brand-text-muted);
        }

        .post-meta i {
            margin-right: 4px;
        }

        .status-badge {
            background: #e9eefa;
            color: var(--brand-primary);
            font-size: 0.7rem;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 60px;
        }

        /* recent activity (third row) */
        .activity-section {
            background: var(--brand-bg-card);
            border-radius: var(--radius-lg);
            padding: 1.5rem 1.8rem;
            box-shadow: var(--brand-shadow);
            border: 1px solid var(--brand-border);
            margin-top: 26px;
        }

        .activity-row {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 0.9rem 0;
            border-bottom: 1px solid var(--brand-border);
        }

        .activity-row:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 42px;
            height: 42px;
            background: #f4f7fd;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--brand-primary);
        }

        /* responsiveness */
        @media (max-width: 1100px) {
            .metric-grid { grid-template-columns: repeat(2,1fr); }
            .dashboard-main { grid-template-columns: 1fr; }
            body { padding: 20px; }
        }

        @media (max-width: 600px) {
            .metric-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
<div class="dashboard">
    <!-- ========== HEADER with brand management ========== -->
    <div class="dashboard-header">
        <div class="logo-area">
            <div class="logo-icon"><i class="fas fa-chart-pie"></i></div>
            <h1>BrandFlow<span style="font-weight:400; color: var(--brand-text-secondary); font-size:1.2rem; margin-left:10px;">| Instagram</span></h1>
        </div>
        <div class="brand-tag">
            <i class="fas fa-check-circle"></i> <span>brand assets: indigo & orange · <strong>v2.3</strong></span>
        </div>
    </div>

    <!-- ========== METRIC CARDS (professional dashboard KPIs) ========== -->
    <div class="metric-grid">
        <div class="metric-card">
            <div class="metric-icon"><i class="fas fa-calendar-alt"></i></div>
            <div class="metric-content">
                <h3>14</h3>
                <p>scheduled posts</p>
            </div>
        </div>
        <div class="metric-card">
            <div class="metric-icon"><i class="fas fa-check-circle" style="color:#f97316; background: rgba(249,115,22,0.1);"></i></div>
            <div class="metric-content">
                <h3>9</h3>
                <p>published (month)</p>
            </div>
        </div>
        <div class="metric-card">
            <div class="metric-icon"><i class="fas fa-users"></i></div>
            <div class="metric-content">
                <h3>8.2k</h3>
                <p>total reach</p>
            </div>
        </div>
        <div class="metric-card">
            <div class="metric-icon"><i class="fas fa-clock"></i></div>
            <div class="metric-content">
                <h3>6</h3>
                <p>drafts ready</p>
            </div>
        </div>
    </div>

    <!-- ========== MAIN DASHBOARD AREA: schedule + upcoming ========== -->
    <div class="dashboard-main">
        <!-- LEFT COLUMN – original schedule form (fully preserved) -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-plus-circle"></i>
                <h3>Schedule new post</h3>
            </div>

            <!-- DYNAMIC SUCCESS MESSAGE (exactly as blade) -->
            <!--
                @if (session('success'))
            -->
            <div class="alert-success">
                <i class="fas fa-circle-check"></i>
                <!-- {{ session('success') }} -->
                <span>Post scheduled to Instagram (demo feedback)</span>
            </div>
            <!--
                @endif
            -->

            <!-- Laravel form: method POST, action /schedule/store, enctype -->
            <form method="POST" action="/schedule/store" enctype="multipart/form-data">
                <!-- @csrf token (placeholder) -->
                <input type="hidden" name="_token" value="static_demo_token_xyz" autocomplete="off">

                <!-- Instagram account dropdown -->
                <div class="form-group">
                    <label><i class="fab fa-instagram"></i> Instagram account</label>
                    <select name="instagram_account_id" class="form-control">
                        <!-- @foreach ($accounts as $a) -->
                        <option value="1">@brand_narrative (primary)</option>
                        <option value="2">@creative.studio</option>
                        <option value="3">@travel_lens</option>
                        <!-- @endforeach -->
                    </select>
                </div>

                <!-- Caption field -->
                <div class="form-group">
                    <label><i class="fas fa-quote-right"></i> Caption</label>
                    <textarea name="caption" rows="3" placeholder="Write a compelling caption... use #hashtags" class="form-control">🚀 New summer collection drops next week! ✨ #streetwear</textarea>
                </div>

                <!-- Media + schedule time side by side (inline row) -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div class="form-group">
                        <label><i class="fas fa-cloud-upload-alt"></i> Media</label>
                        <input type="file" name="media" accept="image/*,video/*" class="form-control">
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-calendar-clock"></i> Schedule</label>
                        <input type="datetime-local" name="scheduled_at" class="form-control" value="2025-06-10T09:30">
                    </div>
                </div>

                <!-- submit button (primary) -->
                <button type="submit" class="btn-primary">
                    <i class="fas fa-instagram"></i> Schedule post
                    <i class="fas fa-arrow-right"></i>
                </button>
            </form>

            <!-- subtle brand note -->
            <div style="margin-top: 20px; color: var(--brand-text-muted); font-size:0.8rem; display: flex; gap: 16px;">
                <span><i class="fas-regular fa-circle" style="color:var(--brand-primary);"></i> reusable card system</span>
                <span><i class="fas-regular fa-circle" style="color:var(--brand-secondary);"></i> brand variables</span>
            </div>
        </div>

        <!-- RIGHT COLUMN – upcoming queue (professional) -->
        <div class="queue-card">
            <div class="queue-header">
                <h3><i class="fas fa-list-check" style="color:var(--brand-primary);"></i> Upcoming queue</h3>
                <span class="badge">5 posts</span>
            </div>

            <!-- scheduled posts list (static demo) -->
            <div class="post-item">
                <div class="post-thumb"><i class="fas fa-image"></i></div>
                <div class="post-info">
                    <p>Summer lookbook • carousel</p>
                    <div class="post-meta">
                        <span><i class="far fa-clock"></i> Jun 12, 11:30</span>
                        <span><i class="fas fa-instagram"></i> @main</span>
                    </div>
                </div>
                <div class="status-badge">on time</div>
            </div>

            <div class="post-item">
                <div class="post-thumb"><i class="fas fa-video"></i></div>
                <div class="post-info">
                    <p>Behind the scenes (reel)</p>
                    <div class="post-meta">
                        <span><i class="far fa-clock"></i> Jun 13, 16:00</span>
                        <span><i class="fas fa-instagram"></i> @studio</span>
                    </div>
                </div>
                <div class="status-badge">draft</div>
            </div>

            <div class="post-item">
                <div class="post-thumb"><i class="fas fa-calendar"></i></div>
                <div class="post-info">
                    <p>Product launch • story</p>
                    <div class="post-meta">
                        <span><i class="far fa-clock"></i> Jun 15, 09:00</span>
                        <span><i class="fas fa-instagram"></i> @travel</span>
                    </div>
                </div>
                <div class="status-badge">approved</div>
            </div>

            <div style="margin-top: 1.2rem; text-align: right;">
                <a href="#" style="color: var(--brand-primary); text-decoration: none; font-weight: 500;">View all <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>

    <!-- ========== EXTRA SECTION: recent activity (professional touch) ========== -->
    <div class="activity-section">
        <h2 style="margin-bottom: 0.2rem; font-size: 1.3rem;"><i class="fas fa-history" style="color:var(--brand-primary);"></i> Recent activity</h2>
        <p class="text-secondary" style="margin-bottom: 1rem;">Track scheduled & published actions</p>

        <div class="activity-row">
            <div class="activity-icon"><i class="fas fa-check"></i></div>
            <div><strong>Creative studio</strong> — post published 2h ago · 1,230 impressions</div>
        </div>
        <div class="activity-row">
            <div class="activity-icon"><i class="fas fa-clock"></i></div>
            <div><strong>Summer lookbook</strong> scheduled for tomorrow 11:30 AM</div>
        </div>
        <div class="activity-row">
            <div class="activity-icon"><i class="fas fa-image"></i></div>
            <div><strong>Media uploaded</strong> — 4 new items in drafts</div>
        </div>
    </div>

    <!-- subtle footnote: complete brand system reusability -->
    <div style="display: flex; justify-content: flex-end; gap: 20px; margin-top: 20px; font-size:0.85rem; color: var(--brand-text-muted);">
        <span><i class="fas-regular fa-circle" style="color: var(--brand-primary);"></i> palette: indigo / orange</span>
        <span><i class="fas-regular fa-circle" style="color: var(--brand-secondary);"></i> radius variables</span>
        <span>✨ reusable across all dashboards</span>
    </div>
</div>

<!--
    PROFESSIONAL DASHBOARD READY:
    - original schedule form fully preserved (with blade comments)
    - added metrics row + queue + activity feed
    - all styles based on css variables → use same classes elsewhere
    - brand colors consistent and configurable in :root
-->
</body>
</html>
