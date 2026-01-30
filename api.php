<?php
require_once __DIR__ . '/config.php';

header('Content-Type: application/json');

if (!is_logged_in()) {
    http_response_code(401);
    echo json_encode(['ok' => false, 'error' => 'Unauthorized']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
if (!$input || empty($input['action'])) {
    echo json_encode(['ok' => false, 'error' => 'Invalid request']);
    exit;
}

$action  = $input['action'];
$section = $input['section'] ?? '';
$index   = $input['index'] ?? null;
$item    = $input['item'] ?? null;
$data    = load_data();

$allowed_sections = ['projects', 'skills', 'about'];

switch ($action) {
    case 'add':
        if (!in_array($section, $allowed_sections) || !$item) {
            echo json_encode(['ok' => false, 'error' => 'Invalid section or item']);
            exit;
        }
        if (!isset($data[$section])) $data[$section] = [];
        $data[$section][] = $item;
        save_data($data);
        echo json_encode(['ok' => true, 'data' => $data]);
        break;

    case 'update':
        if (!in_array($section, $allowed_sections) || $index === null || !$item) {
            echo json_encode(['ok' => false, 'error' => 'Invalid params']);
            exit;
        }
        if (!isset($data[$section][$index])) {
            echo json_encode(['ok' => false, 'error' => 'Item not found']);
            exit;
        }
        $data[$section][$index] = $item;
        save_data($data);
        echo json_encode(['ok' => true, 'data' => $data]);
        break;

    case 'delete':
        if (!in_array($section, $allowed_sections) || $index === null) {
            echo json_encode(['ok' => false, 'error' => 'Invalid params']);
            exit;
        }
        if (!isset($data[$section][$index])) {
            echo json_encode(['ok' => false, 'error' => 'Item not found']);
            exit;
        }
        array_splice($data[$section], $index, 1);
        save_data($data);
        echo json_encode(['ok' => true, 'data' => $data]);
        break;

    case 'stats':
        $stats = $input['stats'] ?? null;
        if (!$stats) {
            echo json_encode(['ok' => false, 'error' => 'No stats provided']);
            exit;
        }
        $data['stats'] = [
            'experience' => strip_tags(trim($stats['experience'] ?? '')),
            'projects'   => strip_tags(trim($stats['projects'] ?? '')),
            'clients'    => strip_tags(trim($stats['clients'] ?? ''))
        ];
        save_data($data);
        echo json_encode(['ok' => true, 'data' => $data]);
        break;

    case 'profile':
        $profile = $input['profile'] ?? null;
        if (!$profile) {
            echo json_encode(['ok' => false, 'error' => 'No profile data provided']);
            exit;
        }
        $allowed_profile = [
            'name','role','brand_subtitle','avatar_letter',
            'hero_badge','hero_heading_before','hero_heading_highlight','hero_heading_after','hero_description',
            'cta_primary','cta_secondary','cv_link',
            'location','availability',
            'about_label','about_heading','about_description',
            'skills_label','skills_heading','skills_description',
            'projects_label','projects_heading','projects_description',
            'contact_label','contact_heading','contact_description'
        ];
        $clean = [];
        foreach ($allowed_profile as $key) {
            $clean[$key] = strip_tags(trim($profile[$key] ?? ''));
        }
        $data['profile'] = $clean;
        save_data($data);
        echo json_encode(['ok' => true, 'data' => $data]);
        break;

    case 'seo':
        $seo = $input['seo'] ?? null;
        if (!$seo) {
            echo json_encode(['ok' => false, 'error' => 'No SEO data provided']);
            exit;
        }
        $allowed_seo = [
            'site_title','meta_description','meta_keywords','canonical_url','author','job_title',
            'og_title','og_description','twitter_title','twitter_description',
            'email','github_url','linkedin_url'
        ];
        $clean = [];
        foreach ($allowed_seo as $key) {
            $clean[$key] = strip_tags(trim($seo[$key] ?? ''));
        }
        $data['seo'] = $clean;
        save_data($data);
        echo json_encode(['ok' => true, 'data' => $data]);
        break;

    default:
        echo json_encode(['ok' => false, 'error' => 'Unknown action']);
}
