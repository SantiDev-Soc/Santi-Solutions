<?php
declare(strict_types=1);

namespace App\Console\Commands;

//use App\Jobs\ProcessImpactWindowLeadJob;
use App\Jobs\RecordActivityJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use JsonException;

class TestEventSystemCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'santi:test-event-system';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'sent a test lead to event bus';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = [
            'service' => 'gateway',
            'event' => 'LeadCaptured',
            'payload' => ['name' => 'Prueba Final', 'email' => 'test@test.com']
        ];

        // Usamos dispatch() sobre el JOB que creamos para el Auditor
        // Esto obligará a Laravel a meterlo en Redis (queues:default)
        RecordActivityJob::dispatch($data);

        $this->info("Job enviado a Redis satisfactoriamente.");
    }
}
