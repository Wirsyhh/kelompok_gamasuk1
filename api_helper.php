<?php
// api_helper.php
function sendResponse($status, $message, $data = null) {
    header("Content-Type: application/json");
    http_response_code($status);
    $response = [
        "status" => $status,
        "message" => $message,
        "data" => $data,
        "timestamp" => date('Y-m-d H:i:s')
    ];
    $logMessage = "[" . date('Y-m-d H:i:s') . "] Status: $status - Message: $message" . PHP_EOL;
    file_put_contents('api_access.log', $logMessage, FILE_APPEND);
    echo json_encode($response);
    exit();
}

function writeLog($message) {
    $log = "[" . date('Y-m-d H:i:s') . "] " . $message . PHP_EOL;
    file_put_contents('api_access.log', $log, FILE_APPEND);
}
// Panggil writeLog("User mengakses API Menu") di setiap endpoint.

?>