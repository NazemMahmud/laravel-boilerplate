<?php

namespace App\Traits;

use Carbon\Carbon;

trait DateTimer{

    static function convertToDate($date){
        return date('Y-m-d', strtotime($date));
    }

    static function dateTimeNow(){
        return Carbon::now();
    }
}
