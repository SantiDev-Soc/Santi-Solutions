<?php
declare(strict_types=1);

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;

class RecordActivityJob implements ShouldQueue
{
    use Queueable, Dispatchable;

    public function __construct(public array $data)
    {
    }

    public function handle(): void
    {
    }
}
