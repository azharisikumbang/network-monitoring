<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Site extends Model implements AuditableContract
{
    /** @use HasFactory<\Database\Factories\SiteFactory> */
    use HasFactory, HasUuids, SoftDeletes, Auditable;

    const CONTRACT_UPLOAD_PATH = 'contracts';

    protected $fillable = [
        'terminal_id',
        'name',
        'province',
        'city',
        'address',
        'latitude',
        'longitude',
        'is_active',
        'contract_document',
        'branch_id',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function nodes(): HasMany
    {
        return $this->hasMany(Node::class);
    }
}
