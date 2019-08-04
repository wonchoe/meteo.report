<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\models\Analytic as Analytic;
use App\Http\Controllers\Controller;

class DashboardController extends Controller {

    public function show() {
        $dates = [];
        $responses = [];
        $r = Analytic::orderBy('date','desc')->paginate(30);
        foreach ($r as $item) {
            $dates[] = $item->date;
            $responses[] = $item->response;
        }
        if (!empty($dates)) {
            $dates = implode(',', $dates);
            $responses = implode(',', $responses);
        }

        return view('admin.index', ['analyticDate' => $r, 'dates' => $dates, 'responses' => $responses]);
    }

    //
}
