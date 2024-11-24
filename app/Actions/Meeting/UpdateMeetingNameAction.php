<?php

namespace App\Actions\Meeting;

use App\Models\Meeting;

class UpdateMeetingNameAction
{

    /**
     * Change a meeting name in database
     *
     * @param \App\Models\Meeting $meeting
     * @param string $title
     *
     * @return void
     */
    public function execute(Meeting $meeting, string $title) : void
    {
        $meeting->update(['title' => $title]);
    }
}
