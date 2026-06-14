<?php
declare (strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class RedisAuditSubscriberCommand extends Command
{

    protected $signature = 'santi:audit-listen';

    protected $description = 'Escucha Redis y guarda logs';

    public function handle(): void
    {
        $this->info("Escuchando eventos de Santi Solutions...");

        $redis = Redis::connection();
        $redis->client()->setOption(\Redis::OPT_READ_TIMEOUT, -1);

        $redis->subscribe(['santi_solutions_events'], function (string $message) {

            DB::purge('pgsql');
            DB::reconnect('pgsql');

            $data = json_decode($message, true, 512, JSON_THROW_ON_ERROR);

            \Illuminate\Support\Facades\Log::info("¡REDIS ME HA DICHO ALGO!"); // <--- Añade esto

            $this->info("Evento recibido: " . ($data['event_name'] ?? 'desconocido'));

            try {
                \App\Models\Record::create([
                    'service_name' => 'redis-bus',
                    'event_type' => $data['event_name'] ?? 'generic',
                    'payload' => $data['payload'] ?? [],
                ]);
                $this->info("✔ Guardado en DB con éxito.");
            } catch (\Exception $e) {
                $this->error("ERROR AL GUARDAR: " . $e->getMessage());
                \Illuminate\Support\Facades\Log::error("Error en Audit: " . $e->getMessage());
            }
        });
    }
}
