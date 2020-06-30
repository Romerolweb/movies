<?php

namespace App\Traits;

use App\Change;
use App\LogUser;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

trait LogUserT{

    protected function create_log( $action, $section, $object, $actual_value, $initial_value = null )
    {          
        $user = Auth::user();
        $log = $object->logusers()->create([
            'user_id' => $user->id,
            'action' => $action,
            'section' => $section,
            'object_name' => $object['name'],
            'initial_value' => $initial_value,
            'actual_value' => $actual_value,
        ]);
    }

}
