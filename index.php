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
function hexToRgba(string $hex, float $alpha = 0.1): string {
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
  <meta name="theme-color" content="#0a0f1a" />
  <meta name="color-scheme" content="dark" />
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
      --bg: #0a0f1a;
      --bg2: #0f1628;
      --card: #131c31;
      --card-hover: #182240;
      --border: rgba(255,255,255,0.06);
      --muted: #7c8db5;
      --text: #c9d6ef;
      --white: #eaf0ff;
      --accent: #3b82f6;
      --accent2: #8b5cf6;
      --accent3: #06b6d4;
      --gradient: linear-gradient(135deg, var(--accent2), var(--accent), var(--accent3));
      --glass: rgba(255,255,255,0.03);
    }
    * { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }
    body {
      font-family: 'Inter', system-ui, -apple-system, sans-serif;
      background: var(--bg);
      color: var(--text);
      line-height: 1.7;
      overflow-x: hidden;
    }

    /* Animated background */
    .bg-glow {
      position: fixed; top: 0; left: 0; width: 100%; height: 100%;
      pointer-events: none; z-index: 0;
      background:
        radial-gradient(ellipse 600px 400px at 20% 20%, rgba(139,92,246,0.08), transparent),
        radial-gradient(ellipse 500px 300px at 80% 60%, rgba(59,130,246,0.06), transparent),
        radial-gradient(ellipse 400px 300px at 50% 90%, rgba(6,182,212,0.05), transparent);
    }

    .wrapper { position: relative; z-index: 1; }

    /* ─── HEADER ─── */
    header {
      position: sticky; top: 0; z-index: 100;
      background: rgba(10,15,26,0.85);
      backdrop-filter: blur(20px);
      border-bottom: 1px solid var(--border);
    }
    .container { max-width: 1140px; margin: 0 auto; padding: 0 24px; }
    .nav-wrap { display: flex; align-items: center; justify-content: space-between; height: 70px; }
    .brand { display: flex; align-items: center; gap: 14px; text-decoration: none; }
    .logo {
      width: 42px; height: 42px; border-radius: 12px;
      background: var(--gradient);
      display: grid; place-items: center;
      font-weight: 800; font-size: 18px; color: #fff;
      box-shadow: 0 4px 20px rgba(139,92,246,0.3);
    }
    .brand-text { font-weight: 700; font-size: 18px; color: var(--white); }
    .brand-sub { font-size: 12px; color: var(--muted); font-weight: 400; }
    nav { display: flex; align-items: center; gap: 8px; }
    nav a {
      color: var(--muted); text-decoration: none; font-weight: 500; font-size: 14px;
      padding: 8px 14px; border-radius: 8px; transition: all 0.2s;
    }
    nav a:hover { color: var(--white); background: rgba(255,255,255,0.05); }
    .nav-cta {
      background: var(--gradient) !important; color: #fff !important;
      font-weight: 600; box-shadow: 0 2px 12px rgba(59,130,246,0.3);
    }
    .hamburger { display: none; background: none; border: none; color: var(--white); font-size: 22px; cursor: pointer; }

    /* ─── HERO ─── */
    .hero { padding: 80px 0 60px; display: grid; grid-template-columns: 1fr 400px; gap: 48px; align-items: center; }
    .hero-badge {
      display: inline-flex; align-items: center; gap: 8px;
      background: rgba(139,92,246,0.1); border: 1px solid rgba(139,92,246,0.2);
      padding: 6px 16px; border-radius: 999px; font-size: 13px; color: var(--accent2);
      font-weight: 500; margin-bottom: 20px;
    }
    .hero-badge i { font-size: 10px; }
    .hero h1 { font-size: 42px; font-weight: 800; line-height: 1.2; margin-bottom: 18px; color: var(--white); }
    .hero h1 span { background: var(--gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
    .hero p { font-size: 17px; color: var(--muted); margin-bottom: 28px; max-width: 520px; }
    .hero-btns { display: flex; gap: 14px; flex-wrap: wrap; }
    .btn {
      display: inline-flex; align-items: center; gap: 8px;
      padding: 12px 24px; border-radius: 12px; font-weight: 600; font-size: 15px;
      text-decoration: none; border: none; cursor: pointer; transition: all 0.25s;
    }
    .btn-primary {
      background: var(--gradient); color: #fff;
      box-shadow: 0 4px 20px rgba(59,130,246,0.25);
    }
    .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 28px rgba(59,130,246,0.35); }
    .btn-outline {
      background: transparent; color: var(--muted);
      border: 1px solid var(--border);
    }
    .btn-outline:hover { border-color: rgba(255,255,255,0.15); color: var(--white); }
    .hero-stats { display: flex; gap: 32px; margin-top: 36px; }
    .stat-num { font-size: 28px; font-weight: 800; color: var(--white); }
    .stat-label { font-size: 13px; color: var(--muted); }

    /* Hero card */
    .hero-card {
      background: var(--card); border: 1px solid var(--border);
      border-radius: 20px; padding: 28px; position: relative; overflow: hidden;
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
    }
    .profile-name { font-weight: 700; font-size: 18px; color: var(--white); }
    .profile-role { font-size: 13px; color: var(--muted); }
    .status-dot { display: inline-block; width: 8px; height: 8px; border-radius: 50%; background: #22c55e; margin-right: 6px; }
    .quick-skills { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 16px; }
    .q-skill {
      display: inline-flex; align-items: center; gap: 6px;
      background: rgba(255,255,255,0.04); border: 1px solid var(--border);
      padding: 6px 14px; border-radius: 999px; font-size: 13px; color: var(--muted);
      transition: all 0.2s;
    }
    .q-skill:hover { background: rgba(255,255,255,0.08); color: var(--white); }
    .q-skill i { font-size: 14px; }
    .card-btns { display: flex; gap: 10px; margin-top: 20px; }
    .card-btns .btn { flex: 1; justify-content: center; font-size: 14px; padding: 10px 16px; }

    /* ─── SECTION COMMON ─── */
    section { padding: 80px 0; }
    .section-header { text-align: center; margin-bottom: 48px; }
    .section-label {
      display: inline-flex; align-items: center; gap: 8px;
      font-size: 13px; font-weight: 600; color: var(--accent);
      text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 12px;
    }
    .section-header h2 { font-size: 32px; font-weight: 800; color: var(--white); margin-bottom: 12px; }
    .section-header p { font-size: 16px; color: var(--muted); max-width: 560px; margin: 0 auto; }

    /* ─── ABOUT ─── */
    .about-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
    .about-card {
      background: var(--card); border: 1px solid var(--border);
      border-radius: 16px; padding: 28px; transition: all 0.3s;
    }
    .about-card:hover { border-color: rgba(255,255,255,0.1); transform: translateY(-2px); }
    .about-icon {
      width: 48px; height: 48px; border-radius: 12px;
      display: grid; place-items: center; font-size: 20px;
      margin-bottom: 16px;
    }
    .about-card h4 { font-size: 17px; font-weight: 700; color: var(--white); margin-bottom: 8px; }
    .about-card p { font-size: 14px; color: var(--muted); }

    /* ─── SKILLS ─── */
    .skills-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; }
    .skill-card {
      background: var(--card); border: 1px solid var(--border);
      border-radius: 14px; padding: 24px; text-align: center;
      transition: all 0.3s;
    }
    .skill-card:hover { border-color: rgba(255,255,255,0.12); transform: translateY(-4px); }
    .skill-icon {
      width: 52px; height: 52px; border-radius: 14px;
      display: grid; place-items: center; font-size: 22px;
      margin: 0 auto 14px;
    }
    .skill-card h4 { font-size: 15px; font-weight: 600; color: var(--white); margin-bottom: 4px; }
    .skill-card p { font-size: 13px; color: var(--muted); }

    /* ─── PROJECTS ─── */
    .projects-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 20px; }
    .project-card {
      background: var(--card); border: 1px solid var(--border);
      border-radius: 16px; overflow: hidden; transition: all 0.3s;
    }
    .project-card:hover { border-color: rgba(255,255,255,0.12); transform: translateY(-4px); }
    .project-thumb {
      height: 180px; background: linear-gradient(135deg, var(--card-hover), var(--card));
      display: grid; place-items: center; font-size: 48px; color: var(--muted);
      position: relative; overflow: hidden;
    }
    .project-thumb::after {
      content: ''; position: absolute; inset: 0;
      background: linear-gradient(180deg, transparent 50%, var(--card));
    }
    .project-type {
      position: absolute; top: 12px; left: 12px; z-index: 2;
      background: rgba(0,0,0,0.5); backdrop-filter: blur(8px);
      padding: 4px 12px; border-radius: 999px; font-size: 12px;
      font-weight: 600; color: var(--accent);
    }
    .project-body { padding: 20px; }
    .project-body h4 { font-size: 17px; font-weight: 700; color: var(--white); margin-bottom: 8px; }
    .project-body p { font-size: 14px; color: var(--muted); margin-bottom: 14px; }
    .project-tags { display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 14px; }
    .project-tag {
      background: rgba(255,255,255,0.04); border: 1px solid var(--border);
      padding: 4px 10px; border-radius: 6px; font-size: 12px; color: var(--muted);
    }
    .project-link {
      display: inline-flex; align-items: center; gap: 6px;
      color: var(--accent); font-size: 14px; font-weight: 600; text-decoration: none;
      transition: gap 0.2s;
    }
    .project-link:hover { gap: 10px; }

    /* ─── CONTACT ─── */
    .contact-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 32px; }
    .contact-info { display: flex; flex-direction: column; gap: 20px; }
    .contact-item {
      display: flex; align-items: center; gap: 16px;
      background: var(--card); border: 1px solid var(--border);
      padding: 18px 20px; border-radius: 14px;
    }
    .contact-item-icon {
      width: 44px; height: 44px; border-radius: 12px;
      display: grid; place-items: center; font-size: 18px; flex-shrink: 0;
    }
    .contact-item h4 { font-size: 14px; font-weight: 600; color: var(--white); }
    .contact-item p { font-size: 13px; color: var(--muted); }
    .contact-form {
      background: var(--card); border: 1px solid var(--border);
      border-radius: 16px; padding: 28px;
    }
    .form-group { margin-bottom: 16px; }
    .form-group label { display: block; font-size: 13px; font-weight: 500; color: var(--muted); margin-bottom: 6px; }
    .form-group input, .form-group textarea {
      width: 100%; padding: 12px 16px; border-radius: 10px;
      border: 1px solid var(--border); background: rgba(255,255,255,0.03);
      color: var(--white); font-family: inherit; font-size: 14px;
      transition: border-color 0.2s;
    }
    .form-group input:focus, .form-group textarea:focus {
      outline: none; border-color: var(--accent);
    }
    .form-group textarea { resize: vertical; }

    /* ─── FOOTER ─── */
    footer {
      border-top: 1px solid var(--border);
      padding: 40px 0; text-align: center;
    }
    .footer-links { display: flex; justify-content: center; gap: 24px; margin-bottom: 16px; }
    .footer-links a { color: var(--muted); font-size: 20px; transition: color 0.2s; text-decoration: none; }
    .footer-links a:hover { color: var(--white); }
    .footer-copy { font-size: 14px; color: var(--muted); }

    /* ─── RESPONSIVE ─── */
    @media (max-width: 960px) {
      .hero { grid-template-columns: 1fr; text-align: center; padding: 50px 0 40px; }
      .hero p { margin: 0 auto 28px; }
      .hero-btns { justify-content: center; }
      .hero-stats { justify-content: center; }
      .hero-card { max-width: 420px; margin: 0 auto; }
      .about-grid { grid-template-columns: 1fr; }
      .skills-grid { grid-template-columns: repeat(2, 1fr); }
      .contact-grid { grid-template-columns: 1fr; }
      nav { display: none; }
      .hamburger { display: block; }
      nav.open { display: flex; flex-direction: column; position: absolute; top: 70px; left: 0; right: 0; background: var(--bg2); border-bottom: 1px solid var(--border); padding: 16px; }
    }
    @media (max-width: 640px) {
      .hero h1 { font-size: 28px; }
      .skills-grid { grid-template-columns: 1fr 1fr; }
      .projects-grid { grid-template-columns: 1fr; }
      .hero-stats { flex-direction: column; gap: 16px; }
      .stat-num { font-size: 24px; }
    }
    @media (max-width: 480px) {
      .container { padding: 0 16px; }
      .hero h1 { font-size: 24px; }
      .btn { width: 100%; justify-content: center; }
      .card-btns { flex-direction: column; }
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
            <div class="contact-item-icon" style="background:rgba(139,92,246,0.1);color:var(--accent2);">
              <i class="fas fa-envelope"></i>
            </div>
            <div>
              <h4>Email</h4>
              <p><?= e($seo['email']) ?></p>
            </div>
          </div>
          <div class="contact-item">
            <div class="contact-item-icon" style="background:rgba(59,130,246,0.1);color:var(--accent);">
              <i class="fas fa-map-marker-alt"></i>
            </div>
            <div>
              <h4>Location</h4>
              <p><?= e($profile['location']) ?></p>
            </div>
          </div>
          <div class="contact-item">
            <div class="contact-item-icon" style="background:rgba(34,197,94,0.1);color:#22c55e;">
              <i class="fas fa-clock"></i>
            </div>
            <div>
              <h4>Availability</h4>
              <p><?= e($profile['availability']) ?></p>
            </div>
          </div>
          <div class="contact-item">
            <div class="contact-item-icon" style="background:rgba(6,182,212,0.1);color:var(--accent3);">
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
      <div class="footer-links">
        <?php if (!empty($seo['github_url'])): ?>
          <a href="<?= e($seo['github_url']) ?>" target="_blank" rel="noopener noreferrer"><i class="fab fa-github"></i></a>
        <?php endif; ?>
        <?php if (!empty($seo['linkedin_url'])): ?>
          <a href="<?= e($seo['linkedin_url']) ?>" target="_blank" rel="noopener noreferrer"><i class="fab fa-linkedin"></i></a>
        <?php endif; ?>
        <?php if (!empty($seo['email'])): ?>
          <a href="mailto:<?= e($seo['email']) ?>"><i class="fas fa-envelope"></i></a>
        <?php endif; ?>
      </div>
      <div class="footer-copy">&copy; <?= date('Y') ?> <?= e($seo['author']) ?>. All rights reserved.</div>
    </div>
  </footer>

  </div>
</body>
</html>