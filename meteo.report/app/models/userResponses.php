<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class userResponses extends Model {

    public static function updateUser($request, $response) {
        $r = \DB::statement('INSERT INTO user_responses(ip_address, unique_id, user_agent, country, region, city, weather_data, updated_at, created_at) VALUES(?, ?, ?, ?, ?, ?, ?,?,?)'
                        . 'ON DUPLICATE KEY UPDATE count=count+1, updated_at=NOW(), count_today = '
                        . 'CASE WHEN DATE(updated_at)<>CURDATE() THEN '
                        . '0 ELSE count_today+1 END;', [
                    $request->ip(),
                    $request->uniqueID,
                    $request->server('HTTP_USER_AGENT'),
                    $response->data->nearest_area[0]->country[0]->value,
                    $response->data->nearest_area[0]->region[0]->value,
                    $response->data->nearest_area[0]->areaName[0]->value,
                    json_encode($response),
                    NOW(),
                    NOW()
        ]);
    }
    
}
