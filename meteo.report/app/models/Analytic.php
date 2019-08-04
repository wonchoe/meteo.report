<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Analytic extends Model {

    protected $fillable = ['date'];
    
    public static function updateResponse($request, $obj) {
        
        $stat = Analytic::firstOrNew(['date' => date_format(\Carbon\Carbon::now(),'Y-m-d')]);
        $stat->date = \Carbon\Carbon::now();
        $stat->increment('response');
        $stat->area = $obj->weather->area . ':' . $obj->weather->country;
        $stat->save();
    }
}
