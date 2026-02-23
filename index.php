<?php
// Load admin data if available
$dataFile = __DIR__ . '/data/portfolio.json';
$adminData = null;
if (file_exists($dataFile)) {
    $adminData = json_decode(file_get_contents($dataFile), true);
}

// Stats with fallbacks
$stats = [
    'experience' => $adminData['stats']['experience'] ?? '5+',
    'projects'   => $adminData['stats']['projects'] ?? '30+',
    'clients'    => $adminData['stats']['clients'] ?? '15+',
];

// Default about cards (used when admin has none)
$defaultAbout = [
    ['name' => 'Full-Stack Development', 'icon' => 'fas fa-code', 'color' => '#8b5cf6', 'desc' => 'Building robust web applications with PHP/Laravel, clean REST APIs, and modern frontend frameworks with Tailwind CSS.'],
    ['name' => 'Payment Integrations', 'icon' => 'fas fa-credit-card', 'color' => '#3b82f6', 'desc' => 'Stripe checkout flows, subscription billing, webhooks, and secure payment processing for global clients.'],
    ['name' => 'Cloud & DevOps', 'icon' => 'fas fa-cloud', 'color' => '#06b6d4', 'desc' => 'AWS EC2, S3, RDS deployments with CI/CD pipelines, Linux server management, and scalable infrastructure.'],
    ['name' => 'E-Commerce & Shopify', 'icon' => 'fas fa-store', 'color' => '#22c55e', 'desc' => 'Custom Shopify themes, app development, store setup, and headless commerce solutions for online businesses.'],
];

// Default skills
$defaultSkills = [
    ['name' => 'Laravel / PHP', 'icon' => 'fab fa-laravel', 'color' => '#8b5cf6', 'desc' => 'Backend, APIs, SaaS'],
    ['name' => 'Shopify', 'icon' => 'fab fa-shopify', 'color' => '#3b82f6', 'desc' => 'Themes, Apps, Liquid'],
    ['name' => 'Stripe', 'icon' => 'fab fa-stripe-s', 'color' => '#6366f1', 'desc' => 'Payments, Subscriptions'],
    ['name' => 'AWS', 'icon' => 'fab fa-aws', 'color' => '#fb923c', 'desc' => 'EC2, S3, RDS, CI/CD'],
    ['name' => 'WordPress', 'icon' => 'fab fa-wordpress', 'color' => '#3b82f6', 'desc' => 'Themes, Plugins, CMS'],
    ['name' => 'Tailwind CSS', 'icon' => 'fas fa-wind', 'color' => '#06b6d4', 'desc' => 'UI Design, Responsive'],
    ['name' => 'MySQL / PostgreSQL', 'icon' => 'fas fa-database', 'color' => '#22c55e', 'desc' => 'Database Design'],
    ['name' => 'IoT / Linux', 'icon' => 'fas fa-microchip', 'color' => '#f43f5e', 'desc' => 'Moxa, Raspberry Pi'],
];

// Default projects
$defaultProjects = [
    ['name' => 'Remelt Global', 'type' => 'WordPress', 'icon' => 'fas fa-globe', 'desc' => 'Professional WordPress website built with custom theme, responsive design, and optimized performance for a global business.', 'tags' => 'WordPress, Custom Theme, SEO', 'url' => 'https://remeltglobal.com/'],
    ['name' => 'Evenement.pk', 'type' => 'WordPress', 'icon' => 'fas fa-calendar-alt', 'desc' => 'Event management platform built on WordPress with custom post types, booking features, and dynamic event listings.', 'tags' => 'WordPress, Events, Custom CPT', 'url' => 'https://evenement.pk/'],
    ['name' => 'Xevta', 'type' => 'WordPress', 'icon' => 'fas fa-laptop-code', 'desc' => 'Technology company website with modern design, service showcases, and lead generation features built on WordPress.', 'tags' => 'WordPress, Business, Lead Gen', 'url' => 'https://xevta.com/'],
    ['name' => 'Students Resource', 'type' => 'Laravel', 'icon' => 'fas fa-graduation-cap', 'desc' => 'Educational platform built with Laravel featuring student portals, resource management, and structured learning paths.', 'tags' => 'Laravel, Education, Portal', 'url' => 'https://studentsresource.net/'],
    ['name' => 'Laravel SaaS Platform (ERP/CRM)', 'type' => 'Laravel', 'icon' => 'fas fa-building', 'desc' => 'Multi-tenant ERP + CRM system with role-based access control, Stripe payments, and AWS CI/CD deployment pipelines.', 'tags' => 'Laravel, SaaS, Stripe, AWS', 'url' => ''],
    ['name' => 'IoT Automation System', 'type' => 'IoT', 'icon' => 'fas fa-network-wired', 'desc' => 'Remote management tools and automated data sync from Moxa & Raspberry Pi field devices with real-time monitoring.', 'tags' => 'Moxa, Raspberry Pi, Linux', 'url' => ''],
];

// Use admin data if it has entries, otherwise use defaults
$aboutCards = (!empty($adminData['about'])) ? $adminData['about'] : $defaultAbout;
$skills     = (!empty($adminData['skills'])) ? $adminData['skills'] : $defaultSkills;
$projects   = (!empty($adminData['projects'])) ? $adminData['projects'] : $defaultProjects;

