<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function table(Request $request)
    {
        $customers = Customer::latest()->paginate(10);
        $keyword = $request->keyword;
        if ($keyword) $customers = Customer::where('name', 'LIKE', "%$keyword%")->latest()->paginate(10);        

        return view('customers.table', compact('customers'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Customer::select('name', 'email'))->make(true);
        }

        return view('customers.datatable');
    }
}
