<?php

namespace App\Actions\User;

use App\Models\Person;

class DestroyUserAction
{
    /**
     * @param \App\Models\Person $person
     *
     * @return void
     */
    public function execute(Person $person): void
    {
        $person->delete();
    }
}
