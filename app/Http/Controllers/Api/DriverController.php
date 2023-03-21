<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::paginate(15);
        return response()->json($drivers);
    }

    public function show(Driver $driver)
    {
        return $driver;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_reg' => 'required',
            'name' => 'required',
            'address' => 'required',
            'phone_no' => 'required',
        ]);

        $driver = Driver::create($request->all());

        return response()->json(['status' => true, 'data' => $driver]);
    }

    public function update(Driver $driver, Request $request)
    {
        $validated = $request->validate([
            'no_reg' => 'required',
            'name' => 'required',
            'address' => 'required',
            'phone_no' => 'required',
        ]);

        $driver->no_reg = $request->no_reg;
        $driver->name = $request->name;
        $driver->address = $request->address;
        $driver->phone_no = $request->phone_no;
        $driver->save();

        return response()->json(['status' => true, 'data' => $driver]);
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();
        return response()->json(['status' => true]);
    }
}
