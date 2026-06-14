<?php
declare(strict_types=1);

namespace Santi\Leads\Infrastructure\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Santi\Leads\Application\CapturedLead\CapturedLeadCommand;
use Santi\Leads\Application\CapturedLead\CapturedLeadHandler;
use Santi\Shared\Domain\ValueObject\LeadId;

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
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|min:7|max:20',
            'zip' => 'required|string|size:5',
            'interest' => 'required|string|in:windows,remodeling,landscaping,efficiency',
            'budget' => 'required|string',
        ]);

        ($this->handler)(new CapturedLeadCommand(
            LeadId::random(),
            $data['name'],
            $data['email'],
            $data['phone'],
            $data['zip'],
            $data['interest'],
            $data['budget']
        ));

        return response()->json(['status' => 'success',
            'message' => 'Lead received and processed!'
        ], 201);
    }
}
