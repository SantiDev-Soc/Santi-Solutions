<?php
declare(strict_types=1);

namespace App\Jobs;

use App\Models\Record;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class RecordActivityJob implements ShouldQueue
{
    use Queueable, Dispatchable;

    /**
     * Create a new job instance.
     */
    public function __construct(public array $data)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info("Audit Worker procesando datos...", [
            'payload' => $this->data
        ]);

        try {
            Record::create([
                'service_name' => $this->data['service'] ?? 'gateway',
                'event_type' => $this->data['event'] ?? 'test',
                'payload' => json_encode($this->data['payload'] ?? [], JSON_THROW_ON_ERROR),
            ]);

            Log::info("¡Guardado en DB con éxito!");
        } catch (Exception $e) {
            Log::error("Error al guardar en Audit DB: " . $e->getMessage());
        }
    }
}
