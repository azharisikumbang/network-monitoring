<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Branch extends Model implements AuditableContract
{
    /** @use HasFactory<\Database\Factories\BranchFactory> */
    use HasFactory, HasUuids, SoftDeletes, Auditable;

    protected $fillable = [
        'name',
        'province',
        'city',
        'is_active',
        'manager_id'
    ];

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function technicians(): HasMany
    {
        return $this->hasMany(User::class, 'branch_id');
    }

    public function sites(): HasMany
    {
        return $this->hasMany(Site::class);
    }

    #[Scope]
    protected function active(Builder $query)
    {
        $query->where('is_active', true);
    }
}
