<?php
declare (strict_types=1);

namespace Santi\Audit\Application\Console\Commands;

use App\Models\Record;
use Illuminate\Console\Command;
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
            $data = json_decode($message, true, 512, JSON_THROW_ON_ERROR);

            $this->info("Evento recibido: " . ($data['event_name'] ?? 'desconocido'));

            $record = new Record();
            $record->service_name = 'redis-bus';
            $record->event_type = $data['event_name'] ?? 'generic';
            $record->payload = $data['payload'] ?? [];
            $record->save();
        });
    }
}
