<?php

namespace Plance\Controllers\Profile;

use Plance\Repositories\UserRepository;
use Plance\Services\Profile\Exceptions\ValidationException;
use Plance\Services\Profile\ProfileService;
use Plance\Support\SafeRedirect;

class ProfileUpdateController
{
    private ProfileService $service;

    public function __construct(?ProfileService $service = null)
    {
        $this->service = $service ?? new ProfileService(new UserRepository());
    }

    public function handle(array $post, array $files): void
    {
        $userId = (int) ($_SESSION['user_id'] ?? 0);
        $accion = $post['accion'] ?? '';
        $redirect = SafeRedirect::resolve($post['redirect'] ?? null, 'index.php');

        try {
            $mensaje = match ($accion) {
                'foto' => $this->service->actualizarFoto($userId, $files['foto'] ?? []),
                'usuario' => $this->actualizarUsuario($userId, (string) ($post['usuario'] ?? '')),
                'correo' => $this->actualizarCorreo($userId, (string) ($post['correo'] ?? '')),
                'bio' => $this->service->actualizarBio($userId, (string) ($post['bio'] ?? '')),
                'location' => $this->service->actualizarLocation($userId, (string) ($post['location'] ?? '')),
                'password' => $this->service->actualizarPassword(
                    $userId,
                    (string) ($post['password_actual'] ?? ''),
                    (string) ($post['password_nuevo'] ?? ''),
                    (string) ($post['password_confirmar'] ?? '')
                ),
                default => null,
            };
        } catch (ValidationException $e) {
            $_SESSION['profile_msg'] = $e->getMessage();
            $_SESSION['profile_msg_type'] = 'error';
            header('Location: ' . $redirect);
            exit();
        }

        if ($mensaje !== null) {
            $_SESSION['profile_msg'] = $mensaje;
            $_SESSION['profile_msg_type'] = 'success';
        }

        header('Location: ' . $redirect);
        exit();
    }

    private function actualizarUsuario(int $userId, string $nuevo): string
    {
        $mensaje = $this->service->actualizarUsuario($userId, $nuevo);
        $_SESSION['usuario'] = trim($nuevo);

        return $mensaje;
    }

    private function actualizarCorreo(int $userId, string $nuevo): string
    {
        $mensaje = $this->service->actualizarCorreo($userId, $nuevo);
        $_SESSION['correo'] = trim($nuevo);

        return $mensaje;
    }
}
