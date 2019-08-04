<?php

namespace App\Http\Controllers;

use App\models;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TraficController extends Controller {

    public function index(Request $request) {
        try {
            $res = models\Trafic::firstOrNew(['ip' => $request->ip, 'archived' => '0']);
            $res->ip = $request->ip;
            $res->site_id = htmlspecialchars($request->site_id);
            $res->installed = $request->installed;
            $res->save();
            $result = ['result' => true, 'installed' => (($request->installed <> 0) ? true : false), 'site' => $res->site_id];
        } catch (\Illuminate\Database\QueryException $e) {
            abort(404);
            return;
        }

        return $result;
    }

    public function show() {
        $res = DB::select('SELECT site_id, date(created_at) as cdate , sum(installed) as inst, count(*) as cnt FROM trafics WHERE archived=0 GROUP BY cdate,site_id ORDER BY cdate DESC');
        return view('admin.install', ['res' => $res]);
    }
    
    public function showArchived() {
        $res = DB::select('SELECT site_id, date(created_at) as cdate , sum(installed) as inst, count(*) as cnt FROM trafics WHERE archived=1 GROUP BY cdate,site_id ORDER BY cdate DESC');
        return view('admin.installArchived', ['res' => $res]);
    }    
    
    public function archive(){
        $res = DB::update('UPDATE trafics SET archived=1');
         return ['result' => true];
    }

}
