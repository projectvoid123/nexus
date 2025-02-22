<?php
header('Content-Type: application/json');
error_reporting(0); // Disable error reporting
ini_set('display_errors', 0); // Don't display errors

// Enhanced logging function
function logChat($message, $response, $additional_data = []) {
    $logFile = __DIR__ . '/logs.json';
    $logs = [];
    
    // Read existing logs if file exists
    if (file_exists($logFile)) {
        $logs = json_decode(file_get_contents($logFile), true) ?? [];
    }
    
    // Add new log entry with enhanced information
    $logs[] = array_merge([
        'timestamp' => time(),
        'datetime' => date('Y-m-d H:i:s'),
        'user_message' => $message,
        'ai_response' => $response,
        'username' => $_SESSION['username'] ?? 'Anonymous',
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
        'system_prompt' => $additional_data['system_prompt'] ?? null,
        'temperature' => $additional_data['temperature'] ?? null,
        'python_command' => $additional_data['python_command'] ?? null,
        'raw_python_output' => $additional_data['raw_python_output'] ?? null,
        'error' => $additional_data['error'] ?? null
    ], $additional_data);
    
    // Keep only last 1000 messages
    if (count($logs) > 1000) {
        $logs = array_slice($logs, -1000);
    }
    
    // Save logs with pretty print
    file_put_contents($logFile, json_encode($logs, JSON_PRETTY_PRINT));
}

try {
    // Add rate limiting
    session_start();
    $rateLimit = 10; // requests per minute
    $currentTime = time();
    $_SESSION['requests'] = $_SESSION['requests'] ?? [];

    // Clean old requests
    $_SESSION['requests'] = array_filter($_SESSION['requests'], 
        fn($time) => $time > $currentTime - 60);

    if (count($_SESSION['requests']) >= $rateLimit) {
        throw new Exception('Rate limit exceeded. Please wait a moment.');
    }

    $_SESSION['requests'][] = $currentTime;

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method');
    }

    $input = file_get_contents('php://input');
    $data = json_decode($input, true);
    
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Invalid JSON input');
    }
    
    $message = $data['message'] ?? '';
    $systemPrompt = $data['systemPrompt'] ?? null;
    $temperature = $data['temperature'] ?? 0.7;
    $model = $data['model'] ?? 'mistralai/Mixtral-8x7B-Instruct-v0.1';

    if (empty($message)) {
        throw new Exception('No message provided');
    }

    $pythonScript = realpath(__DIR__ . "/handler.py");
    if (!$pythonScript) {
        throw new Exception('Could not find Python script');
    }

    $message_arg = escapeshellarg($message);
    $system_arg = $systemPrompt ? escapeshellarg($systemPrompt) : "''";
    $temp_arg = escapeshellarg((string)$temperature);
    $model_arg = escapeshellarg($model);
    
    $command = "python3 " . escapeshellarg($pythonScript) . " {$message_arg} {$system_arg} {$temp_arg} {$model_arg}";
    
    $output = shell_exec($command);
    
    if ($output === null) {
        throw new Exception('Failed to execute Python script');
    }

    // Log and return response
    $logData = [
        'system_prompt' => $systemPrompt,
        'temperature' => $temperature,
        'python_command' => $command,
        'raw_python_output' => $output,
        'request_data' => $data
    ];
    
    logChat($message, $output, $logData);
    echo json_encode(['response' => $output]);

} catch (Exception $e) {
    // Log the error
    $logData = [
        'error' => $e->getMessage(),
        'error_trace' => $e->getTraceAsString(),
        'system_prompt' => $systemPrompt ?? null,
        'temperature' => $temperature ?? null,
        'python_command' => $command ?? null,
        'raw_python_output' => $output ?? null
    ];
    logChat($message ?? '', null, $logData);
    
    http_response_code(500);
    echo json_encode([
        'error' => $e->getMessage(),
        'details' => [
            'file' => basename($e->getFile()),
            'line' => $e->getLine()
        ]
    ]);
}