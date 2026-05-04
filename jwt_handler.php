<?php
// jwt_handler.php (Simulasi Sederhana JWT)
function generateToken($user_id) {
    $header = base64_encode(json_encode(['alg' => 'HS256', 'typ' => 'JWT']));
    $payload = base64_encode(json_encode(['user_id' => $user_id, 'exp' => time() + 3600]));
    $signature = hash_hmac('sha256', "$header.$payload", 'RAHASIA_KUNCI_ITPLN');
    return "$header.$payload.$signature";
}

function validateToken($token) {
    $parts = explode('.', $token);
    if(count($parts) != 3) return false;
    // Validasi signature (logika disederhanakan)
    return true; 
}
?>