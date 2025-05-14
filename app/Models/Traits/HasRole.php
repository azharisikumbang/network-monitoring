<?php

namespace App\Models\Traits;

trait HasRole
{
    const ROLE_ADMINISTRATOR = 'ADMINSITRATOR';
    const ROLE_BRANCH_MANAGER = 'BRANCH_MANAGER';
    const ROLE_TECHNICIAN = 'TECHNICIAN';

    public function hasRole(string $role)
    {
        return $this->role == $role;
    }

    public function isAdministrator(): bool
    {
        return $this->role === self::ROLE_ADMINISTRATOR;
    }

    public function isBranchManger(): bool
    {
        return $this->role === self::ROLE_BRANCH_MANAGER;
    }

    public function isTechnician(): bool
    {
        return $this->role === self::ROLE_TECHNICIAN;
    }
}