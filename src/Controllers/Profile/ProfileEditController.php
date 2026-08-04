<?php

namespace Plance\Controllers\Profile;

use Plance\Repositories\UserRepository;
use Plance\Support\Auth;

class ProfileEditController
{
    public function __construct(private UserRepository $users = new UserRepository())
    {
    }

    public function handle(): array
    {
        $userId = (int) ($_SESSION['user_id'] ?? 0);
        $row = $userId > 0 ? $this->users->findById($userId) : null;

        if ($row === null && !Auth::esInvitado()) {
            header('Location: ../login.php');
            exit();
        }

        $row ??= ['id' => '-', 'usuario' => 'Invitado', 'correo' => '', 'bio' => '', 'location' => '', 'profile_image' => null];

        $msg = $_SESSION['profile_msg'] ?? '';
        $msgType = $_SESSION['profile_msg_type'] ?? '';
        unset($_SESSION['profile_msg'], $_SESSION['profile_msg_type']);

        return [
            'row' => $row,
            'msg' => $msg,
            'msgType' => $msgType,
        ];
    }
}
