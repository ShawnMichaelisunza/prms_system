<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function selectAllUserService()
    {
        $users = User::orderBy('created_at', 'DESC')->paginate(10);
        return $users;
    }

    public function storeUserService($data)
    {
        $user = User::create($data);
        return $user;
    }

    public function editUserService($id)
    {
        $decryptedEditUserId = decrypt($id);
        $user = User::findOrFail($decryptedEditUserId);

        return $user;
    }

    public function updateUserService($id, $data)
    {
        $decryptedUpdateUserId = decrypt($id);
        $user = User::findOrFail($decryptedUpdateUserId);
        $user->update($data);

        return $user;
    }

    public function destroyUserService($id){

        $decryptedDeleteUserId = decrypt($id);
        $user = User::findOrFail($decryptedDeleteUserId);
        $user->delete();

        return $user;
    }
}
