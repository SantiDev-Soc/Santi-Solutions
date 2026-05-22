<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Santi\Leads\Application\CapturedLead\CapturedLeadCommand;
use Santi\Leads\Application\CapturedLead\CapturedLeadHandler;
use Santi\Leads\Domain\ValueObjects\LeadId;

class LeadController extends Controller
{
    public function __construct(
        private CapturedLeadHandler $handler
    ) {}

    public function __invoke(): JsonResponse
    {
        $command = new CapturedLeadCommand(
            LeadId::random(),
            "Santi Solutions Test",
            "test@santisolutions.com"
        );

        ($this->handler)($command);

        return response()->json(['message' => 'Lead captured and event sent to Redis!']);
    }
}
