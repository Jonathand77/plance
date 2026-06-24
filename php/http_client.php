<?php
if (!function_exists('p2p_json_post')) {
    function p2p_json_post_via_curl_cli(string $url, string $jsonBody): array {
        if (!function_exists('exec')) {
            return [false, 'exec() no esta disponible para usar curl.exe'];
        }

        $curlCandidates = [];
        if (PHP_OS_FAMILY === 'Windows') {
            $systemRoot = getenv('SystemRoot') ?: 'C:\\Windows';
            $curlCandidates[] = $systemRoot . '\\System32\\curl.exe';
            $curlCandidates[] = 'curl.exe';
        } else {
            $curlCandidates[] = 'curl';
        }

        $curlBinary = null;
        foreach ($curlCandidates as $candidate) {
            if ($candidate === 'curl.exe' || $candidate === 'curl' || is_file($candidate)) {
                $curlBinary = $candidate;
                break;
            }
        }

        if ($curlBinary === null) {
            return [false, 'No se encontro curl.exe en el sistema'];
        }

        $tmpFile = tempnam(sys_get_temp_dir(), 'p2p_');
        if ($tmpFile === false) {
            return [false, 'No se pudo crear archivo temporal para curl.exe'];
        }

        if (file_put_contents($tmpFile, $jsonBody) === false) {
            @unlink($tmpFile);
            return [false, 'No se pudo escribir payload temporal para curl.exe'];
        }

        $cmd = escapeshellarg($curlBinary)
            . ' -sS -k -X POST'
            . ' -H ' . escapeshellarg('Content-Type: application/json')
            . ' --data-binary @' . escapeshellarg($tmpFile)
            . ' --connect-timeout 20 --max-time 60 '
            . escapeshellarg($url)
            . ' 2>&1';

        $output = [];
        $exitCode = 1;
        exec($cmd, $output, $exitCode);
        @unlink($tmpFile);

        $response = implode("\n", $output);
        if ($exitCode !== 0) {
            return [false, $response !== '' ? $response : 'curl.exe devolvio error'];
        }

        return [$response, ''];
    }

    function p2p_json_post(string $url, array $payload): array {
        $jsonBody = json_encode($payload);
        if ($jsonBody === false) {
            return [false, 'No se pudo serializar el payload JSON'];
        }

        if (function_exists('curl_init')) {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonBody);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

            $response = curl_exec($ch);
            $error = curl_error($ch);
            curl_close($ch);

            if ($response === false) {
                return [false, $error !== '' ? $error : 'Error HTTP con cURL'];
            }

            return [$response, ''];
        }

        [$cliResponse, $cliError] = p2p_json_post_via_curl_cli($url, $jsonBody);
        if ($cliResponse !== false) {
            return [$cliResponse, ''];
        }

        if (!in_array('https', stream_get_wrappers(), true)) {
            return [false, 'PHP no tiene soporte HTTPS (openssl deshabilitado) y curl.exe no pudo ejecutarse: ' . $cliError];
        }

        $context = stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => "Content-Type: application/json\r\n",
                'content' => $jsonBody,
                'ignore_errors' => true,
                'timeout' => 45,
            ],
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
        ]);

        $response = @file_get_contents($url, false, $context);
        if ($response === false) {
            $lastError = error_get_last();
            $errorMessage = $lastError['message'] ?? 'Error HTTP sin cURL';
            return [false, $errorMessage];
        }

        return [$response, ''];
    }
}