// Profile with fallbacks
$p = $adminData['profile'] ?? [];
$profile = [
    'name'                  => $p['name'] ?? 'Faisal Akhtar',
    'role'                  => $p['role'] ?? 'Senior Software Engineer',
    'brand_subtitle'        => $p['brand_subtitle'] ?? 'Software Engineer — PHP · Laravel · AWS · Stripe',
    'avatar_letter'         => $p['avatar_letter'] ?? 'F',
    'hero_badge'            => $p['hero_badge'] ?? 'Available for freelance work',
    'hero_heading_before'   => $p['hero_heading_before'] ?? 'Building',
    'hero_heading_highlight'=> $p['hero_heading_highlight'] ?? 'Scalable Apps',
    'hero_heading_after'    => $p['hero_heading_after'] ?? '& Secure Integrations',
    'hero_description'      => $p['hero_description'] ?? 'I specialize in PHP/Laravel, Shopify, Stripe payments, AWS infrastructure, WordPress, ERP/CRM systems, and Linux IoT devices.',
    'cta_primary'           => $p['cta_primary'] ?? 'Get In Touch',
    'cta_secondary'         => $p['cta_secondary'] ?? 'View Projects',
    'cv_link'               => $p['cv_link'] ?? '',
    'location'              => $p['location'] ?? 'Available Worldwide (Remote)',
    'availability'          => $p['availability'] ?? 'Open for freelance & contract work',
    'about_label'           => $p['about_label'] ?? 'About Me',
    'about_heading'         => $p['about_heading'] ?? 'What I Do',
    'about_description'     => $p['about_description'] ?? 'Delivering end-to-end solutions from backend architecture to deployment and everything in between.',
    'skills_label'          => $p['skills_label'] ?? 'Skills & Tools',
    'skills_heading'        => $p['skills_heading'] ?? 'My Tech Stack',
    'skills_description'    => $p['skills_description'] ?? 'Technologies and tools I use to build high-quality software.',
    'projects_label'        => $p['projects_label'] ?? 'Portfolio',
    'projects_heading'      => $p['projects_heading'] ?? 'Featured Projects',
    'projects_description'  => $p['projects_description'] ?? 'A selection of real-world projects I\'ve built and deployed.',
    'contact_label'         => $p['contact_label'] ?? 'Get In Touch',
    'contact_heading'       => $p['contact_heading'] ?? 'Let\'s Work Together',
    'contact_description'   => $p['contact_description'] ?? 'Have a project in mind? Drop me a message and let\'s discuss how I can help.',
];

// SEO with fallbacks
$seo = [
    'site_title'          => $adminData['seo']['site_title'] ?? 'Faisal Akhtar — Software Engineer | PHP, Laravel, Shopify, AWS Expert',
    'meta_description'    => $adminData['seo']['meta_description'] ?? 'Faisal Akhtar is a Senior Software Engineer specializing in PHP, Laravel, Shopify, Stripe integrations, AWS EC2/S3, WordPress, ERP/CRM systems, Tailwind CSS, and IoT devices. Available for freelance and contract work.',
    'meta_keywords'       => $adminData['seo']['meta_keywords'] ?? 'Faisal Akhtar, Software Engineer, PHP Developer, Laravel Developer, Shopify Expert, Stripe Integration, AWS EC2, WordPress Developer, ERP CRM, Tailwind CSS, IoT Developer, Full Stack Developer, Freelance Developer',
    'canonical_url'       => $adminData['seo']['canonical_url'] ?? 'https://fai-box.online/',
    'author'              => $adminData['seo']['author'] ?? 'Faisal Akhtar',
    'job_title'           => $adminData['seo']['job_title'] ?? 'Senior Software Engineer',
    'og_title'            => $adminData['seo']['og_title'] ?? 'Faisal Akhtar — Software Engineer | PHP, Laravel, Shopify, AWS',
    'og_description'      => $adminData['seo']['og_description'] ?? 'Senior Software Engineer specializing in PHP/Laravel, Shopify, Stripe, AWS, WordPress, and ERP/CRM systems. Building scalable applications and secure integrations.',
    'twitter_title'       => $adminData['seo']['twitter_title'] ?? 'Faisal Akhtar — Software Engineer | PHP, Laravel, Shopify, AWS',
    'twitter_description' => $adminData['seo']['twitter_description'] ?? 'Senior Software Engineer specializing in PHP/Laravel, Shopify, Stripe, AWS, WordPress, and ERP/CRM systems. Available for freelance work.',
    'email'               => $adminData['seo']['email'] ?? 'faisalakhtar336@gmail.com',
    'github_url'          => $adminData['seo']['github_url'] ?? 'https://github.com/faisalakhtar',
    'linkedin_url'        => $adminData['seo']['linkedin_url'] ?? '',
];

// Helper to get type icon
function getTypeIcon(string $type): string {
    $map = [
        'WordPress' => 'fab fa-wordpress',
        'Laravel'   => 'fab fa-laravel',
        'Shopify'   => 'fab fa-shopify',
        'IoT'       => 'fas fa-microchip',
    ];
    return $map[$type] ?? 'fas fa-code';
}

// Helper for hex to rgba
function hexToRgba(string $hex, float $alpha = 0.08): string {
    $hex = ltrim($hex, '#');
    if (strlen($hex) === 3) {
        $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
    }
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
    return "rgba($r,$g,$b,$alpha)";
}

