<?php
declare(strict_types=1);

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;


class ProcessImpactWindowLeadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**Create a new job instance.*/
    public function __construct(
        public array $leadData
    )
    {
    }

    /**Execute the job.*/
    public function handle(): void
    {
        Log::info('== SERVICE PROCESS EXTERIOR LEAD ===');
        Log::info('Processing impact window lead in Florida');
        Log::info('Client: '.$this->leadData['name']);
        Log::info('Zone (Zip Code): '.$this->leadData['zip']);
        Log::info('======================');
    }
}
