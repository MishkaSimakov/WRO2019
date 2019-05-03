<?php

namespace App\Http\Controllers;

use App\Status;
use function compact;
use function dd;
use Illuminate\Http\Request;
use function view;

class StatusController extends Controller
{
    public function show(Status $status)
    {
        return view('statuses.show', compact('status'));
    }

    public function update(Request $request, Status $status)
    {
        $status->update(['name' => $request->name]);
        $status->update(['color' => $request->color]);
        $status->update(['issue' => $request->issue]);
        $status->update(['code' => $request->code]);

        return redirect(route('statuses.show', $status));
    }

    public function create(Request $request)
    {
        $status = Status::make();

        $status->name = $request->name;

        if ($status->color) {
            $status->color = $request->color;
        } else {
            $status->color = "#000000";
        }

        $status->save();

        return redirect(route('create'));
    }
}