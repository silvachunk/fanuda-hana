<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'language',
        'birthday',
        'trust_score',
        'persona_id',
        'last_seen',
        'preferred_name',
        'relationship_stage'
    ];

    // Relationships
    public function memories()
    {
        return $this->hasMany(Memory::class);
    }

    public function trustEvents()
    {
        return $this->hasMany(TrustEvent::class);
    }

    public function boundaries()
    {
        return $this->hasMany(Boundary::class);
    }
}
