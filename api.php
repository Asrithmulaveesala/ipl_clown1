<?php
// api.php - minimal SaaS-ready API
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');

require_once __DIR__ . '/config.php';
$conn = get_db_conn();
if (!$conn) {
    http_response_code(500);
    echo json_encode(['status'=>'error','message'=>'DB connection failed']);
    exit;
}

$endpoint = isset($_GET['endpoint']) ? strtolower(trim($_GET['endpoint'])) : '';

// ensure cache dir exists
$cacheDir = __DIR__ . '/cache';
if (!is_dir($cacheDir)) mkdir($cacheDir, 0755, true);

function send_json($code, $payload) {
    http_response_code($code);
    echo json_encode($payload, JSON_PRETTY_PRINT);
    exit;
}

/* --- /api.php?endpoint=points  (top 5) --- */
if ($endpoint === 'points') {
    $cacheFile = $cacheDir . '/points.json';
    $ttl = 20; // seconds - very short for demo, raise for production

    if (file_exists($cacheFile) && (time() - filemtime($cacheFile) < $ttl)) {
        $teams = json_decode(file_get_contents($cacheFile), true);
        send_json(200, ['status'=>'success','data'=>$teams]);
    }

    $sql = "SELECT team_id, team, logo, points, played, won, nrr, recent_form 
            FROM ipl_teams 
            ORDER BY points DESC, nrr DESC 
            LIMIT 5";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $res = $stmt->get_result();
    $teams = $res->fetch_all(MYSQLI_ASSOC);

    file_put_contents($cacheFile, json_encode($teams));
    send_json(200, ['status'=>'success','data'=>$teams]);
}

/* --- /api.php?endpoint=teams  (all teams) --- */
if ($endpoint === 'teams') {
    $sql = "SELECT team_id, team, logo FROM ipl_teams ORDER BY team ASC";
    $res = $conn->query($sql);
    $teams = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    send_json(200, ['status'=>'success','data'=>$teams]);
}

/* --- /api.php?endpoint=matches  (fixtures) --- */
if ($endpoint === 'matches') {
    $sql = "SELECT match_id, team1, team2, venue, match_date FROM ipl_matches ORDER BY match_date ASC";
    $res = $conn->query($sql);
    $matches = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    send_json(200, ['status'=>'success','data'=>$matches]);
}

/* --- /api.php?endpoint=team&id=TEAMID  (single team) --- */
if ($endpoint === 'team' && isset($_GET['id'])) {
    $teamId = trim($_GET['id']);
    $sql = "SELECT team_id, team, logo, points, played, won, nrr, recent_form FROM ipl_teams WHERE team_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $teamId);
    $stmt->execute();
    $res = $stmt->get_result();
    $team = $res->fetch_assoc();
    if ($team) send_json(200, ['status'=>'success','data'=>$team]);
    else send_json(404, ['status'=>'error','message'=>'Team not found']);
}

send_json(400, ['status'=>'error','message'=>'Invalid endpoint']);
?>
