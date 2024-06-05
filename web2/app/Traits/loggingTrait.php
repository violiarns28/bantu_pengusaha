<?php

namespace App\Traits;

use App\Models\Logging;
use Illuminate\Http\Request;
use Exception;

trait loggingTrait {

    public function addLog($table, $user, $pkidint, $pkidstr, $action, $keterangan){

        Logging::create([
            'table' => $table,
            'user' => $user,
            'pkidint' => $pkidint,
            'pkidstr' => $pkidstr,
            'action' => $action,
            'keterangan' => $keterangan,
        ]);
    }
}
