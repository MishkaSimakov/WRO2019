<?php

namespace App;

use function compact;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use function optional;
use function route;
use function var_dump;

class Sensor extends Model
{
    protected $fillable = ['min_value', 'max_value', 'name', 'units'];

    static function getId(Request $request) {
        if (Sensor::where('model', $request->sensor_name)->exists()) {
            $sensor_id = Sensor::where('model', $request->sensor_name)->first()->id;
        } else {
            $sensor = Sensor::make();

            $sensor->name = $request->sensor_name;
            $sensor->model = $request->sensor_name;
            $sensor->max_value = 10;
            $sensor->min_value = 9;
            $sensor->units = "вы можете изменить значение";

            $sensor->save();

            $sensor_id = $sensor->id;
        }

        return $sensor_id;
    }
}
