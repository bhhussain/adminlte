<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Advance;
use Auth;


class AdvancehistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr['advances'] = Advance::where('ca_comp_code', auth()->user()->company)
            ->orderBy('ID', 'desc')->get();
        return view('admin.advancehistory.index')->with($arr);
    }

    public function advpending()
    {
        //  $arr['advances'] = Advance::where('ca_comp_code', auth()->user()->company)
        //    ->where('ca_status', 1)
        //  ->orderBy('ID', 'desc')->get();
        //return view('admin.advancehistory.advpending')->with($arr);

        $arr['advances'] = Advance::where('ca_comp_code', auth()->user()->company)
            ->where('ca_status', 1)
            ->groupBy('ca_emp_id', 'ca_emp_name')
            ->selectRaw('ca_emp_id,ca_emp_name,sum(ca_adv_amt) as total')
            ->get();
        return view('admin.advancehistory.advpending')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
