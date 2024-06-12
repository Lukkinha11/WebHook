<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WebhookRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'url_id',
        'method',
        'headers',
        'ip',
        'body',
    ];
    
    protected function casts(): array
    {
        return [
            'headers' => 'array',
        ];
    }

    public function url(): BelongsTo
    {
        return $this->belongsTo(Url::class);
    }
}
