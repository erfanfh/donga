<?php

namespace App\Actions\Support;

use App\Models\Ticket;

class CreateTicketAction {
    /**
     * @param array $ticket
     *
     * @return \App\Models\Ticket
     */
    public function execute(array $ticket) : Ticket
    {
        return auth()->user()->tickets()->create([
            'title' => $ticket['name'],
            'status' => 1,
            'description' => $ticket['description'],
            'category' => $ticket['category'],
            'section' => $ticket['section'],
        ]);
    }
}
