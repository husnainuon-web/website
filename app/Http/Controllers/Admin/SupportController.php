<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SupportController extends Controller
{
    public function index(): View
    {
        $tickets = DB::table('support_tickets')->orderByDesc('created_at')->paginate(15);
        $tickets->getCollection()->transform(function ($ticket) {
            $ticket->created_at = Carbon::parse($ticket->created_at);
            $ticket->user = DB::table('users')->where('id', $ticket->user_id)->first();

            return $ticket;
        });

        return view('admin.support.index', compact('tickets'));
    }

    public function show(int $supportTicket): View
    {
        $supportTicket = $this->findTicket($supportTicket);

        return view('admin.support.show', compact('supportTicket'));
    }

    public function update(Request $request, int $supportTicket): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,in_progress,resolved,closed'],
            'admin_reply' => ['nullable', 'string'],
        ]);

        DB::table('support_tickets')->where('id', $supportTicket)->firstOrFail();
        DB::table('support_tickets')->where('id', $supportTicket)->update([
            'status' => $validated['status'],
            'admin_reply' => $validated['admin_reply'] ?? null,
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.support.show', $supportTicket)->with('success', 'Support ticket updated.');
    }

    private function findTicket(int $ticketId): object
    {
        $ticket = DB::table('support_tickets')->where('id', $ticketId)->firstOrFail();
        $ticket->created_at = Carbon::parse($ticket->created_at);
        $ticket->updated_at = Carbon::parse($ticket->updated_at);
        $ticket->user = DB::table('users')->where('id', $ticket->user_id)->first();

        return $ticket;
    }
}