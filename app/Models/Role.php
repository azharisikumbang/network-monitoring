<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Role extends Model implements AuditableContract
{
    /** @use HasFactory<\Database\Factories\RoleFactory> */
    use HasFactory, HasUuids, SoftDeletes, Auditable;

    const ROLE_ADMINISTRATOR = 'ADMINISTRATOR';
    const ROLE_BRANCH_MANAGER = 'BRANCH_MANAGER';
    const ROLE_TECHNICIAN = 'TECHNICIAN';

    protected $fillable = [
        'name',
        'as',
        'default'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function isCannotDeleted(): bool
    {
        return $this->default;
    }
}
