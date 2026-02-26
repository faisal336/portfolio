<?php
require_once __DIR__ . '/config.php';
require_login();

$data = load_data();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Dashboard — Faisal Akhtar</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <style>
    :root {
      --bg: #0a0f1a; --bg2: #0f1628; --card: #131c31; --card-hover: #182240;
      --border: rgba(255,255,255,0.06); --muted: #7c8db5; --text: #c9d6ef; --white: #eaf0ff;
      --accent: #3b82f6; --accent2: #8b5cf6; --accent3: #06b6d4;
      --gradient: linear-gradient(135deg, var(--accent2), var(--accent));
      --danger: #f43f5e; --success: #22c55e;
    }
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; }

    /* Sidebar */
    .layout { display: grid; grid-template-columns: 260px 1fr; min-height: 100vh; }
    .sidebar {
      background: var(--bg2); border-right: 1px solid var(--border);
      padding: 24px 0; display: flex; flex-direction: column;
    }
    .sidebar-brand { display: flex; align-items: center; gap: 12px; padding: 0 20px; margin-bottom: 32px; }
    .sidebar-logo {
      width: 40px; height: 40px; border-radius: 10px; background: var(--gradient);
      display: grid; place-items: center; font-weight: 800; font-size: 16px; color: #fff;
    }
    .sidebar-brand span { font-weight: 700; font-size: 16px; color: var(--white); }
    .sidebar-brand small { display: block; font-size: 11px; color: var(--muted); font-weight: 400; }
    .sidebar-nav { flex: 1; }
    .sidebar-nav a {
      display: flex; align-items: center; gap: 12px;
      padding: 12px 24px; color: var(--muted); text-decoration: none;
      font-size: 14px; font-weight: 500; transition: all 0.2s; border-left: 3px solid transparent;
    }
    .sidebar-nav a:hover, .sidebar-nav a.active {
      background: rgba(255,255,255,0.03); color: var(--white); border-left-color: var(--accent);
    }
    .sidebar-nav a i { width: 20px; text-align: center; }
    .sidebar-footer { padding: 16px 20px; border-top: 1px solid var(--border); }
    .sidebar-footer a {
      display: flex; align-items: center; gap: 10px;
      color: var(--danger); text-decoration: none; font-size: 14px; font-weight: 500;
    }

    /* Main */
    .main { padding: 32px; overflow-y: auto; }
    .page-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 32px; }
    .page-header h1 { font-size: 24px; font-weight: 800; color: var(--white); }
    .breadcrumb { font-size: 13px; color: var(--muted); }

    /* Tab panels */
    .tabs { display: flex; gap: 4px; margin-bottom: 24px; background: var(--bg2); padding: 4px; border-radius: 12px; }
    .tab {
      padding: 10px 20px; border-radius: 10px; border: none; background: none;
      color: var(--muted); font-family: inherit; font-size: 14px; font-weight: 500;
      cursor: pointer; transition: all 0.2s; display: flex; align-items: center; gap: 8px;
    }
    .tab:hover { color: var(--white); }
    .tab.active { background: var(--card); color: var(--white); box-shadow: 0 2px 8px rgba(0,0,0,0.2); }
    .panel { display: none; }
    .panel.active { display: block; }

    /* Cards / Table */
    .data-card {
      background: var(--card); border: 1px solid var(--border);
      border-radius: 16px; overflow: hidden;
    }
    .data-header {
      display: flex; align-items: center; justify-content: space-between;
      padding: 20px 24px; border-bottom: 1px solid var(--border);
    }
    .data-header h3 { font-size: 16px; font-weight: 700; color: var(--white); }
    table { width: 100%; border-collapse: collapse; }
    th { text-align: left; padding: 12px 24px; font-size: 12px; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 1px solid var(--border); }
    td { padding: 14px 24px; font-size: 14px; border-bottom: 1px solid var(--border); }
    tr:last-child td { border-bottom: none; }
    tr:hover { background: rgba(255,255,255,0.02); }

    /* Buttons */
    .btn {
      display: inline-flex; align-items: center; gap: 6px;
      padding: 8px 16px; border-radius: 8px; font-size: 13px; font-weight: 600;
      border: none; cursor: pointer; font-family: inherit; transition: all 0.2s;
    }
    .btn-sm { padding: 6px 12px; font-size: 12px; }
    .btn-primary { background: var(--gradient); color: #fff; }
    .btn-primary:hover { transform: translateY(-1px); }
    .btn-outline { background: none; border: 1px solid var(--border); color: var(--muted); }
    .btn-outline:hover { border-color: var(--accent); color: var(--accent); }
    .btn-danger { background: rgba(244,63,94,0.1); color: var(--danger); border: 1px solid rgba(244,63,94,0.2); }
    .btn-danger:hover { background: rgba(244,63,94,0.2); }
    .btn-success { background: rgba(34,197,94,0.1); color: var(--success); border: 1px solid rgba(34,197,94,0.2); }
    .action-btns { display: flex; gap: 6px; }

    /* Modal */
    .modal-overlay {
      display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.6);
      backdrop-filter: blur(4px); z-index: 1000; place-items: center;
    }
    .modal-overlay.open { display: grid; }
    .modal {
      background: var(--card); border: 1px solid var(--border);
      border-radius: 20px; padding: 32px; width: 100%; max-width: 520px;
      box-shadow: 0 20px 60px rgba(0,0,0,0.4);
    }
    .modal h2 { font-size: 20px; font-weight: 700; color: var(--white); margin-bottom: 20px; }
    .form-group { margin-bottom: 16px; }
    .form-group label { display: block; font-size: 13px; font-weight: 500; color: var(--muted); margin-bottom: 6px; }
    .form-group input, .form-group textarea, .form-group select {
      width: 100%; padding: 10px 14px; border-radius: 8px;
      border: 1px solid var(--border); background: rgba(255,255,255,0.03);
      color: var(--white); font-family: inherit; font-size: 14px; outline: none;
    }
    .form-group input:focus, .form-group textarea:focus, .form-group select:focus { border-color: var(--accent); }
    .form-group textarea { resize: vertical; }
    .form-group select option { background: var(--card); }
    .modal-btns { display: flex; gap: 10px; justify-content: flex-end; margin-top: 24px; }

    /* Toast */
    .toast {
      position: fixed; bottom: 24px; right: 24px; z-index: 2000;
      padding: 12px 20px; border-radius: 10px; font-size: 14px; font-weight: 500;
      display: none; align-items: center; gap: 8px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.3);
    }
    .toast.show { display: flex; animation: slideIn 0.3s ease; }
    .toast.success { background: rgba(34,197,94,0.15); border: 1px solid rgba(34,197,94,0.3); color: var(--success); }
    .toast.error { background: rgba(244,63,94,0.15); border: 1px solid rgba(244,63,94,0.3); color: var(--danger); }
    @keyframes slideIn { from { transform: translateY(20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

    /* Empty state */
    .empty { padding: 48px 24px; text-align: center; color: var(--muted); }
    .empty i { font-size: 48px; margin-bottom: 16px; display: block; opacity: 0.3; }
    .empty p { font-size: 14px; }

    /* Stats inputs */
    .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; padding: 24px; }
    .stat-input label { font-size: 13px; color: var(--muted); font-weight: 500; margin-bottom: 6px; display: block; }
    .stat-input input {
      width: 100%; padding: 10px 14px; border-radius: 8px;
      border: 1px solid var(--border); background: rgba(255,255,255,0.03);
      color: var(--white); font-family: inherit; font-size: 14px; outline: none;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .layout { grid-template-columns: 1fr; }
      .sidebar { display: none; }
      .stats-grid { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>
  <div class="layout">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="sidebar-brand">
        <div class="sidebar-logo">F</div>
        <div>
          <span>Dashboard</span>
          <small>Portfolio Admin</small>
        </div>
      </div>
      <div class="sidebar-nav">
        <a href="#" class="active" data-tab="profile"><i class="fas fa-id-card"></i> Profile & Hero</a>
        <a href="#" data-tab="projects"><i class="fas fa-rocket"></i> Projects</a>
        <a href="#" data-tab="skills"><i class="fas fa-cogs"></i> Skills</a>
        <a href="#" data-tab="about"><i class="fas fa-user"></i> About Cards</a>
        <a href="#" data-tab="stats"><i class="fas fa-chart-bar"></i> Stats</a>
        <a href="#" data-tab="seo"><i class="fas fa-search"></i> SEO</a>
        <a href="#" data-tab="queries"><i class="fas fa-envelope"></i> Queries</a>
        <a href="index.php" target="_blank"><i class="fas fa-external-link-alt"></i> View Site</a>
      </div>
      <div class="sidebar-footer">
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
      </div>
    </aside>

    <!-- Main Content -->
    <div class="main">
      <div class="page-header">
        <div>
          <div class="breadcrumb">Admin / Dashboard</div>
          <h1>Portfolio Manager</h1>
        </div>
        <a href="index.php" target="_blank" class="btn btn-outline"><i class="fas fa-eye"></i> Preview Site</a>
      </div>

      <!-- Tabs -->
      <div class="tabs" style="flex-wrap:wrap;">
        <button class="tab active" data-tab="profile"><i class="fas fa-id-card"></i> Profile</button>
        <button class="tab" data-tab="projects"><i class="fas fa-rocket"></i> Projects</button>
        <button class="tab" data-tab="skills"><i class="fas fa-cogs"></i> Skills</button>
        <button class="tab" data-tab="about"><i class="fas fa-user"></i> About</button>
        <button class="tab" data-tab="stats"><i class="fas fa-chart-bar"></i> Stats</button>
        <button class="tab" data-tab="seo"><i class="fas fa-search"></i> SEO</button>
        <button class="tab" data-tab="queries"><i class="fas fa-envelope"></i> Queries</button>
      </div>

      <!-- ═══ PROFILE PANEL ═══ -->
      <div class="panel active" id="panel-profile">
        <div class="data-card">
          <div class="data-header">
            <h3><i class="fas fa-id-card"></i> Profile & Hero Section</h3>
            <button class="btn btn-primary" onclick="saveProfile()"><i class="fas fa-save"></i> Save Profile</button>
          </div>
          <div style="padding:24px;display:grid;gap:20px;">

            <div style="border-bottom:1px solid var(--border);padding-bottom:16px;">
              <h4 style="color:var(--white);font-size:15px;margin-bottom:4px;"><i class="fas fa-user-circle"></i> Identity</h4>
              <p style="font-size:12px;color:var(--muted);">Your name, role, and branding shown across the site.</p>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
              <div class="form-group" style="margin:0">
                <label>Full Name</label>
                <input id="pf-name" placeholder="Faisal Akhtar" />
              </div>
              <div class="form-group" style="margin:0">
                <label>Role / Title</label>
                <input id="pf-role" placeholder="Senior Software Engineer" />
              </div>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
              <div class="form-group" style="margin:0">
                <label>Brand Subtitle (header)</label>
                <input id="pf-brand_subtitle" placeholder="Software Engineer — PHP · Laravel · AWS" />
              </div>
              <div class="form-group" style="margin:0">
                <label>Avatar Letter</label>
                <input id="pf-avatar_letter" placeholder="F" maxlength="2" style="max-width:80px;" />
              </div>
            </div>

            <div style="border-bottom:1px solid var(--border);padding-bottom:16px;padding-top:8px;">
              <h4 style="color:var(--white);font-size:15px;margin-bottom:4px;"><i class="fas fa-star"></i> Hero Section</h4>
              <p style="font-size:12px;color:var(--muted);">The main banner area visitors see first.</p>
            </div>

            <div class="form-group" style="margin:0">
              <label>Badge Text (top of hero)</label>
              <input id="pf-hero_badge" placeholder="Available for freelance work" />
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px;">
              <div class="form-group" style="margin:0">
                <label>Heading Before</label>
                <input id="pf-hero_heading_before" placeholder="Building" />
              </div>
              <div class="form-group" style="margin:0">
                <label>Heading Highlight (gradient)</label>
                <input id="pf-hero_heading_highlight" placeholder="Scalable Apps" />
              </div>
              <div class="form-group" style="margin:0">
                <label>Heading After</label>
                <input id="pf-hero_heading_after" placeholder="& Secure Integrations" />
              </div>
            </div>
            <div class="form-group" style="margin:0">
              <label>Hero Description</label>
              <textarea id="pf-hero_description" rows="2" placeholder="I specialize in..."></textarea>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px;">
              <div class="form-group" style="margin:0">
                <label>Primary CTA Button</label>
                <input id="pf-cta_primary" placeholder="Get In Touch" />
              </div>
              <div class="form-group" style="margin:0">
                <label>Secondary CTA Button</label>
                <input id="pf-cta_secondary" placeholder="View Projects" />
              </div>
              <div class="form-group" style="margin:0">
                <label>CV Download Link</label>
                <input id="pf-cv_link" placeholder="https://example.com/cv.pdf" />
              </div>
            </div>

            <div style="border-bottom:1px solid var(--border);padding-bottom:16px;padding-top:8px;">
              <h4 style="color:var(--white);font-size:15px;margin-bottom:4px;"><i class="fas fa-map-marker-alt"></i> Contact Info</h4>
              <p style="font-size:12px;color:var(--muted);">Shown in the contact section of the landing page.</p>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
              <div class="form-group" style="margin:0">
                <label>Location</label>
                <input id="pf-location" placeholder="Available Worldwide (Remote)" />
              </div>
              <div class="form-group" style="margin:0">
                <label>Availability</label>
                <input id="pf-availability" placeholder="Open for freelance & contract work" />
              </div>
            </div>

            <div style="border-bottom:1px solid var(--border);padding-bottom:16px;padding-top:8px;">
              <h4 style="color:var(--white);font-size:15px;margin-bottom:4px;"><i class="fas fa-layer-group"></i> Section Headings</h4>
              <p style="font-size:12px;color:var(--muted);">Customize labels and headings for each section on the page.</p>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px;">
              <div class="form-group" style="margin:0">
                <label>About Label</label>
                <input id="pf-about_label" placeholder="About Me" />
              </div>
              <div class="form-group" style="margin:0">
                <label>About Heading</label>
                <input id="pf-about_heading" placeholder="What I Do" />
              </div>
              <div class="form-group" style="margin:0">
                <label>About Description</label>
                <input id="pf-about_description" placeholder="Delivering end-to-end..." />
              </div>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px;">
              <div class="form-group" style="margin:0">
                <label>Skills Label</label>
                <input id="pf-skills_label" placeholder="Skills & Tools" />
              </div>
              <div class="form-group" style="margin:0">
                <label>Skills Heading</label>
                <input id="pf-skills_heading" placeholder="My Tech Stack" />
              </div>
              <div class="form-group" style="margin:0">
                <label>Skills Description</label>
                <input id="pf-skills_description" placeholder="Technologies and tools..." />
              </div>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px;">
              <div class="form-group" style="margin:0">
                <label>Projects Label</label>
                <input id="pf-projects_label" placeholder="Portfolio" />
              </div>
              <div class="form-group" style="margin:0">
                <label>Projects Heading</label>
                <input id="pf-projects_heading" placeholder="Featured Projects" />
              </div>
              <div class="form-group" style="margin:0">
                <label>Projects Description</label>
                <input id="pf-projects_description" placeholder="A selection of..." />
              </div>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px;">
              <div class="form-group" style="margin:0">
                <label>Contact Label</label>
                <input id="pf-contact_label" placeholder="Get In Touch" />
              </div>
              <div class="form-group" style="margin:0">
                <label>Contact Heading</label>
                <input id="pf-contact_heading" placeholder="Let's Work Together" />
              </div>
              <div class="form-group" style="margin:0">
                <label>Contact Description</label>
                <input id="pf-contact_description" placeholder="Have a project in mind?" />
              </div>
            </div>

          </div>
        </div>
      </div>

      <!-- ═══ PROJECTS PANEL ═══ -->
      <div class="panel" id="panel-projects">
        <div class="data-card">
          <div class="data-header">
            <h3><i class="fas fa-rocket"></i> Projects</h3>
            <button class="btn btn-primary" onclick="openModal('project')"><i class="fas fa-plus"></i> Add Project</button>
          </div>
          <div id="projects-list">
            <table>
              <thead><tr><th>Title</th><th>Type</th><th>URL</th><th>Actions</th></tr></thead>
              <tbody id="projects-tbody"></tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- ═══ SKILLS PANEL ═══ -->
      <div class="panel" id="panel-skills">
        <div class="data-card">
          <div class="data-header">
            <h3><i class="fas fa-cogs"></i> Skills</h3>
            <button class="btn btn-primary" onclick="openModal('skill')"><i class="fas fa-plus"></i> Add Skill</button>
          </div>
          <div id="skills-list">
            <table>
              <thead><tr><th>Name</th><th>Icon</th><th>Description</th><th>Actions</th></tr></thead>
              <tbody id="skills-tbody"></tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- ═══ ABOUT PANEL ═══ -->
      <div class="panel" id="panel-about">
        <div class="data-card">
          <div class="data-header">
            <h3><i class="fas fa-user"></i> About Cards</h3>
            <button class="btn btn-primary" onclick="openModal('about')"><i class="fas fa-plus"></i> Add Card</button>
          </div>
          <div id="about-list">
            <table>
              <thead><tr><th>Title</th><th>Icon</th><th>Description</th><th>Actions</th></tr></thead>
              <tbody id="about-tbody"></tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- ═══ STATS PANEL ═══ -->
      <div class="panel" id="panel-stats">
        <div class="data-card">
          <div class="data-header">
            <h3><i class="fas fa-chart-bar"></i> Hero Stats</h3>
            <button class="btn btn-primary" onclick="saveStats()"><i class="fas fa-save"></i> Save Stats</button>
          </div>
          <div class="stats-grid">
            <div class="stat-input">
              <label>Years Experience</label>
              <input id="stat-experience" placeholder="e.g. 5+" />
            </div>
            <div class="stat-input">
              <label>Projects Delivered</label>
              <input id="stat-projects" placeholder="e.g. 30+" />
            </div>
            <div class="stat-input">
              <label>Happy Clients</label>
              <input id="stat-clients" placeholder="e.g. 15+" />
            </div>
          </div>
        </div>
      </div>

      <!-- ═══ SEO PANEL ═══ -->
      <div class="panel" id="panel-seo">
        <div class="data-card">
          <div class="data-header">
            <h3><i class="fas fa-search"></i> SEO Settings</h3>
            <button class="btn btn-primary" onclick="saveSeo()"><i class="fas fa-save"></i> Save SEO</button>
          </div>
          <div style="padding:24px;display:grid;gap:20px;">

            <div style="border-bottom:1px solid var(--border);padding-bottom:16px;">
              <h4 style="color:var(--white);font-size:15px;margin-bottom:4px;"><i class="fas fa-heading"></i> Page Title & Meta</h4>
              <p style="font-size:12px;color:var(--muted);">These appear in search engine results and browser tabs.</p>
            </div>

            <div class="form-group" style="margin:0">
              <label>Site Title (shown in browser tab & Google results)</label>
              <input id="seo-site_title" placeholder="e.g. Faisal Akhtar — Software Engineer | PHP, Laravel, AWS" />
            </div>
            <div class="form-group" style="margin:0">
              <label>Meta Description (150-160 chars recommended for Google snippet)</label>
              <textarea id="seo-meta_description" rows="3" placeholder="Brief description of your site for search engines..."></textarea>
            </div>
            <div class="form-group" style="margin:0">
              <label>Meta Keywords (comma separated)</label>
              <textarea id="seo-meta_keywords" rows="2" placeholder="PHP Developer, Laravel, Shopify, AWS, WordPress..."></textarea>
            </div>
            <div class="form-group" style="margin:0">
              <label>Canonical URL</label>
              <input id="seo-canonical_url" placeholder="https://fai-box.online/" />
            </div>
            <div class="form-group" style="margin:0">
              <label>Author Name</label>
              <input id="seo-author" placeholder="Faisal Akhtar" />
            </div>
            <div class="form-group" style="margin:0">
              <label>Job Title (used in structured data)</label>
              <input id="seo-job_title" placeholder="Senior Software Engineer" />
            </div>

            <div style="border-bottom:1px solid var(--border);padding-bottom:16px;padding-top:8px;">
              <h4 style="color:var(--white);font-size:15px;margin-bottom:4px;"><i class="fab fa-facebook"></i> Open Graph (Facebook / LinkedIn)</h4>
              <p style="font-size:12px;color:var(--muted);">Controls how your site looks when shared on social media.</p>
            </div>

            <div class="form-group" style="margin:0">
              <label>OG Title</label>
              <input id="seo-og_title" placeholder="Title shown when shared on Facebook/LinkedIn" />
            </div>
            <div class="form-group" style="margin:0">
              <label>OG Description</label>
              <textarea id="seo-og_description" rows="2" placeholder="Description shown when shared on social media..."></textarea>
            </div>

            <div style="border-bottom:1px solid var(--border);padding-bottom:16px;padding-top:8px;">
              <h4 style="color:var(--white);font-size:15px;margin-bottom:4px;"><i class="fab fa-twitter"></i> Twitter Card</h4>
              <p style="font-size:12px;color:var(--muted);">Controls how your site looks when shared on Twitter/X.</p>
            </div>

            <div class="form-group" style="margin:0">
              <label>Twitter Title</label>
              <input id="seo-twitter_title" placeholder="Title shown when shared on Twitter" />
            </div>
            <div class="form-group" style="margin:0">
              <label>Twitter Description</label>
              <textarea id="seo-twitter_description" rows="2" placeholder="Description shown when shared on Twitter..."></textarea>
            </div>

            <div style="border-bottom:1px solid var(--border);padding-bottom:16px;padding-top:8px;">
              <h4 style="color:var(--white);font-size:15px;margin-bottom:4px;"><i class="fas fa-link"></i> Social & Contact Links</h4>
              <p style="font-size:12px;color:var(--muted);">Used in footer and structured data for search engines.</p>
            </div>

            <div class="form-group" style="margin:0">
              <label>Email Address</label>
              <input id="seo-email" type="email" placeholder="faisalakhtar336@gmail.com" />
            </div>
            <div class="form-group" style="margin:0">
              <label>GitHub URL</label>
              <input id="seo-github_url" placeholder="https://github.com/faisalakhtar" />
            </div>
            <div class="form-group" style="margin:0">
              <label>LinkedIn URL</label>
              <input id="seo-linkedin_url" placeholder="https://linkedin.com/in/your-profile" />
            </div>

          </div>
        </div>
      </div>

      <!-- ═══ QUERIES PANEL ═══ -->
      <div class="panel" id="panel-queries">
        <div class="data-card">
          <div class="data-header">
            <h3><i class="fas fa-envelope"></i> Contact Queries <span id="queries-count" style="font-size:13px;font-weight:500;color:var(--muted);margin-left:8px;"></span></h3>
            <button class="btn btn-danger" onclick="clearQueries()"><i class="fas fa-trash"></i> Clear All</button>
          </div>
          <div style="padding:24px;">
            <pre id="queries-json" style="background:rgba(0,0,0,0.25);border:1px solid var(--border);border-radius:10px;padding:20px;overflow-x:auto;font-size:13px;line-height:1.7;color:var(--text);white-space:pre-wrap;word-break:break-word;min-height:80px;"></pre>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- ═══ PROJECT MODAL ═══ -->
  <div class="modal-overlay" id="modal-project">
    <div class="modal">
      <h2 id="modal-project-title">Add Project</h2>
      <input type="hidden" id="project-id" />
      <div class="form-group">
        <label>Project Title</label>
        <input id="project-name" placeholder="e.g. Remelt Global" />
      </div>
      <div class="form-group">
        <label>Type</label>
        <select id="project-type">
          <option value="WordPress">WordPress</option>
          <option value="Laravel">Laravel</option>
          <option value="Shopify">Shopify</option>
          <option value="IoT">IoT</option>
          <option value="Other">Other</option>
        </select>
      </div>
      <div class="form-group">
        <label>Description</label>
        <textarea id="project-desc" rows="3" placeholder="Brief project description..."></textarea>
      </div>
      <div class="form-group">
        <label>Tags (comma separated)</label>
        <input id="project-tags" placeholder="e.g. WordPress, SEO, Custom Theme" />
      </div>
      <div class="form-group">
        <label>URL (leave empty for private projects)</label>
        <input id="project-url" placeholder="https://example.com" />
      </div>
      <div class="form-group">
        <label>Icon (Font Awesome class)</label>
        <input id="project-icon" placeholder="e.g. fas fa-globe" value="fas fa-globe" />
      </div>
      <div class="modal-btns">
        <button class="btn btn-outline" onclick="closeModal('project')">Cancel</button>
        <button class="btn btn-primary" onclick="saveProject()"><i class="fas fa-save"></i> Save</button>
      </div>
    </div>
  </div>

  <!-- ═══ SKILL MODAL ═══ -->
  <div class="modal-overlay" id="modal-skill">
    <div class="modal">
      <h2 id="modal-skill-title">Add Skill</h2>
      <input type="hidden" id="skill-id" />
      <div class="form-group">
        <label>Skill Name</label>
        <input id="skill-name" placeholder="e.g. Laravel / PHP" />
      </div>
      <div class="form-group">
        <label>Icon (Font Awesome class)</label>
        <input id="skill-icon" placeholder="e.g. fab fa-laravel" />
      </div>
      <div class="form-group">
        <label>Short Description</label>
        <input id="skill-desc" placeholder="e.g. Backend, APIs, SaaS" />
      </div>
      <div class="form-group">
        <label>Color (hex)</label>
        <input id="skill-color" placeholder="e.g. #8b5cf6" value="#3b82f6" />
      </div>
      <div class="modal-btns">
        <button class="btn btn-outline" onclick="closeModal('skill')">Cancel</button>
        <button class="btn btn-primary" onclick="saveSkill()"><i class="fas fa-save"></i> Save</button>
      </div>
    </div>
  </div>

  <!-- ═══ ABOUT MODAL ═══ -->
  <div class="modal-overlay" id="modal-about">
    <div class="modal">
      <h2 id="modal-about-title">Add About Card</h2>
      <input type="hidden" id="about-id" />
      <div class="form-group">
        <label>Card Title</label>
        <input id="about-name" placeholder="e.g. Full-Stack Development" />
      </div>
      <div class="form-group">
        <label>Icon (Font Awesome class)</label>
        <input id="about-icon" placeholder="e.g. fas fa-code" />
      </div>
      <div class="form-group">
        <label>Description</label>
        <textarea id="about-desc" rows="3" placeholder="What you do in this area..."></textarea>
      </div>
      <div class="form-group">
        <label>Color (hex)</label>
        <input id="about-color" placeholder="e.g. #8b5cf6" value="#3b82f6" />
      </div>
      <div class="modal-btns">
        <button class="btn btn-outline" onclick="closeModal('about')">Cancel</button>
        <button class="btn btn-primary" onclick="saveAbout()"><i class="fas fa-save"></i> Save</button>
      </div>
    </div>
  </div>

  <!-- Toast -->
  <div class="toast" id="toast"></div>

  <script>
    // ─── DATA ───
    let data = <?= json_encode($data) ?>;

    // ─── TABS ───
    document.querySelectorAll('.tab, .sidebar-nav a[data-tab]').forEach(el => {
      el.addEventListener('click', e => {
        e.preventDefault();
        const tab = el.dataset.tab;
        if (!tab) return;
        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
        document.querySelector(`.tab[data-tab="${tab}"]`).classList.add('active');
        document.getElementById(`panel-${tab}`).classList.add('active');
        document.querySelectorAll('.sidebar-nav a').forEach(a => a.classList.remove('active'));
        const sideLink = document.querySelector(`.sidebar-nav a[data-tab="${tab}"]`);
        if (sideLink) sideLink.classList.add('active');
      });
    });

    // ─── MODAL ───
    function openModal(type) {
      document.getElementById(`modal-${type}`).classList.add('open');
    }
    function closeModal(type) {
      document.getElementById(`modal-${type}`).classList.remove('open');
      clearForm(type);
    }
    function clearForm(type) {
      if (type === 'project') {
        ['project-id','project-name','project-desc','project-tags','project-url'].forEach(id => document.getElementById(id).value = '');
        document.getElementById('project-icon').value = 'fas fa-globe';
        document.getElementById('project-type').value = 'WordPress';
        document.getElementById('modal-project-title').textContent = 'Add Project';
      } else if (type === 'skill') {
        ['skill-id','skill-name','skill-icon','skill-desc'].forEach(id => document.getElementById(id).value = '');
        document.getElementById('skill-color').value = '#3b82f6';
        document.getElementById('modal-skill-title').textContent = 'Add Skill';
      } else if (type === 'about') {
        ['about-id','about-name','about-icon','about-desc'].forEach(id => document.getElementById(id).value = '');
        document.getElementById('about-color').value = '#3b82f6';
        document.getElementById('modal-about-title').textContent = 'Add About Card';
      }
    }

    // ─── TOAST ───
    function showToast(msg, type = 'success') {
      const t = document.getElementById('toast');
      t.className = `toast show ${type}`;
      t.innerHTML = `<i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i> ${msg}`;
      setTimeout(() => t.classList.remove('show'), 3000);
    }

    // ─── API CALL ───
    async function api(action, payload = {}) {
      const res = await fetch('api.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ action, ...payload })
      });
      return res.json();
    }

    // ─── RENDER ───
    function render() {
      // Projects
      const ptb = document.getElementById('projects-tbody');
      if (!data.projects || data.projects.length === 0) {
        ptb.innerHTML = '<tr><td colspan="4"><div class="empty"><i class="fas fa-folder-open"></i><p>No projects yet. Add your first project.</p></div></td></tr>';
      } else {
        ptb.innerHTML = data.projects.map((p, i) => `
          <tr>
            <td style="color:var(--white);font-weight:600">${esc(p.name)}</td>
            <td><span style="color:var(--accent)">${esc(p.type)}</span></td>
            <td>${p.url ? `<a href="${esc(p.url)}" target="_blank" style="color:var(--accent3)">${esc(p.url)}</a>` : '<span style="color:var(--muted)">Private</span>'}</td>
            <td><div class="action-btns">
              <button class="btn btn-sm btn-outline" onclick="editProject(${i})"><i class="fas fa-edit"></i></button>
              <button class="btn btn-sm btn-danger" onclick="deleteItem('projects',${i})"><i class="fas fa-trash"></i></button>
            </div></td>
          </tr>
        `).join('');
      }

      // Skills
      const stb = document.getElementById('skills-tbody');
      if (!data.skills || data.skills.length === 0) {
        stb.innerHTML = '<tr><td colspan="4"><div class="empty"><i class="fas fa-cogs"></i><p>No skills yet. Add your tech stack.</p></div></td></tr>';
      } else {
        stb.innerHTML = data.skills.map((s, i) => `
          <tr>
            <td style="color:var(--white);font-weight:600">${esc(s.name)}</td>
            <td><i class="${esc(s.icon)}" style="color:${esc(s.color)}"></i> ${esc(s.icon)}</td>
            <td>${esc(s.desc)}</td>
            <td><div class="action-btns">
              <button class="btn btn-sm btn-outline" onclick="editSkill(${i})"><i class="fas fa-edit"></i></button>
              <button class="btn btn-sm btn-danger" onclick="deleteItem('skills',${i})"><i class="fas fa-trash"></i></button>
            </div></td>
          </tr>
        `).join('');
      }

      // About
      const atb = document.getElementById('about-tbody');
      if (!data.about || data.about.length === 0) {
        atb.innerHTML = '<tr><td colspan="4"><div class="empty"><i class="fas fa-user"></i><p>No about cards yet.</p></div></td></tr>';
      } else {
        atb.innerHTML = data.about.map((a, i) => `
          <tr>
            <td style="color:var(--white);font-weight:600">${esc(a.name)}</td>
            <td><i class="${esc(a.icon)}" style="color:${esc(a.color)}"></i> ${esc(a.icon)}</td>
            <td>${esc(a.desc).substring(0, 60)}...</td>
            <td><div class="action-btns">
              <button class="btn btn-sm btn-outline" onclick="editAbout(${i})"><i class="fas fa-edit"></i></button>
              <button class="btn btn-sm btn-danger" onclick="deleteItem('about',${i})"><i class="fas fa-trash"></i></button>
            </div></td>
          </tr>
        `).join('');
      }

      // Stats
      if (data.stats) {
        document.getElementById('stat-experience').value = data.stats.experience || '';
        document.getElementById('stat-projects').value = data.stats.projects || '';
        document.getElementById('stat-clients').value = data.stats.clients || '';
      }
    }

    function esc(s) {
      const d = document.createElement('div');
      d.textContent = s || '';
      return d.innerHTML;
    }

    // ─── CRUD: PROJECTS ───
    async function saveProject() {
      const id = document.getElementById('project-id').value;
      const item = {
        name: document.getElementById('project-name').value.trim(),
        type: document.getElementById('project-type').value,
        desc: document.getElementById('project-desc').value.trim(),
        tags: document.getElementById('project-tags').value.trim(),
        url: document.getElementById('project-url').value.trim(),
        icon: document.getElementById('project-icon').value.trim()
      };
      if (!item.name) return showToast('Title is required', 'error');
      const res = await api(id !== '' ? 'update' : 'add', { section: 'projects', index: parseInt(id), item });
      if (res.ok) { data = res.data; render(); closeModal('project'); showToast('Project saved!'); }
      else showToast(res.error || 'Error', 'error');
    }

    function editProject(i) {
      const p = data.projects[i];
      document.getElementById('project-id').value = i;
      document.getElementById('project-name').value = p.name;
      document.getElementById('project-type').value = p.type;
      document.getElementById('project-desc').value = p.desc;
      document.getElementById('project-tags').value = p.tags;
      document.getElementById('project-url').value = p.url || '';
      document.getElementById('project-icon').value = p.icon || 'fas fa-globe';
      document.getElementById('modal-project-title').textContent = 'Edit Project';
      openModal('project');
    }

    // ─── CRUD: SKILLS ───
    async function saveSkill() {
      const id = document.getElementById('skill-id').value;
      const item = {
        name: document.getElementById('skill-name').value.trim(),
        icon: document.getElementById('skill-icon').value.trim(),
        desc: document.getElementById('skill-desc').value.trim(),
        color: document.getElementById('skill-color').value.trim()
      };
      if (!item.name) return showToast('Name is required', 'error');
      const res = await api(id !== '' ? 'update' : 'add', { section: 'skills', index: parseInt(id), item });
      if (res.ok) { data = res.data; render(); closeModal('skill'); showToast('Skill saved!'); }
      else showToast(res.error || 'Error', 'error');
    }

    function editSkill(i) {
      const s = data.skills[i];
      document.getElementById('skill-id').value = i;
      document.getElementById('skill-name').value = s.name;
      document.getElementById('skill-icon').value = s.icon;
      document.getElementById('skill-desc').value = s.desc;
      document.getElementById('skill-color').value = s.color;
      document.getElementById('modal-skill-title').textContent = 'Edit Skill';
      openModal('skill');
    }

    // ─── CRUD: ABOUT ───
    async function saveAbout() {
      const id = document.getElementById('about-id').value;
      const item = {
        name: document.getElementById('about-name').value.trim(),
        icon: document.getElementById('about-icon').value.trim(),
        desc: document.getElementById('about-desc').value.trim(),
        color: document.getElementById('about-color').value.trim()
      };
      if (!item.name) return showToast('Title is required', 'error');
      const res = await api(id !== '' ? 'update' : 'add', { section: 'about', index: parseInt(id), item });
      if (res.ok) { data = res.data; render(); closeModal('about'); showToast('About card saved!'); }
      else showToast(res.error || 'Error', 'error');
    }

    function editAbout(i) {
      const a = data.about[i];
      document.getElementById('about-id').value = i;
      document.getElementById('about-name').value = a.name;
      document.getElementById('about-icon').value = a.icon;
      document.getElementById('about-desc').value = a.desc;
      document.getElementById('about-color').value = a.color;
      document.getElementById('modal-about-title').textContent = 'Edit About Card';
      openModal('about');
    }

    // ─── DELETE ───
    async function deleteItem(section, index) {
      if (!confirm('Are you sure you want to delete this item?')) return;
      const res = await api('delete', { section, index });
      if (res.ok) { data = res.data; render(); showToast('Deleted successfully!'); }
      else showToast(res.error || 'Error', 'error');
    }

    // ─── STATS ───
    async function saveStats() {
      const stats = {
        experience: document.getElementById('stat-experience').value.trim(),
        projects: document.getElementById('stat-projects').value.trim(),
        clients: document.getElementById('stat-clients').value.trim()
      };
      const res = await api('stats', { stats });
      if (res.ok) { data = res.data; showToast('Stats saved!'); }
      else showToast(res.error || 'Error', 'error');
    }

    // ─── PROFILE ───
    const profileFields = [
      'name','role','brand_subtitle','avatar_letter',
      'hero_badge','hero_heading_before','hero_heading_highlight','hero_heading_after','hero_description',
      'cta_primary','cta_secondary','cv_link',
      'location','availability',
      'about_label','about_heading','about_description',
      'skills_label','skills_heading','skills_description',
      'projects_label','projects_heading','projects_description',
      'contact_label','contact_heading','contact_description'
    ];

    function renderProfile() {
      if (!data.profile) return;
      profileFields.forEach(f => {
        const el = document.getElementById('pf-' + f);
        if (el) el.value = data.profile[f] || '';
      });
    }

    async function saveProfile() {
      const profile = {};
      profileFields.forEach(f => {
        const el = document.getElementById('pf-' + f);
        if (el) profile[f] = el.value.trim();
      });
      const res = await api('profile', { profile });
      if (res.ok) { data = res.data; showToast('Profile saved!'); }
      else showToast(res.error || 'Error', 'error');
    }

    // ─── SEO ───
    const seoFields = [
      'site_title','meta_description','meta_keywords','canonical_url','author','job_title',
      'og_title','og_description','twitter_title','twitter_description',
      'email','github_url','linkedin_url'
    ];

    function renderSeo() {
      if (!data.seo) return;
      seoFields.forEach(f => {
        const el = document.getElementById('seo-' + f);
        if (el) el.value = data.seo[f] || '';
      });
    }

    async function saveSeo() {
      const seo = {};
      seoFields.forEach(f => {
        const el = document.getElementById('seo-' + f);
        if (el) seo[f] = el.value.trim();
      });
      const res = await api('seo', { seo });
      if (res.ok) { data = res.data; showToast('SEO settings saved!'); }
      else showToast(res.error || 'Error', 'error');
    }

    // ─── QUERIES ───
    function renderQueries() {
      const queries = data.queries || [];
      const pre = document.getElementById('queries-json');
      const badge = document.getElementById('queries-count');
      badge.textContent = queries.length ? `(${queries.length})` : '';
      if (queries.length === 0) {
        pre.innerHTML = '<span style="color:var(--muted);font-style:italic;">No queries yet.</span>';
        return;
      }
      pre.textContent = JSON.stringify(queries, null, 2);
    }

    async function clearQueries() {
      if (!confirm('Delete all queries? This cannot be undone.')) return;
      const res = await api('clear_queries');
      if (res.ok) { data = res.data; renderQueries(); showToast('All queries cleared!'); }
      else showToast(res.error || 'Error', 'error');
    }

    // ─── INIT ───
    render();
    renderProfile();
    renderSeo();
    renderQueries();

    // Close modal on overlay click
    document.querySelectorAll('.modal-overlay').forEach(o => {
      o.addEventListener('click', e => {
        if (e.target === o) o.classList.remove('open');
      });
    });
  </script>
</body>
</html>
