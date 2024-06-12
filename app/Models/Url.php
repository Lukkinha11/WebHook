<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Url extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
    ];

    public function requests(): HasMany
    {
        return $this->hasMany(WebhookRequest::class);
    }
}
