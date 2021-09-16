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
        $query = Customer::select('id', 'name', 'email', 'created_at');
        if ($request->ajax()) {
            if (request('date_filter')) {
                $filter_date = now()->subDays(request('date_filter'))->toDateString();
                info($filter_date);
                $query->where('created_at', '>=', $filter_date);
            }
            return DataTables::of($query)->make(true);
        }

        $customers = Customer::all();
        $names =  $customers->sortBy('name')->pluck('name')->unique();
        $emails =  $customers->sortBy('email')->pluck('email')->unique();

        return view('customers.datatable', compact('names', 'emails'));
    }
}