function e(string $s): string {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}
?>
<!doctype html>
<html lang="en" prefix="og: https://ogp.me/ns#">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Primary SEO -->
  <title><?= e($seo['site_title']) ?></title>
  <meta name="description" content="<?= e($seo['meta_description']) ?>" />
  <meta name="keywords" content="<?= e($seo['meta_keywords']) ?>" />
  <meta name="author" content="<?= e($seo['author']) ?>" />
  <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />
  <link rel="canonical" href="<?= e($seo['canonical_url']) ?>" />

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website" />
  <meta property="og:url" content="<?= e($seo['canonical_url']) ?>" />
  <meta property="og:title" content="<?= e($seo['og_title']) ?>" />
  <meta property="og:description" content="<?= e($seo['og_description']) ?>" />
  <meta property="og:site_name" content="<?= e($seo['author']) ?> Portfolio" />
  <meta property="og:locale" content="en_US" />

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="<?= e($seo['twitter_title']) ?>" />
  <meta name="twitter:description" content="<?= e($seo['twitter_description']) ?>" />

  <!-- Additional SEO -->
  <meta name="theme-color" content="#f8fafc" />
  <meta name="color-scheme" content="light" />
  <meta name="generator" content="Custom PHP" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <!-- Structured Data (JSON-LD) — Person -->
  <script type="application/ld+json">
  <?php
  $personLd = [
      '@context' => 'https://schema.org',
      '@type' => 'Person',
      'name' => $seo['author'],
      'url' => $seo['canonical_url'],
      'email' => $seo['email'],
      'jobTitle' => $seo['job_title'],
      'description' => $seo['meta_description'],
      'knowsAbout' => array_map(function($s) { return $s['name']; }, $skills),
  ];
  $sameAs = [];
  if (!empty($seo['github_url'])) $sameAs[] = $seo['github_url'];
  if (!empty($seo['linkedin_url'])) $sameAs[] = $seo['linkedin_url'];
  if (!empty($sameAs)) $personLd['sameAs'] = $sameAs;
  echo json_encode($personLd, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
  ?>
  </script>

  <!-- Structured Data (JSON-LD) — WebSite -->
  <script type="application/ld+json">
  <?= json_encode([
      '@context' => 'https://schema.org',
      '@type' => 'WebSite',
      'name' => $seo['site_title'],
      'url' => $seo['canonical_url'],
      'description' => $seo['meta_description'],
      'author' => ['@type' => 'Person', 'name' => $seo['author']],
  ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>
  </script>

  <!-- Structured Data (JSON-LD) — Projects -->
  <script type="application/ld+json">
  <?php
  $items = [];
  foreach ($projects as $i => $proj) {
      $item = [
          '@type' => 'ListItem',
          'position' => $i + 1,
          'item' => [
              '@type' => 'CreativeWork',
              'name' => $proj['name'],
              'description' => $proj['desc'] ?? '',
          ]
      ];
      if (!empty($proj['url'])) {
          $item['item']['url'] = $proj['url'];
      }
      $items[] = $item;
  }
  echo json_encode([
      '@context' => 'https://schema.org',
      '@type' => 'ItemList',
      'name' => 'Portfolio Projects',
      'itemListElement' => $items,
  ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
  ?>
  </script>

  <!-- Preconnect for performance -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="preconnect" href="https://cdnjs.cloudflare.com" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <style>
    :root {
      --bg: #f8fafc;
      --bg2: #f1f5f9;
      --bg-alt: #eef2f7;
      --card: #ffffff;
      --card-hover: #f8fafc;
      --border: rgba(15,23,42,0.08);
      --border-hover: rgba(15,23,42,0.15);
      --muted: #64748b;
      --text: #334155;
      --white: #0f172a;
      --accent: #4f46e5;
      --accent2: #7c3aed;
      --accent3: #0ea5e9;
      --gradient: linear-gradient(135deg, #4f46e5, #7c3aed, #0ea5e9);
      --gradient-soft: linear-gradient(135deg, rgba(79,70,229,0.08), rgba(124,58,237,0.06), rgba(14,165,233,0.04));
      --shadow-sm: 0 1px 3px rgba(15,23,42,0.04), 0 1px 2px rgba(15,23,42,0.06);
      --shadow: 0 4px 6px -1px rgba(15,23,42,0.06), 0 2px 4px -2px rgba(15,23,42,0.05);
      --shadow-md: 0 10px 25px -5px rgba(15,23,42,0.08), 0 8px 10px -6px rgba(15,23,42,0.04);
      --shadow-lg: 0 20px 40px -10px rgba(15,23,42,0.1), 0 8px 16px -8px rgba(15,23,42,0.06);
      --radius: 16px;
      --radius-sm: 10px;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }
    body {
      font-family: 'Inter', system-ui, -apple-system, sans-serif;
      background: var(--bg);
      color: var(--text);
      line-height: 1.7;
      overflow-x: hidden;
      -webkit-font-smoothing: antialiased;
    }

    /* Animated background */
    .bg-glow {
      position: fixed; top: 0; left: 0; width: 100%; height: 100%;
      pointer-events: none; z-index: 0;
      background:
        radial-gradient(ellipse 800px 500px at 15% 10%, rgba(79,70,229,0.06), transparent),
        radial-gradient(ellipse 600px 400px at 85% 50%, rgba(124,58,237,0.04), transparent),
        radial-gradient(ellipse 500px 300px at 50% 100%, rgba(14,165,233,0.03), transparent);
    }

    .wrapper { position: relative; z-index: 1; }

    /* ─── ANIMATIONS ─── */
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(24px); }
      to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
    @keyframes slideRight {
      from { opacity: 0; transform: translateX(-20px); }
      to { opacity: 1; transform: translateX(0); }
    }
    @keyframes slideLeft {
      from { opacity: 0; transform: translateX(20px); }
      to { opacity: 1; transform: translateX(0); }
    }
    @keyframes pulse {
      0%, 100% { opacity: 1; }
      50% { opacity: 0.5; }
    }

    /* ─── HEADER ─── */
    header {
      position: sticky; top: 0; z-index: 100;
      background: rgba(248,250,252,0.8);
      backdrop-filter: blur(20px) saturate(180%);
      -webkit-backdrop-filter: blur(20px) saturate(180%);
      border-bottom: 1px solid var(--border);
    }
    .container { max-width: 1180px; margin: 0 auto; padding: 0 28px; }
    .nav-wrap { display: flex; align-items: center; justify-content: space-between; height: 72px; }
    .brand { display: flex; align-items: center; gap: 14px; text-decoration: none; }
    .logo {
      width: 44px; height: 44px; border-radius: 13px;
      background: var(--gradient);
      display: grid; place-items: center;
      font-weight: 800; font-size: 18px; color: #fff;
      box-shadow: 0 4px 14px rgba(79,70,229,0.25), 0 2px 6px rgba(79,70,229,0.15);
      transition: transform 0.3s, box-shadow 0.3s;
    }
    .brand:hover .logo {
      transform: scale(1.05) rotate(-2deg);
      box-shadow: 0 6px 20px rgba(79,70,229,0.3), 0 3px 8px rgba(79,70,229,0.2);
    }
    .brand-text { font-weight: 700; font-size: 18px; color: var(--white); letter-spacing: -0.3px; }
    .brand-sub { font-size: 12px; color: var(--muted); font-weight: 400; }
    nav { display: flex; align-items: center; gap: 4px; }
    nav a {
      color: var(--muted); text-decoration: none; font-weight: 500; font-size: 14px;
      padding: 8px 16px; border-radius: var(--radius-sm); transition: all 0.2s;
      position: relative;
    }
    nav a:hover { color: var(--white); background: var(--bg2); }
    .nav-cta {
      background: var(--gradient) !important; color: #fff !important;
      font-weight: 600; border-radius: var(--radius-sm) !important;
      box-shadow: 0 2px 10px rgba(79,70,229,0.25);
      transition: all 0.25s !important;
    }
    .nav-cta:hover { transform: translateY(-1px); box-shadow: 0 4px 16px rgba(79,70,229,0.35) !important; }
    .hamburger { display: none; background: none; border: none; color: var(--white); font-size: 22px; cursor: pointer; padding: 8px; border-radius: 8px; transition: background 0.2s; }
    .hamburger:hover { background: var(--bg2); }

    /* ─── HERO ─── */
    .hero {
      padding: 72px 0 64px;
      display: grid; grid-template-columns: 1fr 420px; gap: 56px; align-items: center;
      animation: fadeIn 0.6s ease-out;
    }
    .hero > div:first-child { animation: slideRight 0.7s ease-out; }
    .hero > .hero-card { animation: slideLeft 0.7s ease-out 0.15s both; }
    .hero-badge {
      display: inline-flex; align-items: center; gap: 8px;
      background: rgba(79,70,229,0.06); border: 1px solid rgba(79,70,229,0.12);
      padding: 7px 18px; border-radius: 999px; font-size: 13px; color: var(--accent);
      font-weight: 600; margin-bottom: 24px;
    }
    .hero-badge i { font-size: 8px; animation: pulse 2s ease-in-out infinite; color: #22c55e; }
    .hero h1 {
      font-size: 46px; font-weight: 800; line-height: 1.15; margin-bottom: 20px;
      color: var(--white); letter-spacing: -1.2px;
    }
    .hero h1 span {
      background: var(--gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    }
    .hero p { font-size: 17px; color: var(--muted); margin-bottom: 32px; max-width: 520px; line-height: 1.8; }
    .hero-btns { display: flex; gap: 14px; flex-wrap: wrap; }
    .btn {
      display: inline-flex; align-items: center; gap: 8px;
      padding: 13px 26px; border-radius: var(--radius-sm); font-weight: 600; font-size: 15px;
      text-decoration: none; border: none; cursor: pointer; transition: all 0.25s;
    }
    .btn-primary {
      background: var(--gradient); color: #fff;
      box-shadow: 0 4px 16px rgba(79,70,229,0.25), 0 2px 6px rgba(79,70,229,0.15);
    }
    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(79,70,229,0.3), 0 4px 8px rgba(79,70,229,0.15);
    }
    .btn-outline {
      background: var(--card); color: var(--text);
      border: 1px solid var(--border);
      box-shadow: var(--shadow-sm);
    }
    .btn-outline:hover {
      border-color: var(--border-hover); color: var(--white);
      box-shadow: var(--shadow);
      transform: translateY(-1px);
    }
    .hero-stats {
      display: flex; gap: 40px; margin-top: 40px;
      padding-top: 32px; border-top: 1px solid var(--border);
    }
    .stat-num {
      font-size: 30px; font-weight: 800; color: var(--white); letter-spacing: -0.5px;
      background: var(--gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    }
    .stat-label { font-size: 13px; color: var(--muted); font-weight: 500; margin-top: 2px; }

    /* Hero card */
    .hero-card {
      background: var(--card); border: 1px solid var(--border);
      border-radius: 20px; padding: 28px; position: relative; overflow: hidden;
      box-shadow: var(--shadow-lg);
    }
    .hero-card::before {
      content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
      background: var(--gradient);
    }
    .profile-row { display: flex; align-items: center; gap: 16px; margin-bottom: 20px; }
    .profile-avatar {
      width: 56px; height: 56px; border-radius: 14px;
      background: var(--gradient); display: grid; place-items: center;
      font-weight: 800; font-size: 22px; color: #fff;
      box-shadow: 0 4px 12px rgba(79,70,229,0.2);
    }
    .profile-name { font-weight: 700; font-size: 18px; color: var(--white); letter-spacing: -0.3px; }
    .profile-role { font-size: 13px; color: var(--muted); font-weight: 500; }
    .status-dot {
      display: inline-block; width: 8px; height: 8px; border-radius: 50%;
      background: #22c55e; margin-right: 6px;
      box-shadow: 0 0 0 3px rgba(34,197,94,0.15);
      animation: pulse 2s ease-in-out infinite;
    }
    .quick-skills { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 16px; }
    .q-skill {
      display: inline-flex; align-items: center; gap: 6px;
      background: var(--bg2); border: 1px solid var(--border);
      padding: 6px 14px; border-radius: 999px; font-size: 13px; color: var(--muted);
      font-weight: 500; transition: all 0.2s;
    }
    .q-skill:hover { background: rgba(79,70,229,0.06); color: var(--accent); border-color: rgba(79,70,229,0.15); }
    .q-skill i { font-size: 14px; }
    .card-btns { display: flex; gap: 10px; margin-top: 20px; }
    .card-btns .btn { flex: 1; justify-content: center; font-size: 14px; padding: 11px 16px; }

    /* ─── SECTION COMMON ─── */
    section { padding: 88px 0; }
    #about { background: var(--bg2); }
    #skills { background: var(--bg); }
    #projects { background: var(--bg2); }
    #contact { background: var(--bg); }
    .section-header { text-align: center; margin-bottom: 52px; }
    .section-label {
      display: inline-flex; align-items: center; gap: 8px;
      font-size: 13px; font-weight: 700; color: var(--accent);
      text-transform: uppercase; letter-spacing: 2px; margin-bottom: 14px;
      background: rgba(79,70,229,0.06); padding: 6px 16px; border-radius: 999px;
    }
    .section-header h2 {
      font-size: 34px; font-weight: 800; color: var(--white); margin-bottom: 14px;
      letter-spacing: -0.8px;
    }
    .section-header p { font-size: 16px; color: var(--muted); max-width: 560px; margin: 0 auto; line-height: 1.7; }

    /* ─── ABOUT ─── */
    .about-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
    .about-card {
      background: var(--card); border: 1px solid var(--border);
      border-radius: var(--radius); padding: 32px; transition: all 0.35s;
      box-shadow: var(--shadow-sm);
      position: relative; overflow: hidden;
    }
    .about-card::after {
      content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
      background: var(--gradient); transform: scaleX(0); transform-origin: left;
      transition: transform 0.35s;
    }
    .about-card:hover::after { transform: scaleX(1); }
    .about-card:hover { box-shadow: var(--shadow-md); transform: translateY(-4px); border-color: transparent; }
    .about-icon {
      width: 52px; height: 52px; border-radius: 14px;
      display: grid; place-items: center; font-size: 22px;
      margin-bottom: 18px;
    }
    .about-card h4 { font-size: 17px; font-weight: 700; color: var(--white); margin-bottom: 10px; letter-spacing: -0.2px; }
    .about-card p { font-size: 14px; color: var(--muted); line-height: 1.7; }

    /* ─── SKILLS ─── */
    .skills-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px; }
    .skill-card {
      background: var(--card); border: 1px solid var(--border);
      border-radius: var(--radius); padding: 28px 20px; text-align: center;
      transition: all 0.35s; box-shadow: var(--shadow-sm);
      position: relative; overflow: hidden;
    }
    .skill-card:hover {
      box-shadow: var(--shadow-md); transform: translateY(-6px);
      border-color: transparent;
    }
    .skill-icon {
      width: 56px; height: 56px; border-radius: 16px;
      display: grid; place-items: center; font-size: 24px;
      margin: 0 auto 16px;
      transition: transform 0.3s;
    }
    .skill-card:hover .skill-icon { transform: scale(1.1) rotate(-3deg); }
    .skill-card h4 { font-size: 15px; font-weight: 700; color: var(--white); margin-bottom: 4px; }
    .skill-card p { font-size: 13px; color: var(--muted); }

    /* ─── PROJECTS ─── */
    .projects-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(340px, 1fr)); gap: 24px; }
    .project-card {
      background: var(--card); border: 1px solid var(--border);
      border-radius: var(--radius); overflow: hidden; transition: all 0.35s;
      box-shadow: var(--shadow-sm);
    }
    .project-card:hover { box-shadow: var(--shadow-lg); transform: translateY(-6px); border-color: transparent; }
    .project-thumb {
      height: 190px; background: var(--gradient-soft);
      display: grid; place-items: center; font-size: 52px; color: var(--accent);
      position: relative; overflow: hidden; opacity: 0.9;
    }
    .project-card:hover .project-thumb { opacity: 1; }
    .project-thumb::after {
      content: ''; position: absolute; inset: 0;
      background: linear-gradient(180deg, transparent 40%, var(--card));
    }
    .project-type {
      position: absolute; top: 14px; left: 14px; z-index: 2;
      background: var(--card); border: 1px solid var(--border);
      padding: 5px 14px; border-radius: 999px; font-size: 12px;
      font-weight: 600; color: var(--accent);
      box-shadow: var(--shadow-sm);
    }
    .project-body { padding: 24px; }
    .project-body h4 { font-size: 18px; font-weight: 700; color: var(--white); margin-bottom: 10px; letter-spacing: -0.2px; }
    .project-body p { font-size: 14px; color: var(--muted); margin-bottom: 16px; line-height: 1.7; }
    .project-tags { display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 16px; }
    .project-tag {
      background: var(--bg2); border: 1px solid var(--border);
      padding: 4px 12px; border-radius: 8px; font-size: 12px; color: var(--muted); font-weight: 500;
    }
    .project-link {
      display: inline-flex; align-items: center; gap: 6px;
      color: var(--accent); font-size: 14px; font-weight: 600; text-decoration: none;
      transition: gap 0.25s, color 0.2s;
    }
    .project-link:hover { gap: 10px; color: var(--accent2); }

    /* ─── CONTACT ─── */
    .contact-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 36px; }
    .contact-info { display: flex; flex-direction: column; gap: 16px; }
    .contact-item {
      display: flex; align-items: center; gap: 16px;
      background: var(--card); border: 1px solid var(--border);
      padding: 20px 22px; border-radius: var(--radius);
      box-shadow: var(--shadow-sm); transition: all 0.25s;
    }
    .contact-item:hover { box-shadow: var(--shadow); transform: translateX(4px); }
    .contact-item-icon {
      width: 48px; height: 48px; border-radius: 14px;
      display: grid; place-items: center; font-size: 19px; flex-shrink: 0;
    }
    .contact-item h4 { font-size: 14px; font-weight: 700; color: var(--white); margin-bottom: 2px; }
    .contact-item p { font-size: 13px; color: var(--muted); }
    .contact-form {
      background: var(--card); border: 1px solid var(--border);
      border-radius: var(--radius); padding: 32px;
      box-shadow: var(--shadow);
    }
    .form-group { margin-bottom: 18px; }
    .form-group label {
      display: flex; align-items: center; gap: 6px;
      font-size: 13px; font-weight: 600; color: var(--text); margin-bottom: 8px;
    }
    .form-group label i { color: var(--muted); font-size: 12px; }
    .form-group input, .form-group textarea {
      width: 100%; padding: 13px 16px; border-radius: var(--radius-sm);
      border: 1.5px solid var(--border); background: var(--bg);
      color: var(--white); font-family: inherit; font-size: 14px;
      transition: all 0.25s;
    }
    .form-group input::placeholder, .form-group textarea::placeholder { color: #94a3b8; }
    .form-group input:focus, .form-group textarea:focus {
      outline: none; border-color: var(--accent);
      box-shadow: 0 0 0 3px rgba(79,70,229,0.1);
      background: var(--card);
    }
    .form-group textarea { resize: vertical; min-height: 100px; }

    /* ─── FOOTER ─── */
    footer {
      background: #0f172a;
      padding: 24px 0;
    }
    .footer-inner {
      display: flex; align-items: center; justify-content: space-between;
      gap: 16px; flex-wrap: wrap;
    }
    .footer-brand {
      display: flex; align-items: center; gap: 10px; text-decoration: none;
    }
    .footer-brand .logo {
      width: 32px; height: 32px; border-radius: 9px; font-size: 14px;
      box-shadow: none;
    }
    .footer-brand-name { font-size: 14px; font-weight: 600; color: rgba(255,255,255,0.85); }
    .footer-links { display: flex; align-items: center; gap: 6px; }
    .footer-links a {
      color: rgba(255,255,255,0.4); font-size: 16px; text-decoration: none;
      width: 34px; height: 34px; border-radius: 9px;
      display: grid; place-items: center;
      background: rgba(255,255,255,0.05);
      transition: all 0.2s;
    }
    .footer-links a:hover { color: #fff; background: rgba(255,255,255,0.1); transform: translateY(-1px); }
    .footer-copy { font-size: 13px; color: rgba(255,255,255,0.3); }

    /* ─── RESPONSIVE ─── */
    @media (max-width: 960px) {
      .hero { grid-template-columns: 1fr; text-align: center; padding: 50px 0 40px; gap: 36px; }
      .hero p { margin: 0 auto 28px; }
      .hero-btns { justify-content: center; }
      .hero-stats { justify-content: center; }
      .hero-card { max-width: 420px; margin: 0 auto; }
      .about-grid { grid-template-columns: 1fr; }
      .skills-grid { grid-template-columns: repeat(2, 1fr); }
      .contact-grid { grid-template-columns: 1fr; }
      nav { display: none; }
      .hamburger { display: block; }
      nav.open {
        display: flex; flex-direction: column; position: absolute; top: 72px; left: 0; right: 0;
        background: var(--card); border-bottom: 1px solid var(--border);
        padding: 16px; box-shadow: var(--shadow-lg);
        animation: fadeUp 0.25s ease-out;
      }
    }
    @media (max-width: 640px) {
      .hero h1 { font-size: 30px; }
      .skills-grid { grid-template-columns: 1fr 1fr; }
      .projects-grid { grid-template-columns: 1fr; }
      .hero-stats { flex-wrap: wrap; gap: 24px; }
      .stat-num { font-size: 26px; }
      section { padding: 64px 0; }
    }
    @media (max-width: 480px) {
      .container { padding: 0 16px; }
      .hero h1 { font-size: 26px; }
      .btn { width: 100%; justify-content: center; }
      .card-btns { flex-direction: column; }
      .hero-stats { flex-direction: column; gap: 16px; }
      .about-card, .contact-form { padding: 24px; }
    }
    @media (max-width: 560px) {
      .footer-inner { flex-direction: column; align-items: center; gap: 12px; text-align: center; }
    }
  </style>
</head>
<body>
  <div class="bg-glow"></div>
  <div class="wrapper">

  <!-- HEADER -->
  <header>
    <div class="container">
      <div class="nav-wrap">
        <a href="#" class="brand">
          <div class="logo"><?= e($profile['avatar_letter']) ?></div>
          <div>
            <div class="brand-text"><?= e($profile['name']) ?></div>
            <div class="brand-sub"><?= e($profile['role']) ?></div>
          </div>
        </a>
        <button class="hamburger" onclick="document.querySelector('nav').classList.toggle('open')">
          <i class="fas fa-bars"></i>
        </button>
        <nav>
          <a href="#about">About</a>
          <a href="#skills">Skills</a>
          <a href="#projects">Projects</a>
          <a href="#contact">Contact</a>
          <a href="#contact" class="nav-cta"><?= e($profile['cta_primary']) ?></a>
        </nav>
      </div>
    </div>
  </header>

  <!-- HERO -->
  <section class="hero container" aria-label="Introduction">
    <div>
      <div class="hero-badge"><i class="fas fa-circle"></i> <?= e($profile['hero_badge']) ?></div>
      <h1><?= e($profile['hero_heading_before']) ?> <span><?= e($profile['hero_heading_highlight']) ?></span> <?= e($profile['hero_heading_after']) ?></h1>
      <p><?= e($profile['hero_description']) ?></p>
      <div class="hero-btns">
        <a href="#contact" class="btn btn-primary"><i class="fas fa-paper-plane"></i> <?= e($profile['cta_primary']) ?></a>
        <a href="#projects" class="btn btn-outline"><i class="fas fa-folder-open"></i> <?= e($profile['cta_secondary']) ?></a>
      </div>
      <div class="hero-stats">
        <div><div class="stat-num"><?= e($stats['experience']) ?></div><div class="stat-label">Years Experience</div></div>
        <div><div class="stat-num"><?= e($stats['projects']) ?></div><div class="stat-label">Projects Delivered</div></div>
        <div><div class="stat-num"><?= e($stats['clients']) ?></div><div class="stat-label">Happy Clients</div></div>
      </div>
    </div>
    <div class="hero-card">
      <div class="profile-row">
        <div class="profile-avatar"><?= e($profile['avatar_letter']) ?></div>
        <div>
          <div class="profile-name"><?= e($profile['name']) ?></div>
          <div class="profile-role"><span class="status-dot"></span><?= e($profile['role']) ?></div>
        </div>
      </div>
      <div style="font-size:13px;color:var(--muted);margin-bottom:12px;">Core Technologies</div>
      <div class="quick-skills">
        <?php foreach ($skills as $sk): ?>
        <span class="q-skill"><i class="<?= e($sk['icon'] ?? 'fas fa-code') ?>"></i> <?= e($sk['name']) ?></span>
        <?php endforeach; ?>
      </div>
      <div class="card-btns">
        <a href="#contact" class="btn btn-primary"><i class="fas fa-envelope"></i> <?= e($profile['cta_primary']) ?></a>
        <?php if (!empty($profile['cv_link'])): ?>
        <a href="<?= e($profile['cv_link']) ?>" class="btn btn-outline" download><i class="fas fa-download"></i> Download CV</a>
        <?php else: ?>
        <a href="#projects" class="btn btn-outline"><i class="fas fa-folder-open"></i> <?= e($profile['cta_secondary']) ?></a>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- ABOUT — Dynamic from admin -->
  <section id="about" aria-label="About Me">
    <div class="container">
      <div class="section-header">
        <div class="section-label"><i class="fas fa-user"></i> <?= e($profile['about_label']) ?></div>
        <h2><?= e($profile['about_heading']) ?></h2>
        <p><?= e($profile['about_description']) ?></p>
      </div>
      <div class="about-grid">
        <?php foreach ($aboutCards as $card): ?>
        <div class="about-card">
          <div class="about-icon" style="background:<?= hexToRgba($card['color'] ?? '#3b82f6') ?>;color:<?= e($card['color'] ?? '#3b82f6') ?>;">
            <i class="<?= e($card['icon'] ?? 'fas fa-code') ?>"></i>
          </div>
          <h4><?= e($card['name']) ?></h4>
          <p><?= e($card['desc']) ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- SKILLS — Dynamic from admin -->
  <section id="skills">
    <div class="container">
      <div class="section-header">
        <div class="section-label"><i class="fas fa-cogs"></i> <?= e($profile['skills_label']) ?></div>
        <h2><?= e($profile['skills_heading']) ?></h2>
        <p><?= e($profile['skills_description']) ?></p>
      </div>
      <div class="skills-grid">
        <?php foreach ($skills as $skill): ?>
        <div class="skill-card">
          <div class="skill-icon" style="background:<?= hexToRgba($skill['color'] ?? '#3b82f6') ?>;color:<?= e($skill['color'] ?? '#3b82f6') ?>;">
            <i class="<?= e($skill['icon'] ?? 'fas fa-code') ?>"></i>
          </div>
          <h4><?= e($skill['name']) ?></h4>
          <p><?= e($skill['desc'] ?? '') ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- PROJECTS — Dynamic from admin -->
  <section id="projects">
    <div class="container">
      <div class="section-header">
        <div class="section-label"><i class="fas fa-rocket"></i> <?= e($profile['projects_label']) ?></div>
        <h2><?= e($profile['projects_heading']) ?></h2>
        <p><?= e($profile['projects_description']) ?></p>
      </div>
      <div class="projects-grid">
        <?php foreach ($projects as $proj): ?>
        <div class="project-card">
          <div class="project-thumb">
            <span class="project-type"><i class="<?= e(getTypeIcon($proj['type'] ?? 'Other')) ?>"></i> <?= e($proj['type'] ?? 'Other') ?></span>
            <i class="<?= e($proj['icon'] ?? 'fas fa-globe') ?>"></i>
          </div>
          <div class="project-body">
            <h4><?= e($proj['name']) ?></h4>
            <p><?= e($proj['desc'] ?? '') ?></p>
            <div class="project-tags">
              <?php
              $tags = array_filter(array_map('trim', explode(',', $proj['tags'] ?? '')));
              foreach ($tags as $tag): ?>
                <span class="project-tag"><?= e($tag) ?></span>
              <?php endforeach; ?>
            </div>
            <?php if (!empty($proj['url'])): ?>
              <a href="<?= e($proj['url']) ?>" target="_blank" class="project-link">Visit Site <i class="fas fa-arrow-right"></i></a>
            <?php else: ?>
              <span class="project-link" style="opacity:0.5"><i class="fas fa-lock"></i> Private Project</span>
            <?php endif; ?>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- CONTACT -->
  <section id="contact">
    <div class="container">
      <div class="section-header">
        <div class="section-label"><i class="fas fa-envelope"></i> <?= e($profile['contact_label']) ?></div>
        <h2><?= e($profile['contact_heading']) ?></h2>
        <p><?= e($profile['contact_description']) ?></p>
      </div>
      <div class="contact-grid">
        <div class="contact-info">
          <div class="contact-item">
            <div class="contact-item-icon" style="background:rgba(79,70,229,0.08);color:var(--accent);">
              <i class="fas fa-envelope"></i>
            </div>
            <div>
              <h4>Email</h4>
              <p><?= e($seo['email']) ?></p>
            </div>
          </div>
          <div class="contact-item">
            <div class="contact-item-icon" style="background:rgba(124,58,237,0.08);color:var(--accent2);">
              <i class="fas fa-map-marker-alt"></i>
            </div>
            <div>
              <h4>Location</h4>
              <p><?= e($profile['location']) ?></p>
            </div>
          </div>
          <div class="contact-item">
            <div class="contact-item-icon" style="background:rgba(34,197,94,0.08);color:#16a34a;">
              <i class="fas fa-clock"></i>
            </div>
            <div>
              <h4>Availability</h4>
              <p><?= e($profile['availability']) ?></p>
            </div>
          </div>
          <div class="contact-item">
            <div class="contact-item-icon" style="background:rgba(14,165,233,0.08);color:var(--accent3);">
              <i class="fab fa-github"></i>
            </div>
            <div>
              <h4>GitHub</h4>
              <p><?= e(str_replace('https://', '', $seo['github_url'])) ?></p>
            </div>
          </div>
        </div>
        <div class="contact-form">
          <form method="POST" action="contact.php">
            <div class="form-group">
              <label><i class="fas fa-user"></i> Name</label>
              <input name="name" placeholder="Your full name" required />
            </div>
            <div class="form-group">
              <label><i class="fas fa-at"></i> Email</label>
              <input name="email" type="email" placeholder="you@example.com" required />
            </div>
            <div class="form-group">
              <label><i class="fas fa-comment"></i> Message</label>
              <textarea name="message" rows="5" placeholder="Tell me about your project..." required></textarea>
            </div>
            <button class="btn btn-primary" type="submit" style="width:100%;justify-content:center;">
              <i class="fas fa-paper-plane"></i> Send Message
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    <div class="container">
      <div class="footer-inner">
        <a href="#" class="footer-brand">
          <div class="logo"><?= e($profile['avatar_letter']) ?></div>
          <span class="footer-brand-name"><?= e($profile['name']) ?></span>
        </a>
        <div class="footer-copy">&copy; <?= date('Y') ?> <?= e($seo['author']) ?>. All rights reserved.</div>
        <div class="footer-links">
          <?php if (!empty($seo['github_url'])): ?>
            <a href="<?= e($seo['github_url']) ?>" target="_blank" rel="noopener noreferrer" title="GitHub"><i class="fab fa-github"></i></a>
          <?php endif; ?>
          <?php if (!empty($seo['linkedin_url'])): ?>
            <a href="<?= e($seo['linkedin_url']) ?>" target="_blank" rel="noopener noreferrer" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
          <?php endif; ?>
          <?php if (!empty($seo['email'])): ?>
            <a href="mailto:<?= e($seo['email']) ?>" title="Email"><i class="fas fa-envelope"></i></a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </footer>

  </div>
</body>
</html>