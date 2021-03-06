<?php

namespace App\Http\Controllers\Procurement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\ProductStock;

use Carbon\Carbon;

use Auth;
use App\User;
use Gate;

use App\Tenant;
use App\Brand;
use App\Purchaserequest;
use App\Purchaserequestitem;

class PurchaserequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr['purchaserequest'] = Purchaserequest::All();
        return view('procurement.purchaserequest.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Tenant $tenant, Brand $brand, User $user, Request $request)
    {


        $comp_id = Auth::user()->company;
        $tenant = Tenant::where('id', '=', $comp_id)->first();
        $brand = Brand::where('bm_tm_id', '=', $tenant->id)->orderBy('bm_name', 'asc')->get();

        //return back()->with('success', 'Record Created Successfully.')->with(['tenant' => $tenant, 'brand' => $brand, 'user' => $user]);

        return view('procurement.purchaserequest.create')->with(['tenant' => $tenant, 'brand' => $brand, 'user' => $user]);
    }

    public function addMorePost_working(Request $request, Tenant $tenant, Brand $brand, User $user)
    {
        $request->validate([
            'addmore.*.name' => 'required',
            'addmore.*.qty' => 'required',
            'addmore.*.price' => 'required',
        ]);

        foreach ($request->addmore as $key => $value) {
            ProductStock::create($value);
        }



        $comp_id = Auth::user()->company;
        $tenant = Tenant::where('id', '=', $comp_id)->first();
        $brand = Brand::where('bm_tm_id', '=', $tenant->id)->orderBy('bm_name', 'asc')->get();

        return back()->with('success', 'Record Created Successfully.')->with(['tenant' => $tenant, 'brand' => $brand, 'user' => $user]);
    }


    public function addMorePost(Request $request, Purchaserequest $purchaserequest, Purchaserequestitem $purchaserequestitem)
    {


        $id = Purchaserequest::where('pr_req_comp_code', auth()->user()->company)
            ->first()->pr_req_no ?? date('Y') . 00000;
        $year = date('Y');
        $id_year = substr($id, 0, 4);
        $seq = $year <> $id_year ? 0 : +substr($id, -5);
        $new_id = sprintf("%0+4u%0+6u", $year, $seq + 1);
        // $purchaserequest->pr_req_no = $new_id;


        $lastAccountForCurrentYear = Purchaserequest::where('pr_req_comp_code', auth()->user()->company)
            ->where('pr_req_no', 'like', date('Y') . '%') // filter for current year numbers
            ->orderByDesc('pr_req_no', 'desc') // the biggist one first
            ->first();

        $purchaserequest->pr_req_no = $lastAccountForCurrentYear
            ? ($lastAccountForCurrentYear->pr_req_no + 1) // just increase value to 1
            : (date('Y') . $digitRepresentingASerie . '00001');

        $new_id = $purchaserequest->pr_req_no;
        $purchaserequest->pr_req_no = $new_id;



        //  dd($purchaserequest->id);


        foreach ($request->addmore as $key => $value) {



            if (!empty($value['pri_item'])) {
                $purchaserequestitem = new Purchaserequestitem;
                $purchaserequestitem->pri_item = $value['pri_item'];
                $purchaserequestitem->pri_qty = $value['pri_qty'];
                $purchaserequestitem->pri_price = $value['pri_price'];
                $purchaserequestitem->pri_amount = $value['pri_qty'] * $value['pri_price'];
                $purchaserequestitem->pri_flex1 = $new_id;
                $purchaserequestitem->save();
                // $purchaserequest->purchaserequestitem()->save($purchaserequestitem);

            }
        }

        $purchaserequest->pr_req_name = $request->wp_applicant;
        $purchaserequest->pr_req_desi = $request->wp_designation;
        $purchaserequest->pr_req_mobile = $request->wp_mobile;
        $purchaserequest->pr_req_email = $request->wp_email;

        $purchaserequest->pr_req_comp_code = Auth::user()->company;

        if ((Auth::user()->company)  == 92) {

            $purchaserequest->pr_req_comp_name = 'Mall Of Muscat';
        } else if ((Auth::user()->company)  == 34) {

            $purchaserequest->pr_req_comp_name = 'Oman Aquarium';
        } else {

            $purchaserequest->pr_req_comp_name = 'Al Jarwani';
        }


        $purchaserequest->save();



        return redirect('procurement/purchaserequest')->with('success', 'Record Created Successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->name as $key => $value) {

            if ($request->qty[$key]) {
                $ProductStock = resolve(ProductStock::class);
                $ProductStock->name = $request->name[$key];
                $ProductStock->qty = $request->qty[$key];
                $ProductStock->price = $request->price[$key];

                $ProductStock->save();
                // $account->item()->save($item);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Purchaserequest $purchaserequest, Purchaserequestitem $purchaserequestitem)
    {
        // dd($purchaserequest);
        // return view('procurement.purchaserequest.show', compact('purchaserequest'));


        $purchaserequestitems = Purchaserequestitem::where('pri_flex1', $purchaserequest->pr_req_no)->orderBy('id', 'asc')->Get();



        return view('procurement.purchaserequest.show')->with(['purchaserequest' => $purchaserequest, 'purchaserequestitems' => $purchaserequestitems]);
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
