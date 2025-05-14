<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    /** @use HasFactory<\Database\Factories\RoleFactory> */
    use HasFactory, HasUuids;

    const ROLE_ADMINISTRATOR = 'ADMINISTRATOR';

    protected $fillable = [
        'name',
        'as'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function isAdministrator(): bool
    {
        return strtoupper($this->name) == self::ROLE_ADMINISTRATOR;
    }
}
