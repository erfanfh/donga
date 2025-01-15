<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SupportController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index() : View
    {
        $tickets = auth()->user()->tickets()->paginate(10);

        return view('support.index', compact('tickets'));
    }

    /**
     * @param \App\Models\Ticket $ticket
     *
     * @return \Illuminate\View\View
     */
    public function show(Ticket $ticket) : View
    {
        return view('support.show', compact('ticket'));
    }

    /**
     * @param \App\Models\Ticket $ticket
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function closeTicket(Ticket $ticket) : RedirectResponse
    {
        $ticket->update(['status' => 0]);

        return redirect()->back()->with('notification-success', 'تیکت مورد نظر با موفقیت بسته شد.');
    }
}
