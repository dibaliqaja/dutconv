<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgencyRequest;
use App\Models\Agency;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $agencies = Agency::latest()->paginate(10);
        $keyword = $request->keyword;
        if ($keyword) $agencies = Agency::where('name', 'LIKE', "%$keyword%")->latest()->paginate(10);        

        return view('agencies.index', compact('agencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\AgencyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AgencyRequest $request)
    {
        Agency::create($request->all());

        return redirect()->route('agencies.index')
            ->with('alert', 'Instansi berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\AgencyRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AgencyRequest $request, $id)
    {
        $agency = Agency::findOrFail($id);
        $agency->update($request->all());

        return redirect()->route('agencies.index')
            ->with('alert', 'Instansi berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agency = Agency::findOrFail($id);
        $agency->delete();

        return redirect()->route('agencies.index')
            ->with('alert', 'Instansi berhasil dihapus.');
    }
}
