<?php

namespace App\Http\Controllers\Api;

use App\Models\Terminal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TerminalRequestStore;

class TerminalController extends Controller
{
    public function index()
    {
        $terminals = Terminal::paginate(15);
        return response()->json($terminals);
    }

    public function store(TerminalRequestStore $request)
    {
        $terminal = Terminal::create($request->all());

        return response()->json(['status' => true, 'data' => $terminal]);
    }

    public function update(Terminal $terminal, Request $request)
    {
        $validate = $request->validate([
            'code' => 'required',
            'name' => 'required',
            'address' => 'required',
            'provinsi' => 'required',
            'kecamatan' => 'required',
            'kota' => 'required',
            'tipe' => 'required|in:' . Terminal::TIPE_CHECKPOINT . ',' . Terminal::TIPE_TERMINAL . ',' . Terminal::TIPE_PUL
        ]);

        $terminal->code = $request->code;
        $terminal->name = $request->name;
        $terminal->address = $request->address;
        $terminal->provinsi = $request->provinsi;
        $terminal->kecamatan = $request->kecamatan;
        $terminal->kota = $request->kota;
        $terminal->tipe = $request->tipe;
        $terminal->save();

        return response()->json($terminal);
    }

    public function destroy(Terminal $terminal)
    {
        $terminal->delete();

        return response()->json(['status' => true, 'data' => $terminal]);
    }
}
