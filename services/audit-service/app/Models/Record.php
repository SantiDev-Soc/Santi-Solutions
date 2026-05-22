<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Record extends Model
{
    protected $table = 'activity_logs';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'service_name',
        'event_type',
        'payload',
    ];

    protected $casts = [
        'payload' => 'array',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(static function ($model) {
            $model->id = (string) Str::uuid();
        });
    }
}
