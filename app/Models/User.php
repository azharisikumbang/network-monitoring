<?php

namespace App\Models;

use App\Observers\UserObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

#[ObservedBy(UserObserver::class)]
class User extends Authenticatable implements AuditableContract
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasUuids, SoftDeletes, Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'contact',
        'is_active',
        'role_id',
        'branch_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    #[Scope]
    protected function manager(Builder $query)
    {
        $query->where(
            'role_id',
            Role::where('name', Role::ROLE_BRANCH_MANAGER)->first()->id
        );
    }

    public function technicianBranch(): BelongsTo
    {
        return $this
            ->belongsTo(Branch::class, 'branch_id');
    }

    public function branches(): HasMany
    {
        return $this->hasMany(Branch::class, 'manager_id');
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function hasRole(string|Role $role): bool
    {
        if (is_string($role))
        {
            $role = strtolower($role);

            return strtolower($this->role->name) === $role || $this->role->id === $role;
        }

        return $this->role->id == $role->id;
    }

    public function isAdministrator(): bool
    {
        return $this->hasRole(Role::ROLE_ADMINISTRATOR);
    }


    public function isBranchManger(): bool
    {
        return $this->hasRole(Role::ROLE_BRANCH_MANAGER);
    }

    public function isTechnician(): bool
    {
        return $this->hasRole(Role::ROLE_TECHNICIAN);
    }
}
