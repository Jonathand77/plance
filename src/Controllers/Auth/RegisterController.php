<?php

namespace Plance\Controllers\Auth;

use Plance\Repositories\UserRepository;
use Plance\Services\Auth\AuthService;
use Plance\Services\Auth\Exceptions\AuthException;

class RegisterController
{
    private AuthService $auth;

    public function __construct(?AuthService $auth = null)
    {
        $this->auth = $auth ?? new AuthService(new UserRepository());
    }

    public function handle(array $post): void
    {
        try {
            $this->auth->register($post);
        } catch (AuthException $e) {
            $this->redirectWithAlert($e->getMessage(), '../login.php');
            return;
        }

        $this->redirectWithAlert('Usuario registrado exitosamente', '../login.php');
    }

    private function redirectWithAlert(string $message, string $url): void
    {
        echo '<script>alert(' . json_encode($message) . '); window.location=' . json_encode($url) . ';</script>';
        exit();
    }
}
