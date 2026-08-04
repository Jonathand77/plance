<?php

namespace Plance\Controllers\Profile;

use Plance\Repositories\OrdenRepository;
use Plance\Repositories\UserRepository;
use Plance\Services\Profile\ProfileService;
use Plance\Services\Profile\ThemeService;
use Plance\Support\Auth;

class SettingsController
{
    public function __construct(
        private ?ProfileService $profileService = null,
        private ?UserRepository $users = null,
        private ?OrdenRepository $ordenes = null,
        private ?ThemeService $theme = null
    ) {
        $this->profileService ??= new ProfileService(new UserRepository());
        $this->users ??= new UserRepository();
        $this->ordenes ??= new OrdenRepository();
        $this->theme ??= new ThemeService();
    }

    public function handle(array $post, string $method): array
    {
        $userId = (int) ($_SESSION['user_id'] ?? 0);
        $esInvitado = Auth::esInvitado();
        $row = $userId > 0 ? $this->users->findById($userId) : null;

        if ($row === null && !$esInvitado) {
            header('Location: ../login.php');
            exit();
        }

        $row ??= ['id' => '-', 'usuario' => 'Invitado', 'correo' => '', 'location' => '', 'profile_image' => null];
        $correo = $row['correo'];

        $alerta = '';
        $alertaTipo = '';

        if ($method === 'POST' && isset($post['tema'])) {
            $tema = $this->theme->guardar($correo, $esInvitado, (string) $post['tema']);
            setcookie('tema', $tema, time() + 60 * 60 * 24 * 365, '/');
            $alerta = 'Tema actualizado correctamente.';
            $alertaTipo = 'success';
        } elseif ($method === 'POST' && !$esInvitado) {
            $bio = trim((string) ($post['bio'] ?? ''));
            $location = trim((string) ($post['location'] ?? ''));

            try {
                $this->profileService->actualizarBioYLocation($userId, $bio, $location);
                $alerta = 'Configuración actualizada correctamente.';
                $alertaTipo = 'success';
                $row = $this->users->findById($userId);
            } catch (\Throwable $e) {
                $alerta = 'No se pudo actualizar la configuración.';
                $alertaTipo = 'error';
            }
        }

        $avatar = '';
        $uploadPath = dirname(__DIR__, 3) . '/public/uploads/' . ($row['profile_image'] ?? '');
        if (!empty($row['profile_image']) && file_exists($uploadPath)) {
            $avatar = '../uploads/' . htmlspecialchars($row['profile_image']);
        }

        return [
            'row' => $row,
            'alerta' => $alerta,
            'alertaTipo' => $alertaTipo,
            'esInvitado' => $esInvitado,
            'tema' => $this->theme->obtener($correo, $esInvitado),
            'totalOrdenes' => $esInvitado ? 0 : $this->ordenes->countByCorreo($correo),
            'totalAprobadas' => $esInvitado ? 0 : $this->ordenes->countByCorreoYEstado($correo, 'aprobada'),
            'totalRechazadas' => $esInvitado ? 0 : $this->ordenes->countByCorreoYEstado($correo, 'rechazada'),
            'totalPendientes' => $esInvitado ? 0 : $this->ordenes->countByCorreoYEstado($correo, 'pendiente'),
            'avatar' => $avatar,
            'initial' => strtoupper(substr($row['usuario'] ?? 'U', 0, 1)),
        ];
    }
}
