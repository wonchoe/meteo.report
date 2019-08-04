<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class EditorController extends Controller {

    public function show() {
        return view('admin.editor');
    }

    public function getCode() {
        $data = Storage::get('raw.txt');
        return Response()->json(['data' => $data,
                    'result' => true]);
    }

    public function setCode(Request $request) {
        $data = $request->codeValue;

        $yui = new \YUI\Compressor();
        $yui->setType(\YUI\Compressor::TYPE_JS);
        try {
            $optimizedScript = $yui->compress($data);
            Storage::put('compressed.txt', $optimizedScript);
            Storage::put('raw.txt', $data);
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            $msg = substr($msg, 0, strpos($msg, 'org.mozilla.javascript.EvaluatorException'));
            return Response()->json(['data' => $msg,
                    'result' => false]);            
        }

        return Response()->json(['data' => $request->codeValue,
                    'result' => true]);
    }

}
