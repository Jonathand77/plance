<?php

namespace Plance\Controllers\Profile;

use Plance\Repositories\OrdenRepository;
use Plance\Repositories\UserRepository;
use Plance\Services\Profile\ProfileService;

class SettingsController
{
    public function __construct(
        private ?ProfileService $profileService = null,
        private ?UserRepository $users = null,
        private ?OrdenRepository $ordenes = null
    ) {
        $this->profileService ??= new ProfileService(new UserRepository());
        $this->users ??= new UserRepository();
        $this->ordenes ??= new OrdenRepository();
    }

    public function handle(array $post, string $method): array
    {
        $userId = (int) ($_SESSION['user_id'] ?? 0);
        $row = $this->users->findById($userId);

        if ($row === null) {
            header('Location: ../login.php');
            exit();
        }

        $alerta = '';
        $alertaTipo = '';

        if ($method === 'POST') {
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

        $correo = $row['correo'];

        $avatar = '';
        $uploadPath = dirname(__DIR__, 3) . '/public/uploads/' . $row['profile_image'];
        if (!empty($row['profile_image']) && file_exists($uploadPath)) {
            $avatar = '../uploads/' . htmlspecialchars($row['profile_image']);
        }

        return [
            'row' => $row,
            'alerta' => $alerta,
            'alertaTipo' => $alertaTipo,
            'totalOrdenes' => $this->ordenes->countByCorreo($correo),
            'totalAprobadas' => $this->ordenes->countByCorreoYEstado($correo, 'aprobada'),
            'totalRechazadas' => $this->ordenes->countByCorreoYEstado($correo, 'rechazada'),
            'totalPendientes' => $this->ordenes->countByCorreoYEstado($correo, 'pendiente'),
            'avatar' => $avatar,
            'initial' => strtoupper(substr($row['usuario'] ?? 'U', 0, 1)),
        ];
    }
}
