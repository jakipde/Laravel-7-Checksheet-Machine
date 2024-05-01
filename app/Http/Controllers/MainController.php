<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Main;

class MainController extends Controller
{
    public function index()
    {
        $mains = Main::all();
        return view('main.index', compact('mains'));
    }

    public function create()
    {
        return view('main.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'line_id' => 'required',
            'date' => 'required|date_format:Y-m-d',
            'pf_retry' => 'required',
            'pf_ng' => 'required',
            'atsu_retry' => 'required',
            'atsu_ng' => 'required',
        ]);
    
        Main::create($validatedData);
    
        return redirect()->route('main.index')->with('success', 'Data berhasil disimpan');
    }    
    public function destroy($date)
    {
        // Parse the date string and format it to match the datetime format in the database
        $datetime = date('Y-m-d H:i:s', strtotime($date));
    
        // Delete records where the date matches
        $affectedRows = Main::where('date', $datetime)->delete();
    
        if ($affectedRows > 0) {
            return redirect()->route('main.index')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->route('main.index')->with('error', 'Data tidak ditemukan');
        }
    }    
}
