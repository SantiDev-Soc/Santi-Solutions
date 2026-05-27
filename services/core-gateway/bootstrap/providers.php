<?php
declare(strict_types=1);

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\Filament\SantiPanelProvider::class,
    App\Providers\FortifyServiceProvider::class,
    Santi\Leads\Infrastructure\Providers\LeadServiceProvider::class
];
