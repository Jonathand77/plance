<?php

namespace Plance\Controllers\Auth;

use Plance\Repositories\UserRepository;
use Plance\Services\Auth\AuthService;
use Plance\Services\Auth\Exceptions\AuthException;
use Plance\Services\Profile\ThemeService;

class LoginController
{
    private AuthService $auth;

    public function __construct(?AuthService $auth = null)
    {
        $this->auth = $auth ?? new AuthService(new UserRepository());
    }

    public function handle(array $post): void
    {
        $correo = trim((string) ($post['correo'] ?? ''));
        $contrasena = (string) ($post['contrasena'] ?? '');

        try {
            $user = $this->auth->login($correo, $contrasena);
        } catch (AuthException $e) {
            $this->redirectWithAlert($e->getMessage(), '../login.php');
            return;
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['usuario'] = $user['usuario'];
        $_SESSION['correo'] = $user['correo'];

        $tema = (new ThemeService())->obtener($user['correo'], false);
        setcookie('tema', $tema, time() + 60 * 60 * 24 * 365, '/');

        header('Location: ../index.php');
        exit();
    }

    private function redirectWithAlert(string $message, string $url): void
    {
        echo '<script>alert(' . json_encode($message) . '); window.location=' . json_encode($url) . ';</script>';
        exit();
    }
}
