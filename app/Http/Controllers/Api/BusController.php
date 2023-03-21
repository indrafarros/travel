<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusRequestStore;
use App\Models\Bus;
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function index()
    {
        $buses = Bus::paginate(15);
        return response()->json($buses);
    }

    public function store(BusRequestStore $request)
    {
        $bus = Bus::create([
            'plat_number' => $request->plat_number,
            'bus_number' => $request->bus_number,
            'distributor' => $request->distributor,
            'size' =>  $request->size
        ]);

        return response()->json(['status' => true, 'data' => $bus]);
    }

    public function show(Bus $bus)
    {
        return $bus;
    }

    public function update(Bus $bus, BusRequestStore $request)
    {
        $bus->plat_number = $request->plat_number;
        $bus->bus_number = $request->bus_number;
        $bus->distributor = $request->distributor;
        $bus->size = $request->size;
        $bus->save();

        return response()->json(['status' => true, 'data' => $bus]);
    }

    public function destroy(Bus $bus)
    {
        $bus->delete();
        return response()->json(['status' => true, 'data' => $bus]);
    }
}
