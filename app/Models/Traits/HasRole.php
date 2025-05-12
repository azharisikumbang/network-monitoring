<?php

namespace App\Models\Traits;

trait HasRole
{
    const ROLE_ADMINISTRATOR = 'administrator';
    const ROLE_NOC = 'noc';
    const ROLE_TECHNICIAN = 'technician';

    public function hasRole(string $role)
    {
        return $this->role == $role;
    }

    public function isAdministrator(): bool
    {
        return $this->role === self::ROLE_ADMINISTRATOR;
    }

    public function isNOC(): bool
    {
        return $this->role === self::ROLE_NOC;
    }

    public function isTechnician(): bool
    {
        return $this->role === self::ROLE_TECHNICIAN;
    }
}