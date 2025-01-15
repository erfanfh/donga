<?php

namespace App\Http\Middleware;

use App\Models\Ticket;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClosedTickets
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ticket = $request->route('ticket');
        if ($ticket->status == "بسته") {
            return redirect()->back()->with('notification-error', 'تیکت موردنظر بسته است');
        }
        return $next($request);
    }
}
