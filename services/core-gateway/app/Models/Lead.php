<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Lead extends Model
{
    protected $table = 'leads';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id', 'name','email', 'phone', 'zip_code', 'interest', 'status', 'budget_estimate'];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(static function ($model) {
            $model->id = (string) Str::uuid();
        });
    }
}
