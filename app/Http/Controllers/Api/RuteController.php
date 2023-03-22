<?php

namespace App\Http\Controllers\Api;

use App\Models\Rute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Terminal;

class RuteController extends Controller
{
    public function index()
    {
        $rutes = Rute::select(['id', 'asal', 'tujuan', 'kode', 'waktu_tempuh'])->paginate(15);
        return response()->json($rutes);
    }


    public function store(Request $request)
    {
        $validate = $request->validate([
            'asal' => 'required',
            'tujuan' => 'required',
            'kode' => 'required',
            'waktu_tempuh' => 'required|int',
            'checkpoints' => 'required|array'
        ]);

        $rute = Rute::create([
            'asal' => $request->asal,
            'tujuan' => $request->tujuan,
            'kode' => $request->kode,
            'waktu_tempuh' => $request->waktu_tempuh,
            'checkpoints' => json_encode($request->checkpoints),
        ]);

        $rute->checkpoints = json_decode($rute->checkpoints, true);

        $getTerminal = Terminal::whereIn('id', array_column($rute->checkpoints, "id"))
            ->select('id', 'code', 'name', 'kota', 'address')
            ->get();

        $rute->checkpoints = array_map(function ($item) use ($getTerminal) {
            $item['terminal'] = $getTerminal->where('id', $item['id'])->first();
            return $item;
        }, $rute->checkpoints);
        return response()->json($rute);
    }


    public function show(Rute $rute)
    {
        $rute->checkpoints = json_decode($rute->checkpoints, true);
        $getTerminal = Terminal::whereIn('id', array_column($rute->checkpoints, "id"))
            ->select('id', 'code', 'name', 'kota', 'address')
            ->get();
        $rute->checkpoints = array_map(function ($item) use ($getTerminal) {
            $item['terminal'] = $getTerminal->where('id', $item['id'])->first();
            return $item;
        }, $rute->checkpoints);
        return $rute;
    }



    public function update(Request $request, Rute $rute)
    {
        $validate = $request->validate([
            'asal' => 'required',
            'tujuan' => 'required',
            'kode' => 'required',
            'waktu_tempuh' => 'required|int',
            'checkpoints' => 'required|array'
        ]);

        $rute->asal = $request->asal;
        $rute->tujuan = $request->tujuan;
        $rute->kode = $request->kode;
        $rute->waktu_tempuh = $request->waktu_tempuh;
        $rute->checkpoints = json_encode($request->checkpoints);
        $rute->save();

        $rute->checkpoints = json_decode($rute->checkpoints, true);

        $getTerminal = Terminal::whereIn('id', array_column($rute->checkpoints, "id"))
            ->select('id', 'code', 'name', 'kota', 'address')
            ->get();

        $rute->checkpoints = array_map(function ($item) use ($getTerminal) {
            $item['terminal'] = $getTerminal->where('id', $item['id'])->first();
            return $item;
        }, $rute->checkpoints);
        return response()->json($rute);
    }


    public function destroy(Rute $rute)
    {
        $rute->delete();

        return response()->json(['status' => true]);
    }
}
