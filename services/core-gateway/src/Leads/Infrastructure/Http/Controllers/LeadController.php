<?php
declare(strict_types=1);

namespace Santi\Leads\Infrastructure\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Santi\Leads\Application\CapturedLead\CapturedLeadCommand;
use Santi\Leads\Application\CapturedLead\CapturedLeadHandler;
use Santi\Leads\Domain\ValueObjects\LeadId;

class LeadController extends Controller
{
    public function __construct(
        private readonly CapturedLeadHandler $handler,
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'zip' => 'required|string|max:5|min:5',
            'interest' => 'required|string'
        ]);

        $command = new CapturedLeadCommand(
            LeadId::random(),
            $data['name'],
            $data['email']
        );

        ($this->handler)($command);

        return response()->json(['status'  => 'success',
            'message' => 'Lead received and processed!'
        ], 201);
    }
}
