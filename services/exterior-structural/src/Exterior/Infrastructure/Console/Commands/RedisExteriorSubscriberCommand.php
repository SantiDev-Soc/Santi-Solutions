<?php
declare(strict_types=1);

namespace Santi\Exterior\Infrastructure\Console\Commands;

use App\Models\Project;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class RedisExteriorSubscriberCommand extends Command
{
    protected $signature = 'santi:exterior-listen';
    protected $description = 'Escucha el bus de eventos para procesos de ventanas';

    public function handle(): void
    {
        $this->info("Servicio de Ventanas (Exterior) escuchando...");

        $redis = Redis::connection();
        $redis->client()->setOption(\Redis::OPT_READ_TIMEOUT, -1);

        $redis->subscribe(['santi_solutions_events'], function (string $message) {

            DB::purge('pgsql');
            DB::reconnect('pgsql');

            $data = json_decode($message, true, 512, JSON_THROW_ON_ERROR);
            $eventName = $data['event_name'];

            if ($eventName === 'leads.captured' && ($data['payload']['interest'] ?? '') === 'windows') {
                $this->info("¡Lead para ventanas recibido! Guardando...");

                Project::updateOrCreate(
                    ['id' => $data['aggregate_id']],
                    [
                        'name' => $data['payload']['name'],
                        'email' => $data['payload']['email'],
                        'status' => 'pending_quote'
                    ]
                );
            }
        });
    }
}
