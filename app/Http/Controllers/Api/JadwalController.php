<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Rute;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::whereDate('berangkat', now())->paginate(15);
        return response()->json($jadwals);
    }

    public function show(Jadwal $jadwal)
    {
        return $jadwal;
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'bus_id' => 'required|exists:buses,id',
            'driver_id' => 'required|exists:drivers,id',
            'rute_id' => 'required|exists:rutes,id',
            'berangkat' => 'required',
        ]);

        $rute = Rute::findOrFail($request->rute_id);
        $berangkat = (new Carbon($request->berangkat))->toImmutable();
        $tiba = $berangkat->addMinutes($rute->waktu_tempuh);

        $jadwal = Jadwal::create([
            'bus_id' => $request->bus_id,
            'driver_id' => $request->driver_id,
            'rute_id' => $request->rute_id,
            'berangkat' => $berangkat,
            'tiba' => $tiba,
            'status' => Jadwal::NGY
        ]);

        return response()->json(['data' => $jadwal]);
    }

    public function update(Request $request, Jadwal $jadwal)
    {
        $validate = $request->validate([
            'bus_id' => 'required|exists:buses,id',
            'driver_id' => 'required|exists:drivers,id',
            'rute_id' => 'required|exists:rutes,id',
            'berangkat' => 'required',
        ]);

        $rute = Rute::findOrFail($request->rute_id);
        $berangkat = (new Carbon($request->berangkat))->toImmutable();
        $tiba = $berangkat->addMinutes($rute->waktu_tempuh);

        $jadwal->bus_id = $request->bus_id;
        $jadwal->driver_id = $request->driver_id;
        $jadwal->rute_id = $request->rute_id;
        $jadwal->berangkat = $berangkat;
        $jadwal->tiba = $tiba;
        // $jadwal->status = Jadwal::NGY;
        $jadwal->save();

        return response()->json(['data' => $jadwal]);
    }

    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return response()->json(['status' => true]);
    }
}
