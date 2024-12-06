<?php 

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    /**
     * Récupérer le nombre total d'utilisateurs
     */
    public function getTotalUsers()
    {
        return User::count();
    }

}
