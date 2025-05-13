<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Node extends Model
{
    /** @use HasFactory<\Database\Factories\NodeFactory> */
    use HasFactory, HasUlids;

    const DEFAULT_SSH_PORT = 22;
    const DEFAULT_SNMP_PORT = 161;

    protected $fillable = [
        'name',
        'ip_address',
        'network_address',
        'type',
        'description',
        'config_snmp_port',
        'config_snmp_key',
        'config_ssh_port',
        'config_ssh_public_key',
        'is_active',
        'site_id'
    ];

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }
}
