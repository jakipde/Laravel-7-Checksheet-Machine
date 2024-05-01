<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Main;

class MainController extends Controller
{
    public function index()
    {
        $mains = Main::all();
    
        return view('main.index', compact('mains'));
    }    

    // public function refresh()
    // {
    //     $mains = Main::where('line_id', '168')
    //         ->whereIn('defect_name', ['PF_RETRY', 'PF_NG', 'ATSU_RETRY', 'ATSU_NG'])
    //         ->get();
    
    //     return response()->json(['mains' => $mains]);
    // }    
    
    public function fetchExternalData()
    {
        $results = DB::connection('cmt')->select("
            SELECT TOP 1000
                [line_id],
                [block_no],
                [shift],
                [date],
                [defect_name],
                [quantity],
                [id],
                [quantity_correction]
            FROM [Chcecksheet_Machine_Tokusei].[dbo].[inline_defect]
        ");

        return view('main.index', ['results' => $results]);
    }

    public function create()
    {
        // Fetch data from the external database
        $externalData = DB::connection('cmt')->select("
            SELECT TOP 1000
                [line_id],
                [block_no],
                [shift],
                [date],
                [defect_name],
                [quantity],
                [id],
                [quantity_correction]
            FROM [Chcecksheet_Machine_Tokusei].[dbo].[inline_defect]
        ");

        // Return the fetched data to the view
        return view('main.create', ['externalData' => $externalData]);
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'line_id' => 'required',
            'block_no' => 'required',
            'shift' => 'required',
            'date' => 'required',
            'defect_name' => 'required',
            'quantity' => 'required',
            'id' => 'required',
            'quantity_correction' => 'required',
        ]);

        // Store the validated data in your application's database
        // For example, assuming Main is your model for storing data
        $main = new Main;
        $main->line_id = $request->line_id;
        $main->block_no = $request->block_no;
        $main->shift = $request->shift;
        $main->date = $request->date;
        $main->defect_name = $request->defect_name;
        $main->quantity = $request->quantity;
        $main->id = $request->id;
        $main->quantity_correction = $request->quantity_correction;
        $main->save();

        // Redirect back to the create page with a success message
        return redirect()->route('main.create')->with('success', 'Data berhasil disimpan');
    }

    // public function show($id)
    // {
    //     $main = Main::findOrFail($id);
    //     return view('main.show', compact('main'));
    // }
    

    // public function edit(Main $main)
    // {
    //     $parts = Part::all();
    //     $customers = Customer::all();
    //     $raks = Rak::all();
    
    //     return view('main.edit', compact('main', 'parts', 'customers', 'raks'));
    // }

    // public function update(Request $request, Main $main)
    // {
    //     $validatedData = $request->validate([
    //         'part_id' => 'required',
    //         'customer_id' => 'required',
    //         'rak_id' => 'required',
    //         'shift' => 'required|in:A,B,C',
    //         'in' => 'required|integer|min:1|max:100',
    //         'out' => 'required|integer|min:1|max:100',
    //         'sisa' => 'required|integer|min:1|max:100',
    //         'pic' => 'required|in:MFG,QC',
    //         'pic_name' => 'required|string',
    //         'keterangan' => 'nullable',
    //     ]);
    
    //     $main->part_id = $validatedData['part_id'];
    //     $main->customer_id = $validatedData['customer_id'];
    //     $main->rak_id = $validatedData['rak_id'];
    //     $main->shift = $validatedData['shift'];
    //     $main->in = $validatedData['in'];
    //     $main->out = $validatedData['out'];
    //     $main->sisa = $validatedData['sisa'];
    //     $main->pic = $validatedData['pic'];
    //     $main->pic_name = $validatedData['pic_name'];
    //     $main->keterangan = $validatedData['keterangan'];
    
    //     $main->save();
    
    //     return redirect()->route('main.index')->with('success', 'Berhasil Diperbarui');
    // }

    public function destroy(Main $main)
    {
        $main->delete();
        return redirect()->route('main.index')->with('success', 'Data berhasil dihapus');
    }
}
