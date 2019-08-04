<?php

namespace App\Http\Controllers;

use App\models\userResponses as userReponse;
use App\models\Analytic as stat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WeatherController extends Controller {

    public function getData(Request $request) {
        try {
            $response = json_decode(file_get_contents('http://api.worldweatheronline.com/premium/v1/weather.ashx?key=' . env('API_WEATHER_KEY') . '&q=' . $request->lat . ',' . $request->lon . '&format=json&num_of_days=7&lang=ru&includelocation=yes&tp=1&cc=no', true));
            $obj = new \stdClass();
            $obj->weather = new \stdClass();
            $obj->weather->{'area'} = $response->data->nearest_area[0]->areaName[0]->value ?? 'Unknown city';
            $obj->weather->{'country'} = $response->data->nearest_area[0]->areaName[0]->value ?? 'Unknown city';
            $obj->weather->{'d' . $response->data->weather[0]->date} = $response->data->weather[0];
            $obj->weather->{'d' . $response->data->weather[1]->date} = $response->data->weather[1];
            $obj->weather->{'d' . $response->data->weather[2]->date} = $response->data->weather[2];
            $obj->weather->{'d' . $response->data->weather[3]->date} = $response->data->weather[3];
            $obj->weather->{'d' . $response->data->weather[4]->date} = $response->data->weather[4];
            $obj->weather->{'d' . $response->data->weather[5]->date} = $response->data->weather[5];
            $obj->weather->{'d' . $response->data->weather[6]->date} = $response->data->weather[6];


            if (Storage::drive('local')->path('compressed.txt')) {
                $hash = md5_file(Storage::drive('local')->path('compressed.txt'));
                if ($hash != $request->hash) {
                    $obj->template = (Storage::disk('local')->has('compressed.txt')) ? Storage::get('compressed.txt') : '';
                    $obj->hash = $hash;
                }
            }
            
            

            $res = userReponse::where('unique_id', '=', $request->uniqueID)->get();

            if (!$res->isEmpty()){
                foreach($res as $row){
                    if (!(date_format($row->updated_at, 'Y-m-d')==date_format(\Carbon\Carbon::now(), 'Y-m-d'))) stat::updateResponse($request, $obj);
                }
            }
            else stat::updateResponse($request, $obj);

            $r = userReponse::updateUser($request, $response);

            $obj->updateInterval = 8;
            $obj->result = true;

            unset($response);
            return response()->json($obj);
        } catch (\Exception $e) {
            return ['result' => false,
                'error_message' => $e->getMessage()];
        }
    }

}
