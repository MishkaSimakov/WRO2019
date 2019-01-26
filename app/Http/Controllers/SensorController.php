<?php

namespace App\Http\Controllers;

use App\Sensor;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    public function create(Request $request)
    {
        $sensor = Sensor::make();

        $sensor->name = $request->name;
        $sensor->max_value = $request->max_value;
        $sensor->min_value = $request->min_value;
        $sensor->units = $request->units;

        $sensor->save();

        return redirect(route('create'));
    }
}
