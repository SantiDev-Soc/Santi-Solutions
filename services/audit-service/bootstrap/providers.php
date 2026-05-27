<?php

use App\Providers\AppServiceProvider;
use Santi\Audit\Infrastructure\Providers\AuditServiceProvider;

return [
    AppServiceProvider::class,
    AuditServiceProvider::class,
];
