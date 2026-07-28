<?php

namespace Plance\Services\Payments;

use Plance\Config\Env;

class PlaceToPayClient
{
    private string $baseUrl;

    public function __construct(?string $baseUrl = null)
    {
        $this->baseUrl = $baseUrl ?? Env::get('P2P_BASE_URL', 'https://checkout-test.placetopay.com');

        require_once __DIR__ . '/../../../public/php/http_client.php';
    }

    /**
     * Consulta el estado de una sesión de PlaceToPay. Reproduce exactamente la firma
     * HMAC y la llamada que antes vivía duplicada en cada retorno_*.php.
     */
    public function querySession(string $requestId, string $tipo = 'estandar'): array
    {
        [$response] = \p2p_json_post($this->baseUrl . '/api/session/' . $requestId, $this->buildAuth($tipo));

        return json_decode($response ?: '{}', true);
    }

    /**
     * Crea una nueva sesión de checkout (POST /api/session), usada por los crear_*.php
     * para iniciar un pago/preautorización y obtener el processUrl de PlaceToPay.
     */
    public function createSession(array $body, string $tipo = 'estandar'): array
    {
        $auth = $this->buildAuth($tipo);
        $body = $auth + $body;

        [$response, $curlError] = \p2p_json_post($this->baseUrl . '/api/session', $body);

        if ($curlError) {
            throw new \RuntimeException('Error de conexión: ' . $curlError);
        }

        return json_decode($response ?: '{}', true);
    }

    /**
     * Procesa un pago síncrono vía el API Gateway (POST /rest/gateway/process),
     * usado por los flujos que cobran directo con tarjeta/cuenta sin redirect a Web Checkout.
     */
    public function processGateway(array $body, string $tipo = 'estandar'): array
    {
        $auth = $this->buildAuth($tipo);
        $body = $auth + $body;

        $gatewayUrl = Env::get('P2P_GATEWAY_BASE_URL', 'https://api-test.placetopay.com');

        [$response] = \p2p_json_post($gatewayUrl . '/rest/gateway/process', $body);

        return json_decode($response ?: '{}', true);
    }

    /**
     * Genera un link de pago compartible (POST /api/payment-link) en el sitio
     * de "Payment Sites" de PlaceToPay, usado por el flujo de link de pago de Textil.
     */
    public function createPaymentLink(array $body, string $tipo = 'estandar'): array
    {
        $auth = $this->buildAuth($tipo);
        $body = $auth + $body;

        $sitesUrl = Env::get('P2P_SITES_BASE_URL', 'https://sites-test.placetopay.com');

        [$response] = \p2p_json_post($sitesUrl . '/api/payment-link', $body);

        return json_decode($response ?: '{}', true);
    }

    private function buildAuth(string $tipo): array
    {
        $seed = date('c');
        $nonce = bin2hex(random_bytes(16));
        $secretKey = PlaceToPayCredentials::secretKey($tipo);
        $tranKey = base64_encode(hash('sha256', $nonce . $seed . $secretKey, true));
        $nonceB64 = base64_encode($nonce);

        return [
            'auth' => [
                'login' => PlaceToPayCredentials::login($tipo),
                'tranKey' => $tranKey,
                'nonce' => $nonceB64,
                'seed' => $seed,
            ],
        ];
    }
}
