<?php

namespace Plance\Controllers\Profile;

use Plance\Repositories\UserRepository;

class ProfileEditController
{
    public function __construct(private UserRepository $users = new UserRepository())
    {
    }

    public function handle(): array
    {
        $userId = (int) ($_SESSION['user_id'] ?? 0);
        $row = $this->users->findById($userId);

        if ($row === null) {
            header('Location: ../login.php');
            exit();
        }

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
